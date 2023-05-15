-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 15 2023 г., 17:36
-- Версия сервера: 5.7.39
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lr4`
--

-- --------------------------------------------------------

--
-- Структура таблицы `curs`
--

CREATE TABLE `curs` (
  `number_curs` int(11) NOT NULL,
  `mail_prepod` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_curs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `info_curs` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pred_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `curs`
--

INSERT INTO `curs` (`number_curs`, `mail_prepod`, `name_curs`, `info_curs`, `pred_num`) VALUES
(3, 'golubi@mail.ru', 'ГИС', 'Геоинформационные системы', NULL),
(4, 'gore@mail.ru', 'КС', 'Компьютерная схемотехника', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `prepod`
--

CREATE TABLE `prepod` (
  `mail` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FIO` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `prepod`
--

INSERT INTO `prepod` (`mail`, `FIO`, `password`) VALUES
('golubi@mail.ru', 'Голубев Алексей Дмитриевич', '1234'),
('gore@mail.ru', 'Горелов Петр Сергеевич', '1234');

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `mail` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FIO` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`mail`, `FIO`, `password`) VALUES
('anto@mail.ru', 'Антонов Виктор Сергеевич', '1234'),
('kucher@mail.ru', 'Кучерявых Александр Александрович', '1234'),
('my@mail.ru', 'Орлов Александр Леонидович', '1535');

-- --------------------------------------------------------

--
-- Структура таблицы `stud_curs`
--

CREATE TABLE `stud_curs` (
  `mail_stud` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_curs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `stud_curs`
--

INSERT INTO `stud_curs` (`mail_stud`, `number_curs`) VALUES
('my@mail.ru', 3),
('kucher@mail.ru', 3),
('anto@mail.ru', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `zanyat`
--

CREATE TABLE `zanyat` (
  `date` date NOT NULL,
  `number_aud` int(11) NOT NULL,
  `number_curs` int(11) NOT NULL,
  `zanyat_type` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `zanyat`
--

INSERT INTO `zanyat` (`date`, `number_aud`, `number_curs`, `zanyat_type`) VALUES
('2022-01-01', 113, 3, 'Л'),
('2022-01-01', 322, 4, 'ЛЗ'),
('2022-01-02', 11, 3, 'ПЗ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `curs`
--
ALTER TABLE `curs`
  ADD PRIMARY KEY (`number_curs`),
  ADD KEY `mail_prepod` (`mail_prepod`);

--
-- Индексы таблицы `prepod`
--
ALTER TABLE `prepod`
  ADD PRIMARY KEY (`mail`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`mail`);

--
-- Индексы таблицы `stud_curs`
--
ALTER TABLE `stud_curs`
  ADD KEY `number_curs` (`number_curs`),
  ADD KEY `stud_curs_ibfk_2` (`mail_stud`);

--
-- Индексы таблицы `zanyat`
--
ALTER TABLE `zanyat`
  ADD KEY `number_curs` (`number_curs`);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `curs`
--
ALTER TABLE `curs`
  ADD CONSTRAINT `curs_ibfk_1` FOREIGN KEY (`mail_prepod`) REFERENCES `prepod` (`mail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `stud_curs`
--
ALTER TABLE `stud_curs`
  ADD CONSTRAINT `stud_curs_ibfk_1` FOREIGN KEY (`number_curs`) REFERENCES `curs` (`number_curs`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stud_curs_ibfk_2` FOREIGN KEY (`mail_stud`) REFERENCES `student` (`mail`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `zanyat`
--
ALTER TABLE `zanyat`
  ADD CONSTRAINT `zanyat_ibfk_1` FOREIGN KEY (`number_curs`) REFERENCES `curs` (`number_curs`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
