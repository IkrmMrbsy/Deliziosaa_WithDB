-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2024 at 11:58 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant_reservation_system`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `paid_ticket` (IN `idOrder` VARCHAR(255), IN `paidStat` VARCHAR(8))   BEGIN
	DECLARE generatedTicket VARCHAR(12) DEFAULT '';
    
    -- Update the orders table
    IF paidStat = 'Paid' THEN
		CALL generate_random_ticket(generatedTicket); 
    
        UPDATE orders
        SET paid_stat = paidStat,
            ticket = generatedTicket,
            date_paid = CURDATE()
            WHERE id_orders = idOrder;
    ELSEIF paidStat = 'Cancel' THEN
        UPDATE orders
        SET paid_stat = paidStat WHERE id_orders = idOrder;
    END IF;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_price` (IN `idParty` VARCHAR(4), IN `idClass` VARCHAR(5), IN `revsQuantity` INT(11), IN `idOrder` VARCHAR(4))   BEGIN
    DECLARE partyPrice INT;
    DECLARE classPrice INT;
    DECLARE totalPrice INT;
    
-- 	Get party and class prices, then summarize them
    SELECT price INTO partyPrice FROM party WHERE id_party = idParty;
    SELECT price INTO classPrice FROM class WHERE id_class = idClass;

    SET totalPrice = (classPrice + partyPrice) * revsQuantity;
    
-- 	Inserting the values based on param and insert the already set total price
    INSERT INTO reservation(party_id, class_id, quantity, price, orders_id)
	VALUES (idParty, idClass, revsQuantity, totalPrice, idOrder);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_reservation_price` (IN `idReservation` VARCHAR(4), IN `idParty` VARCHAR(4), IN `idClass` VARCHAR(4), IN `revsQuantity` INT(11))   BEGIN
    DECLARE partyPrice INT;
    DECLARE classPrice INT;
    DECLARE totalPrice INT;

    -- Get party and class prices, then summarize them
    SELECT price INTO partyPrice FROM party WHERE id_party = idParty;
    SELECT price INTO classPrice FROM class WHERE id_class = idClass;

    SET totalPrice = (classPrice + partyPrice) * revsQuantity;

    -- Update the reservation with the new values based on parameters
    UPDATE reservation
    SET
        party_id = idParty,
        class_id = idClass,
        quantity = revsQuantity,
        price = totalPrice
    WHERE id_reservation = idReservation;
END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `generate_numeric_uuid` (`length` INT) RETURNS VARCHAR(255) CHARSET utf8mb4 COLLATE utf8mb4_general_ci  BEGIN
    DECLARE characters VARCHAR(10) DEFAULT '0123456789';
    DECLARE result VARCHAR(255) DEFAULT '';
    DECLARE i INT DEFAULT 0;
    
    WHILE i < length DO
        SET result = CONCAT(result, SUBSTRING(characters, FLOOR(1 + RAND() * LENGTH(characters)), 1));
        SET i = i + 1;
    END WHILE;

    RETURN result;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
('A001', 'admin', 'admin123');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_admin` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_admin, 2) AS SIGNED)), 0) INTO current_value FROM admin;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_admin = CONCAT('A', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `id_class` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `class_type` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `price` int(15) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id_class`, `class_type`, `price`) VALUES
('CL001', 'Regular', 50000),
('CL002', 'VIP', 150000),
('CL003', 'VVIP', 250000);

--
-- Triggers `class`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_class` BEFORE INSERT ON `class` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_class, 3) AS SIGNED)), 0) INTO current_value FROM class;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_class = CONCAT('CL', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id_customers` varchar(4) NOT NULL,
  `numbers_phone` varchar(12) NOT NULL,
  `email` varchar(89) NOT NULL,
  `name` varchar(45) NOT NULL,
  `password` varchar(20) NOT NULL DEFAULT 'user123'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id_customers`, `numbers_phone`, `email`, `name`, `password`) VALUES
('C001', '081234567892', 'arbhy@gmail.com', 'Arbhy', 'arb16'),
('C002', '081234567890', 'ikram@gmail.com', 'Ikram M.', 'ikram122');

--
-- Triggers `customers`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_customers` BEFORE INSERT ON `customers` FOR EACH ROW BEGIN
    DECLARE current_value INT DEFAULT 0;
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_customers, 2) AS SIGNED)), 0) INTO current_value FROM customers;
    SET current_value = current_value + 1;
    SET NEW.id_customers = CONCAT('C', LPAD(current_value, 3, '0'));

    -- Add the OUT parameter to store the generated ID
    SET @generated_id = NEW.id_customers;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `customer_wallet` AFTER INSERT ON `customers` FOR EACH ROW BEGIN

    INSERT INTO wallet (wallet, customers_id) VALUES (0, NEW.id_customers);
    
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id_meals` varchar(4) NOT NULL,
  `meals_type` varchar(20) NOT NULL,
  `time_desc` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id_meals`, `meals_type`, `time_desc`) VALUES
('M001', 'Breakfast', '07.00 AM-08.00 AM'),
('M002', 'Lunch', '12.00 PM-02.00 PM'),
('M003', 'Dinner', '06.00 PM-09.00 PM');

--
-- Triggers `meals`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_meals` BEFORE INSERT ON `meals` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_meals, 2) AS SIGNED)), 0) INTO current_value FROM meals;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_meals = CONCAT('M', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_orders` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `customers_id` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `total_price` int(15) UNSIGNED DEFAULT 0,
  `meals_id` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `paid_stat` enum('Paid','Pending') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Pending',
  `date_paid` date DEFAULT NULL,
  `date_reservation` date NOT NULL,
  `ticket` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `customers_id`, `total_price`, `meals_id`, `paid_stat`, `date_paid`, `date_reservation`, `ticket`) VALUES
('O001', 'C001', 1650000, 'M001', 'Paid', '2024-01-23', '2024-01-24', '04089567'),
('O002', 'C002', 500000, 'M001', 'Paid', '2024-01-23', '2024-01-23', '80434089');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_orders` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;

    -- Retrieve the maximum value, handling NULL with COALESCE
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_orders, 2) AS SIGNED)), 0) INTO current_value FROM orders;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_orders = CONCAT('O', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pay_orders` AFTER UPDATE ON `orders` FOR EACH ROW BEGIN
    DECLARE customer_wallet DECIMAL(10, 2);
    DECLARE order_total DECIMAL(10, 2);

    -- Check if the order is updated to paid
    IF NEW.paid_stat = 'Paid' AND OLD.paid_stat <> 'Paid' THEN
        -- Get the wallet amount of the customer
        SELECT wallet INTO customer_wallet FROM wallet WHERE customers_id = NEW.customers_id;

        -- Get the total price of the order
        SELECT total_price INTO order_total FROM orders WHERE id_orders = NEW.id_orders;

        -- Check if the wallet has sufficient balance
        IF customer_wallet >= order_total THEN
            -- Update the wallet amount
            UPDATE wallet SET wallet = customer_wallet - order_total WHERE customers_id = NEW.customers_id;
        ELSE
            -- Set paid_stat to 'Pending' if the wallet is insufficient
            UPDATE orders SET paid_stat = 'Pending' WHERE id_orders = NEW.id_orders;
        END IF;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ticket` BEFORE UPDATE ON `orders` FOR EACH ROW BEGIN
    IF NEW.paid_stat = 'Paid' AND OLD.paid_stat <> 'Paid' THEN
        SET NEW.date_paid = CURDATE();
        SET NEW.ticket = generate_numeric_uuid(12); -- Change the length as needed
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE `party` (
  `id_party` varchar(4) NOT NULL,
  `party_type` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` int(15) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id_party`, `party_type`, `capacity`, `price`) VALUES
('P001', 'Family', 8, 200000),
('P002', 'Private', 4, 300000),
('P003', 'Group', 12, 400000);

--
-- Triggers `party`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_party` BEFORE INSERT ON `party` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_party, 2) AS SIGNED)), 0) INTO current_value FROM party;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_party = CONCAT('P', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id_reservation` varchar(4) NOT NULL,
  `party_id` varchar(4) NOT NULL,
  `class_id` varchar(5) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(15) NOT NULL DEFAULT 0,
  `orders_id` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id_reservation`, `party_id`, `class_id`, `quantity`, `price`, `orders_id`) VALUES
('R001', 'P002', 'CL001', 1, 350000, 'O001'),
('R002', 'P003', 'CL003', 2, 1300000, 'O001'),
('R003', 'P001', 'CL001', 2, 500000, 'O002');

--
-- Triggers `reservation`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_reservation` BEFORE INSERT ON `reservation` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;

    -- Retrieve the maximum value, handling NULL with COALESCE
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_reservation, 2) AS SIGNED)), 0) INTO current_value FROM reservation;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_reservation = CONCAT('R', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `before_reservation_update` BEFORE UPDATE ON `reservation` FOR EACH ROW BEGIN
    DECLARE partyPrice INT;
    DECLARE classPrice INT;
    DECLARE totalPrice INT;

    -- Get party and class prices, then summarize them
    SELECT price INTO partyPrice FROM party WHERE id_party = NEW.party_id;
    SELECT price INTO classPrice FROM class WHERE id_class = NEW.class_id;

    SET totalPrice = (classPrice + partyPrice) * NEW.quantity;

    -- Update the reservation with the new values
    SET NEW.price = totalPrice;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `substract_order_price` AFTER DELETE ON `reservation` FOR EACH ROW BEGIN

    UPDATE orders o
    SET total_price = COALESCE(
        (SELECT SUM(r.price)
         FROM reservation r
         WHERE r.orders_id = o.id_orders),
        0
    )
    WHERE id_orders = OLD.orders_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `summarize_order_price` AFTER INSERT ON `reservation` FOR EACH ROW BEGIN

	UPDATE orders o SET total_price = (
		SELECT SUM(r.price)
        FROM reservation r
        WHERE r.orders_id = o.id_orders
    )
	WHERE id_orders = NEW.orders_id;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_order_price` AFTER UPDATE ON `reservation` FOR EACH ROW BEGIN

	UPDATE orders o SET total_price = (
		SELECT SUM(r.price)
        FROM reservation r
        WHERE r.orders_id = o.id_orders
    )
	WHERE id_orders = NEW.orders_id;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id_wallet` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `wallet` int(11) UNSIGNED NOT NULL,
  `customers_id` varchar(4) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id_wallet`, `wallet`, `customers_id`) VALUES
('W001', 97650000, 'C001'),
('W002', 400000, 'C002');

--
-- Triggers `wallet`
--
DELIMITER $$
CREATE TRIGGER `alphanumeric_id_wallet` BEFORE INSERT ON `wallet` FOR EACH ROW BEGIN
    -- Initialize or retrieve the current incrementing value
    DECLARE current_value INT DEFAULT 0;
    SELECT COALESCE(MAX(CAST(SUBSTRING(id_wallet, 2) AS SIGNED)), 0) INTO current_value FROM wallet;

    -- Increment the value for the new record
    SET current_value = current_value + 1;

    -- Generate a 4-character key with incrementing numeric part
    SET NEW.id_wallet = CONCAT('W', LPAD(current_value, 3, '0'));
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customers`),
  ADD UNIQUE KEY `numbers_phone` (`numbers_phone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id_meals`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_orders`),
  ADD KEY `fk_order_customer` (`customers_id`),
  ADD KEY `fk_order_meals` (`meals_id`);

--
-- Indexes for table `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id_party`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id_reservation`),
  ADD KEY `party_id` (`party_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `orders_id` (`orders_id`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id_wallet`),
  ADD KEY `customers_id` (`customers_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id_customers`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_meals` FOREIGN KEY (`meals_id`) REFERENCES `meals` (`id_meals`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_orders` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id_orders`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`id_party`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `wallet`
--
ALTER TABLE `wallet`
  ADD CONSTRAINT `fk_wallet_customers` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id_customers`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
