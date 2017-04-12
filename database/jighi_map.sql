-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 08 Mai 2015 à 14:04
-- Version du serveur: 5.5.40-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `jighi_map`
--

-- --------------------------------------------------------

--
-- Structure de la table `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `access_id` int(11) NOT NULL AUTO_INCREMENT,
  `access_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `access`
--

INSERT INTO `access` (`access_id`, `access_type`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` int(11) NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address_type_id` int(11) DEFAULT NULL,
  `latitude` varchar(55) DEFAULT NULL,
  `longitude` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`address_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Contenu de la table `address`
--

INSERT INTO `address` (`address_id`, `address`, `zone_id`, `country_id`, `state_id`, `location`, `zipcode`, `city`, `address_type_id`, `latitude`, `longitude`) VALUES
(3, 'BACI TOIT ROUGE', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.331439', '-4.055166'),
(4, 'CRS', 4, 1, 1, 'Abidjan', '00225', 'COTE D’IVOIRE', 4, '5.330113', '-4.128313'),
(5, 'COOPEC SELMER', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.341056', '-4.066523'),
(6, 'BACI-ATTECOUBE', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.348352', '-4.034874'),
(9, 'OCIT VRIDI', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 1, '5.264692', '-3.987353'),
(11, 'COMPHARMED VRIDI', 3, 1, 1, 'Abidjan', '00225', 'COTE D’IVOIRE', 4, '5.285278', '-4.007778'),
(16, 'SOTRA KOUMASSI', 3, 1, 1, 'Abidjan', '110', 'COTE D’IVOIRE', 4, '5.286389', '-3.953056'),
(17, 'SOGEA PORT DE PECHE', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.288203', '-4.012800'),
(19, 'UNICEF COCODY', 2, 1, 1, 'Abidjan', '110', 'COTE D’IVOIRE', 4, '5.341390', '-3.961670'),
(21, 'BNI ABOBO', 1, 1, 1, 'Abidjan', '110', 'COTE D’IVOIRE', 4, '5.423440', '-4.015735'),
(22, 'BACI ABOBO', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.422308', '-4.015097'),
(23, 'ECOBANK ABOBO SANTE', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.423802', '-4.015173'),
(24, 'ECOBANK ABOBO-GARE', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D’IVOIRE', 4, '5.439845', '-4.043167'),
(25, 'BOA ABOBO', 1, 1, 1, 'Abidjan', '00225', 'COTE D’IVOIRE', 4, '5.418177', '-4.016953'),
(26, 'BNI AGBAN', 1, 1, 1, 'Abidjan', '00225', 'COTE D’IVOIRE', 4, '5.368337', '-4.000187'),
(27, 'LA FAYETTE', 1, 1, 1, 'Abidjan', '00225', 'COTE D’IVOIRE', 4, '5.393056', '-4.994444'),
(28, 'ADM COCOA ABOBO', 1, 1, 1, 'Abidjan', '00225', 'COTE D’IVOIRE', 4, '5.456283', '-4.054518'),
(29, 'OCIT COCODY DANGA', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 1, '5.339692', '-4.004342'),
(30, 'BIAO STE-MARIE', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.335045', '-3.997897'),
(31, 'SOL BENI', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.326010', '-3.960888'),
(32, 'UNICEF', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.341390', '-3.961670'),
(33, 'BNI COCODY DANGA', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.33694', '-4.00528'),
(34, 'PFIZER', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.3386536', '-4.0128889'),
(35, 'VOODOO', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.353890', '-3.980560'),
(36, 'AWI', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.355833', '-3.989444'),
(37, 'SIB RIVIERA 3', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.35472', '-3.95944'),
(38, 'SIB Palmeraie', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.36389', '-3.96028'),
(39, 'SIB ANGRE DJIBI', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.40528', '-3.99361'),
(40, 'SDV Université', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.3453486', '-3.9899004'),
(41, 'VIVO ENERGIES', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.26472', '-4.01278'),
(42, 'DGI COCODY', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.35778', '-4.00139'),
(43, 'FRANCHISE_ATTOBAN', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.35556', '-3.97778'),
(44, 'OCIT VILLA', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 3, '5.36417', '-3.98889'),
(45, 'BIAO SOCOCE', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE ', 4, '5.37417', '-3.99806'),
(46, 'SODIREP 2 PLATEAU', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.37722', '-3.9925'),
(47, 'SIB COCODY', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.33833', '-4.00389'),
(48, 'INSTITUT PASTEUR', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.344150', '-3.995577'),
(49, 'AFRIQUE TABAC VALLON', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.359044', '-3.989716'),
(50, 'OCIT BANCO (ZI)', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 3, '5.333900', '-4.074075'),
(52, 'SIB-MAROC', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.334556', '-4.102663'),
(53, 'FRANCH-SOGEf', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.336110', '-4.083890'),
(54, 'SOLIBRA-YOP', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.381670', '-4.079440'),
(55, 'BACI-ZONE INDUSTRIELLE', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.370498', '-4.081094'),
(56, 'BACI-SIPOREX', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.351922', '-4.074111'),
(57, 'DIAMOND BANK', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.369238', '-4.079887'),
(58, 'BIAO-FIGAYO', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.348773', '-4.073114'),
(59, 'LABOREX_YOP', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.367178', '-4.088962'),
(60, 'SOTRA-YOP', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.368803', '-4.075880'),
(61, 'SIB-NOUV QUARTIER', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.338976', '-4.062027'),
(62, 'DGI-ATTECOUBE', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.47292', '-4.040696'),
(63, 'CORIS-YOP', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.342809', '-4.073115'),
(64, 'BIAO-BEL AIR', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.346434', ' -4.064049'),
(65, 'BACI-ONUCI', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.33889', '-4.03083'),
(66, 'TRESOR ABOBO GARE', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.42111', '-4.01556'),
(68, 'SODECI ABOBO SOGEFIA', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.438659', '-4.013344'),
(69, 'MUGEFCI ABOBO GARE  ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.423578', '-4.016240'),
(70, 'ABOBO CENTRAL', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 3, '5.4228117744094', ' -4.01566390555729'),
(71, 'SIB ABOBO ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.42139', '-4.01833'),
(72, 'UBA ABOBO ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.41139', '-4.01722'),
(73, 'ASEC ABOBO ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.41917', '-4.02278'),
(74, 'FILTISAC CI2M ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.3925', '-4.02167'),
(75, 'FILTISAC BVPN ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.3925', '-4.02167'),
(76, 'CECP ABOBO SOGEFIA', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.43639', '-4.01528'),
(77, 'BNI ABOBO SOGEFIA', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.43528', '-4.01'),
(78, 'Formation Sanitaire Abobo Sud', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.42389', '-4.01639'),
(79, 'FIDRA Abobo ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.43833', '-4.01722'),
(80, 'BSIC Abobo ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE ', 4, '5.39722', '-3.99194'),
(81, 'FRANCHISE DOKOUI', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.40139', '-4.00667'),
(82, 'UNACOOPEC ABOBO', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.416937', ' -4.016967'),
(83, 'DGI ABOBO ', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.436132', ' -4.020518'),
(84, 'COPHARMED ', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.285278', ' -4.00777777'),
(85, 'MOVIS INTERNET', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.271111', ' -4.00194444'),
(86, 'SEIGNEURIE IPL', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.268056', '-4.00638888'),
(87, 'ASSINIE MARINE', 5, 1, 1, 'ASSINIE', '00225', 'COTE D''IVOIRE', 3, '5.154845', '-3.408366'),
(88, 'CHALET DINE', 5, 1, 1, 'ASSINIE', '00225', 'COTE D''IVOIRE', 4, '5.163061', '-3.459908'),
(89, 'AFRICAN QUEEN', 5, 1, 1, 'ASSINIE', '00225', 'COTE D''IVOIRE', 4, '5.161664', '-3.454552'),
(90, 'LE LODGE BY COUCOUE', 5, 1, 1, 'ASSINIE', '00225', 'COTE D''IVOIRE', 4, '5.154108', '-3.403842'),
(91, 'LAGUNA BEACH', 6, 1, 1, 'ASSOUINDE', '00225', 'COTE D''IVOIRE', 4, '5.154368', '-3.432203'),
(92, 'EHOTILE LODGE', 6, 1, 1, 'ASSOUINDE', '00225', 'COTE D''IVOIRE', 4, '5.146831', '-3.392556'),
(93, 'MAISON BLANCHE', 5, 1, 1, 'ASSINIE', '00225', 'COTE D''IVOIRE', 4, '5.160325', '-3.445162'),
(94, 'CENTRAL ASSOUINDE', 6, 1, 1, 'ASSOUINDE', '00225', 'COTE D''IVOIRE', 3, '5.15972', '-3.4625'),
(95, 'ORYS GAZ', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.266667', ' -4.00861111'),
(96, 'CORIS BANK KOUMASSI', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.29361', '-3.95611'),
(97, 'MOVIS AEROPORT', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.25111', '-3.93444'),
(98, 'AIR LIQUID VRIDI', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.26417', '-3.99861'),
(99, 'ONOMO HOTEL', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.25722', '-3.9375'),
(100, 'PALMCI', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.26667', '-4'),
(101, 'Movis CFS4', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.26667 ', '-4.00778'),
(102, 'MOVIS CFS2', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.26306', '-4.00222'),
(103, 'MOVIS GARAGE', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.28167', '-4.00944'),
(104, 'Web fontaine ', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.26667', '-4'),
(105, 'YARA ', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.25', '-4'),
(106, 'BOLLORE SUV', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.25611', '-4.00028'),
(107, 'OCIT YOPLAIT', 4, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.36694', '-4.09'),
(109, 'FIRCA ANGRE', 1, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.389564', '-3.989881'),
(110, 'SANIA CIE VRIDI SHCI', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.2637931', ' -4.0110888'),
(111, 'SANIA COMPAGNIE VRIDI', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.263723', '-4.011279'),
(112, 'Sodirep Bietry ', 3, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.300942', ' -3.986927'),
(113, 'SIB ZONE 4 PMC', 8, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.294589', '-3.982161'),
(114, 'SIB MARCORY RESIDENTIEL', 8, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.309089', '-3.991103'),
(115, 'COPHARMED               vpn ', 3, 1, 1, 'ABIDJAN', '00225', 'CÔTE D''IVOIRE', 4, '5.285278', '-4.00777777'),
(116, 'BIAO ANYAMA', 1, 1, 1, 'ANYAMA', '00225', 'COTE D''IVOIRE', 4, '5.48444', '-4.05306'),
(118, 'SIB ANGRE OSCAR', 2, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.400021', '-3.991573'),
(119, 'CENTRAL ANYAMA', 10, 1, 1, 'ANYAMA', '00225', 'COTE D''IVOIRE', 3, '5.494652', '-4.049967'),
(120, 'SIB VGE', 7, 1, 1, 'ABIDJAN', '00225', 'COTE D''IVOIRE', 4, '5.299380', '-3.987197'),
(121, 'Cocody Danga', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.339575', '-4.004774'),
(122, ' Franchise Angré', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.39132', '-3.99298'),
(123, 'OCIT Angré', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.3862285', '-3.9827405'),
(124, 'Franchise Ena', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.360599', '-3.998105'),
(125, ' OCIT Ena', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.362776', '-3.9974'),
(126, 'OCIT Riviera 3', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.3550939', '-3.9521382'),
(127, 'Franchise Attoban', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.355863', '-3.977911'),
(128, 'Franchise Canebiere', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.342266', '-4.014529'),
(129, ' Franchise Marcory', 7, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.308049', '-3.99375'),
(130, 'Alpha 2000', 11, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.32395', '-4.019585'),
(131, 'Pyramide', 11, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.321768', '-4.017188'),
(132, 'OCIT Saha', 7, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.293702', '-3.977842'),
(133, 'Plateau Sud', 11, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.315546', '-4.019193'),
(134, 'Franchise Treichville', 8, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.302085', '-4.010521'),
(135, 'KM4', 8, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.292773', '-3.999036'),
(136, 'Quartz', 7, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.297699', '-3.984903'),
(137, 'Franchise Koumassi', 12, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5.297746', '-3.954901'),
(138, 'Cap Sud', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.298387', '-3.986612'),
(139, 'OCIT Abobo', 1, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '5.422761', '-4.015577'),
(140, 'OCIT Banco', 1, 1, 1, 'Abidjan', '0225', 'cote d''ivoire', 1, '5.334098', '-4.073394'),
(141, 'yop st andre', 4, 1, 1, 'Abidjan', '225', 'abidjan', 4, '5,292773', '-3,954901'),
(142, 'OCIT cap sud', 7, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 2, '5,298387', '-3,986612'),
(143, 'OCIT san pedro', 14, 1, 1, 'San pedro', '00225', 'cote d''ivoire', 2, '4.7467313', '-6.6337786'),
(144, 'Franchise 1-San Pedro', 14, 1, 1, 'San pedro', '00225', 'cote d''ivoire', 1, '4.739902', '-6.634879'),
(145, 'Franchise 2-San Pedro', 14, 1, 1, 'San pedro', '00225', 'cote d''ivoire', 1, '5.316667', '-4.033333'),
(146, 'OCIT Abengourou', 15, 1, 1, 'abengourou', '00225', 'cote d''ivoire', 1, '6.433958', '-3.294476'),
(147, 'Defis Strategies Sodefor', 2, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 4, '5.316667', '-4.033333'),
(148, 'BIAO ABOBO GARE', 1, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 4, '5.42122', '-4.0248483'),
(149, 'Hôpital FHB ABOBO-NORD', 1, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 4, '5.316667', '-4.033333'),
(150, 'Airivoire-gatl', 16, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 4, '5.190801', '-3.743871'),
(151, 'OCIT Bouaké', 17, 1, 1, 'Abidjan', '00225', 'cote d''ivoire', 1, '7,44145', '-5,15237');

-- --------------------------------------------------------

--
-- Structure de la table `address_equipment`
--

CREATE TABLE IF NOT EXISTS `address_equipment` (
  `address_equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) DEFAULT NULL,
  `equipment_inventory_id` int(11) DEFAULT NULL,
  `date_of_installation` date DEFAULT NULL,
  `project_id` int(13) DEFAULT NULL,
  `date_of_uninstallation` date DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `ip` varchar(55) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`address_equipment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Contenu de la table `address_equipment`
--

INSERT INTO `address_equipment` (`address_equipment_id`, `address_id`, `equipment_inventory_id`, `date_of_installation`, `project_id`, `date_of_uninstallation`, `added_by`, `ip`, `status`) VALUES
(1, 1, 22, '2014-03-27', 1, NULL, 1, '172.16.5.3/172.16.5.4/ 172.16.5.5', '1'),
(2, 2, 3, '2014-12-08', 1, '2014-12-08', 1, '172.16.6.3/172.16.6.4/172.16.6.5/172.16.6.6', '1'),
(7, 7, 16, '2014-12-08', 2, '1970-01-01', 1, '172.16.6.8', '1'),
(8, 8, 21, '2014-12-08', 2, '1970-01-01', 1, '172.16.6.10', '1'),
(10, 10, 9, '2014-12-08', 1, '1970-01-01', 1, '172.16.27.3/172.16.27.4/172.16.27.5', '1'),
(12, 12, 23, '2014-12-08', 1, '1970-01-01', 1, '172.16.4.10', '1'),
(13, 13, 15, '2014-12-08', 1, '1970-01-01', 1, '172.16.27.7', '1'),
(14, 14, 24, '2014-12-08', 1, '1970-01-01', 1, '172.16.4.12', '1'),
(15, 15, 14, '2014-12-08', 1, '1970-01-01', 1, '172.16.4.8', '1'),
(16, 16, 143, '2014-06-18', 1, NULL, 1, '172.16.4.7', '1'),
(17, 17, 13, '2014-12-08', 1, '1970-01-01', 1, '172.16.4.13', '1'),
(18, 18, 11, '2014-12-08', 1, '1970-01-01', 1, '', '1'),
(19, 19, 189, '2014-10-07', 1, '1970-01-01', 1, '172.16.27.9', '1'),
(20, 20, 42, '2014-12-08', 1, '1970-01-01', 1, '172.16.5.11', '1'),
(21, 21, 108, '2015-06-02', 1, NULL, 1, '172.16.5.7', '1'),
(22, 22, 166, '2014-03-27', 1, NULL, 1, '172.16.5.8', '1'),
(23, 23, 107, '2014-05-06', 1, NULL, 1, '172.16.5.14', '1'),
(24, 24, 111, '2014-06-05', 1, NULL, 1, '172.16.5.15', '1'),
(25, 25, 168, '2014-03-07', 1, NULL, 1, '172.16.5.9', '1'),
(27, 27, 29, '1970-01-01', 1, NULL, 1, '172.16.5.x', '1'),
(30, 4, 34, '1970-01-01', NULL, NULL, 1, '172.16.6.9', '1'),
(32, 3, 64, '2014-06-18', NULL, NULL, 1, '172.16.6.11', '1'),
(34, 50, 77, '1970-01-01', NULL, NULL, 1, ' 172.16.6.4', '1'),
(43, 63, 62, '2014-10-17', NULL, NULL, 1, '172.16.6.21', '1'),
(45, 52, 65, '2014-09-10', NULL, NULL, 1, '172.16.6.15', '1'),
(46, 53, 45, '2014-10-17', NULL, NULL, 1, '172.16.6.23', '1'),
(47, 54, 75, '1970-01-01', NULL, NULL, 1, '172.16.6.25', '1'),
(49, 70, 155, '2014-03-27', NULL, NULL, 1, '172.16.5.3', '1'),
(50, 28, 115, '1970-01-01', NULL, NULL, 1, '172.16.5.12', '1'),
(53, 5, 66, '2014-07-24', NULL, NULL, 1, '172.16.6.12', '1'),
(54, 6, 67, '2014-11-08', NULL, NULL, 1, '172.16.6.7', '1'),
(55, 55, 68, '2014-08-11', NULL, NULL, 1, '172.16.6.8', '1'),
(56, 56, 72, '2014-08-12', NULL, NULL, 1, '172.16.6.10', '1'),
(57, 57, 71, '2014-09-22', NULL, NULL, 1, '172.16.5.17', '1'),
(58, 58, 73, '2014-08-20', NULL, NULL, 1, '172.16.6.20', '1'),
(59, 59, 54, '1970-01-01', NULL, NULL, 1, '172.16.6.24', '1'),
(60, 60, 70, '2014-10-16', NULL, NULL, 1, '172.16.6.27', '1'),
(61, 61, 81, '2014-09-12', NULL, NULL, 1, '172.16.6.16', '1'),
(62, 62, 59, '2014-10-01', NULL, NULL, 1, '172.16.6.19', '1'),
(63, 64, 76, '2014-10-29', NULL, NULL, 1, '172.16.6.28', '1'),
(64, 108, 78, '2014-06-20', NULL, NULL, 1, '172.16.6.3', '1'),
(65, 49, 82, '1970-01-01', NULL, NULL, 1, '172.16.16.9', '1'),
(66, 44, 92, '2014-10-28', NULL, NULL, 1, '172.16.16.4', '1'),
(67, 46, 91, '2015-01-05', NULL, NULL, 1, '172.16.16.6', '1'),
(68, 36, 94, '2015-03-05', NULL, NULL, 1, '172.16.16.26', '1'),
(69, 45, 83, '2015-12-01', NULL, NULL, 1, '172.16.6.8', '1'),
(70, 39, 95, '2014-10-13', NULL, NULL, 1, '172.16.5.20', '1'),
(71, 71, 96, '2014-09-01', NULL, NULL, 1, '172.16.5.18', '1'),
(73, 68, 98, '2014-12-29', NULL, NULL, 1, '172.16.5.34', '1'),
(74, 79, 100, '2015-03-06', NULL, NULL, 1, '172.16.5.32', '1'),
(75, 66, 103, '1970-01-01', NULL, NULL, 1, '172.16.5.48', '1'),
(76, 73, 104, '2015-02-27', NULL, NULL, 1, '172.16.5.45', '1'),
(77, 80, 106, '2014-11-18', NULL, NULL, 1, '172.16.5.27', '1'),
(78, 76, 109, '2015-02-25', NULL, NULL, 1, '172.16.5.31', '1'),
(79, 83, 110, '2014-03-27', NULL, NULL, 1, '172.16.5.11', '1'),
(80, 81, 112, '2015-02-17', NULL, NULL, 1, '172.16.5.25', '1'),
(81, 72, 114, '2014-10-22', NULL, NULL, 1, '172.16.5.26', '1'),
(82, 41, 33, '2015-02-27', NULL, NULL, 1, '', '1'),
(83, 97, 122, '1970-01-01', NULL, NULL, 1, '172.16.4.17', '1'),
(84, 98, 131, '2014-10-24', NULL, NULL, 1, '172.16.4.20', '1'),
(85, 99, 142, '2014-05-09', NULL, NULL, 1, '172.16.4.32', '1'),
(86, 84, 117, '1970-01-01', NULL, NULL, 1, '', '1'),
(87, 106, 124, '1970-01-01', NULL, NULL, 1, '172.16.4.54', '1'),
(88, 101, 127, '1970-01-01', NULL, NULL, 1, '172.16.4.14', '1'),
(89, 102, 128, '1970-01-01', NULL, NULL, 1, '172.16.4.16', '1'),
(90, 103, 129, '1970-01-01', NULL, NULL, 1, '172.16.4.15', '1'),
(91, 109, 101, '2014-10-20', NULL, NULL, 1, '172.16.5.30', '1'),
(92, 86, 134, '2014-06-24', NULL, NULL, 1, '172.16.4.8', '1'),
(93, 85, 139, '1970-01-01', NULL, NULL, 1, '172.16.4.10', '1'),
(94, 11, 119, '2014-06-18', NULL, NULL, 1, '172.16.4.11', '1'),
(95, 95, 133, '2014-06-18', NULL, NULL, 1, '172.16.4.12', '1'),
(96, 105, 141, '2014-10-28', NULL, NULL, 1, '172.16.4.42', '1'),
(97, 104, 140, '2014-10-27', NULL, NULL, 1, '172.16.4.43', '1'),
(98, 100, 136, '2014-10-21', NULL, NULL, 1, '172.16.4.39', '1'),
(99, 115, 154, '2014-06-18', NULL, NULL, 1, '', '1'),
(100, 74, 170, '2014-05-09', NULL, NULL, 1, '172.16.5.11', '1'),
(101, 75, 169, '2014-05-09', NULL, NULL, 1, '172.16.5.12', '1'),
(102, 82, 165, '2014-03-27', NULL, NULL, 1, '172.16.5.10', '1'),
(103, 118, 171, '2014-09-22', NULL, NULL, 1, '172.16.5.19', '1'),
(105, 69, 113, '2014-12-01', NULL, NULL, 1, '172.16.5.39', '1'),
(106, 43, 194, '2015-04-02', NULL, NULL, 1, '172.16.27.30', '1'),
(107, 42, 181, '1970-01-01', NULL, NULL, 1, '172.16.27.12', '1'),
(108, 30, 182, '1970-01-01', NULL, NULL, 1, '172.16.27.26', '1'),
(109, 33, 184, '1970-01-01', NULL, NULL, 1, '172.16.27.11', '1'),
(110, 40, 185, '2014-08-10', NULL, NULL, 1, '172.16.27.33', '1'),
(111, 47, 186, '1970-01-01', NULL, NULL, 1, '172.16.27.15', '1'),
(112, 34, 187, '1970-01-01', NULL, NULL, 1, '172.16.27.34', '1'),
(113, 48, 188, '1970-01-01', NULL, NULL, 1, '172.16.27.14', '1'),
(114, 35, 195, '1970-01-01', NULL, NULL, 1, '172.16.27.7', '1'),
(115, 141, 200, '2015-04-16', NULL, '2015-04-24', 1, '172.16.27.11', '1'),
(119, 122, 231, '2014-10-11', NULL, NULL, 1, '154.68.62.145', '1'),
(120, 132, 256, '1970-01-01', NULL, NULL, 1, '192.168.12.33', '1'),
(121, 139, 252, '2014-06-10', NULL, NULL, 1, '154.68.62.139', '1'),
(122, 131, 253, '1970-01-01', NULL, NULL, 1, '154.68.62.135', '1'),
(123, 136, 254, '1970-01-01', NULL, NULL, 1, '154.68.62.138', '1'),
(124, 126, 255, '1970-01-01', NULL, NULL, 1, '154.68.62.131', '1'),
(125, 123, 227, '2014-07-11', NULL, NULL, 1, '154.68.62.140', '1'),
(126, 125, 228, '2014-10-11', NULL, NULL, 1, '154.68.62.141', '1'),
(127, 124, 229, '2014-07-11', NULL, NULL, 1, '154.68.62.142', '1'),
(128, 127, 230, '2014-10-11', NULL, NULL, 1, '154.68.62.143', '1'),
(129, 134, 232, '2014-11-11', NULL, NULL, 1, '154.68.62.146', '1'),
(130, 142, 233, '2014-12-11', NULL, NULL, 1, '154.68.62.161', '1'),
(131, 129, 234, '2014-11-11', NULL, NULL, 1, '154.68.62.147', '1'),
(132, 143, 235, '1970-01-01', NULL, NULL, 1, '154.68.62.149', '1'),
(133, 130, 257, '2014-11-03', NULL, NULL, 1, '154.68.62.136', '1'),
(135, 29, 251, '2015-04-28', NULL, '2015-04-30', 1, '193.32.06.32', '1'),
(136, 9, 241, '2015-04-22', NULL, '2015-05-06', 1, '193.32.06.32', '1'),
(138, 133, 244, '2015-04-28', NULL, '2015-04-30', 1, '172.16.27.11', '1'),
(139, 128, 260, '1970-01-01', NULL, NULL, 1, '154.68.62.144', '1'),
(140, 135, 261, '1970-01-01', NULL, NULL, 1, '154.68.62.132', '1'),
(141, 137, 259, '1970-01-01', NULL, NULL, 1, '154.68.62.133', '1'),
(142, 140, 258, '1970-01-01', NULL, NULL, 1, '154.68.62.130', '1'),
(143, 146, 262, '1970-01-01', NULL, NULL, 1, '154.68.62.163', '1'),
(144, 147, 192, '2014-05-03', NULL, NULL, 1, '172.16.27.53', '1'),
(145, 26, 167, '2014-08-05', NULL, NULL, 1, '172.16.5.13', '1'),
(146, 78, 105, '2014-11-11', NULL, NULL, 1, '172.16.5.36', '1'),
(147, 148, 97, '2015-11-02', NULL, NULL, 1, '172.16.5.43', '1'),
(148, 149, 264, '2014-10-03', NULL, NULL, 1, '172.16.5.39', '1'),
(149, 77, 99, '1970-01-01', NULL, NULL, 1, '172.16.5.28', '1'),
(150, 150, 116, '2014-05-10', NULL, NULL, 1, '172.16.28.15', '1'),
(151, 151, 248, '2014-05-11', NULL, NULL, 1, '154.68.62.164', '1');

-- --------------------------------------------------------

--
-- Structure de la table `address_equipment_project`
--

CREATE TABLE IF NOT EXISTS `address_equipment_project` (
  `address_equipment_project_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_id` int(11) DEFAULT NULL,
  `address_equipment_id` int(11) DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`address_equipment_project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=263 ;

--
-- Contenu de la table `address_equipment_project`
--

INSERT INTO `address_equipment_project` (`address_equipment_project_id`, `address_id`, `address_equipment_id`, `project_id`) VALUES
(8, 4, 4, 1),
(9, 4, 4, 2),
(10, 4, 4, 3),
(11, 1, 28, 1),
(12, 1, 28, 3),
(14, 4, 29, 1),
(19, 5, 31, 1),
(24, 6, 33, 2),
(27, 55, 35, 2),
(31, 57, 37, 2),
(32, 56, 38, 2),
(33, 59, 39, 4),
(36, 60, 40, 4),
(37, 61, 41, 2),
(38, 62, 42, 2),
(43, 64, 44, 4),
(48, 55, 36, 2),
(49, 53, 46, 4),
(52, 1, 1, 5),
(64, 28, 48, 3),
(65, 28, 48, 5),
(81, 26, 26, 5),
(82, 27, 27, 1),
(84, 29, 51, 5),
(85, 6, 52, 2),
(99, 52, 45, 2),
(102, 5, 53, 1),
(104, 6, 54, 2),
(105, 54, 47, 4),
(106, 55, 55, 2),
(107, 56, 56, 2),
(108, 57, 57, 2),
(109, 58, 58, 2),
(111, 59, 59, 4),
(112, 60, 60, 2),
(113, 61, 61, 2),
(114, 62, 62, 2),
(115, 63, 43, 2),
(116, 64, 63, 2),
(117, 108, 64, 5),
(119, 44, 66, 6),
(120, 46, 67, 4),
(121, 36, 68, 1),
(124, 45, 69, 6),
(125, 49, 65, 4),
(126, 50, 34, 5),
(127, 39, 70, 2),
(128, 71, 71, 2),
(129, 71, 72, 2),
(130, 68, 73, 4),
(131, 79, 74, 4),
(133, 66, 75, 6),
(135, 73, 76, 6),
(136, 80, 77, 4),
(139, 23, 23, 1),
(140, 76, 78, 4),
(141, 83, 79, 5),
(142, 24, 24, 1),
(143, 81, 80, 4),
(144, 72, 81, 4),
(145, 28, 50, 5),
(146, 41, 82, 1),
(155, 84, 86, 1),
(156, 16, 16, 1),
(161, 109, 91, 4),
(162, 98, 84, 2),
(165, 86, 92, 1),
(166, 97, 83, 2),
(167, 85, 93, 1),
(168, 11, 94, 1),
(169, 95, 95, 1),
(170, 4, 30, 1),
(172, 3, 32, 1),
(173, 101, 88, 2),
(177, 103, 90, 2),
(179, 102, 89, 2),
(180, 99, 85, 2),
(181, 105, 96, 4),
(182, 104, 97, 4),
(183, 100, 98, 4),
(185, 106, 87, 4),
(186, 115, 99, 1),
(189, 70, 49, 5),
(194, 25, 25, 5),
(195, 22, 22, 5),
(196, 82, 102, 5),
(197, 75, 101, 2),
(198, 74, 100, 2),
(199, 118, 103, 2),
(200, 118, 104, 2),
(201, 69, 105, 4),
(202, 43, 106, 4),
(203, 42, 107, 2),
(204, 30, 108, 2),
(205, 33, 109, 2),
(206, 40, 110, 4),
(207, 47, 111, 2),
(208, 34, 112, 4),
(212, 19, 19, 1),
(213, 35, 114, 1),
(216, 48, 113, 4),
(217, 141, 115, 1),
(218, 3, 116, 1),
(219, 73, 117, 5),
(221, 121, 118, 3),
(224, 139, 121, 1),
(225, 131, 122, 1),
(226, 136, 123, 1),
(227, 126, 124, 1),
(231, 124, 127, 2),
(232, 123, 125, 2),
(233, 125, 126, 2),
(234, 127, 128, 2),
(235, 122, 119, 2),
(236, 134, 129, 2),
(237, 142, 130, 2),
(238, 129, 131, 2),
(239, 143, 132, 2),
(240, 130, 133, 1),
(242, 132, 120, 1),
(244, 121, 134, 2),
(245, 29, 135, 1),
(246, 9, 136, 1),
(247, 144, 137, 4),
(248, 133, 138, 3),
(249, 128, 139, 3),
(250, 135, 140, 3),
(251, 137, 141, 3),
(252, 140, 142, 3),
(253, 146, 143, 3),
(254, 147, 144, 3),
(255, 26, 145, 5),
(256, 21, 21, 4),
(257, 78, 146, 3),
(258, 148, 147, 6),
(259, 149, 148, 3),
(260, 77, 149, 3),
(261, 150, 150, 4),
(262, 151, 151, 3);

-- --------------------------------------------------------

--
-- Structure de la table `address_type`
--

CREATE TABLE IF NOT EXISTS `address_type` (
  `address_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_type` varchar(55) DEFAULT NULL,
  `address_type_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`address_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `address_type`
--

INSERT INTO `address_type` (`address_type_id`, `address_type`, `address_type_slug`) VALUES
(1, 'Agency ', 'agency'),
(2, ' Orange Office', 'orange-office'),
(3, 'Site centraux', 'site-centraux'),
(4, 'Site client', 'site-client');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `admin`
--

INSERT INTO `admin` (`id`, `login`, `pass`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Structure de la table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) DEFAULT NULL,
  `brand_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `brand_slug`) VALUES
(1, 'Ubiquiti', 'ubiquiti'),
(7, '4ipnet', '4ipnet');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `comment` text,
  `comment_status_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL,
  `added_on` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `comment`, `comment_status_id`, `address_id`, `added_on`) VALUES
(1, 3, 'Verified - Working fine', 1, 6, '2015-03-09 14:04:07'),
(2, 1, 'Cross checked. Seems something is wrong with the device.\n\nPlease replace the device...', 3, 6, '2015-03-09 14:05:59'),
(3, 2, 'Device replaced.', 4, 6, '2015-03-09 17:53:01'),
(4, 1, 'ABOBO CENTRAL', 1, 28, '2015-03-13 15:41:58'),
(5, 1, 'HH', 2, 28, '2015-03-13 15:42:53'),
(6, 1, 'Equipement 2: Rocket M5\nIP: 172.16.16.5\nInstalled On: 2014-10-28\nSr.Number: 24-A4-3C-78-78-E7-7E  \n\nEquipement 3: Rocket M5\nIP: 172.16.16.3\nInstalled On: 2014-10-28\nSr.Number: 68-72-51-04-DF-69\n\nEquipement 4: TSW-PoE\nIP: 172.16.16.2\nInstalled On: 2014-10-28\nSr.Number: 04-18-D6-07-45-09', 1, 44, '2015-04-08 16:07:21'),
(7, 1, 'Equipement 2 : Rocket M5\nIP: 172.16.5.5\nInstalled On: 1970-01-01\nSr.Number: 68-72-51-04-E0-4B\n', 1, 70, '2015-04-08 16:45:28'),
(8, 1, 'Equipement 3 : Rocket M5\nIP: 172.16.5.4\nInstalled On: 1970-01-01\nSr.Number: 24-A4-3C-F4-OB-42', 1, 70, '2015-04-08 16:47:34'),
(9, 1, 'Equipement 4 : Rocket M5\nIP: 172.16.5.3\nInstalled On: 1970-01-01\nSr.Number: 68-72-51-08-67-CC', 1, 70, '2015-04-08 16:50:45');

-- --------------------------------------------------------

--
-- Structure de la table `comment_status`
--

CREATE TABLE IF NOT EXISTS `comment_status` (
  `comment_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_status` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`comment_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `comment_status`
--

INSERT INTO `comment_status` (`comment_status_id`, `comment_status`) VALUES
(1, 'Up'),
(2, 'Down'),
(3, 'Faulty '),
(4, 'Replaced');

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(55) DEFAULT NULL,
  `short_name` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`country_id`, `country`, `short_name`) VALUES
(1, 'Ivory Coast ', '');

-- --------------------------------------------------------

--
-- Structure de la table `equipment`
--

CREATE TABLE IF NOT EXISTS `equipment` (
  `equipment_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment` varchar(255) DEFAULT NULL,
  `equipment_slug` varchar(55) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `equipment_type_id` int(11) DEFAULT NULL,
  `status` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`equipment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `equipment`
--

INSERT INTO `equipment` (`equipment_id`, `equipment`, `equipment_slug`, `brand_id`, `equipment_type_id`, `status`) VALUES
(1, 'NanoBeam M5-400', 'nanobeam-m5-400', 1, 1, '1'),
(2, 'Rocket M5', 'rocket-m5', 1, 2, '1'),
(3, 'NanoBeam M5-300', 'nanobeam-m5-300', 1, 2, '1'),
(4, 'Nanostation', 'nanostation', 1, 1, '1'),
(5, 'airGrid M5', 'airgrid-m5', 1, 1, '1'),
(6, 'Toughswitch', 'toughswitch', 1, 5, '1'),
(8, 'HSG327', 'hsg327', 7, 7, '1');

-- --------------------------------------------------------

--
-- Structure de la table `equipment_inventory`
--

CREATE TABLE IF NOT EXISTS `equipment_inventory` (
  `equipment_inventory_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `date_of_purchase` date DEFAULT NULL,
  `assigned` int(11) NOT NULL DEFAULT '0',
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`equipment_inventory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=265 ;

--
-- Contenu de la table `equipment_inventory`
--

INSERT INTO `equipment_inventory` (`equipment_inventory_id`, `equipment_id`, `seller_id`, `serial_number`, `date_of_purchase`, `assigned`, `status`) VALUES
(33, 4, 1, '54321', '2014-12-12', 1, 1),
(34, 5, 1, '24-A4-3C-D4-DE-E4', NULL, 1, 1),
(54, 1, 1, '24-A4-3C-DC-E6-7C', NULL, 1, 1),
(55, 5, 1, '24-A4-3C-D6-82-57', NULL, 0, 1),
(56, 1, 1, '04-18-D6-56-5A-12', NULL, 0, 1),
(59, 1, 1, '04-18-D6-56-5F-2B', '2014-12-12', 1, 1),
(60, 1, 1, '04-18-D6-54-E5-8C', '2014-12-12', 0, 1),
(61, 1, 1, '04-18-D6-54-E5-9B', '2014-12-12', 0, 1),
(62, 1, 1, '04-18-D6-56-5E-EF', '2014-12-12', 1, 1),
(63, 1, 1, '04-18-D6-56-5C-4C', '2014-12-12', 0, 1),
(64, 1, 1, '24-A4-3C-DC-E4-E1', '2014-12-12', 1, 1),
(65, 1, 1, '04-18-D6-26-0B-54', '2014-12-12', 1, 1),
(66, 1, 1, '24-A4-3C-DC-E7-28', '2014-12-12', 1, 1),
(67, 1, 1, '24-A4-3C-DC-EE-E9', '2014-12-12', 1, 1),
(68, 1, 1, '24-A4-3C-DC-E8-88', '2014-12-12', 1, 1),
(69, 1, 1, '04-18-D6-54-E5-85', '2014-12-12', 0, 1),
(70, 1, 1, '04-18-D6-56-5B-8D', '2014-12-12', 1, 1),
(71, 1, 1, '04-18-D6-54-D4-5E', '2014-12-12', 1, 1),
(72, 1, 1, '24-A4-3C-DC-ED-8B', '2014-12-12', 1, 1),
(73, 1, 1, '24-A4-3C-DC-E7-C5', '2014-12-12', 1, 1),
(74, 1, 1, '04-18-D6-54-ED-38', '2014-12-12', 0, 1),
(75, 1, 1, '04-18-D6-56-5C-3D', '2014-12-12', 1, 1),
(76, 1, 1, '04-18-D6-54-D2-93', '2014-12-12', 1, 1),
(77, 2, 1, '24-A4-3C-46-D6-73', '2014-12-12', 1, 1),
(78, 2, 1, '24-A4-3C-F4-54-B1', '2014-12-12', 1, 1),
(79, 2, 1, '24-A4-3C-F4-0E-5D', '2014-12-12', 0, 1),
(80, 2, 1, '24-A4-3C-78-EE-A8', '2014-12-12', 0, 1),
(81, 3, 1, '04-18-D6-0C-E9-E7', '2014-12-12', 1, 1),
(82, 1, 1, '04-18-D6-54-DE-C7', '2014-12-12', 1, 1),
(83, 1, 1, '04-18-D6-56-57-F0', '2014-12-12', 1, 1),
(84, 1, 1, '04-18-D6-54-EB-B0', '2014-12-12', 0, 1),
(85, 1, 1, '24-A4-3C-DC-EB-59', '2014-12-12', 0, 1),
(89, 1, 1, '04-18-D6-56-5F-58', '2014-12-12', 0, 1),
(90, 1, 1, '04-18-D6-56-5F-05', '2014-12-12', 0, 1),
(91, 1, 1, '04-18-D6-56-5D-37', '2014-12-12', 1, 1),
(92, 2, 1, '24-A4-3C-F4-0A-BF', '2014-12-12', 1, 1),
(93, 2, 1, '68-72-51-04-DF-69', '2014-12-12', 0, 1),
(94, 3, 1, '04-18-D6-0C-E8-57', '2014-12-12', 1, 1),
(95, 1, 1, '04-18-D6-28-18-C5', '2014-12-12', 1, 1),
(96, 1, 1, '04-18-D6-26-0A-49', '2014-12-12', 1, 1),
(97, 1, 1, '04-18-D6-24-C3-41', '2014-12-12', 1, 1),
(98, 1, 1, '04-18-D6-54-E0-9B', '2014-12-12', 1, 1),
(99, 1, 1, '04-18-D6-54-E5-9C', '2014-12-12', 1, 1),
(100, 1, 1, '04-18-D6-56-5D-0E', '2014-12-12', 1, 1),
(101, 1, 1, '04-18-D6-54-EF-22', '2014-12-12', 1, 1),
(102, 1, 1, '04-18-D6-54-EF-22', '2014-12-12', 0, 1),
(103, 1, 1, '04-18-D6-56-56-B4', '2014-12-12', 1, 1),
(104, 1, 1, '04-18-D6-56-5B-2B', '2014-12-12', 1, 1),
(105, 1, 1, '04-18-D6-56-56-B2', '2014-12-12', 1, 1),
(106, 1, 1, '04-18-D6-54-DF-4F', '2014-12-12', 1, 1),
(107, 1, 1, '24-A4-3C-BE-BA-2D', '2014-12-12', 1, 1),
(108, 4, 1, '24-A4-3C-7E-2A-B6', '2014-12-12', 1, 1),
(109, 1, 1, '04-18-D6-54-D2-38', '2014-12-12', 1, 1),
(110, 1, 1, '24-A4-3C-BE-C3-BF', '2014-12-12', 1, 1),
(111, 1, 1, '24-A4-3C-DC-E9-2B', '2014-12-12', 1, 1),
(112, 1, 1, '04-18-D6-54-D8-A4', '2014-12-12', 1, 1),
(114, 1, 1, '04-18-D6-56-58-62', '2014-12-12', 1, 1),
(115, 1, 1, '24-A4-3C--BE-BA-C0', '2014-12-12', 1, 1),
(116, 1, 1, '04-18-D6-24-C3-9F', '2014-12-12', 1, 1),
(117, 1, 1, '04:18:D6:56:56:B9', '2014-01-20', 1, 1),
(118, 1, 1, '04:18:D6:54:D1:B3', '2014-12-20', 0, 1),
(119, 1, 1, '24:A4:3C:DC:E8:7A', '2014-12-20', 1, 1),
(120, 1, 1, '04:18:D6:54:D8:D2', '2014-12-20', 0, 1),
(121, 1, 1, '04:18:D6:54:E0:31', '2014-12-20', 0, 1),
(122, 1, 1, '04-18-D6-26-A2-07', '2014-12-12', 1, 1),
(123, 1, 1, '04:18:D6:54:E0:11', '2014-12-20', 0, 1),
(124, 1, 1, '04:18:D6:54:D8:81', '2014-12-20', 1, 1),
(125, 1, 1, '04:18:D6:54:D9:08', '2014-12-20', 0, 1),
(126, 1, 1, '04:18:D6:24:A2:18', '2014-12-20', 0, 1),
(127, 1, 1, '24:A4:3C:DC:E8:E5', '2014-12-20', 1, 1),
(128, 1, 1, '04:18:D6:26:AB:FD', '2014-12-20', 1, 1),
(129, 1, 1, '04:18:D6:54:EB:36', '2014-12-20', 1, 1),
(130, 1, 1, '04:18:D6:54:EB:2C', '2014-12-20', 0, 1),
(131, 1, 1, '04-18-D6-28-16-76', '2014-12-12', 1, 1),
(132, 1, 1, '04:18:D6:54:EB:AD', '2014-12-20', 0, 1),
(133, 1, 1, '24:A4:3C:DC:E6:79', '2014-12-20', 1, 1),
(134, 1, 1, '24:A4:3C:DC:E7:3C', '2014-12-20', 1, 1),
(135, 1, 1, '04:18:D6:28:16:9A', '2014-12-20', 0, 1),
(136, 1, 1, '04:18:D6:54:D5:C2', '2014-12-20', 1, 1),
(137, 1, 1, '04:18:D6:54:E0:5A', '2014-12-20', 0, 1),
(138, 1, 1, '04:18:D6:54:D1:BA', '2014-12-20', 0, 1),
(139, 1, 1, '24-A4-3C-DC-E5-3D', '2014-12-12', 1, 1),
(140, 1, 1, '04:18:D6:54:D6:CB', '2014-12-20', 1, 1),
(141, 1, 1, '04:18:D6:54:D5:FC', '2014-12-20', 1, 1),
(142, 1, 1, '24-A4-3C-DC-E4-53', '2014-12-12', 1, 1),
(143, 1, 1, '24-A4-3C-DC-E6-B2', '2014-12-12', 1, 1),
(144, 1, 1, '24-A4-D6-28-1B-AD', '2014-12-12', 0, 1),
(145, 1, 1, '24-A4-3C-DC-E6-84', '2014-12-12', 0, 1),
(146, 1, 1, '04-18-D6-0C-E4-00', '2014-12-12', 0, 1),
(147, 2, 1, '24-A4-3C-F4-0B-7C', '2014-12-12', 0, 1),
(148, 2, 1, '24-A4-3C-F4-0B-AA', '2014-12-12', 0, 1),
(149, 2, 1, '24-A4-3C-F4-0C-46', '2014-12-12', 0, 1),
(150, 2, 1, '24-A4-3C-F4-0B-FF', '2014-12-12', 0, 1),
(151, 6, 1, '24-A4-3C-3D-32-85', '2014-12-12', 0, 1),
(152, 1, 1, '04-18-D6-54-EB-50', '2014-12-12', 0, 1),
(153, 1, 1, '04-18-D6-54-E5-9A', '2014-12-12', 1, 1),
(154, 1, 1, '04-18-D6-56-56-B9', '2014-12-12', 1, 1),
(155, 2, 1, '68-72-51-08-67-CC', '2014-12-12', 1, 1),
(156, 1, 1, '04-18-D6-54-D8-EC', '2014-01-01', 0, 1),
(157, 1, 1, '24-A4-3C-DC-E9-15', '2014-01-01', 0, 1),
(158, 1, 1, '24-A4-3C-DC-EB-5C', '2014-01-01', 0, 1),
(159, 1, 1, '24-A4-3C-78-E8-60', '2014-01-01', 0, 1),
(160, 1, 1, '24-A4-3C-78-E9-2F', '2014-01-01', 0, 1),
(161, 1, 1, '24-A4-3C-78-E8-A1', '2014-01-01', 0, 1),
(162, 1, 1, '04-18-D6-54-D3-37', '2014-01-01', 0, 1),
(163, 1, 1, '04-18-D6-54-EA-0F', '2014-01-01', 0, 1),
(164, 1, 1, '24-A4-3C-DC-32-85', '2014-01-01', 0, 1),
(165, 1, 1, '24-A4-3C-BE-C3-90', '2014-01-01', 1, 1),
(166, 1, 1, '24-A4-3C-7E-29-5C', '2014-01-01', 1, 1),
(167, 1, 1, '24-A4-3C-BE-B9-9C', '2014-01-01', 1, 1),
(168, 1, 1, '24-A4-3C-BE-BA-C2', '2014-01-01', 1, 1),
(169, 1, 1, '04-18-D6-26-09-8B', '2014-01-01', 1, 1),
(170, 1, 1, '24-A4-3C-DC-E9-A5', '2014-01-01', 1, 1),
(171, 1, 1, '04-18-D6-54-D4-3A', '2014-01-01', 1, 1),
(172, 2, 1, '68-72-51-08-67-FB', '2014-01-01', 0, 1),
(173, 1, 1, '24-4A-3C-78-EE-A8', NULL, 0, 1),
(174, 1, 1, '24-4A-3C-78-EE-3E', NULL, 0, 1),
(175, 1, 1, '24-A4-3C-78-EE-A8', NULL, 0, 1),
(176, 1, 1, '24-A4-3C-78-EE-3E', NULL, 0, 1),
(177, 2, 1, '24-A4-3C-78-EE-3E', NULL, 0, 1),
(178, 2, 1, '24-A4-3C-47-D6-73', NULL, 0, 1),
(179, 1, 1, '24-A4-3C-DD-E4-E1', NULL, 0, 1),
(180, 6, 1, '04-18-D6--07-48-A0', NULL, 0, 1),
(181, 1, 1, '24-A4-3C-DC-EB-A7', NULL, 1, 1),
(182, 1, 1, '04-18-D6-28-1E-B1', NULL, 1, 1),
(183, 1, 1, '04-18-D6-0C-E8-DA', NULL, 0, 1),
(184, 3, 1, '04-18-D6-0C-E8-DA', NULL, 1, 1),
(185, 1, 1, '04-18-D6-56-57-D5', NULL, 1, 1),
(186, 3, 1, '04-18-D6-0C-E6-3A', NULL, 1, 1),
(187, 1, 1, '04-18-D6-54-DE-9B', NULL, 1, 1),
(188, 1, 1, '04-18-D6-54-D4-F2', NULL, 1, 1),
(189, 1, 1, '24-A4-3C-DC-E6-E8', NULL, 1, 1),
(190, 2, 1, '24-A4-3C-F4-57-3F', NULL, 0, 1),
(191, 2, 1, '24-A4-3C-F4-0C-3E', NULL, 0, 1),
(192, 1, 1, '04-18-D6-54-E0-AA', NULL, 1, 1),
(193, 2, 1, '24-A4-3C-F4-0C-7E', NULL, 0, 1),
(194, 1, 1, '04-18-D6-56-5A-41', NULL, 1, 1),
(195, 1, 1, '24-A4-3C-DC-EB-D7', NULL, 1, 1),
(196, 2, 1, '24-A4-3C-F4-OC-3E', NULL, 0, 1),
(197, 2, 1, '24-A4-3C-F4-57-7E', NULL, 0, 1),
(227, 8, 1, '143D7M00016', NULL, 1, 1),
(228, 8, 1, '143D7M00026', NULL, 1, 1),
(229, 8, 1, '143D7M00007', NULL, 1, 1),
(230, 8, 1, '143D7M00006', NULL, 1, 1),
(231, 8, 1, '143D7M00002', NULL, 1, 1),
(232, 8, 1, '143D7M00050', NULL, 1, 1),
(233, 8, 1, '143D7M00005', NULL, 1, 1),
(234, 8, 1, '143D7M00003', NULL, 1, 1),
(235, 8, 1, '143D7M00010', NULL, 1, 1),
(236, 8, 1, '13AD7M00094', NULL, 0, 1),
(237, 8, 1, '143D7M00017', NULL, 0, 1),
(238, 8, 1, '143D7M00008', NULL, 0, 1),
(239, 8, 1, '143D7M00009', NULL, 0, 1),
(240, 8, 1, '143D7M00030', NULL, 0, 1),
(241, 8, 1, '143D7M00023', NULL, 1, 1),
(242, 8, 1, '13AD7M00004', NULL, 0, 1),
(243, 8, 1, '144D7R00032', NULL, 0, 1),
(244, 8, 1, '143D7M00001', NULL, 1, 1),
(245, 8, 1, '128D7M00004', NULL, 1, 1),
(246, 8, 1, '128D7M00049', NULL, 0, 1),
(247, 8, 1, '143D7M00011', NULL, 0, 1),
(248, 8, 1, '13AD7M00093', NULL, 1, 1),
(250, 8, 1, '144D7R00033', NULL, 0, 1),
(251, 8, 1, '144D7R00034', NULL, 1, 1),
(252, 8, 1, '143D7M00013', NULL, 1, 1),
(253, 8, 1, '143D7M00028', NULL, 1, 1),
(254, 8, 1, '143D7M00095', NULL, 1, 1),
(255, 8, 1, '143D7M00025', NULL, 1, 1),
(256, 8, 1, '143D7M00012', NULL, 1, 1),
(257, 8, 1, '00-1F-D4-03-1D-C2', NULL, 1, 1),
(258, 8, 1, '00-1F-D4-03-1D-32', NULL, 1, 1),
(259, 8, 1, '00-1F-D4-03-1D-52', NULL, 1, 1),
(260, 8, 1, '00-1F-D4-02-4E-C6', NULL, 1, 1),
(261, 8, 1, '143D7M00014', NULL, 1, 1),
(262, 8, 1, '143D7M00020', NULL, 1, 1),
(263, 1, 1, '24-A4-3C-7E-2A-B6', NULL, 0, 1),
(264, 1, 1, '04-18-D6-54-E0-AD', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `equipment_type`
--

CREATE TABLE IF NOT EXISTS `equipment_type` (
  `equipment_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `equipment_type` varchar(255) DEFAULT NULL,
  `equipment_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`equipment_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `equipment_type`
--

INSERT INTO `equipment_type` (`equipment_type_id`, `equipment_type`, `equipment_slug`) VALUES
(1, 'AirMax', 'airmax'),
(2, 'Antenne', 'antenne'),
(3, 'GPS', 'gps'),
(4, 'WiFi Router', 'wifi-router'),
(5, 'Switch', 'switch'),
(7, 'Contrôleur', 'controleur');

-- --------------------------------------------------------

--
-- Structure de la table `markers`
--

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site` varchar(150) NOT NULL,
  `zone` varchar(150) NOT NULL,
  `projet` varchar(150) NOT NULL,
  `pylon` varchar(150) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `type` varchar(150) NOT NULL,
  `equip` text NOT NULL,
  `ip` varchar(200) NOT NULL,
  `mask` varchar(50) NOT NULL,
  `type_site` varchar(200) NOT NULL,
  `connected_to` varchar(200) NOT NULL,
  `info_sites` varchar(200) NOT NULL,
  `nb_equip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Contenu de la table `markers`
--

INSERT INTO `markers` (`id`, `site`, `zone`, `projet`, `pylon`, `lat`, `lng`, `type`, `equip`, `ip`, `mask`, `type_site`, `connected_to`, `info_sites`, `nb_equip`) VALUES
(40, 'OCIT BANCO', 'Yopougon', 'P2MPT Phase I', 'Autostable', '5.333900', -4.074075, 'fh', 'Rocket M5\r\n', '172.16.6.3/172.16.6.4/172.16.6.5/172.16.6.6', '0', 'Site centraux', '', '', '4'),
(41, 'BACI toit rouge', 'Yopougon', 'P2MPT Phase I', 'Aubane ST 15', '5.331439', -4.055166, 'fh', 'NanoBeam M5-400', '172.16.6.11', '0', 'Site client', 'OCIT BANCO', '', '1'),
(42, 'Centre Suisse', 'Yopougon', 'P2MPT Phase I', 'Aubane ST 15', '5.330113', -4.128313, 'fh', 'NanoBeam M5-400', '172.16.6.9', '0', 'Site client', 'OCIT BANCO', '', '1'),
(43, 'Coopec Selmer', 'Yopougon', 'P2MPT Phase I', 'Aubane ST 15', '5.341056', -4.066523, 'fh', 'NanoBeam M5-400', '172.16.6.13', '0', 'Site client', 'OCIT BANCO', '', '1'),
(44, 'BACI Attécoubé', 'Yopougon', 'P2MPT Phase II', 'Aubane ST 15', '5.348352', -4.034874, 'fh', 'NanoBeam M5-400', '172.16.6.7', '0', 'Site client', 'OCIT BANCO', '', '1'),
(45, 'BACI Zone Industrielle', 'Yopougon', 'P2MPT Phase II', 'Aubane ST 15', '5.370498', -4.081094, 'fh', 'NanoBeam M5-400', '172.16.6.8', '0', 'Site client', 'OCIT BANCO', '', '1'),
(46, 'BACI Siporex', 'Yopougon', 'P2MPT Phase II', 'Aubane ST 15', '5.351922', -4.074111, 'fh', 'NanoBeam M5-400', '172.16.6.10', '0', 'warning', 'OCIT BANCO', '', '1'),
(47, 'ocit vridi', 'Vridi', 'P2MPT Phase I', 'Autostable', '5.264444', -3.998611, 'fh', 'Rocket M5', '172.16.4.3/172.16.4.4/172.16.4.5/172.16.4.6', '0', 'Site centraux', '', '', '4'),
(48, 'OCIT_COCODY_DANGA', 'Cocody', 'P2MPT Phase I', 'Autostable', '5.339692', -4.004342, 'fh', 'Rocket M5', '172.16.27.3/172.16.27.4/172.16.27.5', '0', 'Site centraux', '', 'nous utilisons ici 3 antennes de 120°', '3'),
(49, 'COMPHARMED VRIDI', 'Vridi', 'Aucun', 'Aubane ST 15', '5.285278', -4.007778, 'fh', 'NanoBeam M5-400', '', '0', 'Site client', 'ocit vridi', '', '1'),
(50, 'COMPHARMED VRIDI', 'Vridi', 'P2MPT Phase I', 'Aubane ST 15', '5.285278', -4.007778, 'fh', 'NanoBeam M5-400', '172.16.4.11', '0', 'Site client', 'ocit vridi', '', '1'),
(51, 'MOVIS INTERNET', 'Vridi', 'P2MPT Phase I', 'Aubane ST 15', '5.271111', -4.001944, 'fh', 'NanoBeam M5-400', '172.16.4.10', '0', 'Site client', 'ocit vridi', '', '1'),
(52, 'VOODOO', 'Cocody', 'P2MPT Phase I', 'Aubane ST 15', '5.353890', -3.980560, 'fh', 'NanoBeam M5-400', '172.16.27.7', '0', 'Site client', 'OCIT_COCODY_DANGA', 'le CPE est installé sur un pylône de 15 m', '1'),
(53, 'ORYS GAZ', 'Vridi', 'P2MPT Phase I', 'Aubane ST 15', '5.266667', -4.008611, 'fh', 'NanoBeam M5-400', '172.16.4.12', '0', 'Site client', 'ocit vridi', '', '1'),
(54, 'SEIGNEURIE', 'Vridi', 'P2MPT Phase I', 'Aubane ST 15', '5.268056', -4.006389, 'fh', 'NanoBeam M5-400', '172.16.4.8', '0', 'Site client', 'ocit vridi', '', '1'),
(55, 'SOTRA KOUMASSSI', 'Vridi', 'P2MPT Phase I', 'Aubane ST 15', '5.286389', -3.953056, 'fh', 'NanoBeam M5-400', '172.16.4.7', '0', 'Site client', 'ocit vridi', '', '1'),
(56, 'SOGEA PORT DE PECHE', 'Vridi', 'P2MPT Phase I', 'Aubane ST 15', '5.288203', -4.012800, 'fh', 'NanoBeam M5-400', '172.16.4.13', '0', 'Site client', 'ocit vridi', '', '1'),
(57, 'UNACOOPEC', 'Abobo', 'P2MPT Phase I', 'Aucun', '5.416937', -4.016967, 'fh', 'NanoBeam M5-400', '', '0', 'Site client', 'SITE CENTRAL ABOBO', '', '1'),
(58, 'UNICEF COCODY', 'Cocody', 'P2MPT Phase I', 'Aubane ST 15', '5.341390', -3.961670, 'fh', 'NanoBeam M5-400', '172.16.27.9', '0', 'Site client', 'OCIT_COCODY_DANGA', 'la hauteur du pylône est de 24 m et le cpe est installé à 21 m', '1'),
(59, 'VOODOO', 'Cocody', 'P2MPT Phase I', 'Aubane ST 15', '5.353890', -3.980560, 'fh', 'NanoBeam M5-400', '172.16.27.7', '0', 'Site client', 'OCIT_COCODY_DANGA', 'la hauteur du pylône est de 15 m et le CPE est à 15 m', '1'),
(60, 'OCIT_COCODY_DANGA', 'Cocody', 'P2MPT Phase I', 'Autostable', '5.339692', -4.004342, 'fh', 'Rocket M5', '172.16.27.3/172.16.27.4/172.16.27.5', '0', 'Site centraux', '', 'la hauteur du pylône est de 40 m et les antennes sont placées à cette hauteur.', '3'),
(61, 'UNACOOPEC', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.416937', -4.016967, 'fh', 'NanoBeam M5-300', '172.16.5.10', '0', 'Site client', ' ABOBO CI-TELECOM', '', '1'),
(62, 'DGI ABOBO', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.436132', -4.020518, 'fh', 'NanoBeam M5-300', '172.16.5.11', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(63, 'BNI ABOBO', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.423440', -4.015735, 'fh', 'NanoBeam M5-300', '172.16.5.7', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(64, 'BACI ABOBO', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.422308', -4.015097, 'fh', 'NanoBeam M5-300', '172.16.5.8', '0', 'warning', 'ABOBO CI-TELECOM', '', '1'),
(65, 'ECOBANK ABOBO SANTE', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.423802', -4.015173, 'fh', 'NanoBeam M5-300', '172.16.5.14', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(66, 'ECOBANK ABOBO-GARE', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.439845', -4.043167, 'fh', 'NanoBeam M5-400', '172.16.5.15', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(67, 'BOA ABOBO', 'Abobo', 'P2MPT Phase I', 'Aucun', '5.418177', -4.016953, 'fh', 'NanoBeam M5-300', '172.16.5.9', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(68, 'BNI AGBAN', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.368337', -4.000187, 'fh', 'NanoBeam M5-300', '172.16.5.13', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(69, 'LA FAYETTE', 'Abobo', 'P2MPT Phase I', 'Aubané ST 15', '5.393056', -4.994444, 'fh', 'NanoBeam M5-300', '172.16.5.16', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(70, 'ADM COCOA ABOBO', 'Abobo', 'P2MPT Phase I', 'Aubane ST 15', '5.456283', -4.054518, 'fh', 'NanoBeam M5-300', '172.16.5.12', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(71, 'LA FAYETTE', 'Abobo', 'P2MPT Phase I', 'Aubane  ST 15', '5.393056', -4.994444, 'fh', 'NanoBeam M5-400', '172.16.5.16', '0', 'Site client', 'ABOBO CI-TELECOM', '', '1'),
(72, 'ABOBO CI-TELECOM', 'Abobo', 'P2MPT Phase I', 'Autostable', '5.422780', -4.015000, 'fh', 'Rocket M5', '172.16.5.3/172.16.5.4', '0', 'Site centraux', 'UNACOOPEC ABOBO,BNI ABOBO,BACI ABOBO, ECOBANK ABOBO-SANTE,ECOBANK ABOBO-GARE,BOA,BNI AGBAN,LA FAYETTE,ADM COCOA', '', '1');

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) DEFAULT NULL,
  `project_slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `project_slug`) VALUES
(1, 'P2MPT Phase I', 'p2mpt-phase-i'),
(2, 'P2MPT Phase II', 'p2mpt-phase-ii'),
(3, 'Aucun', 'aucun'),
(4, 'P2MPT Phase III', 'p2mpt-phase-iii'),
(5, 'P2MPT Phase 0', 'p2mpt-phase-0'),
(6, 'P2MPT Phase IV', 'p2mpt-phase-iv');

-- --------------------------------------------------------

--
-- Structure de la table `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  `seller_name` varchar(255) DEFAULT NULL,
  `seller_address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `seller`
--

INSERT INTO `seller` (`seller_id`, `seller_name`, `seller_address`) VALUES
(1, 'Jighi Reseller', 'JIGHI COTE D’IVOIRE'),
(2, 'Jighi Reselelr 2', 'Abidjan');

-- --------------------------------------------------------

--
-- Structure de la table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(55) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `state`
--

INSERT INTO `state` (`state_id`, `state`, `country_id`) VALUES
(1, 'Abidjan', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `user_name` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `language` varchar(55) DEFAULT NULL,
  `first_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  `register_date` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`user_id`, `title`, `user_name`, `password`, `email`, `language`, `first_name`, `last_name`, `is_active`, `register_date`) VALUES
(1, 'Mr.', 'Deepak', '498b5924adc469aa7b660f457e0fc7e5', 'deepak@jighi.com', 'english', 'Deepak', 'Kumar', 1, '2014-10-30 00:00:00'),
(2, 'Mr.', 'Mario', 'de2f15d014d40b93578d255e6221fd60', 'mario@jighi.com', 'french', 'Mario', '', 1, '2014-11-05 00:00:00'),
(3, 'Mr.', 'Pankul', '19e4ef9d39d194d9e95a0bbc070a1c0f', 'pankul@jighi.com', 'english', 'Pankul', 'Jain', 1, '2015-03-09 00:00:00'),
(4, 'Mr.', 'Mack', '52d0f070051d8c1eeba57c6be2e24d0b', 'mack@jighi.com', 'english', 'Mack', 'Coulibaly', 1, '2015-03-23 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `user_access`
--

CREATE TABLE IF NOT EXISTS `user_access` (
  `user_access_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `access_id` int(11) NOT NULL,
  PRIMARY KEY (`user_access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `user_access`
--

INSERT INTO `user_access` (`user_access_id`, `user_id`, `access_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 2),
(4, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `zone`
--

CREATE TABLE IF NOT EXISTS `zone` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_name` varchar(255) DEFAULT NULL,
  `zone_slug` varchar(255) DEFAULT NULL,
  `zone_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `zone`
--

INSERT INTO `zone` (`zone_id`, `zone_name`, `zone_slug`, `zone_type_id`) VALUES
(1, 'ABOBO', 'abobo', 1),
(2, 'COCODY', 'cocody', 1),
(3, 'VRIDI', 'vridi', 1),
(4, 'YOPOUGON', 'yopougon', 1),
(5, 'ASSINIE', 'assinie', 1),
(6, 'ASSOUINDE', 'assouinde', 1),
(7, 'MARCORY', 'marcory', 1),
(8, 'TREICHVILLE', 'treichville', 1),
(9, 'TREICHVILLE', 'treichville', 1),
(10, 'ANYAMA', 'anyama', 9),
(11, 'PLATEAU', 'plateau', 1),
(12, 'KOUMASSI', 'koumassi', 1),
(13, 'DIVO', 'divo', 11),
(14, 'SAN PEDRO', 'san-pedro', 12),
(15, 'ABENGOUROU', 'abengourou', 15),
(16, 'PORT BOUET', 'port-bouet', 17),
(17, 'BOUAKE', 'bouake', 8);

-- --------------------------------------------------------

--
-- Structure de la table `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `libelle_zone` varchar(150) NOT NULL,
  `type_zone` varchar(100) NOT NULL,
  `ville_zone` varchar(150) NOT NULL,
  PRIMARY KEY (`libelle_zone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `zone_type`
--

CREATE TABLE IF NOT EXISTS `zone_type` (
  `zone_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_type` varchar(255) DEFAULT NULL,
  `zone_slug` varchar(155) DEFAULT NULL,
  PRIMARY KEY (`zone_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `zone_type`
--

INSERT INTO `zone_type` (`zone_type_id`, `zone_type`, `zone_slug`) VALUES
(1, 'Abidjan', 'abidjan'),
(2, 'Zone Type 2', 'zone-type-2'),
(3, 'Zone Type 3', 'zone-type-3'),
(4, 'Zone Type 4', 'zone-type-4'),
(5, 'Zone Type 5', 'zone-type-5'),
(6, 'Alepe', 'alepe'),
(7, 'Yamoussoukro', 'yamoussoukro'),
(8, 'Bouaké', 'bouake'),
(9, 'Anyama', 'anyama'),
(10, 'PLATEAU', 'plateau'),
(11, 'divo', 'divo'),
(12, 'san pedro', 'san-pedro'),
(13, 'daloa', 'daloa'),
(14, 'soubre', 'soubre'),
(15, 'abengourou', 'abengourou'),
(16, 'gagnoa', 'gagnoa'),
(17, 'Port bouet', 'port-bouet');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
