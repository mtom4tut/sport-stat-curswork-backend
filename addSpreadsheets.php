<?php
// Подключение бд
include_once("./config/init.php");

// Подключение функций
include_once("./functions/helpers.php");

if (isset($_POST['id'])) {
  $sql = "INSERT INTO spreadsheets SET id_user = ?, spreadsheet = ?";
  $res = db_insert_data($link, $sql, [$_SESSION['id_user'], $_POST['id']]);

  if (!$res) {
    echo 'Не удалось добавить таблицу';
  }
} else {
  echo 'Данные не корректны';
}
