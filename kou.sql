-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Kas 2016, 17:26:20
-- Sunucu sürümü: 5.6.17
-- PHP Sürümü: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `kou`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `duyurular`
--

CREATE TABLE IF NOT EXISTS `duyurular` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `baslik_tr` varchar(255) NOT NULL,
  `baslik_en` varchar(255) NOT NULL,
  `aciklama_tr` text NOT NULL,
  `aciklama_en` text NOT NULL,
  `durum` char(1) NOT NULL DEFAULT '1',
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ek_tr` varchar(255) NOT NULL,
  `ek_en` varchar(255) NOT NULL,
  `yazar` varchar(255) NOT NULL,
  `type` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `panel_user`
--

CREATE TABLE IF NOT EXISTS `panel_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `panel_user`
--

INSERT INTO `panel_user` (`id`, `user`, `pass`) VALUES
(1, 'kou', '7499e193891af1ef96d260d31eeff809');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `personel`
--

CREATE TABLE IF NOT EXISTS `personel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `isim` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `oda` varchar(255) NOT NULL,
  `telefon` varchar(255) NOT NULL,
  `arastirma_alani_tr` text NOT NULL,
  `arastirma_alani_en` text NOT NULL,
  `anabilim_dali` varchar(255) NOT NULL,
  `url` varchar(511) NOT NULL,
  `resim` varchar(255) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sira` int(11) NOT NULL,
  `durum` char(1) NOT NULL DEFAULT '1',
  `type` char(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(500) NOT NULL,
  `baslik_tr` text NOT NULL,
  `baslik_en` text NOT NULL,
  `resim_tr` varchar(255) NOT NULL,
  `resim_en` varchar(255) NOT NULL,
  `durum` char(1) NOT NULL DEFAULT '1',
  `sira` int(11) NOT NULL,
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
