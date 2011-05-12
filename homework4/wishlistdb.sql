-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 03, 2011 at 10:02 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wishlistdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Category` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `priority` int(11) NOT NULL,
  `info` longtext NOT NULL,
  `picture` varchar(255) NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `Category`, `name`, `priority`, `info`, `picture`, `added`) VALUES
(1, 'Категория 2', 'Желание 2', 11, 'Няма налична информация', '', '2011-05-03 22:22:57'),
(2, 'Практични', 'Чаршаф', 5, 'Чаршаф с ластик хасе Ранфорс от <a href=''http://png.bg/catalog/69/1041''>тук</a>', 'sheet.png', '2011-05-03 16:31:13'),
(3, 'Практични', 'Бетонобъркачка', 4, 'Бетонобъркачка 150 литра, мощност 1000 W, метален венец, произведена в Словения от  <a href=''http://argo-market.com/ViewProduct.aspx?id=691''>тук</a>', 'mixer.png', '2011-05-03 16:31:13'),
(4, 'Идеали', 'Мир', 2, 'Мир в най-общия смисъл на думата означава обратното на война, или отсъствие на каквито и да е военни действия. В преносен смисъл означава спокойствие и хармония.\r\nЕдни от най-изявените представители на борбата за мир и ненасилие са Мартин Лутър Кинг и Махатма Ганди. Хипитата също прегръщат пацифизма като своя идеология.\r\nЗа запазването на мира на цялата планета са създадени различни организации. Една от функциите на Организацията на обединените нации (ООН) е именно поддържането на мира в света.', 'peace.jpg', '2011-05-03 06:35:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `level` tinyint(4) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `level`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'admin@admin.com'),
(3, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 0, 'user@admin.com');
