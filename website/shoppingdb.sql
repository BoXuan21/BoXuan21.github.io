-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Jun 2024 um 06:21
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `shoppingdb`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_auction`
--

CREATE TABLE `tbl_auction` (
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `biduserID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productCategory` varchar(50) NOT NULL,
  `productDescription` text NOT NULL,
  `productPrice` int(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `auctionEndTime` int(50) NOT NULL,
  `auctionDuration` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_auction`
--

INSERT INTO `tbl_auction` (`productID`, `userID`, `biduserID`, `productName`, `productCategory`, `productDescription`, `productPrice`, `filename`, `auctionEndTime`, `auctionDuration`) VALUES
(1, 12, 10, 'test', 'electronics', 'Test one week 1', 1045, '1337543.png', 2024, 7),
(2, 10, 0, 'newauction', 'cars', 'yippie^^', 200, 'car2.jpg', 2024, 14);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_products`
--

CREATE TABLE `tbl_products` (
  `productID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `productName` varchar(50) NOT NULL,
  `productCategory` varchar(50) NOT NULL,
  `productDescription` text NOT NULL,
  `productPrice` int(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `edited` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `tbl_products`
--

INSERT INTO `tbl_products` (`productID`, `userID`, `productName`, `productCategory`, `productDescription`, `productPrice`, `filename`, `edited`) VALUES
(1, 9, 'flowers', 'cars', 'asda', 14, 'Blumen.png', 1),
(2, 9, 'neon', 'cars', 'neon mooon', 123, 'cool.jpg', 1),
(3, 10, 'First casual product', 'electronics', 'Damage/Round\r\n111.9\r\nBottom 9%\r\nK/D Ratio\r\n0.82\r\nBottom 15%\r\nHeadshot %\r\n19.9%\r\nTop 44%\r\nWin %\r\n42.5%\r\nBottom 20%\r\nWins\r\n17\r\nTop 33%\r\nKAST\r\n69.6%\r\nBottom 40%\r\nDDÎ”/Round\r\n-21\r\nBottom 15%\r\nKills\r\n514\r\nTop 31%\r\nDeaths\r\n627\r\nAssists\r\n271\r\nACS\r\n174.2\r\nBottom 11%\r\nKAD Ratio\r\n1.25\r\nKills/Round\r\n0.6\r\nFirst Bloods\r\n57\r\nFlawless Rounds\r\n30\r\nAces\r\n1', 34, 'Obi_Schwan.png', 0),
(5, 10, 'Bitcoin', 'cars', 'real bitcoin', 21, 'bitcoin.jpg', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_password`) VALUES
(9, 'admin', 'admin@gmx.at', '1234'),
(10, 'casual', 'casual@gmx.at', '333!');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `tbl_auction`
--
ALTER TABLE `tbl_auction`
  ADD PRIMARY KEY (`productID`);

--
-- Indizes für die Tabelle `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`productID`);

--
-- Indizes für die Tabelle `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `tbl_auction`
--
ALTER TABLE `tbl_auction`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `tbl_products`
--
ALTER TABLE `tbl_products`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
