<?php
header('Access-Control-Allow-Origin: *');

session_start(); // запуск сессии

// Подключение бд
$link = mysqli_connect("localhost", "root", "root", "coursework"); // подключение к бд в OpenServer

if (!$link) { // проверка соединения
  die("Ошибка соединения: " . mysqli_connect_error());
}

$_POST = json_decode(file_get_contents("php://input"), true);
mysqli_set_charset($link, "utf8"); // установка кодировки