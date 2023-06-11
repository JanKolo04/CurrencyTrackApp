-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 11 Cze 2023, 16:20
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `currency_tracker`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencies`
--

CREATE TABLE `currencies` (
  `currency_id` int(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(3) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `currencies`
--

INSERT INTO `currencies` (`currency_id`, `name`, `code`, `price`) VALUES
(1, 'bat (Tajlandia)', 'THB', 0.1201),
(2, 'dolar amerykański', 'USD', 4.1545),
(3, 'dolar australijski', 'AUD', 2.79),
(4, 'dolar Hongkongu', 'HKD', 0.5299),
(5, 'dolar kanadyjski', 'CAD', 3.1154),
(6, 'dolar nowozelandzki', 'NZD', 2.5322),
(7, 'dolar singapurski', 'SGD', 3.0925),
(8, 'euro', 'EUR', 4.4717),
(9, 'forint (Węgry)', 'HUF', 0.012109),
(10, 'frank szwajcarski', 'CHF', 4.6136),
(11, 'funt szterling', 'GBP', 5.2106),
(12, 'hrywna (Ukraina)', 'UAH', 0.1125),
(13, 'jen (Japonia)', 'JPY', 0.029748),
(14, 'korona czeska', 'CZK', 0.1891),
(15, 'korona duńska', 'DKK', 0.6002),
(16, 'korona islandzka', 'ISK', 0.029911),
(17, 'korona norweska', 'NOK', 0.3832),
(18, 'korona szwedzka', 'SEK', 0.3828),
(19, 'lej rumuński', 'RON', 0.9024),
(20, 'lew (Bułgaria)', 'BGN', 2.2863),
(21, 'lira turecka', 'TRY', 0.1768),
(22, 'nowy izraelski szekel', 'ILS', 1.1488),
(23, 'peso chilijskie', 'CLP', 0.005277),
(24, 'peso filipińskie', 'PHP', 0.0741),
(25, 'peso meksykańskie', 'MXN', 0.2394),
(26, 'rand (Republika Południowej Afryki)', 'ZAR', 0.2213),
(27, 'real (Brazylia)', 'BRL', 0.8438),
(28, 'ringgit (Malezja)', 'MYR', 0.9007),
(29, 'rupia indonezyjska', 'IDR', 0.00027995),
(30, 'rupia indyjska', 'INR', 0.050359),
(31, 'won południowokoreański', 'KRW', 0.003215),
(32, 'yuan renminbi (Chiny)', 'CNY', 0.5832),
(33, 'SDR (MFW)', 'XDR', 5.5395),
(34, 'polski złoty', 'PLN', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `last_converts`
--

CREATE TABLE `last_converts` (
  `converts_id` int(255) NOT NULL,
  `first_currency` varchar(3) DEFAULT NULL,
  `second_currency` varchar(3) DEFAULT NULL,
  `ammount` float DEFAULT NULL,
  `converted_ammount` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currency_id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indeksy dla tabeli `last_converts`
--
ALTER TABLE `last_converts`
  ADD PRIMARY KEY (`converts_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `currencies`
--
ALTER TABLE `currencies`
  MODIFY `currency_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3172;

--
-- AUTO_INCREMENT dla tabeli `last_converts`
--
ALTER TABLE `last_converts`
  MODIFY `converts_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
