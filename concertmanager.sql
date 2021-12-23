-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Loomise aeg: Dets 23, 2021 kell 03:35 PL
-- Serveri versioon: 10.4.11-MariaDB
-- PHP versioon: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Andmebaas: `concertmanager`
--

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `about`
--

CREATE TABLE `about` (
  `id` bigint(20) NOT NULL,
  `kava_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `language` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT 'et'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `about`
--

INSERT INTO `about` (`id`, `kava_id`, `title`, `description`, `language`) VALUES
(1, 1, 'See on sündmus eesti keeles', 'Kirjeldame pikat-laiat', 'et'),
(2, 1, 'La place pour l\'évenement', 'Celui-ci est la déscription de l\'endroit ou les choses se passent', 'fr'),
(3, 1, 'Events venue', 'Here we describe where actually people should go if they go to the event', 'en'),
(4, 1, 'See on koht, kus toimub asju', 'Eks seda kohta, kus midagi aset leiab, peab kirjeldama ka, kui just rahvast üllatada ei taha', 'et'),
(5, 2, 'Another place', 'Another description of another place', 'en'),
(6, 2, 'Et voilà l\'évenement', 'Rien d\'écrire', 'fr'),
(7, 1, 'L\'évenement s\'appelle', 'Il y\'a toujours qch qu\'on a besoin de savoir avant l\'évenement', 'fr'),
(8, 1, 'The name of the event', 'We describe here to make people know what will happen there where they go', 'en'),
(9, 2, 'Teine koht', 'Teine kirjeldus, mis käib teise koha kohta', 'et'),
(10, 2, 'Un autre place', 'et une autre texte à décriver', 'fr'),
(11, 2, 'Another event', 'Another description for another event', 'en'),
(12, 2, 'Teine sündmus', 'Ja siin on hoopis teistsugune kirjeldus', 'et'),
(13, 3, 'Absoluutselt teistsugune koht', 'Avastasin, et kolmanda paiga kohta polnud ühtki kirjeldust', 'et'),
(14, 3, 'Absolutely another place', 'Without textual information about the venue it just doesn\'t display', 'en'),
(15, 3, 'Une place absolument différent', 'Sans une texte decrivant la place on n\'en peut rien savoier :)', 'fr'),
(16, NULL, 'Näidissündmus näitamaks uue sündmuse sisestamist', 'See siin on väljamõeldud sündmus, mis näitab seda, mismoodi on ühe sündmusega seotud andmed omavahel seotud ning kuidas nad paistavad välja eeskätt sellele inimesele, kes sündmust haldab. ', 'et'),
(17, NULL, 'Exemple d\'événement pour afficher la soumission d\'un nouvel evenement', 'Il s\'agit d\'un événement fictif, qui montre comment les données liées à un événement sont liées les unes aux autres et à quoi elles ressemblent, en particulier pour la personne qui gère l\'événement.', 'fr'),
(18, NULL, 'Sample event to show new event submission', 'This is a fictional event, which shows how the data related to one event is related to each other and how it looks, especially to the person who manages the event.', 'en'),
(19, NULL, 'Näidissündmus näitamaks uue sündmuse sisestamist', 'See siin on väljamõeldud sündmus, mis näitab seda, mismoodi on ühe sündmusega seotud andmed omavahel seotud ning kuidas nad paistavad välja eeskätt sellele inimesele, kes sündmust haldab. ', 'et'),
(20, NULL, 'Exemple d\'événement pour afficher la soumission d\'un nouvel evenement', 'Il s\'agit d\'un événement fictif, qui montre comment les données liées à un événement sont liées les unes aux autres et à quoi elles ressemblent, en particulier pour la personne qui gère l\'événement.', 'fr'),
(21, NULL, 'Sample event to show new event submission', 'This is a fictional event, which shows how the data related to one event is related to each other and how it looks, especially to the person who manages the event.', 'en'),
(22, NULL, 'Näidissündmus näitamaks uue sündmuse sisestamist', 'See siin on väljamõeldud sündmus, mis näitab seda, mismoodi on ühe sündmusega seotud andmed omavahel seotud ning kuidas nad paistavad välja eeskätt sellele inimesele, kes sündmust haldab. ', 'et'),
(23, NULL, 'Exemple d\'événement pour afficher la soumission d\'un nouvel evenement', 'Il s\'agit d\'un événement fictif, qui montre comment les données liées à un événement sont liées les unes aux autres et à quoi elles ressemblent, en particulier pour la personne qui gère l\'événement.', 'fr'),
(24, NULL, 'Sample event to show new event submission', 'This is a fictional event, which shows how the data related to one event is related to each other and how it looks, especially to the person who manages the event.', 'en'),
(25, NULL, 'See sündmus on väheke isevärki', 'Annab ikka välja mõelda neid näidissündmusi, mis mõeldud üksnes näitamaks, kuidas nad paistavad välja eeskätt sellele inimesele, kes sündmust haldab. ', 'et'),
(26, NULL, 'Cet évenement est un peu particulière', 'Il s\'agit d\'un événement fictif, qui montre comment les données liées à un événement sont liées les unes aux autres et à quoi elles ressemblent, en particulier pour la personne qui gère l\'événement.', 'fr'),
(27, NULL, 'This event is a little bit particulary', 'This is a fictional event, which shows how the data related to one event is related to each other and how it looks, especially to the person who manages the event.', 'en'),
(28, NULL, 'See väheke isevärki', 'Annab ikka välja mõelda neid näidissündmusi, mis mõeldud üksnes näitamaks, kuidas nad paistavad välja eeskätt sellele inimesele, kes sündmust haldab. ', 'et'),
(29, NULL, ' un peu particulière', 'Il s\'agit d\'un événement fictif, qui montre comment les données liées à un événement sont liées les unes aux autres et à quoi elles ressemblent, en particulier pour la personne qui gère l\'événement.', 'fr'),
(30, NULL, 'a little bit particulary', 'This is a fictional event, which shows how the data related to one event is related to each other and how it looks, especially to the person who manages the event.', 'en');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `esitajad`
--

CREATE TABLE `esitajad` (
  `id` int(11) NOT NULL,
  `esitus_id` int(11) DEFAULT NULL,
  `ext_id` varchar(45) COLLATE utf8mb4_estonian_ci NOT NULL,
  `nimi` varchar(255) COLLATE utf8mb4_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `esitajad`
--

INSERT INTO `esitajad` (`id`, `esitus_id`, `ext_id`, `nimi`) VALUES
(1, 1, '', 'RAMMMMM'),
(2, 2, '', 'HaLe MaJa');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `esitus`
--

CREATE TABLE `esitus` (
  `id` int(11) NOT NULL,
  `kava_id` int(11) DEFAULT NULL,
  `jrk` int(11) NOT NULL,
  `teos` varchar(45) COLLATE utf8mb4_estonian_ci NOT NULL,
  `teos_info_txt` text COLLATE utf8mb4_estonian_ci NOT NULL,
  `teose_kestvus` time NOT NULL,
  `lisakestvus` time NOT NULL,
  `esituse_kestvus` time NOT NULL,
  `perfdesc` tinytext COLLATE utf8mb4_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `esitus`
--

INSERT INTO `esitus` (`id`, `kava_id`, `jrk`, `teos`, `teos_info_txt`, `teose_kestvus`, `lisakestvus`, `esituse_kestvus`, `perfdesc`) VALUES
(1, 1, 0, '1582693197-2', '{\"pealkiri\":\"Aeg meil minna üheskoos\",\"autorid\":\"Agu Tammeorg, tekst: Ott Arder, seadnud Ahti Bachblum\"}', '00:05:00', '00:00:00', '00:05:00', ''),
(2, 1, 1, '123323-2', '{\"pealkiri\":\"Tre pepparkaksgubbar\",\"autorid\":\"Vello Lipand, tekst: Astrid Gullstrand\"}', '00:01:09', '00:00:00', '00:01:09', '');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `kava`
--

CREATE TABLE `kava` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_estonian_ci NOT NULL,
  `description` text COLLATE utf8mb4_estonian_ci NOT NULL,
  `syndmus_id` int(11) NOT NULL,
  `syndmus` text COLLATE utf8mb4_estonian_ci NOT NULL,
  `concert_date` date NOT NULL,
  `start_date` time NOT NULL,
  `start_time` time NOT NULL,
  `duration` time NOT NULL,
  `calc_duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `kava`
--

INSERT INTO `kava` (`id`, `title`, `description`, `syndmus_id`, `syndmus`, `concert_date`, `start_date`, `start_time`, `duration`, `calc_duration`) VALUES
(1, 'Nüüd proovin veel uuemat moodi', '', 0, '', '2021-12-31', '00:00:00', '21:00:00', '00:00:00', '00:06:09');

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `organisation`
--

CREATE TABLE `organisation` (
  `id` bigint(20) NOT NULL,
  `known_name` varchar(255) COLLATE utf8mb4_estonian_ci NOT NULL,
  `known_abbreviation_name` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `official_registry_name` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `registry_code` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  `ended` date DEFAULT NULL,
  `primary_contact_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `organisation`
--

INSERT INTO `organisation` (`id`, `known_name`, `known_abbreviation_name`, `official_registry_name`, `type`, `registry_code`, `created`, `is_active`, `ended`, `primary_contact_id`) VALUES
(1, 'Concert Frog', 'CF', 'OÜ Kontsertkonn', 'OÜ', '12345678', '2021-03-24', b'1', NULL, 10);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `person`
--

CREATE TABLE `person` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_estonian_ci NOT NULL,
  `middle_name` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_estonian_ci NOT NULL,
  `national_id` varchar(255) COLLATE utf8mb4_estonian_ci DEFAULT NULL,
  `born` date NOT NULL,
  `is_alive` bit(1) DEFAULT NULL,
  `deceased` date DEFAULT NULL,
  `is_user` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `person`
--

INSERT INTO `person` (`id`, `first_name`, `middle_name`, `last_name`, `national_id`, `born`, `is_alive`, `deceased`, `is_user`) VALUES
(1, 'Jaanus', NULL, 'Nurmoja', '3670620305', '1967-06-23', b'1', NULL, 0),
(2, 'Oliver', NULL, 'Kotkas', NULL, '1970-01-01', b'1', NULL, 0),
(3, 'Friedrich', 'Reinhold', 'Kreutzwald', NULL, '1803-12-26', b'0', '1882-08-25', 0);

-- --------------------------------------------------------

--
-- Tabeli struktuur tabelile `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `username` varchar(20) COLLATE utf8mb4_estonian_ci NOT NULL,
  `role` enum('ülemhaldur','kunstiline juht','','') COLLATE utf8mb4_estonian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_estonian_ci;

--
-- Andmete tõmmistamine tabelile `users`
--

INSERT INTO `users` (`id`, `person_id`, `organisation_id`, `username`, `role`) VALUES
(1, 1, 1, 'jaanusnurmoja', 'kunstiline juht'),
(2, 2, NULL, 'oliverkotkas', 'ülemhaldur');

--
-- Indeksid tõmmistatud tabelitele
--

--
-- Indeksid tabelile `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indeksid tabelile `esitajad`
--
ALTER TABLE `esitajad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kava` (`esitus_id`);

--
-- Indeksid tabelile `esitus`
--
ALTER TABLE `esitus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kava_id` (`kava_id`);

--
-- Indeksid tabelile `kava`
--
ALTER TABLE `kava`
  ADD PRIMARY KEY (`id`),
  ADD KEY `syndmus_id` (`syndmus_id`);

--
-- Indeksid tabelile `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ux_organisation__primary_contact_id` (`primary_contact_id`);

--
-- Indeksid tabelile `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`);

--
-- Indeksid tabelile `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `person` (`person_id`),
  ADD KEY `organisation` (`organisation_id`);

--
-- AUTO_INCREMENT tõmmistatud tabelitele
--

--
-- AUTO_INCREMENT tabelile `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT tabelile `esitajad`
--
ALTER TABLE `esitajad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabelile `esitus`
--
ALTER TABLE `esitus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT tabelile `kava`
--
ALTER TABLE `kava`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT tabelile `organisation`
--
ALTER TABLE `organisation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT tabelile `person`
--
ALTER TABLE `person`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT tabelile `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tõmmistatud tabelite piirangud

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
