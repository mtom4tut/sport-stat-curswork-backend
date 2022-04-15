<?php
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers: http://localhost:3000');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type, X-CSRF-Token');

// Подключение бд
$link = mysqli_connect("localhost", "root", "root", "sport_stat_coursework"); // подключение к бд в OpenServer

if (!$link) { // проверка соединения
  die("Ошибка соединения: " . mysqli_connect_error());
}

$_POST = json_decode(file_get_contents("php://input"), true);
mysqli_set_charset($link, "utf8"); // установка кодировки

session_id($_SERVER['HTTP_X_CSRF_TOKEN']);
session_start();