-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Dez 2023 um 09:31
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
('Broeker', '1234', 1, 4),
('Kevin', '1234', 2, 4),
('Berkay', '1234', 3, 8),
('Freddy', '1234', 4, 4),
('admin', '1234', 5, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mannschaften`
--

CREATE TABLE `mannschaften` (
  `mannschaftsid` int(11) NOT NULL,
  `mannschaftsname` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `mannschaften`
--

INSERT INTO `mannschaften` (`mannschaftsid`, `mannschaftsname`) VALUES
(1, 'FC Bayern München'),
(2, 'Borussia Dortmund'),
(3, 'Bayer 04 Leverkusen'),
(4, 'RB Leipzig'),
(5, 'SC Freiburg'),
(6, 'Borussia Mönchengladbach'),
(7, 'VfL Wolfsburg'),
(8, 'Eintracht Frankfurt'),
(9, '1. FC Union Berlin'),
(10, 'VfB Stuttgart'),
(11, '1. FC Heidenheim'),
(12, '1. FC Köln'),
(13, 'VfL Bochum'),
(14, 'SV Darmstadt 98'),
(15, 'Werder Bremen'),
(16, 'FC Augsburg'),
(17, 'TSG 1899 Hoffenheim'),
(18, '1. FSV Mainz 05');

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
(32, 3, 1, 1, 1, 'gespielt');

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
(34, 2, 32, 2, 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT für Tabelle `mannschaften`
--
ALTER TABLE `mannschaften`
  MODIFY `mannschaftsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT für Tabelle `spiel`
--
ALTER TABLE `spiel`
  MODIFY `spielnummer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT für Tabelle `tipp`
--
ALTER TABLE `tipp`
  MODIFY `tippid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
