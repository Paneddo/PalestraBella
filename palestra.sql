-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2024 at 08:26 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palestra`
--

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE `corso` (
  `idCorso` int(11) NOT NULL,
  `numeroPosti` int(11) NOT NULL,
  `descrizioneCorso` varchar(255) NOT NULL,
  `nomeCorso` varchar(45) NOT NULL,
  `idTipologia` int(11) NOT NULL,
  `idIstruttore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `corso`
--

INSERT INTO `corso` (`idCorso`, `numeroPosti`, `descrizioneCorso`, `nomeCorso`, `idTipologia`, `idIstruttore`) VALUES
(7, 10, 'sos', 'CiccioGamer', 1, 8),
(12, 10, 'sd', 'scuola', 3, 22);

-- --------------------------------------------------------

--
-- Table structure for table `lezione`
--

CREATE TABLE `lezione` (
  `idLezione` int(11) NOT NULL,
  `giorno` varchar(12) NOT NULL,
  `oraInizio` time NOT NULL,
  `oraFine` time NOT NULL,
  `idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lezione`
--

INSERT INTO `lezione` (`idLezione`, `giorno`, `oraInizio`, `oraFine`, `idCorso`) VALUES
(0, 'Lunedì', '13:15:00', '14:15:00', 7);

-- --------------------------------------------------------

--
-- Stand-in structure for view `postiliberipercorso`
-- (See below for the actual view)
--
CREATE TABLE `postiliberipercorso` (
`idCorso` int(11)
,`postiliberi` bigint(22)
);

-- --------------------------------------------------------

--
-- Table structure for table `prenotazione`
--

CREATE TABLE `prenotazione` (
  `idUtente` int(11) NOT NULL,
  `idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `prenotazione`
--

INSERT INTO `prenotazione` (`idUtente`, `idCorso`) VALUES
(1, 7),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `recensione`
--

CREATE TABLE `recensione` (
  `idRecensione` int(11) NOT NULL,
  `idUtente` int(11) NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `numeroStelle` int(11) NOT NULL,
  `testo` varchar(255) NOT NULL,
  `dataRecensione` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `recensione`
--

INSERT INTO `recensione` (`idRecensione`, `idUtente`, `titolo`, `numeroStelle`, `testo`, `dataRecensione`) VALUES
(25, 1, 'sdsad', 4, 'gd', '2024-04-30 13:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `tipologia`
--

CREATE TABLE `tipologia` (
  `idTipologia` int(11) NOT NULL,
  `prezzoOrario` float(4,2) NOT NULL,
  `nomeTipologia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tipologia`
--

INSERT INTO `tipologia` (`idTipologia`, `prezzoOrario`, `nomeTipologia`) VALUES
(1, 10.00, 'Yoga'),
(2, 4.00, 'Sus'),
(3, 1.00, 'AAA');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `genere` varchar(1) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cellulare` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `genere`, `email`, `password`, `cellulare`, `tipo`, `foto`) VALUES
(1, 'Angela', 'CPN', 'f', 'angela@gmail.com', '$2y$10$RrDIwQWF98ANYcYnoJF7iu.r0004F4H7oN6xwKvsthRY7rY.tF/9i', '333 000 9999', 'segretaria', NULL),
(5, 'Lorenzo', 'Pani', '', 'lorenzopanilorenzo@gmail.com', '$2y$10$ceSYrqGnB6YkUsgKFlA9Y.TXMzK3BYo1limc4kG70zhWzAUAtBKhy', '333 3333', 'cliente', NULL),
(7, 'Christian', 'Quartucci', '', 'chris.quartucci05@gmail.com', '$2y$10$cJLx8qoXMYhHmyeIIxYGn.uJswQrrqMSBwECCtEKJkHwol9U4sLn6', '234324', 'cliente', NULL),
(8, 'Chris', 'Ninja', '', 'fifamobile19112005@gmail.com', '$2y$10$7oV3.3cGKyhIf7tjSU6MtuqwuH7BXk1iqLBu/D8eFKz31VUkihAuW', '333 3333', 'istruttore', '66387eabbbbed.jpeg'),
(16, 'Lorenzo', 'Pani', '', 'lebecay767@qiradio.com', '$2y$10$fuBISYM5pSWNSoyHflW3LOo4CcCjX97tqJ//MluBGoXvfSiRwbsd.', '54', 'cliente', NULL),
(19, 'sdf', 'sdf', '', 'fsdf@g.com', '$2y$10$XdlzEnxwBIyqIbnoSLJVyeY/ivH2IqiidqrORBeXijtZtjet8CgHG', 'sdfds', 'istruttore', NULL),
(22, 'Lorenzo', 'Pani', '', 'lorenzopanienzo@gmail.co', '$2y$10$kpjVHgYS.nj/EFi1qz0N2OgLYPUbNJcI/SnhEd2LLDZQmiWZ1R00.', 'ffff', 'istruttore', 'default.png');

-- --------------------------------------------------------

--
-- Structure for view `postiliberipercorso`
--
DROP TABLE IF EXISTS `postiliberipercorso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `postiliberipercorso`  AS SELECT `prenotazione`.`idCorso` AS `idCorso`, `corso`.`numeroPosti`- count(`prenotazione`.`idUtente`) AS `postiliberi` FROM (`prenotazione` join `corso` on(`prenotazione`.`idCorso` = `corso`.`idCorso`)) GROUP BY `prenotazione`.`idCorso` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`idCorso`),
  ADD KEY `fk_Corso_Tipologia` (`idTipologia`),
  ADD KEY `fk_Corso_Utente1` (`idIstruttore`);

--
-- Indexes for table `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`idLezione`,`idCorso`),
  ADD KEY `fk_Lezione_Corso1` (`idCorso`);

--
-- Indexes for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`idUtente`,`idCorso`),
  ADD KEY `fk_Utente_has_Corso_Corso1` (`idCorso`);

--
-- Indexes for table `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`idRecensione`),
  ADD KEY `fk_Recensione_Utente1` (`idUtente`);

--
-- Indexes for table `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`idTipologia`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `corso`
--
ALTER TABLE `corso`
  MODIFY `idCorso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `recensione`
--
ALTER TABLE `recensione`
  MODIFY `idRecensione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `idTipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `fk_Corso_Tipologia` FOREIGN KEY (`idTipologia`) REFERENCES `tipologia` (`idTipologia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Corso_Utente1` FOREIGN KEY (`idIstruttore`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `fk_Lezione_Corso1` FOREIGN KEY (`idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `fk_Utente_has_Corso_Corso1` FOREIGN KEY (`idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utente_has_Corso_Utente1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `fk_Recensione_Utente1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
