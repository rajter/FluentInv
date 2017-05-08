-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2017 at 09:59 PM
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
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `address`, `city`, `zipcode`, `state`, `country`) VALUES
(1, 'Ivana Pl. Zajca', 'Čakovec', '40000', 'Medjimurje', 'Hrvatska'),
(2, 'Zalužje BB', 'Vinkovci', '32100 ', 'Vinkovci', 'Hrvatska'),
(3, 'Vladimira Nazora 5', 'Ogulin', '47300 ', 'Ogulin', 'Hrvatska'),
(4, 'Josipa J. Štrosmajera 16', 'Našice', '31500 ', 'Našice', 'Hrvatska'),
(5, 'Mošćenička 2', 'Zagreb', '10000 ', 'Zagreb', 'Hrvatska'),
(6, 'Jadranska ulica 3', 'Posedarje', '23242 ', 'Posedarje', 'Hrvatska');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `tel` varchar(200) DEFAULT NULL,
  `fax` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address_id` int(11) NOT NULL,
  `client_type_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`address_id`,`client_type_id`),
  KEY `fk_clinets_address1_idx` (`address_id`),
  KEY `fk_clinets_client_type1_idx` (`client_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `description`, `tel`, `fax`, `email`, `address_id`, `client_type_id`) VALUES
(1, 'PODUZECE', 'PODUZECE', '01/0000-001', '01/0001-001', 'poduzece@gmail.com', 1, 1),
(2, 'A.B.S.', 'ALU i PVC stolarija, vl. Stanišić Armando', '01/0000-002', '01/0001-002', 'abs@gmail.com', 2, 1),
(3, 'PVC BERTOVIĆ d.o.o.', 'PVC stolarija', '01/0000-003', '01/0001-003', 'pvcbertovic@gmail.com', 3, 1),
(4, 'PVC CENTAR NAŠICE', 'vl. Iljkić Ivica', '01/0000-004', '01/0001-004', 'pvccentar@gmail.com', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients_has_contacts`
--

CREATE TABLE IF NOT EXISTS `clients_has_contacts` (
  `clients_id` int(11) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  PRIMARY KEY (`clients_id`,`contacts_id`),
  KEY `fk_clinets_has_contacts_contacts1_idx` (`contacts_id`),
  KEY `fk_clinets_has_contacts_clinets1_idx` (`clients_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients_has_contacts`
--

INSERT INTO `clients_has_contacts` (`clients_id`, `contacts_id`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(3, 7),
(3, 8),
(4, 9);

-- --------------------------------------------------------

--
-- Table structure for table `client_type`
--

CREATE TABLE IF NOT EXISTS `client_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `client_type`
--

INSERT INTO `client_type` (`id`, `type`) VALUES
(1, 'Dobavljač'),
(2, 'Kupac'),
(3, 'Distributor');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `address` longtext,
  `city` varchar(200) DEFAULT NULL,
  `zipcode` varchar(50) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `fax` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `city`, `zipcode`, `state`, `tel`, `fax`, `email`) VALUES
(1, 'Rajter Industries', 'Ivana Pl. Zajca 61', 'Čakovec', '40001', 'Međimurje do Meksika', '040/001-225', '040/001-226', 'rajterindustries@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `company_has_contacts`
--

CREATE TABLE IF NOT EXISTS `company_has_contacts` (
  `company_id` int(11) NOT NULL,
  `contacts_id` int(11) NOT NULL,
  PRIMARY KEY (`company_id`,`contacts_id`),
  KEY `fk_company_has_contacts_contacts1_idx` (`contacts_id`),
  KEY `fk_company_has_contacts_company1_idx` (`company_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_has_contacts`
--

INSERT INTO `company_has_contacts` (`company_id`, `contacts_id`) VALUES
(1, 1),
(1, 4),
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `tel` varchar(200) DEFAULT NULL,
  `mob` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `surname`, `tel`, `mob`, `email`) VALUES
(1, 'Mirko1', 'Miočić', '01/0000-001', '091/000-001', 'mirkom@gmail.com'),
(2, 'Filip', 'Filipović', '01/0000-002', '091/000-002', 'filipf@gmail.com'),
(3, 'Ivana', 'Ivančić', '01/0000-003', '091/000-003', 'ivanai@gmail.com'),
(4, 'Branimir', 'Brani', '01/0000-004', '091/000-004', 'braneb@gmail.com'),
(5, 'Davor', 'Davorin', '01/0000-005', '091/000-005', 'davord@gmail.com'),
(6, 'Goran', 'Gora', '01/0000-006', '091/000-006', 'gorang@gmail.com'),
(7, 'Hrvoje', 'Hrvo', '01/0000-007', '091/000-007', 'hrvojeh@gmail.com'),
(8, 'Krešimir', 'Krešo', '01/0000-008', '091/000-008', 'kresok@gmail.com'),
(9, 'Luka', 'Lukančić', '01/0000-009', '091/000-009', 'lukal@gmail.com'),
(10, 'Zvonimir', 'Zvone', '01/0000-010', '091/000-010', 'zvonimirz@gmail.com'),
(12, 'Ansdrija', '', '', '', ''),
(13, 'Andrija', 'Rajter', '040/328-258', '0919393310', 'rajterandrija@gmail.com'),
(14, 'Novi', 'Kontakt', '040/337-295', '0919393310', 'novikontakt@gmail.com'),
(15, 'Marijan', 'Marijanović', '0919895685', '0914457556', 'marijanm@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_stock_takings`
--

CREATE TABLE IF NOT EXISTS `inventory_stock_takings` (
  `inventory_transactions_id` int(11) NOT NULL,
  `stock_takings_id` int(11) NOT NULL,
  PRIMARY KEY (`inventory_transactions_id`,`stock_takings_id`),
  KEY `fk_inventory_transactions_has_stock_takings_stock_takings1_idx` (`stock_takings_id`),
  KEY `fk_inventory_transactions_has_stock_takings_inventory_trans_idx` (`inventory_transactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transactions`
--

CREATE TABLE IF NOT EXISTS `inventory_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_number` varchar(10) NOT NULL,
  `transaction_type_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `from_location_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `footnote` longtext,
  PRIMARY KEY (`id`,`transaction_number`,`transaction_type_id`,`client_id`,`location_id`,`from_location_id`,`user_id`),
  KEY `fk_inventory_transactions_transaction_type1_idx` (`transaction_type_id`),
  KEY `fk_inventory_transactions_users1_idx` (`user_id`),
  KEY `fk_inventory_transactions_locations1_idx` (`location_id`),
  KEY `fk_inventory_transactions_locations2_idx` (`from_location_id`),
  KEY `fk_inventory_transactions_transaction_number1_idx` (`transaction_number`),
  KEY `fk_inventory_transactions_clinets1_idx` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `inventory_transactions`
--

INSERT INTO `inventory_transactions` (`id`, `transaction_number`, `transaction_type_id`, `client_id`, `location_id`, `from_location_id`, `user_id`, `date`, `footnote`) VALUES
(1, '17-0000001', 1, 1, 1, 1, 1, '2017-04-08 14:51:07', ''),
(2, '17-0000002', 1, 3, 3, 3, 1, '2017-04-13 18:32:34', ''),
(3, '17-0000003', 1, 1, 1, 1, 1, '2017-04-01 12:04:38', ''),
(4, '17-0000004', 1, 1, 1, 1, 1, '2017-03-22 12:07:31', ''),
(5, '17-0000001', 3, 1, 2, 1, 1, '2017-01-10 12:22:59', ''),
(6, '17-0000001', 2, 1, 1, 1, 1, '2017-03-01 15:43:38', ''),
(7, '17-0000002', 2, 1, 1, 1, 1, '2017-03-23 15:43:48', ''),
(8, '17-0000003', 2, 3, 1, 1, 1, '2017-05-03 15:58:47', ''),
(9, '17-0000002', 3, 1, 3, 2, 1, '2017-02-15 15:59:18', ''),
(10, '17-0000005', 1, 3, 1, 1, 5, '2017-05-02 20:45:27', '');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` longtext,
  `item_type_id` int(11) NOT NULL,
  `item_status_id` int(11) NOT NULL,
  `price` double NOT NULL,
  `code` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`,`item_type_id`,`item_status_id`),
  KEY `fk_items_item_type1_idx` (`item_type_id`),
  KEY `fk_items_item_status1_idx` (`item_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `description`, `item_type_id`, `item_status_id`, `price`, `code`, `image`) VALUES
(1, 'Kosilica', 'Samohodna kosilica VIKING', 1, 1, 1500.45, 'AAAAAAAA', '1.jpg'),
(2, 'Trimer', 'Trimer električni', 2, 1, 350.48, 'BBBBBBBB', '2.jpg'),
(3, 'Škare', 'Škare', 2, 1, 150.45, 'CCCCCCCC', '3.jpg'),
(4, 'Busilica', 'Busilica BOSCH', 1, 1, 1000, 'DDDDDDDD', '4.jpg'),
(5, 'Flex', 'Kutna brusilica', 1, 1, 850.17, 'EEEEEEEE', '5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `item_status`
--

CREATE TABLE IF NOT EXISTS `item_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_status`
--

INSERT INTO `item_status` (`id`, `status`) VALUES
(1, 'dostupno'),
(2, 'nedostupno'),
(3, 'otpisano');

-- --------------------------------------------------------

--
-- Table structure for table `item_transaction`
--

CREATE TABLE IF NOT EXISTS `item_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_transaction_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`,`inventory_transaction_id`,`item_id`),
  KEY `fk_receipt_items1_idx` (`item_id`),
  KEY `fk_inventory_transaction_id_idx` (`inventory_transaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `item_transaction`
--

INSERT INTO `item_transaction` (`id`, `inventory_transaction_id`, `item_id`, `quantity`) VALUES
(1, 1, 3, 1),
(2, 2, 5, 4),
(3, 2, 2, 2),
(4, 2, 1, 7),
(6, 3, 3, 1),
(7, 4, 1, 8),
(8, 4, 4, 3),
(9, 5, 4, 1),
(10, 6, 4, 1),
(11, 6, 5, 1),
(12, 7, 4, 1),
(13, 8, 4, 9),
(14, 9, 4, 1),
(15, 10, 4, 11),
(16, 10, 5, 12);

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `description`) VALUES
(1, 'razno', NULL),
(2, 'ručni alat', NULL),
(3, 'električni alat', NULL),
(4, 'elektronika', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` longtext,
  `address_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`address_id`),
  KEY `fk_locations_address1_idx` (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `description`, `address_id`) VALUES
(1, 'Centralno Skladište', 'Centralno Skladište', 1),
(2, 'Skladište 1', 'Skladište 1', 2),
(3, 'Skladište 2', 'Skladište 2', 3);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `body` longtext,
  `message_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`message_status_id`),
  KEY `fk_messages_message_status1_idx` (`message_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_status`
--

CREATE TABLE IF NOT EXISTS `message_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` longtext NOT NULL,
  `notification_status_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`notification_status_id`),
  KEY `fk_notification_notification_status1_idx` (`notification_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `notification_status`
--

CREATE TABLE IF NOT EXISTS `notification_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE IF NOT EXISTS `preferences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `description` longtext NOT NULL,
  `datatype` varchar(45) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_takings`
--

CREATE TABLE IF NOT EXISTS `stock_takings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_taking_number` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `locations_id` int(11) NOT NULL,
  `footnote` longtext,
  PRIMARY KEY (`id`,`users_id`,`locations_id`),
  KEY `fk_stock_takings_users1_idx` (`users_id`),
  KEY `fk_stock_takings_locations1_idx` (`locations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_type`
--

CREATE TABLE IF NOT EXISTS `transaction_type` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_type`
--

INSERT INTO `transaction_type` (`id`, `description`) VALUES
(1, 'Primka'),
(2, 'Izdatnica'),
(3, 'Međuskladišnica'),
(4, 'Otpisnica'),
(5, 'Ispravak'),
(6, 'Inventura'),
(7, 'Zakljucak');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `role` varchar(200) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`user_type_id`),
  KEY `fk_users_user_type1_idx` (`user_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `image`, `email`, `user_type_id`, `name`, `surname`, `role`, `login_date`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'avatar.png', 'admin@logtrack.com', 1, 'Admin', 'Admin', 'Admin', '2017-05-08 21:58:41'),
(5, 'Andrija', '4f506376dfd5619a10928c88241c8dd5', 'avatar5.png', 'rajterandrija@gmail.com', 2, 'Andrija', 'Rajter', 'Programer', '2017-05-03 21:06:30'),
(7, 'Marko', 'c28aa76990994587b0e907683792297c', 'avatar.png', 'mmarkovic@gmail.com', 2, 'Marko', 'Marković', 'Skladištar', '2017-05-03 22:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'employee');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clinets_address1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clinets_client_type1` FOREIGN KEY (`client_type_id`) REFERENCES `client_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `clients_has_contacts`
--
ALTER TABLE `clients_has_contacts`
  ADD CONSTRAINT `fk_clients_has_contacts_clients1` FOREIGN KEY (`clients_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clients_has_contacts_contacts1` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `company_has_contacts`
--
ALTER TABLE `company_has_contacts`
  ADD CONSTRAINT `fk_company_has_contacts_company1` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_company_has_contacts_contacts1` FOREIGN KEY (`contacts_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inventory_stock_takings`
--
ALTER TABLE `inventory_stock_takings`
  ADD CONSTRAINT `fk_inventory_transactions_has_stock_takings_inventory_transac1` FOREIGN KEY (`inventory_transactions_id`) REFERENCES `inventory_transactions` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inventory_transactions_has_stock_takings_stock_takings1` FOREIGN KEY (`stock_takings_id`) REFERENCES `stock_takings` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD CONSTRAINT `fk_inventory_transactions_clinets1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventory_transactions_locations1` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventory_transactions_locations2` FOREIGN KEY (`from_location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventory_transactions_transaction_type1` FOREIGN KEY (`transaction_type_id`) REFERENCES `transaction_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inventory_transactions_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `fk_items_item_status1` FOREIGN KEY (`item_status_id`) REFERENCES `item_status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_items_item_type1` FOREIGN KEY (`item_type_id`) REFERENCES `item_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `item_transaction`
--
ALTER TABLE `item_transaction`
  ADD CONSTRAINT `fk_inventory_transaction_id` FOREIGN KEY (`inventory_transaction_id`) REFERENCES `inventory_transactions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_receipt_items1` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `fk_locations_address1` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_message_status1` FOREIGN KEY (`message_status_id`) REFERENCES `message_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `fk_notification_notification_status1` FOREIGN KEY (`notification_status_id`) REFERENCES `notification_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock_takings`
--
ALTER TABLE `stock_takings`
  ADD CONSTRAINT `fk_stock_takings_locations1` FOREIGN KEY (`locations_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stock_takings_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_user_type1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
