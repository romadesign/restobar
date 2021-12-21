-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-12-2021 a las 19:39:40
-- Versión del servidor: 10.1.25-MariaDB
-- Versión de PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `opd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `categorieId` int(12) NOT NULL,
  `categorieName` varchar(255) NOT NULL,
  `categorieDesc` text NOT NULL,
  `categorieCreateDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `categorieImage` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`categorieId`, `categorieName`, `categorieDesc`, `categorieCreateDate`, `categorieImage`) VALUES
(1, 'asdasd asd asda', 'Adsdasdasd ', '2021-03-17 18:16:28', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact`
--

CREATE TABLE `contact` (
  `contactId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `orderId` int(21) NOT NULL DEFAULT '0' COMMENT 'If problem is not related to the order then order id = 0',
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contact`
--

INSERT INTO `contact` (`contactId`, `userId`, `email`, `phoneNo`, `orderId`, `message`, `time`) VALUES
(1, 2, 'roman247.RG@gmail.com', 2343243242, 1, 'adasdasdasd', '2021-12-09 18:57:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactreply`
--

CREATE TABLE `contactreply` (
  `id` int(21) NOT NULL,
  `contactId` int(21) NOT NULL,
  `userId` int(23) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `contactreply`
--

INSERT INTO `contactreply` (`id`, `contactId`, `userId`, `message`, `datetime`) VALUES
(1, 1, 2, 'asdas', '2021-12-09 18:58:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deliverydetails`
--

CREATE TABLE `deliverydetails` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `deliveryBoyName` varchar(35) NOT NULL,
  `deliveryBoyPhoneNo` bigint(25) NOT NULL,
  `deliveryTime` int(200) NOT NULL COMMENT 'Time in minutes',
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `deliverydetails`
--

INSERT INTO `deliverydetails` (`id`, `orderId`, `deliveryBoyName`, `deliveryBoyPhoneNo`, `deliveryTime`, `dateTime`) VALUES
(1, 1, 'Roman GÃ³mez', 2343243242, 13, '2021-12-09 19:01:27'),
(2, 2, 'Roman GÃ³mez', 2343243242, 3, '2021-12-09 19:00:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `menuId` int(12) NOT NULL,
  `menuName` varchar(255) NOT NULL,
  `menuPrice` int(12) NOT NULL,
  `menuDesc` text NOT NULL,
  `menuCategorieId` int(12) NOT NULL,
  `menuPubDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menuImage` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`menuId`, `menuName`, `menuPrice`, `menuDesc`, `menuCategorieId`, `menuPubDate`, `menuImage`) VALUES
(1, 'Margherita', 99, 'A hugely popular margherita, with a deliciously tangy single cheese topping\r\n\r\n', 1, '2021-03-17 21:03:26', 'image.jpg');
INSERT INTO `menu` (`menuId`, `menuName`, `menuPrice`, `menuDesc`, `menuCategorieId`, `menuPubDate`, `menuImage`) VALUES
(13, 'PEPPER BARBECUE CHICKEN', 199, 'Pepper Barbecue Chicken I Cheese', 2, '2021-03-17 21:34:37', ''),
(14, 'CHICKEN SAUSAGE', 249, 'Chicken Sausage I Cheese', 2, '2021-03-17 21:35:31', ''),
(15, 'Chicken Golden Delight\r\n', 249, 'Mmm! Barbeque chicken with a topping of golden corn loaded with extra cheese. Worth its weight in gold!\r\n\r\n', 2, '2021-03-17 21:36:36', ''),
(16, 'Non Veg Supreme\r\n', 399, 'Bite into supreme delight of Black Olives, Onions, Grilled Mushrooms, Pepper BBQ Chicken, Peri-Peri Chicken, Grilled Chicken Rashers\r\n\r\n', 2, '2021-03-17 21:37:21', ''),
(17, 'Chicken Dominator', 319, 'Treat your taste buds with Double Pepper Barbecue Chicken, Peri-Peri Chicken, Chicken Tikka & Grilled Chicken Rashers', 2, '2021-03-17 21:38:13', ''),
(18, 'PEPPER BARBECUE & ONION\r\n', 249, 'Pepper Barbecue Chicken I Onion', 2, '2021-03-17 21:39:49', ''),
(19, 'CHICKEN FIESTA', 199, 'Grilled Chicken Rashers I Peri-Peri Chicken I Onion I Capsicum', 2, '2021-03-17 21:40:58', ''),
(20, 'Indi Chicken Tikka', 349, 'The wholesome flavour of tandoori masala with Chicken tikka I onion I red paprika I mint mayo', 2, '2021-03-17 21:41:49', ''),
(21, 'TOMATO', 99, 'Juicy tomato in a flavourful combination with cheese I tangy sauce', 3, '2021-03-17 21:44:44', ''),
(22, 'VEG LOADED', 149, 'Tomato | Grilled Mushroom |Jalapeno |Golden Corn | Beans in a fresh pan crust', 3, '2021-03-17 21:45:34', ''),
(23, 'CHEESY', 99, 'Orange Cheddar Cheese I Mozzarella', 3, '2021-03-17 21:46:21', ''),
(24, 'CAPSICUM', 99, 'Capsicum', 3, '2021-03-17 21:47:07', ''),
(25, 'ONION', 99, 'onion', 3, '2021-03-17 21:47:51', ''),
(26, 'GOLDEN CORN', 139, 'Golden Corn', 3, '2021-03-17 21:48:44', ''),
(27, 'PANEER & ONION', 149, 'Creamy Paneer | Onion', 3, '2021-03-17 21:49:36', ''),
(28, 'CHEESE N TOMATO', 149, 'A delectable combination of cheese and juicy tomato', 3, '2021-03-17 21:50:20', ''),
(29, 'Garlic Breadsticks', 99, 'The endearing tang of garlic in breadstics baked to perfection.', 4, '2021-03-17 22:01:33', ''),
(30, 'Stuffed Garlic Bread', 99, 'Freshly Baked Garlic Bread stuffed with mozzarella cheese, sweet corns & tangy and spicy jalapeños', 4, '2021-03-17 22:02:50', ''),
(31, 'Veg Pasta Italiano White', 99, 'Penne Pasta tossed with extra virgin olive oil, exotic herbs & a generous helping of new flavoured sauce.', 4, '2021-03-17 22:03:44', ''),
(32, 'Non Veg Pasta Italiano White', 99, 'Penne Pasta tossed with extra virgin olive oil, exotic herbs & a generous helping of new flavoured sauce.', 4, '2021-03-17 22:05:08', ''),
(33, 'Cheese Jalapeno Dip', 35, 'A soft creamy cheese dip spiced with jalapeno.', 4, '2021-03-17 22:06:06', ''),
(34, 'Cheese Dip', 35, 'A dreamy creamy cheese dip to add that extra tang to your snack.', 4, '2021-03-17 22:06:59', ''),
(35, 'Lava Cake', 99, 'Filled with delecious molten chocolate inside.', 4, '2021-03-17 22:08:13', ''),
(36, 'Butterscotch Mousse Cake', 149, 'A Creamy & Chocolaty indulgence with layers of rich, fluffy Butterscotch Cream and delicious Dark Chocolate Cake, topped with crunchy Dark Chocolate morsels - for a perfect dessert treat!', 4, '2021-03-17 22:08:58', ''),
(37, 'Lipton Ice Tea', 25, ' 250ml', 5, '2021-03-17 22:12:53', ''),
(38, 'Mirinda', 35, '500ml', 5, '2021-03-17 22:13:38', ''),
(39, 'PEPSI BLACK CAN', 45, 'PEPSI BLACK CAN', 5, '2021-03-17 22:14:24', '');
INSERT INTO `menu` (`menuId`, `menuName`, `menuPrice`, `menuDesc`, `menuCategorieId`, `menuPubDate`, `menuImage`) VALUES
(40, 'Pepsi', 524, '500ml', 2, '2021-03-17 22:16:29', 'image.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderitems`
--

CREATE TABLE `orderitems` (
  `id` int(21) NOT NULL,
  `orderId` int(21) NOT NULL,
  `menuId` int(21) NOT NULL,
  `itemQuantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orderitems`
--

INSERT INTO `orderitems` (`id`, `orderId`, `menuId`, `itemQuantity`) VALUES
(1, 1, 23, 12),
(2, 1, 22, 12),
(3, 2, 21, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orders`
--

CREATE TABLE `orders` (
  `orderId` int(21) NOT NULL,
  `userId` int(21) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipCode` int(21) NOT NULL,
  `phoneNo` bigint(21) NOT NULL,
  `amount` int(200) NOT NULL,
  `paymentMode` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=cash on delivery, \r\n1=online ',
  `orderStatus` enum('0','1','2','3','4','5','6') NOT NULL DEFAULT '0' COMMENT '0=Order Placed.\r\n1=Order Confirmed.\r\n2=Preparing your Order.\r\n3=Your order is on the way!\r\n4=Order Delivered.\r\n5=Order Denied.\r\n6=Order Cancelled.',
  `orderDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `orders`
--

INSERT INTO `orders` (`orderId`, `userId`, `address`, `zipCode`, `phoneNo`, `amount`, `paymentMode`, `orderStatus`, `orderDate`) VALUES
(1, 2, 'Av. Separadora Industrial # 1003, Av. Separadora Industrial # 1003, Av. Separadora Industrial # 1003', 324234, 6033447454, 248, '0', '4', '2021-12-09 18:38:38'),
(2, 1, 'Cristo, ', 324333, 6033447453, 99, '0', '1', '2021-12-09 18:55:48');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sitedetail`
--

CREATE TABLE `sitedetail` (
  `tempId` int(11) NOT NULL,
  `systemName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `contact1` bigint(21) NOT NULL,
  `contact2` bigint(21) DEFAULT NULL COMMENT 'Optional',
  `address` text NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sitedetail`
--

INSERT INTO `sitedetail` (`tempId`, `systemName`, `email`, `contact1`, `contact2`, `address`, `dateTime`) VALUES
(1, 'romacode', 'darshanparmar263@gmail.com', 2515469442, 6304468851, '601 Sherwood Ave.<br> San Bernandino', '2021-03-23 19:56:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(21) NOT NULL,
  `username` varchar(21) NOT NULL,
  `firstName` varchar(21) NOT NULL,
  `lastName` varchar(21) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `userType` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0=user\r\n1=admin',
  `password` varchar(255) NOT NULL,
  `joinDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `phone`, `userType`, `password`, `joinDate`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@gmail.com', 1111111111, '1', '$2y$10$Pb.m0IrHRU4Eq9t4isAF7OJlStCjqi9fmOVTXFHxRtDhdTaPHmm7e', '2021-04-11 11:40:58'),
(2, 'romacode', 'roman', 'gomez', 'roman247.RG@gmail.com', 603344745, '0', '$2y$10$Pb.m0IrHRU4Eq9t4isAF7OJlStCjqi9fmOVTXFHxRtDhdTaPHmm7e', '2021-12-09 18:17:05'),
(3, 'mari', 'maribel', 'villa', 'mari@gmail.com', 603344745, '0', '$2y$10$j9usRzekGgzzVHJyGnaX4.MNe1xBfTOf990WFudlVfQZdA7snmmU.', '2021-12-21 17:41:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viewcart`
--

CREATE TABLE `viewcart` (
  `cartItemId` int(11) NOT NULL,
  `menuId` int(11) NOT NULL,
  `itemQuantity` int(100) NOT NULL,
  `userId` int(11) NOT NULL,
  `addedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `viewcart`
--

INSERT INTO `viewcart` (`cartItemId`, `menuId`, `itemQuantity`, `userId`, `addedDate`) VALUES
(31, 0, 1, 2, '2021-12-21 19:02:57'),
(32, 2, 1, 2, '2021-12-21 19:38:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categorieId`);
ALTER TABLE `categories` ADD FULLTEXT KEY `categorieName` (`categorieName`,`categorieDesc`);

--
-- Indices de la tabla `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contactId`);

--
-- Indices de la tabla `contactreply`
--
ALTER TABLE `contactreply`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `deliverydetails`
--
ALTER TABLE `deliverydetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orderId` (`orderId`);

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menuId`);
ALTER TABLE `menu` ADD FULLTEXT KEY `pizzaName` (`menuName`,`menuDesc`);

--
-- Indices de la tabla `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`);

--
-- Indices de la tabla `sitedetail`
--
ALTER TABLE `sitedetail`
  ADD PRIMARY KEY (`tempId`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Indices de la tabla `viewcart`
--
ALTER TABLE `viewcart`
  ADD PRIMARY KEY (`cartItemId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `categorieId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `contact`
--
ALTER TABLE `contact`
  MODIFY `contactId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contactreply`
--
ALTER TABLE `contactreply`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `deliverydetails`
--
ALTER TABLE `deliverydetails`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `menuId` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT de la tabla `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sitedetail`
--
ALTER TABLE `sitedetail`
  MODIFY `tempId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(21) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `viewcart`
--
ALTER TABLE `viewcart`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
