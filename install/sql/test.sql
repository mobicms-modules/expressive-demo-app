--
-- Drop tables if exists
--
DROP TABLE IF EXISTS `test`;

--
-- Table structure for table `test`
--
CREATE TABLE `sessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_general_ci;

--
-- Дамп данных таблицы `test`
--
INSERT INTO `test` (`id`, `name`) VALUES
(1, 'Проверка слуха'),
(2, 'Еще кое что'),
(3, 'Ну и наконец...'),
(4, 'Заключительная проверка');
