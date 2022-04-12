<?php
// Подключение бд
include_once("./config/init.php");

// Константы
include_once("./config/const.php");

// Подключение функций
include_once("./functions/helpers.php");

// Подключение библиотек
include_once('./vendor/autoload.php');

if (isset($_POST['mail']) && isset($_POST['code']) && isset($_POST['password']) && isset($_POST['passwordCheck'])) {
  $err = validEmail($link, $_POST['mail']);

  if ($err) {
    echo $err;
    exit();
  }

  if ((int)$_POST['code'] !== $_SESSION['code']) {
    echo 'Код не корректен';
    exit();
  }

  if ($_POST['password'] !== $_POST['passwordCheck']) {
    echo 'Пароли не совпадают';
    exit();
  }

  $sql = "INSERT INTO users SET mail = ?, password = ?";
  $data = [$_POST["mail"], password_hash($_POST['password'], PASSWORD_DEFAULT)];
  $res = db_insert_data($link, $sql, $data);

  if ($res) {
    unset($_SESSION['mail']);
    unset($_SESSION['code']);
    unset($_SESSION['code_count']);
  }
}
exit();
