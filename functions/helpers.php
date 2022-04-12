<?php

/**
 * Создает подготовленное выражение на основе готового SQL запроса и переданных данных
 *
 * @param mysqli $link mysqli Ресурс соединения
 * @param string $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_stmt Подготовленное выражение
 */
function db_get_prepare_stmt($link, $sql, $data = [])
{
  $stmt = mysqli_prepare($link, $sql);

  if ($stmt === false) {
    $errorMsg = 'Не удалось инициализировать подготовленное выражение: ' . mysqli_error($link);
    die($errorMsg);
  }

  if ($data) {
    $types = '';
    $stmt_data = [];

    foreach ($data as $value) {
      $type = 's';

      if (is_int($value)) {
        $type = 'i';
      } else if (is_string($value)) {
        $type = 's';
      } else if (is_double($value)) {
        $type = 'd';
      }

      if ($type) {
        $types .= $type;
        $stmt_data[] = $value;
      }
    }

    $values = array_merge([$stmt, $types], $stmt_data);

    $func = 'mysqli_stmt_bind_param';
    $func(...$values);

    if (mysqli_errno($link) > 0) {
      $errorMsg = 'Не удалось связать подготовленное выражение с параметрами: ' . mysqli_error($link);
      die($errorMsg);
    }
  }

  return $stmt;
}

/**
 * Получает записи в результате выполнения подготовленного выражения на основе готового SQL запроса и переданных данных
 *
 * @param mysqli $link mysqli Ресурс соединения
 * @param string $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_result Результат выполнения подготовленного выражения
 */
function db_fetch_data($link, $sql, $data = [])
{
  $result = [];
  $stmt = db_get_prepare_stmt($link, $sql, $data); // получение подготовленного выражения
  mysqli_stmt_execute($stmt); // Выполнение подготовленного выражения
  $res = mysqli_stmt_get_result($stmt); // Получение результата выполнеия подготовленного выражения

  if ($res) {
    $result = mysqli_fetch_all($res, MYSQLI_ASSOC); // преобразование в ассоциативный массив
  }

  return $result; // вернуть результат
}

/**
 * Добавляет новые записи в результате выполнения подготовленного выражения на основе готового SQL запроса и переданных данных
 *
 * @param mysqli $link mysqli Ресурс соединения
 * @param string $sql string SQL запрос с плейсхолдерами вместо значений
 * @param array $data Данные для вставки на место плейсхолдеров
 *
 * @return mysqli_result Добавление новой записи на основе подготовленного выражения
 */
function db_insert_data($link, $sql, $data = [])
{
  $stmt = db_get_prepare_stmt($link, $sql, $data); // получение подготовленного выражения
  $result = mysqli_stmt_execute($stmt); // Выполнение подготовленного выражения

  if ($result) {
    $result = mysqli_insert_id($link); // Возвращает последний ID
  }

  return $result; // вернуть результат
}

/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 *
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 *
 * @return string Итоговый HTML
 */
function include_template($name, array $data = [])
{
  $name = 'templates/' . $name;
  $result = '';

  // is_readable - проверят существование файла и его доступ для чтения
  if (!is_readable($name)) { // если не доступен, то вернуть $result
    return $result;
  }

  ob_start(); // включение буферизации вывода
  extract($data); // импортирует переменных из массива в таблицу символов
  require $name; // подключение файла, путь которого $name

  $result = ob_get_clean(); // получить содержимое текущего буфера и удалить его

  return $result; // вернуть $result
}

/**
 * Функция для проверки длинны текта
 *
 * @param string $name имя поля.
 * @param int $min минимальное число символов.
 * @param int $max максимальное число символов.
 *
 * @return bool если длинна не выйдет за пределы диапазона, то true, иначе false
 */
function is_correct_length($name, $min, $max)
{
  $len = strlen(trim($_POST[$name]));
  return $min < $len && $len < $max;
}

/**
 * Функция для проверки валидности email
 *
 * @param mysqli $link mysqli Ресурс соединения
 *
 * @return string строка с текстом ошибки
 */
function validEmail($link, $mail)
{
  if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
    return "Не верный e-mail адрес";
  }

  $sql = "SELECT id FROM users WHERE mail = ?";
  if (isset(db_fetch_data($link, $sql, [$mail])[0])) {
    return "Пользователь с этим e-mail уже зарегистрирован";
  }
}
