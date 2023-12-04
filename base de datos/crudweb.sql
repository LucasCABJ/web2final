-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 10, 2023 at 09:58 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id_task` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `content` varchar(255) NOT NULL,
  `completed` tinyint NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_task`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id_task`, `id_user`, `content`, `completed`) VALUES
(18, 17, '4', 0),
(19, 17, 'ewew', 0),
(15, 7, 'Ir a entrenar', 0),
(20, 17, 'casdasdDADA', 0),
(22, 17, 'ccSds', 0),
(23, 17, 'xADCAFA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `dni` text NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `admin` tinyint NOT NULL,
  `alumno` tinyint NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `firstname`, `lastname`, `dni`, `username`, `password`, `admin`, `alumno`) VALUES
(6, 'Lucas', 'Caraballo', '45238075', 'LucasCaraballo', 'AguanteWeb123.', 1, 0),
(7, 'Martina', 'Freyre', '44157601', 'MartinaFreyre', '123456', 1, 0),
(14, 'Juan Eduardo', 'Caraballo', '11499339', 'JuanCaraballo', 'Santa2844.', 0, 0),
(15, 'Guido', 'Luppino', '33642117', 'guidoluppino', 'Durkheim123.', 0, 0),
(16, 'Piru', 'Lito', '45934854', 'pirulito', 'Pirulito123.', 0, 0),
(17, 'Claudio', 'Sprejer', '34358563', 'Claudito', 'Claudito64.', 0, 0),
(18, 'Camilo', 'Diaz', '58965354', 'CamiloDiaz', 'Camilo123$', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
