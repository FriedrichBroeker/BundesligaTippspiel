-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 12. Dez 2023 um 11:36
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bundesligatippspiel`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login`
--

CREATE TABLE `login` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `id` int(11) NOT NULL,
  `punktzahl` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `login`
--

INSERT INTO `login` (`username`, `password`, `id`, `punktzahl`) VALUES
('Broeker', '1234', 1, 0),
('Kevin', '1234', 2, 2),
('Berkay', '1234', 3, 4),
('Freddy', '1234', 4, 0),
('admin', '1234', 5, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mannschaften`
--

CREATE TABLE `mannschaften` (
  `mannschaftsid` int(11) NOT NULL,
  `mannschaftsname` varchar(30) DEFAULT NULL,
  `logo_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `mannschaften`
--

INSERT INTO `mannschaften` (`mannschaftsid`, `mannschaftsname`, `logo_url`) VALUES
(1, 'FC Bayern München', NULL),
(2, 'Borussia Dortmund', NULL),
(3, 'Bayer 04 Leverkusen', 'https://upload.wikimedia.org/wikipedia/de/thumb/f/f7/Bayer_Leverkusen_Logo.svg/1200px-Bayer_Leverkusen_Logo.svg.png'),
(4, 'RB Leipzig', NULL),
(5, 'SC Freiburg', NULL),
(6, 'Borussia Mönchengladbach', NULL),
(7, 'VfL Wolfsburg', NULL),
(8, 'Eintracht Frankfurt', NULL),
(9, '1. FC Union Berlin', NULL),
(10, 'VfB Stuttgart', NULL),
(11, '1. FC Heidenheim', NULL),
(12, '1. FC Köln', NULL),
(13, 'VfL Bochum', NULL),
(14, 'SV Darmstadt 98', NULL),
(15, 'Werder Bremen', NULL),
(16, 'FC Augsburg', NULL),
(17, 'TSG 1899 Hoffenheim', NULL),
(18, '1. FSV Mainz 05', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `spiel`
--

CREATE TABLE `spiel` (
  `spielnummer` int(11) NOT NULL,
  `heimmannschaftsid` int(11) DEFAULT NULL,
  `auswaertsmannschaftsid` int(11) DEFAULT NULL,
  `toreHeim` int(11) DEFAULT NULL,
  `toreAuswaerts` int(11) DEFAULT NULL,
  `spielStatus` varchar(20) DEFAULT 'nicht gespielt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `spiel`
--

INSERT INTO `spiel` (`spielnummer`, `heimmannschaftsid`, `auswaertsmannschaftsid`, `toreHeim`, `toreAuswaerts`, `spielStatus`) VALUES
(26, 2, 5, 1, 0, 'gespielt'),
(27, 7, 13, 1, 1, 'gespielt'),
(32, 3, 1, 1, 1, 'gespielt'),
(33, 10, 14, NULL, NULL, 'nicht gespielt'),
(34, 15, 1, NULL, NULL, 'nicht gespielt'),
(35, 5, 6, NULL, NULL, 'nicht gespielt'),
(36, 2, 1, NULL, NULL, 'nicht gespielt'),
(37, 4, 3, NULL, NULL, 'nicht gespielt'),
(38, 2, 1, 1, 0, 'gespielt'),
(39, 1, 7, 1, 0, 'gespielt'),
(40, 1, 2, NULL, NULL, 'nicht gespielt'),
(41, 2, 1, 1, 1, 'gespielt'),
(42, 3, 1, NULL, NULL, 'nicht gespielt');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tipp`
--

CREATE TABLE `tipp` (
  `tippid` int(11) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `spielid` int(11) DEFAULT NULL,
  `getippte_tore_heimteam` int(11) DEFAULT NULL,
  `getippte_tore_auswaertsteam` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `tipp`
--

INSERT INTO `tipp` (`tippid`, `id`, `spielid`, `getippte_tore_heimteam`, `getippte_tore_auswaertsteam`) VALUES
(30, 2, 27, 1, 3),
(31, 1, 27, 1, 2),
(32, 1, 32, 5, 1),
(33, 3, 32, 1, 1),
(34, 2, 32, 2, 2),
(35, 3, 38, 1, 2),
(36, 3, 39, 1, 0);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `mannschaften`
--
ALTER TABLE `mannschaften`
  ADD PRIMARY KEY (`mannschaftsid`);

--
-- Indizes für die Tabelle `spiel`
--
ALTER TABLE `spiel`
  ADD PRIMARY KEY (`spielnummer`),
  ADD KEY `heimmannschaftsid` (`heimmannschaftsid`),
  ADD KEY `auswaertsmannschaftsid` (`auswaertsmannschaftsid`);

--
-- Indizes für die Tabelle `tipp`
--
ALTER TABLE `tipp`
  ADD PRIMARY KEY (`tippid`),
  ADD UNIQUE KEY `unique_user_spiel_tipp` (`id`,`spielid`),
  ADD KEY `spielid` (`spielid`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT für Tabelle `mannschaften`
--
ALTER TABLE `mannschaften`
  MODIFY `mannschaftsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `spiel`
--
ALTER TABLE `spiel`
  MODIFY `spielnummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT für Tabelle `tipp`
--
ALTER TABLE `tipp`
  MODIFY `tippid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `spiel`
--
ALTER TABLE `spiel`
  ADD CONSTRAINT `spiel_ibfk_1` FOREIGN KEY (`heimmannschaftsid`) REFERENCES `mannschaften` (`mannschaftsid`),
  ADD CONSTRAINT `spiel_ibfk_2` FOREIGN KEY (`auswaertsmannschaftsid`) REFERENCES `mannschaften` (`mannschaftsid`);

--
-- Constraints der Tabelle `tipp`
--
ALTER TABLE `tipp`
  ADD CONSTRAINT `tipp_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`),
  ADD CONSTRAINT `tipp_ibfk_2` FOREIGN KEY (`spielid`) REFERENCES `spiel` (`spielnummer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
