-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2017 at 10:57 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fluent_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` longtext,
  `city` varchar(200) DEFAULT NULL,
  `zipcode` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `city`, `zipcode`, `state`, `tel`, `fax`, `email`) VALUES
(1, 'Rajter Industries', 'Ivana Pl. Zajca', 'Čakovec', '40000', '-', '040/325-528', '040/325-529', 'rindustries@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `tel` varchar(200) DEFAULT NULL,
  `mob` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` longtext,
  `price` double NOT NULL,
  `code` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `item_type_id` int(11) NOT NULL,
  `item_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`item_type_id`,`item_status_id`),
  KEY `fk_items_item_type1_idx` (`item_type_id`),
  KEY `fk_items_item_status1_idx` (`item_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `price`, `code`, `image`, `item_type_id`, `item_status_id`) VALUES
(1, 'Kosilica', 'Kosilica', 1500.11, 'C12FBD88', 'Kosilica-600x600.jpg', 1, 2),
(2, 'Kutna', 'Flex', 800.46, '6A1EBD88', '1.jpg', 2, 2),
(4, 'Bušilica', 'Bušilica', 1250.45, '5821BD88', 'Busilica.jpeg', 1, 1),
(6, 'Škare', 'Skare za rezanje zivice', 185.81, 'AAADDD', 'Skare.jpeg', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_status`
--

DROP TABLE IF EXISTS `item_status`;
CREATE TABLE IF NOT EXISTS `item_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_status`
--

INSERT INTO `item_status` (`id`, `status`) VALUES
(1, 'Slobodan'),
(2, 'Zauzet'),
(3, 'Otpisan');

-- --------------------------------------------------------

--
-- Table structure for table `item_transactions`
--

DROP TABLE IF EXISTS `item_transactions`;
CREATE TABLE IF NOT EXISTS `item_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(10) NOT NULL,
  `item_id` int(11) NOT NULL,
  `date_taken` datetime NOT NULL,
  `date_returned` datetime DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `debtor_id` int(11) NOT NULL,
  `footnote` varchar(500) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`,`item_id`,`user_id`,`debtor_id`),
  KEY `fk_item_transactions_items1_idx` (`item_id`),
  KEY `fk_item_transactions_users1_idx` (`user_id`),
  KEY `fk_item_transactions_users2_idx` (`debtor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `item_transactions`
--

INSERT INTO `item_transactions` (`id`, `transaction_number`, `item_id`, `date_taken`, `date_returned`, `deadline`, `user_id`, `debtor_id`, `footnote`, `status`) VALUES
(10, '59ee2a5488', 1, '2017-10-23 00:00:00', '2017-10-30 19:45:54', '2017-10-25 00:00:00', 1, 4, 'Napomena za Marija', 1),
(11, '59ee2c1bd6', 6, '2017-10-23 00:00:00', '2017-10-28 12:48:01', '2017-10-31 00:00:00', 1, 2, 'Napomena', 1),
(14, '59fa02b95a', 6, '2017-10-29 00:00:00', '2017-11-01 18:22:18', '2017-10-31 00:00:00', 1, 4, '', 1),
(15, '59fa02d38b', 6, '2017-10-30 00:00:00', '2017-11-02 17:36:59', '2017-10-29 00:00:00', 1, 4, '', 1),
(16, '59fb49d50b', 4, '2017-10-29 00:00:00', NULL, '2017-11-02 00:00:00', 1, 4, '', 0),
(17, '59fb49df56', 6, '2017-11-02 00:00:00', NULL, '2017-11-16 00:00:00', 1, 3, '', 0),
(18, '59fb4b06c5', 1, '2017-11-02 00:00:00', NULL, '2017-11-10 00:00:00', 1, 4, '', 0),
(19, '59fb4b1053', 2, '2017-10-29 00:00:00', NULL, '2017-11-16 00:00:00', 1, 3, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `description`) VALUES
(1, 'Ručni alat', 'Alat pogonjen ljudskim radom'),
(2, 'Električni alat', 'Alat pogonjen elektricitetom');

-- --------------------------------------------------------

--
-- Table structure for table `overdues`
--

DROP TABLE IF EXISTS `overdues`;
CREATE TABLE IF NOT EXISTS `overdues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reason` longtext,
  `item_transaction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`item_transaction_id`),
  KEY `fk_overdues_item_transactions1_idx` (`item_transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(500) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `role` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `user_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`user_type_id`),
  KEY `fk_users_user_type_idx` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`, `role`, `image`, `login_date`, `user_type_id`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 'Admin', '-', 'Zaposlenik', 'avatar4.png', '2017-11-02 22:09:52', 1),
(2, 'Andrija', '50a45fe7b3a3a8fe92ae51d895d9dcd8', 'andrija@gmail.com', 'Andrija', 'Rajter', 'Zaposlenik', 'avatar5.png', '2017-10-23 23:22:35', 2),
(3, 'Maja', 'afb16009c37c8db88beb7c181573349e', 'majag@gmail.com', 'Maja', 'Gregoric', 'Zaposlenik', 'avatar2.png', '2017-10-23 23:21:07', 1),
(4, 'Mario', '1cc477616bb182e87ec7285bfbf8c34b', 'mario@marilo.com', 'Mario', 'M', 'Zaposlenik', 'avatar.png', '2017-11-02 21:54:44', 2),
(6, 'Iva', 'e845ca4629a181d32d8e438bec2bf867', 'ivad@gmail.com', 'Iva', 'David', 'Zaposlenik', 'avatar3.png', '2017-11-02 22:10:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

DROP TABLE IF EXISTS `user_type`;
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `description`) VALUES
(1, 'Admin'),
(2, 'Korisnik');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_item_status1` FOREIGN KEY (`item_status_id`) REFERENCES `item_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_items_item_type1` FOREIGN KEY (`item_type_id`) REFERENCES `item_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `item_transactions`
--
ALTER TABLE `item_transactions`
  ADD CONSTRAINT `fk_item_transactions_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_transactions_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_item_transactions_users2` FOREIGN KEY (`debtor_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `overdues`
--
ALTER TABLE `overdues`
  ADD CONSTRAINT `fk_overdues_item_transactions1` FOREIGN KEY (`item_transaction_id`) REFERENCES `item_transactions` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_type` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
