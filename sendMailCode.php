<?php
// Подключение бд
include_once("./config/init.php");

// Подключение функций
include_once("./functions/helpers.php");

// Подключение библиотек
include_once('./vendor/autoload.php');

if (isset($_POST['mail'])) {
  // Создание транспорта
  $transport = (new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl'))
    ->setUsername('junepc20@mail.ru')
    ->setPassword('tE0kg3GS04yY9qRXAcGQ');

  // Создание почтовой программы, используя созданный транспорт
  $mailer = new Swift_Mailer($transport);

  $code = mt_rand(100000, 999999);

  $_SESSION['code'] = $code;

  // Создание шаблона
  $msg_content = include_template('mail.php', ['code' => $code]);

  $message = (new Swift_Message('Подтверждение регистрации «Sport Stat»'))
    ->setFrom(['junepc20@mail.ru' => 'Sport Stat']) // отправитель
    ->setTo($_POST['mail']) // получатель
    ->setBody($msg_content, 'text/html');

  $result = $mailer->send($message); // отправляем письмо

  echo $result;
}
exit();
