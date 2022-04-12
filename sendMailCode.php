<?php
// Подключение бд
include_once("./config/init.php");

// Константы
include_once("./config/const.php");

// Подключение функций
include_once("./functions/helpers.php");

// Подключение библиотек
include_once('./vendor/autoload.php');

if (isset($_POST['mail'])) {
  $err = validEmail($link, $_POST['mail']);

  if ($err) {
    echo $err;
    exit();
  }

  // Создание транспорта
  $transport = (new Swift_SmtpTransport($SMTP_HOST, 465, 'ssl'))
    ->setUsername($MAIL)
    ->setPassword($MAIL_TOKEN);

  // Создание почтовой программы, используя созданный транспорт
  $mailer = new Swift_Mailer($transport);
  $mailer->getTransport()->stop();

  $_SESSION['code'] = mt_rand(100000, 999999);

  // Создание шаблона
  $msg_content = include_template('mail.php', ['code' => $_SESSION['code']]);

  $message = (new Swift_Message('Подтверждение регистрации «Sport Stat»'))
    ->setFrom([$MAIL => 'Sport Stat']) // отправитель
    ->setTo($_POST['mail']) // получатель
    ->setBody($msg_content, 'text/html');

  $result = $mailer->send($message); // отправляем письмо
  if ($result) {
    $_SESSION['mail'] = $_POST['mail'];
    $_SESSION['code_count'] = 0;
  } else {
    echo 'Ошибка, не удалось отправит письмо с кодом для подтверждения!';
  }
} else {
  echo 'Ошибка, не удалось обработать данные!';
}
exit();
