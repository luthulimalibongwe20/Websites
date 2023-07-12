-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2023 at 03:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connex`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(200) NOT NULL,
  `price` varchar(200) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `stock` int(2) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `price`, `description`, `stock`, `status`, `name`, `image`) VALUES
('462315', '20000', 'ACER H7550ST PROJECTOR WITH 1080P RESOLUTION.', 2, 'New', 'Acer Projector', 'acer-h7550st-projector-with-1080p-resolution-3000-ansi-brightness-vgahdmimhl-white.jpg'),
('462351', '13500.00', 'PICO 4 ALL-IN-ONE VR HEADSET 256GB - 6 FREE GAME BUNDLE\r\n', 3, 'New', 'PICO 4', 'pico-4-all-in-one-vr-128gb-headset.jpg'),
('462589', '35000.00', 'ACER P6200 PROJECTOR, XGA RESOLUTION', 3, 'New', 'ACER P6200', 'acer-p6200-projector-xga-resolution-vgamhl-connection-brightness-5000-ansi-contrast-200001-black.jpg'),
('463524', '8450.00', 'ACER C120 PROJECTOR, 480P RESOLUTION, 100 ANSI BRIGHTNESS, USB CONNECTION, LED, LAMP LIFE 20,000 H, BLACK\r\n', 3, 'New', 'ACER C120 PROJECTOR', 'acer-c120-projector-480p-resolution-100-ansi-brightness-usb-connection-led-lamp-life-20000-h-black.jpg'),
('478965', ' 1790.00', 'SMATREE META OCULUS QUEST 2 CHARGING DOCK STATION\r\n', 3, 'New', 'SMATREE META', 'smatree-meta-quest-2-oculus-quest-2-charging-dock-charge-oculus-quest-2-vr-headset-and-touch-controller.jpg'),
('526428', '5100.00', 'WAHOO FITNESS ELEMNT BOLT BIKE COMPUTER, UNISEX ADULT, BLACK\r\n', 3, 'New', 'WHA BRand', 'wahoo-fitness-elemnt-bolt-bike-computer-unisex-adult-black.jpg'),
('562315', '14500.00', 'PIONEER CDJ 350 MULTI PLAYER USB/CD NEW', 3, 'New', 'PIONEER CDJ', 'pioneer-cdj-350-multi-player-usbcd-refurbished.jpg'),
('596846', '5000000', 'ACER PREDATOR GD711', 3, 'New', 'ACER PREDATOR', 'acer-predator-gd711-projector-1450-ansi-dlp-2160p-3840x2160-3d-black.jpg'),
('636528', '35000.00', 'ACER P6200 PROJECTOR, XGA', 3, NULL, 'ACER P6200 PROJECTOR', 'acer-p6200-projector-xga-resolution-vgamhl-connection-brightness-5000-ansi-contrast-200001-black.jpg'),
('645289', '8450.00', 'BOSE SMART SOUNDBAR 900 WITH DOLBY ATMOS AND ALEXA VOICE ASSISTANT, BLACK\n', 3, 'New', 'BOSE SMART', 'bose-smart-soundbar-900-with-dolby-atmos-and-alexa-voice-assistant-black.jpg'),
('798659', '13900.00', 'PICO 4 ALL-IN-ONE VR HEADSET 256GB - 6 FREE GAME BUNDLE\r\n', 3, 'New', 'PICO 4', 'pico-4-all-in-one-vr-128gb-headset.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(200) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) DEFAULT NULL,
  `id` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `surname`, `phone`, `password`, `email`, `username`, `id`, `image`) VALUES
('Alec', 'shelembe', '0727237808', '1234', 'ashelembe96@gmail.com', 'acesnizzy', NULL, 'default.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
