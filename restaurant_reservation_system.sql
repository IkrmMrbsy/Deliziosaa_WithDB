-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2024 at 08:07 PM
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_random_password` (OUT `random_string_result` VARCHAR(12))   BEGIN
    DECLARE i INT DEFAULT 0;
    DECLARE random_string VARCHAR(12) DEFAULT '';

    WHILE i < 12 DO
        -- Generate a random alphanumeric character
        SET random_string = CONCAT(random_string, CHAR(FLOOR(65 + RAND() * 36)));

        SET i = i + 1;
    END WHILE;

    -- Set the OUT parameter to the generated random string
    SET random_string_result = random_string;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `generate_random_ticket` (OUT `random_string_result` VARCHAR(8))   BEGIN
    DECLARE i INT DEFAULT 0;
    DECLARE random_string VARCHAR(8) DEFAULT '';

    WHILE i < 8 DO
        -- Generate a random numeric character
        SET random_string = CONCAT(random_string, CHAR(FLOOR(48 + RAND() * 10)));

        SET i = i + 1;
    END WHILE;

    -- Set the OUT parameter to the generated random string
    SET random_string_result = random_string;
END$$

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `signin_suggested_password` (IN `phoneNumbers` VARCHAR(12), IN `custEmail` VARCHAR(29), IN `custName` VARCHAR(45))   BEGIN
	DECLARE generatedPassword VARCHAR(12) DEFAULT '';
	CALL generate_random_password(generatedPassword);
    
    INSERT INTO customers (numbers_phone, email, name, password) VALUE
    (phoneNumbers, custEmail, custName, generatedPassword);
    
    SELECT generatedPassword;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_suggested_password` (IN `custEmail` VARCHAR(89), IN `verifyPassword` VARCHAR(12))   BEGIN
    DECLARE oldPassword VARCHAR(12) DEFAULT '';
    DECLARE newPassword VARCHAR(12) DEFAULT '';
    CALL generate_random_password(newPassword);

    -- Use SELECT ... INTO to retrieve the password for the given email
    SELECT password INTO oldPassword FROM customers WHERE email = custEmail;

    IF verifyPassword = oldPassword THEN
        -- If the passwords match, update the password with the new one
        UPDATE customers
        SET password = newPassword
        WHERE email = custEmail;
        SELECT newPassword;
    ELSE
        -- If the passwords don't match, return an error message
        SELECT 'The inputed password is wrong.' AS ErrorMessage;
    END IF;
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
  `price` int(15) NOT NULL
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
-- Stand-in structure for view `class_party_meals`
-- (See below for the actual view)
--
CREATE TABLE `class_party_meals` (
`Class Type` varchar(20)
,`Class Price` int(15)
,`Party Type` varchar(20)
,`Party Capacity` int(11)
,`Party Price` int(15)
,`Meals` varchar(20)
,`Time Description` varchar(45)
);

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
('C001', '081234567891', 'arbhy@gmail.com', 'Arbhy Adityabrahma', 'arb123'),
('C002', '081234567893', 'ikram@gmail.com', 'Ikram', 'user1234'),
('C003', '081334567895', 'faizz@gmail.com', 'Faizal Akbar', 'sadasdasdasd'),
('C004', '081134567891', 'sba@gmail.com', 'Sbaoidi', '$2y$10$6ZdlPDXy7yJi0'),
('C005', '081233567891', 'asdasd@gmail.com', 'asdasda', '$2y$10$ELBsIqgXTtwk1');

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
  `paid_stat` enum('Paid','Pending','Cancel') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Pending',
  `date_paid` date DEFAULT NULL,
  `date_reservation` date NOT NULL,
  `ticket` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_orders`, `customers_id`, `total_price`, `meals_id`, `paid_stat`, `date_paid`, `date_reservation`, `ticket`) VALUES
('O001', 'C001', 500000, 'M001', 'Pending', NULL, '2024-01-19', NULL),
('O002', 'C002', 1100000, 'M002', 'Pending', NULL, '2024-01-26', NULL);

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
  `price` int(15) NOT NULL
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
('R001', 'P001', 'CL001', 2, 500000, 'O001'),
('R002', 'P002', 'CL003', 2, 1100000, 'O002');

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
-- Stand-in structure for view `reservation_details`
-- (See below for the actual view)
--
CREATE TABLE `reservation_details` (
`Name` varchar(45)
,`Class` varchar(20)
,`Party Type` varchar(20)
,`Capacity` int(11)
,`Reservation Quantity` int(11)
,`Price` int(15)
,`Meals` varchar(20)
,`Meals Time` varchar(45)
,`Ticket` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `ticket`
-- (See below for the actual view)
--
CREATE TABLE `ticket` (
`Name` varchar(45)
,`Total Price` int(15) unsigned
,`Meals` varchar(20)
,`Time` varchar(45)
,`Paid Status` enum('Paid','Pending','Cancel')
,`Reservation Date` date
,`Ticket` varchar(8)
);

-- --------------------------------------------------------

--
-- Structure for view `class_party_meals`
--
DROP TABLE IF EXISTS `class_party_meals`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class_party_meals`  AS SELECT `c`.`class_type` AS `Class Type`, `c`.`price` AS `Class Price`, `p`.`party_type` AS `Party Type`, `p`.`capacity` AS `Party Capacity`, `p`.`price` AS `Party Price`, `m`.`meals_type` AS `Meals`, `m`.`time_desc` AS `Time Description` FROM (((select `class`.`class_type` AS `class_type`,`class`.`price` AS `price`,row_number() over () AS `row_num` from `class`) `c` join (select `party`.`party_type` AS `party_type`,`party`.`capacity` AS `capacity`,`party`.`price` AS `price`,row_number() over () AS `row_num` from `party`) `p`) join (select `meals`.`meals_type` AS `meals_type`,`meals`.`time_desc` AS `time_desc`,row_number() over () AS `row_num` from `meals` where `meals`.`meals_type` in ('Breakfast','Lunch','Dinner')) `m`) WHERE `c`.`row_num` = `p`.`row_num` AND `c`.`row_num` = `m`.`row_num` ;

-- --------------------------------------------------------

--
-- Structure for view `reservation_details`
--
DROP TABLE IF EXISTS `reservation_details`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reservation_details`  AS SELECT `cst`.`name` AS `Name`, `c`.`class_type` AS `Class`, `p`.`party_type` AS `Party Type`, `p`.`capacity` AS `Capacity`, `rsv`.`quantity` AS `Reservation Quantity`, `rsv`.`price` AS `Price`, `m`.`meals_type` AS `Meals`, `m`.`time_desc` AS `Meals Time`, `o`.`ticket` AS `Ticket` FROM (((((`reservation` `rsv` join `class` `c` on(`c`.`id_class` = `rsv`.`class_id`)) join `party` `p` on(`p`.`id_party` = `rsv`.`party_id`)) join `orders` `o` on(`o`.`id_orders` = `rsv`.`orders_id`)) join `meals` `m` on(`m`.`id_meals` = `o`.`meals_id`)) join `customers` `cst` on(`cst`.`id_customers` = `o`.`customers_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `ticket`
--
DROP TABLE IF EXISTS `ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `ticket`  AS SELECT `c`.`name` AS `Name`, `o`.`total_price` AS `Total Price`, `m`.`meals_type` AS `Meals`, `m`.`time_desc` AS `Time`, `o`.`paid_stat` AS `Paid Status`, `o`.`date_reservation` AS `Reservation Date`, `o`.`ticket` AS `Ticket` FROM ((`orders` `o` join `customers` `c` on(`c`.`id_customers` = `o`.`customers_id`)) join `meals` `m` on(`m`.`id_meals` = `o`.`meals_id`)) ;

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
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_customer` FOREIGN KEY (`customers_id`) REFERENCES `customers` (`id_customers`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_meals` FOREIGN KEY (`meals_id`) REFERENCES `meals` (`id_meals`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `fk_reservation_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id_class`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_orders` FOREIGN KEY (`orders_id`) REFERENCES `orders` (`id_orders`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reservation_party` FOREIGN KEY (`party_id`) REFERENCES `party` (`id_party`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
