<?php
// Подключение бд
include_once("./config/init.php");

// Подключение функций
include_once("./functions/helpers.php");

if (isset($_POST['id'])) {
  $sql = "DELETE FROM spreadsheets WHERE id_user = ? AND spreadsheet = ?";
  $res = db_insert_data($link, $sql, [$_SESSION['id_user'], $_POST['id']]);

  if ($res) {
    echo 'Не удалось удалить таблицу';
  }
} else {
  echo 'Данные не корректны';
}
