-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 08, 2019 at 12:23 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(11, 'Kids'),
(12, 'Men'),
(13, 'Women');

-- --------------------------------------------------------

--
-- Table structure for table `lineas_pedidos`
--

DROP TABLE IF EXISTS `lineas_pedidos`;
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `order_id` int(255) NOT NULL,
  `product_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_LineOrder` (`order_id`),
  KEY `FK_LineProduct` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lineas_pedidos`
--

INSERT INTO `lineas_pedidos` (`id`, `order_id`, `product_id`, `unidades`) VALUES
(1, 1, 2, 2),
(2, 2, 2, 2),
(3, 3, 8, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` int(10) NOT NULL,
  `cost` float(200,2) NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_order_user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id`, `user_id`, `fname`, `lname`, `email`, `phone`, `country`, `city`, `address`, `zip`, `cost`, `status`, `date`, `time`) VALUES
(1, 'user_5db0b92892c4b4.95609547', 'Roma', 'Bilibov', 'roma@roma.com', 642316105, 'American Samoa', 'Alcala', 'Damaso', 28806, 39.98, 'ready', '2019-11-06', '20:41:44'),
(2, 'user_5db0b92892c4b4.95609547', 'Roma', 'Bilibov', 'roma@roma.com', 642316105, 'American Samoa', 'Alcala', 'Damaso', 28806, 39.98, 'pending', '2019-11-06', '22:59:01'),
(3, 'user_5dc356ad3d2095.17973513', 'Dorin', 'Bilibov', 'dorin@dorin.com', 456456456, 'Algeria', 'Madrid', 'Adlas', 23232, 73.98, 'sent', '2019-11-07', '00:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8_unicode_ci,
  `precio` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(1, 11, 'Kid dress', 'Tulle dress with bright sequins. Short sleeves of the steering wheel, tear closure with nacreous button on the neck and elastic waist seam. Lined.', 29.99, 30, NULL, '2019-11-04', 'kids.jpg'),
(2, 11, 'Sweater', 'Soft jacquard knitted cotton blend sweater with woolen weft. Model with round neck and ribbed collar, cuffs and hem.', 19.99, 10, NULL, '2019-11-02', 'kids2.jpg'),
(3, 11, 'Treggings de pana', 'Treggings en pana elástica de algodón con cinturilla elástica ajustable, bolsillos decorativos delante y bolsillos traseros.', 9.99, 42, NULL, '2019-11-03', 'kids3.jpg'),
(4, 12, 'Long-sleeve T-shirt', 'Long-sleeved shirt in cotton knit with elastic cuffs.', 32.99, 15, NULL, '2019-11-04', 'men3.jpg'),
(5, 12, 'Knit t-shirt with patterned motif', 'T-shirt in cotton with patterned motif in front and elastic ribbed collar.', 14.99, 36, NULL, '2019-11-01', 'men.jpg'),
(6, 12, 'T-shirt with motif', 'Knit t-shirt with patterned motif.', 14.99, 12, NULL, '2019-11-02', 'men2.jpg'),
(7, 13, 'Knitted turtleneck', 'CONSCIOUS Ribbed knit sweater with wool in the plot. Wide high neck model with drooping shoulders, lateral openings and somewhat longer back. Made with recycled polyester.', 39.99, 43, NULL, '2019-11-04', 'women.jpg'),
(8, 13, 'Dress', 'V-neck dress in recycled polyester with round neck and long sleeves with ruffle on the cuffs. Model fitted at the top with hip seam and wide skirt.', 36.99, 12, NULL, '2019-11-04', 'women2.jpg'),
(9, 13, 'Draped cross bode', 'Knit body with crossed front and pronounced beak neckline with draped effect. Ruched shoulders and waist, long sleeves with thin elastic cuffs and hidden crotch buttons.', 17.50, 23, NULL, '2019-11-02', 'product_5dc34f2730b1b1.44656882.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `fname`, `lname`, `email`, `password`, `role`, `image`, `phone`, `country`, `city`, `address`, `zip`) VALUES
('user_5db0b92892c4b4.95609547', 'Roma', 'Bilibov', 'roma@roma.com', '$2y$04$WUQvVJNBz7lQbh.QeM3QGOXh6EgKBx/yEL9GbRcY7EP1OFXnr6j6a', 'admin', 'user_5dc3542c500f26.88300794.jpg', 642316105, 'American Samoa', 'Alcala', 'Damaso', 28806),
('user_5dc356ad3d2095.17973513', 'Dorin', 'Bilibov', 'dorin@dorin.com', '$2y$04$5bF372Tk0W1hPucviq2SBuTp6hAR63RSNibAy8Ky2eRLx3XqP7t8S', 'user', 'user_5dc35795d3f6a4.15526673.jpg', 456456456, 'Algeria', 'Madrid', 'Adlas', 23232);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `FK_LineOrder` FOREIGN KEY (`order_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `FK_LineProduct` FOREIGN KEY (`product_id`) REFERENCES `productos` (`id`);

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
