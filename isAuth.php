<?php
// Подключение бд
include_once("./config/init.php");

if (isset($_SESSION['id_user'])) {
  echo 'true';
} else {
  echo 'false';
}
