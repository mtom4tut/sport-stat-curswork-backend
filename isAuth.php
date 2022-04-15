<?php
// Подключение бд
include_once("./config/init.php");

if (!isset($_SESSION['user_id'])) {
  echo $_SERVER['HTTP_X_CSRF_TOKEN'];
}
