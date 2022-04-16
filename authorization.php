<?php
// Подключение бд
include_once("./config/init.php");

// Подключение функций
include_once("./functions/helpers.php");

if (isset($_POST['password']) && isset($_POST['mail'])) {
  $sql = "SELECT id, password FROM users WHERE mail = ?";
  $pass = db_fetch_data($link, $sql, [$_POST['mail']]);

  if (!isset($pass[0]['password'])) {
    echo 'Не верный e-mail';
    exit();
  }

  if (!password_verify($_POST['password'], $pass[0]['password'])) {
    echo "Неверный пароль";
    exit();
  }

  $_SESSION['id_user'] = $pass[0]['id'];
} else {
  echo 'Введите данные для входа';
}
exit();
