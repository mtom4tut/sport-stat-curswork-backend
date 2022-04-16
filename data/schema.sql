-- база данных
CREATE DATABASE IF NOT EXISTS sport_stat_coursework DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sport_stat_coursework;

-- БД пользователей
CREATE TABLE users (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,           -- id пользователя
  mail varchar(60) NOT NULL UNIQUE,                         -- маил
  password varchar(70) NOT NULL                             -- пароль
);

-- список таблиц пользователя
CREATE TABLE spreadsheets (
  id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,           -- id таблицы
  id_user int(11) NOT NULL,                                 -- id пользователя
  spreadsheet char(44) NOT NULL,                            -- ключ таблицы
  FOREIGN KEY (id_user) REFERENCES users(id)
);
