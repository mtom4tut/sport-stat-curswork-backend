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

-- итоговые данные
CREATE TABLE totaldata (
  id char(44) NOT NULL PRIMARY KEY,                         -- id таблицы
  name_sportsmen varchar(50) NOT NULL,                      -- имя спортсмена
  weight_sportsmen int(3) NOT NULL,                         -- вес спортсмена
  age_sportsmen int(2) NOT NULL,                            -- возраст спортсмена
  date_passing DATE NOT NULL,                               -- дата прохождения
  aerobic_p_legs float NOT NULL,                            -- Мощность, АэП, Вт ноги
  aerobic_p_args float NOT NULL,                            -- Мощность, АэП, Вт руки
  heart_rate_aerobic_legs float NOT NULL,                   -- ЧСС АэП, уд/мин ноги
  heart_rate_aerobic_args float NOT NULL,                   -- ЧСС АэП, уд/мин руки
  anaerobic_p_legs float NOT NULL,                          -- Мощность, АнП, Вт ноги
  anaerobic_p_args float NOT NULL,                          -- Мощность, АнП, Вт руки
  heart_rate_anaerobic_legs float NOT NULL,                 -- ЧСС АнП, уд/мин ноги
  heart_rate_anaerobic_args float NOT NULL,                 -- ЧСС АнП, уд/мин руки
  mpk_legs float NOT NULL,                                  -- Мощность МПК, Вт ноги
  mpk_args float NOT NULL,                                  -- Мощность МПК, Вт руки
  yoc_max_legs float NOT NULL,                              -- УОС max, мл ноги
  yoc_max_args float NOT NULL                               -- УОС max, мл руки
);
