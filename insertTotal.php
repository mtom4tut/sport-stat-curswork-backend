<?php
// Подключение бд
include_once("./config/init.php");

// Подключение функций
include_once("./functions/helpers.php");

$sql = "SELECT id FROM users WHERE mail = ?";
if (
  isset($_POST['id'])
  && isset(db_fetch_data($link, $sql, [$_POST['id']])[0])
) {
  exit();
}

if (
  isset($_POST['name_sportsmen'])
  && isset($_POST['weight_sportsmen'])
  && isset($_POST['age_sportsmen'])
  && isset($_POST['aerobic_p_legs'])
  && isset($_POST['aerobic_p_args'])
  && isset($_POST['heart_rate_aerobic_legs'])
  && isset($_POST['heart_rate_aerobic_args'])
  && isset($_POST['anaerobic_p_legs'])
  && isset($_POST['anaerobic_p_args'])
  && isset($_POST['heart_rate_anaerobic_legs'])
  && isset($_POST['heart_rate_anaerobic_args'])
  && isset($_POST['mpk_legs'])
  && isset($_POST['mpk_args'])
  && isset($_POST['yoc_max_legs'])
  && isset($_POST['yoc_max_args'])
) {
  $sql = "INSERT INTO totaldata SET id = ?, name_sportsmen = ?, weight_sportsmen = ?, age_sportsmen = ?, aerobic_p_legs = ?, aerobic_p_args = ?, heart_rate_aerobic_legs = ?, heart_rate_aerobic_args = ?, anaerobic_p_legs = ?, anaerobic_p_args = ?, heart_rate_anaerobic_legs = ?, heart_rate_anaerobic_args = ?, mpk_legs = ?, mpk_args = ?, yoc_max_legs = ?, yoc_max_args = ?;";

  $data = [
    $_POST['id'],
    $_POST['name_sportsmen'],
    $_POST['weight_sportsmen'],
    $_POST['age_sportsmen'],
    $_POST['aerobic_p_legs'],
    $_POST['aerobic_p_args'],
    $_POST['heart_rate_aerobic_legs'],
    $_POST['heart_rate_aerobic_args'],
    $_POST['anaerobic_p_legs'],
    $_POST['anaerobic_p_args'],
    $_POST['heart_rate_anaerobic_legs'],
    $_POST['heart_rate_anaerobic_args'],
    $_POST['mpk_legs'],
    $_POST['mpk_args'],
    $_POST['yoc_max_legs'],
    $_POST['yoc_max_args']
  ];
  $res = db_insert_data($link, $sql, $data);

  if (!$res) {
    echo 'Не удалось сохранить данные';
  }
} else {
  echo 'Ошибка данных';
}
exit();
