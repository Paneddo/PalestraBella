-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 15, 2024 alle 10:38
-- Versione del server: 10.4.27-MariaDB
-- Versione PHP: 8.2.0

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
-- Struttura della tabella `corso`
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
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`idCorso`, `numeroPosti`, `descrizioneCorso`, `nomeCorso`, `idTipologia`, `idIstruttore`) VALUES
(7, 10, 'aa', 'aaa', 1, 8),
(10, 10, 'ss', 's', 1, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE `lezione` (
  `idLezione` int(11) NOT NULL,
  `giorno` date NOT NULL,
  `oraInizio` time NOT NULL,
  `oraFine` time NOT NULL,
  `Corso_idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura stand-in per le viste `postiLiberiPerCorso`
-- (Vedi sotto per la vista effettiva)
--
CREATE TABLE `postiLiberiPerCorso` (
`idCorso` int(11)
,`postiliberi` bigint(22)
);

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `idUtente` int(11) NOT NULL,
  `idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `prenotazione`
--

INSERT INTO `prenotazione` (`idUtente`, `idCorso`) VALUES
(1, 7),
(5, 10),
(8, 7);

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
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
-- Dump dei dati per la tabella `recensione`
--

INSERT INTO `recensione` (`idRecensione`, `idUtente`, `titolo`, `numeroStelle`, `testo`, `dataRecensione`) VALUES
(25, 1, 'sdsad', 4, 'gd', '2024-04-30 13:33:58');

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologia`
--

CREATE TABLE `tipologia` (
  `idTipologia` int(11) NOT NULL,
  `prezzoOrario` float(4,2) NOT NULL,
  `nomeTipologia` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `tipologia`
--

INSERT INTO `tipologia` (`idTipologia`, `prezzoOrario`, `nomeTipologia`) VALUES
(1, 10.00, 'Yoga');

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cellulare` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `scadenzaCertificatoMedico` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `email`, `password`, `cellulare`, `tipo`, `foto`, `scadenzaCertificatoMedico`) VALUES
(1, 'Angela', 'Rossi', 'angela@gmail.com', '$2y$10$RrDIwQWF98ANYcYnoJF7iu.r0004F4H7oN6xwKvsthRY7rY.tF/9i', '333 000 9999', 'segretaria', NULL, NULL),
(5, 'Lorenzo', 'Pani', 'lorenzopanilorenzo@gmail.com', '$2y$10$ceSYrqGnB6YkUsgKFlA9Y.TXMzK3BYo1limc4kG70zhWzAUAtBKhy', '333 3333', 'cliente', NULL, NULL),
(7, 'Christian', 'Quartucci', 'chris.quartucci05@gmail.com', '$2y$10$cJLx8qoXMYhHmyeIIxYGn.uJswQrrqMSBwECCtEKJkHwol9U4sLn6', '234324', 'cliente', NULL, NULL),
(8, 'Chris', 'Ninja', 'fifamobile19112005@gmail.com', '$2y$10$7oV3.3cGKyhIf7tjSU6MtuqwuH7BXk1iqLBu/D8eFKz31VUkihAuW', '333 3333', 'istruttore', '66387eabbbbed.jpeg', NULL);

-- --------------------------------------------------------

--
-- Struttura per vista `postiLiberiPerCorso`
--
DROP TABLE IF EXISTS `postiLiberiPerCorso`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `postiLiberiPerCorso`  AS SELECT `prenotazione`.`idCorso` AS `idCorso`, `corso`.`numeroPosti`- count(`prenotazione`.`idUtente`) AS `postiliberi` FROM (`prenotazione` join `corso` on(`prenotazione`.`idCorso` = `corso`.`idCorso`)) GROUP BY `prenotazione`.`idCorso`;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`idCorso`),
  ADD KEY `fk_Corso_Tipologia` (`idTipologia`),
  ADD KEY `fk_Corso_Utente1` (`idIstruttore`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`idLezione`,`Corso_idCorso`),
  ADD KEY `fk_Lezione_Corso1` (`Corso_idCorso`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`idUtente`,`idCorso`),
  ADD KEY `fk_Utente_has_Corso_Corso1` (`idCorso`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`idRecensione`),
  ADD KEY `fk_Recensione_Utente1` (`idUtente`);

--
-- Indici per le tabelle `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`idTipologia`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `idCorso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `idRecensione` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT per la tabella `tipologia`
--
ALTER TABLE `tipologia`
  MODIFY `idTipologia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `fk_Corso_Tipologia` FOREIGN KEY (`idTipologia`) REFERENCES `tipologia` (`idTipologia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Corso_Utente1` FOREIGN KEY (`idIstruttore`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `fk_Lezione_Corso1` FOREIGN KEY (`Corso_idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `fk_Utente_has_Corso_Corso1` FOREIGN KEY (`idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Utente_has_Corso_Utente1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `fk_Recensione_Utente1` FOREIGN KEY (`idUtente`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
