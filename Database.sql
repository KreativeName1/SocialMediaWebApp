CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment primary key,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `gender` int(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image` varchar(255) NULL,
  `verified` boolean NOT NULL DEFAULT 0,
  `verification_code` varchar(255) NULL,
  `verification_code_expiration` timestamp NULL,
  `verfied_at` timestamp NULL,
  UNIQUE(`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- nicht relevant wenn es in Docker gestartet wird
CREATE DATABASE IF NOT EXISTS App;
CREATE USER IF NOT EXISTS 'App'@'localhost' IDENTIFIED BY 'App';
GRANT ALL PRIVILEGES ON App.* TO 'App'@'localhost';
FLUSH PRIVILEGES;
USE App;