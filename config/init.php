<?php
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Headers: http://localhost:3000');
header('Set-Cookie: PHPSESSID=ht0vfqodo72ldi9i1sqp7sdlblud11n2; SameSite=None; Secure');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type, X-CSRF-Token, Accept');

session_id('ht0vfqodo72ldi9i1sqp7sdlblud11n2');
session_start();

// Подключение бд
$link = mysqli_connect("localhost", "root", "root", "sport_stat_coursework"); // подключение к бд в OpenServer

if (!$link) { // проверка соединения
  die("Ошибка соединения: " . mysqli_connect_error());
}

$_POST = json_decode(file_get_contents("php://input"), true);
mysqli_set_charset($link, "utf8"); // установка кодировки