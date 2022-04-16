<?php
// Подключение бд
include_once("./config/init.php");

// Подключение функций
include_once("./functions/helpers.php");

$sql = "SELECT spreadsheet FROM spreadsheets WHERE id_user = ?";
$res = db_fetch_data($link, $sql, [$_SESSION['id_user']]);

if (!$res) {
  echo 'Не удалось добавить таблицу';
} else {
  $arr = [];

  foreach ($res as $value) {
    $arr[] = $value['spreadsheet'];
  }

  echo json_encode($arr);
}
