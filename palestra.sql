-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Mag 06, 2024 alle 09:08
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
  `NumeroPosti` int(11) DEFAULT NULL,
  `DescrizioneCorso` varchar(45) DEFAULT NULL,
  `TitoloCorso` varchar(45) DEFAULT NULL,
  `Tipologia_idTipologia` int(11) NOT NULL,
  `idIstruttore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `lezione`
--

CREATE TABLE `lezione` (
  `idLezione` int(11) NOT NULL,
  `Giorno` date DEFAULT NULL,
  `OraInizio` varchar(45) DEFAULT NULL,
  `OraFine` varchar(45) DEFAULT NULL,
  `Corso_idCorso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `prenotazione`
--

CREATE TABLE `prenotazione` (
  `Corso_idCorso` int(11) NOT NULL,
  `Utente Registrato_idUtenteRegistrato` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `recensione`
--

CREATE TABLE `recensione` (
  `idRecensione` int(11) NOT NULL,
  `dataRecensione` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `titolo` varchar(45) NOT NULL,
  `testo` varchar(500) NOT NULL,
  `stelle` int(11) NOT NULL,
  `Utente_idUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipologia`
--

CREATE TABLE `tipologia` (
  `idTipologia` int(11) NOT NULL,
  `PrezzoOrario` int(11) DEFAULT NULL,
  `NomeTipologia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(45) DEFAULT NULL,
  `cognome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `cellulare` varchar(45) DEFAULT NULL,
  `tipo` varchar(50) NOT NULL,
  `scadenzaCertificatoMedico` varchar(45) DEFAULT NULL,
  `fotoProfilo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`idUtente`, `nome`, `cognome`, `email`, `password`, `cellulare`, `tipo`, `scadenzaCertificatoMedico`, `fotoProfilo`) VALUES
(1, 'Angela', 'Rossi', 'angela@gmail.com', '$2y$10$RrDIwQWF98ANYcYnoJF7iu.r0004F4H7oN6xwKvsthRY7rY.tF/9i', '000 4500 999', 'segretaria', NULL, NULL),
(2, 'dfsa', 'sdfds', 'lab@gmail.com', '$2y$10$Ix/7.bggEl/9ld/YEmQUXOKIRegZnnH7Rtn.NMKTpZD0SdUnR6/Fq', '2312', 'cliente', NULL, NULL),
(3, 'Giancarlo', 'Zita', 'lesgo@gmail.com', '$2y$10$zC78gYWnSjFfKzaZbrS6Teil0YTbVM458DGVPBqijaM0W8GcFl0Ci', '333', 'istruttore', NULL, '66387eeae6bc5.jpeg');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`idCorso`),
  ADD KEY `fk_Corso_Tipologia1` (`Tipologia_idTipologia`),
  ADD KEY `fk_Corso_Istruttore1` (`idIstruttore`);

--
-- Indici per le tabelle `lezione`
--
ALTER TABLE `lezione`
  ADD PRIMARY KEY (`idLezione`),
  ADD KEY `fk_Lezione_Corso1` (`Corso_idCorso`);

--
-- Indici per le tabelle `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD PRIMARY KEY (`Corso_idCorso`,`Utente Registrato_idUtenteRegistrato`),
  ADD KEY `fk_Corso_has_Utente Registrato_Utente Registrato1` (`Utente Registrato_idUtenteRegistrato`);

--
-- Indici per le tabelle `recensione`
--
ALTER TABLE `recensione`
  ADD PRIMARY KEY (`idRecensione`),
  ADD KEY `fk_Recensione_Utente2` (`Utente_idUtente`);

--
-- Indici per le tabelle `tipologia`
--
ALTER TABLE `tipologia`
  ADD PRIMARY KEY (`idTipologia`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `recensione`
--
ALTER TABLE `recensione`
  MODIFY `idRecensione` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `utente`
--
ALTER TABLE `utente`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `fk_Corso_Istruttore1` FOREIGN KEY (`idIstruttore`) REFERENCES `istruttore` (`Utente Registrato_idUtenteRegistrato`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Corso_Tipologia1` FOREIGN KEY (`Tipologia_idTipologia`) REFERENCES `tipologia` (`idTipologia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `lezione`
--
ALTER TABLE `lezione`
  ADD CONSTRAINT `fk_Lezione_Corso1` FOREIGN KEY (`Corso_idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `prenotazione`
--
ALTER TABLE `prenotazione`
  ADD CONSTRAINT `fk_Corso_has_Utente Registrato_Corso1` FOREIGN KEY (`Corso_idCorso`) REFERENCES `corso` (`idCorso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Corso_has_Utente Registrato_Utente Registrato1` FOREIGN KEY (`Utente Registrato_idUtenteRegistrato`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `recensione`
--
ALTER TABLE `recensione`
  ADD CONSTRAINT `fk_Recensione_Utente2` FOREIGN KEY (`Utente_idUtente`) REFERENCES `utente` (`idUtente`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
