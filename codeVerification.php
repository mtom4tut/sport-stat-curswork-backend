<?php
// Подключение бд
include_once("./config/init.php");

$CODE_LIMIT = 4;

if (isset($_POST['code']) && isset($_POST['mail'])) {
  session_id($_SERVER['HTTP_X_CSRF_TOKEN']);
  session_start();

  if ((int)$_POST['code'] !== $_SESSION['code']) {
    $_SESSION['code_count'] = $_SESSION['code_count'] + 1;

    if ($_SESSION['code_count'] >= $CODE_LIMIT) {
      unset($_SESSION['code']);
      echo 'Вы привысили допустимое количество попыток ввода';
    } else {
      $dif = $CODE_LIMIT - $_SESSION['code_count'];
      echo 'Осталось попыток ввода: ' . $dif;
    }
  } else {
    if ($_POST['mail'] !== $_SESSION['mail']) {
      echo 'Почта, не соответствует почте отправления!';
    }
  }
} else {
  echo 'Ошибка, не удалось обработать данные!';
}
exit();
