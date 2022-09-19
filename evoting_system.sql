-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 03:00 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(1) NOT NULL,
  `course_name` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`) VALUES
(1, 'BSIT'),
(2, 'BSCS');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `idnum` varchar(7) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `midname` varchar(30) DEFAULT NULL,
  `course_id` int(1) NOT NULL,
  `year` int(1) NOT NULL,
  `email` varchar(50) NOT NULL,
  `last_access` date DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`idnum`, `lastname`, `firstname`, `midname`, `course_id`, `year`, `email`, `last_access`, `password`) VALUES
('0001569', 'SUMPAY', 'JONIC ALLEN', '', 1, 1, 'sums@gmail.com', NULL, NULL),
('0040836', 'ADLAON', 'ANALYN DUMAL', '', 1, 1, 'adlaon@gmail.com', NULL, NULL),
('0041972', 'MONDIDO', 'PRINCESS', '', 1, 4, 'Princess121@gmail.com', NULL, NULL),
('0060456', 'ADOLFO', 'JESO MARANGA', '', 1, 1, 'jeso@gmail.com', NULL, NULL),
('0071727', 'LARAÑO', 'CLARENCE', '', 1, 1, 'ayy@gmail.com', NULL, NULL),
('0090440', 'BACASNOT', 'HANY ROSE', '', 1, 1, 'hans@gmail.com', NULL, NULL),
('0100574', 'SUBRABAS', 'PAOLO', '', 1, 4, 'paos@gmail.com', NULL, NULL),
('0101014', 'HALASAN', 'KENTLUKE', '', 1, 2, 'hals@gmail.com', NULL, NULL),
('0101915', 'BALATERO', 'BRYLE', '', 1, 1, 'bry@gmail.com', NULL, NULL),
('1101411', 'JIMOYA', 'SCARLIT RUTH', '', 1, 2, 'Jims@gmail.com', NULL, NULL),
('1110001', 'DUMMY', 'DUMMY', 'DUMMY', 1, 1, 'dummy@gmail.com', NULL, NULL),
('1200245', 'REYNA', 'SHEPHERD', '', 1, 2, 'reys@gmail.com', NULL, NULL),
('1200288', 'DECENA', 'DEXTER PHILIP', '', 1, 2, 'Dec@gmail.com', NULL, NULL),
('1200306', 'HAMBRE', 'JEFFERSON', '', 1, 2, 'Hams@gmail.com', NULL, NULL),
('1200780', 'LUMAYAG', 'ARCHELLE', '', 2, 2, 'Lumayag@gmail.com', NULL, NULL),
('1200968', 'EGAY', 'CHRISTIAN CLARK', '', 1, 2, 'egs@gmail.com', NULL, NULL),
('1201673', 'MANDI', 'HASANNOR', '', 1, 2, 'mans@gmail.com', NULL, NULL),
('1212121', 'DUMMY TWO', 'DUMMY', '', 2, 3, 'dummy2@gmail.com', NULL, NULL),
('1300411', 'PALAO', 'REYMUND REX', '', 1, 4, 'palao@gmail.com', NULL, NULL),
('1300675', 'GUIRIGAY', 'HEX ALLAIN', '', 2, 2, 'Guirigay@gmail.com', NULL, NULL),
('1301103', 'CALOG', 'JOHN MICHAEL', '', 1, 1, 'john@gmail.com', NULL, NULL),
('1301105', 'LAGO', 'ABIGAEL', '', 1, 2, 'Lags@gmail.com', NULL, NULL),
('1301283', 'OSTIA', 'KAITA', '', 1, 1, 'ostia@gmail.com', NULL, NULL),
('1301290', 'ARTAJO', 'PRINCE JERIC', '', 1, 1, 'art@gmail.com', NULL, NULL),
('1301334', 'TIA', 'MICHAEL', '', 1, 1, 'waddap@gmail.com', NULL, NULL),
('1301347', 'ANGELIO', 'POL BRYAN', '', 1, 1, 'pol@gmail.com', NULL, NULL),
('1400137', 'SIAO', 'FREDELLE KYLE', '', 1, 1, 'siaomairias@gmail.com', NULL, NULL),
('1402087', 'LLAMAS', 'CHARITY', '', 1, 4, 'llamas@gmail.com', NULL, NULL),
('1500354', 'VALE', 'DIOMAR NEIL', '', 1, 4, 'dio@gmail.com', NULL, NULL),
('1500508', 'LANAS ', 'GARY', '', 1, 1, 'gar@gmail.com', NULL, NULL),
('1500723', 'PEGALAN', 'JEYSIERELLE', '', 1, 4, 'jeys@gmail.com', NULL, NULL),
('1500769', 'LAGAT', 'KENT LESTER', '', 1, 4, 'lagats12@gmail.com', NULL, NULL),
('1500964', 'IPIL', 'HONEY BABE', '', 1, 2, 'ipils@gmail.com', NULL, NULL),
('1501079', 'ARANA', 'KAIROS CHRISTIAN', '', 1, 4, 'Arands@gmail.com', NULL, NULL),
('1501187', 'OBUT', 'MARLON', '', 1, 2, 'marls@gmail.com', NULL, NULL),
('1501368', 'CERVANTES', 'RANEL REY', '', 1, 2, 'cervantes@gmail.com', NULL, NULL),
('1501794', 'NIEVES', 'MICHELLE', '', 1, 4, 'nievs@gmail.com', NULL, NULL),
('1501802', 'BONGGOL', 'CHRISTIAN', '', 1, 4, 'bongs@gmail.com', NULL, NULL),
('1501806', 'YASEIN', 'YARA', '', 1, 4, 'yara@gmail.com', NULL, NULL),
('1600016', 'AMPLAYO', 'CHRISTIAN', '', 1, 2, 'Amplayo@gmail.com', NULL, NULL),
('1600079', 'BALBARAN', 'JOHN BUGSY', '', 1, 2, 'bugs@gmail.com', NULL, NULL),
('1600212', 'JABLA', 'SHAINA MARIE', '', 1, 2, 'jabs@gmail.com', NULL, NULL),
('1600441', 'REQUIROSO', 'TRESHA', '', 1, 2, 'reqs@gmail.com', NULL, NULL),
('1600455', 'CABANDO', 'VON PHILLIP', '', 2, 2, 'vons@gmail.com', NULL, NULL),
('1600526', 'PACLAR', 'PRINCESS JOY', '', 1, 2, 'pacs@gmail.com', NULL, NULL),
('1600600', 'GUIRIGAY', 'HEX ALLAIN', '', 2, 2, 'hex123@gmail.com', NULL, NULL),
('1600609', 'FACIOL', 'APPLE JANE', '', 1, 2, 'aps@gmail.com', NULL, NULL),
('1600627', 'ROSAL', 'ALLAN KENNETH', 'LABADESOS', 1, 2, 'allankenneth143@gmail.com', NULL, NULL),
('1600666', 'NAMUAG', 'JUBIL', '', 1, 2, 'jubs@gmail.com', NULL, NULL),
('1600785', 'DECENAN', 'FERIC', '', 1, 2, 'Decs@gmail.com', NULL, NULL),
('1600856', 'DUYAC', 'ROXANNE JOY', '', 1, 4, 'ducs@gmail.com', NULL, NULL),
('1600981', 'ANTIQUINA', 'ANABIL', '', 1, 4, 'anti@gmail.com', NULL, NULL),
('1601087', 'LARGO', 'KENNETH', '', 1, 2, 'largs@gmail.com', NULL, NULL),
('1601492', 'LUMAGUE', 'BERTRAND', '', 1, 4, 'lumags@gmail.com', NULL, NULL),
('1601494', 'LUMAGUE', 'LENBERT', '', 1, 4, 'lumag112@gmail.com', NULL, NULL),
('1601506', 'NAVIA', 'ELTON JOHN', '', 1, 2, 'navs@gmail.com', NULL, NULL),
('1601645', 'SORIA ', 'CYRUS JULES', '', 1, 4, 'soria@gmail.com', NULL, NULL),
('1700014', 'PABRIGA', 'PAUL MICHAEL', '', 2, 1, 'pabs@gmail.com', NULL, NULL),
('1700077', 'DELA PEÑA', 'JONATHAN', '', 1, 1, 'dela@gmail.com', NULL, NULL),
('1700097', 'TAMPUS', 'ANGIE', '', 1, 1, 'tamsp@gmail.com', NULL, NULL),
('1700288', 'OTACAN', 'FLORENCE', '', 1, 1, 'otacs@gmail.com', NULL, NULL),
('1700335', 'ALCONTIN', 'RICO ANGEL', '', 1, 1, 'rico@gmail.com', NULL, NULL),
('1700808', 'SIMBAJON', 'CHRISTINE', '', 2, 1, 'sims@gmail.com', NULL, NULL),
('1701133', 'TANGCASAN', 'RAUL', '', 1, 1, 'rauls@gmail.com', NULL, NULL),
('1800016', 'TEJERO', 'TRISTIAN KYLE', '', 1, 2, 'arabos@gmail.com', NULL, NULL),
('1800071', 'BOLOS', 'JEFFERSON', '', 1, 2, 'bolos@gmail.com', NULL, NULL),
('1800134', 'CANGGAS', 'MAY CAROLINE', '', 2, 2, 'cangs@gmail.com', NULL, NULL),
('1800263', 'QUINIÑEZA', 'ANTHONY', '', 1, 2, 'quin@gmail.com', NULL, NULL),
('1800375', 'DICO', 'JASMINE', '', 1, 2, 'Dicos@gmail.com', NULL, NULL),
('1800532', 'OHUMAN', 'BISCILOU ANGEL', '', 1, 2, 'bisbis@gmail.com', NULL, NULL),
('1800634', 'MELENDRES', 'MENARD', '', 1, 2, 'melends@gmail.com', NULL, NULL),
('1800657', 'ARCILLAS', 'KERBY', '', 1, 2, 'Arcillas@gmail.com', NULL, NULL),
('1800716', 'MABANAG', 'MARK JAYSON', '', 1, 2, 'mabs@gmail.com', NULL, NULL),
('1800758', 'ORBILLA', 'MARK PHILIP', '', 1, 2, 'orbs@gmail.com', NULL, NULL),
('1800795', 'DULA', 'JOHN CRIS', '', 1, 2, 'dula@gmail.com', NULL, NULL),
('1800917', 'MEDINA', 'KIRK STEVEN', '', 1, 2, 'kirks@gmail.cm', NULL, NULL),
('1800989', 'BOLINA', 'JAIR JAY', '', 1, 2, 'bolina', NULL, NULL),
('1801037', 'LIMBARING', 'RUIGIE', '', 1, 2, 'lims@gmail.com', NULL, NULL),
('1801079', 'PONSARAN', 'EFER', '', 1, 2, 'pons@gmail.com', NULL, NULL),
('1801234', 'BASMAYOR', 'DYLMAR', '', 1, 2, 'Basmayor@gmail.com', NULL, NULL),
('1801345', 'ARINGA', 'EMILYN', '', 1, 2, 'Aringa@gmail.com', NULL, NULL),
('1801617', 'DELICANA', 'ADRIAN', '', 1, 2, 'delics@gmail.com', NULL, NULL),
('1801622', 'VILLARIMO', 'HOLDEN KITH', '', 1, 2, 'Holds@gmail.com', NULL, NULL),
('1801654', 'CABALLAR', 'DANIEL LUIS', '', 1, 2, 'cabs@gmail.com', NULL, NULL),
('1801717', 'CUERING', 'ROBERT EVAN', '', 1, 2, 'cues@gmail.com', NULL, NULL),
('1801896', 'ARCADIO', 'NANETH', '', 1, 1, 'arc@gmail.com', NULL, NULL),
('1802319', 'CAMEOMANES', 'FLORIAN', '', 1, 1, 'flor@gmail.com', NULL, NULL),
('1807890', 'ARMADA', 'CHESTEIR JUDE', '', 1, 2, 'Armada@gmail.com', NULL, NULL),
('1900056', 'TAYLARAN', 'JEFREY', '', 1, 1, 'tay@gmail.com', NULL, NULL),
('1900227', 'KILLOPAS', 'JOHN MICHAEL', '', 1, 1, 'killo@gmail.com', NULL, NULL),
('1900290', 'BUNILLA', 'SIERRA MARIE', '', 1, 1, 'sierra@gmail.com', NULL, NULL),
('1900405', 'VILLARIMO', 'DIVINA', '', 1, 1, 'divs@gmail.com', NULL, NULL),
('1900493', 'LAMBAN', 'FRITZ LORENZ', '', 1, 1, 'fritz@gmail.com', NULL, NULL),
('1900514', 'ABERGAS', 'QUINT NICO', '', 1, 1, 'quint@gmail.com', NULL, NULL),
('1900523', 'JAMBO', 'MARISH', '', 1, 1, 'waddapb@gmail.com', NULL, NULL),
('1900587', 'VELASCO', 'ANGELA', '', 1, 1, 'angela@gmail.com', NULL, NULL),
('1900714', 'MAMA', 'ADRIANA', '', 1, 1, 'mams@gmail.com', NULL, NULL),
('1900763', 'LANZADERAS', 'JONATHAN', '', 1, 1, 'jonat@gmail.com', NULL, NULL),
('1900769', 'LEGANIA', 'FENEROSE', '', 1, 1, 'we1@gmail.com', NULL, NULL),
('1900796', 'JALALON', 'DIANA ANGEL', '', 1, 1, 'jala@gmail.com', NULL, NULL),
('1900813', 'COMETA', 'JOHN', '', 1, 1, 'coms@gmail.com', NULL, NULL),
('1900937', 'RAMOS', 'BRUTUS', '', 1, 1, 'bruts@gmail.com', NULL, NULL),
('1901017', 'VICENTE', 'JOSHUA', '', 1, 1, 'josh@gmail.com', NULL, NULL),
('1901061', 'ANTIPWESTO', 'RAEM', '', 1, 1, 'nan@gmail.com', NULL, NULL),
('1901064', 'SABIN', 'NICELIE JANE', '', 2, 1, 'sabs@gmail.com', NULL, NULL),
('1901066', 'ONDO', 'COLEEN MAE', '', 1, 1, 'cols@gmail.com', NULL, NULL),
('1901084', 'BUENAFE', 'JAN PAUL', '', 1, 1, 'jan@gmail.com', NULL, NULL),
('1901201', 'MADRAGO', 'WILLY', '', 1, 1, 'willies@gmail.com', NULL, NULL),
('1901313', 'CABAÑAS', 'ARMANDO', '', 1, 1, 'arm@gmail.com', NULL, NULL),
('1901362', 'HUMAWAN', 'CHRISTIAN', '', 1, 1, 'hums@gmail.com', NULL, NULL),
('1901575', 'YWARATA', 'LOUIE', '', 1, 1, 'wad@gmail.com', NULL, NULL),
('1901642', 'BENOLIRAO', 'KIT', '', 1, 1, 'bens@gmail.com', NULL, NULL),
('1901654', 'TUMIMBANG', 'IVAN', '', 1, 1, 'ivan@gmail.com', NULL, NULL),
('1901659', 'RAMIREZ', 'ANGHILEKA', '', 1, 1, 'rams@gmail.com', NULL, NULL),
('1901666', 'TAGIOBON', 'ROSS JON', '', 2, 1, 'ross@gmail.com', NULL, NULL),
('1901790', 'DELOS REYES', 'BRYAN', '', 1, 1, 'bryan@gmail.com', NULL, NULL),
('1901869', 'PULMANO', 'LOUIE JAY', '', 1, 1, 'puls@gmail.com', NULL, NULL),
('1902002', 'BATI ON', 'OLSEN', '', 1, 1, 'ols@gmail.com', NULL, NULL),
('1902015', 'KAIMKO', 'ART KYOB', '', 1, 1, 'arts@gmail.com', NULL, NULL),
('1902042', 'LIM', 'ALEJANDRO', '', 1, 1, 'Lim11@gmail.com', NULL, NULL),
('1902122', 'CENAS', 'JOHN MICHAEL', '', 1, 1, 'john21@gmail.com', NULL, NULL),
('1902181', 'BALUBA', 'FE ANGGOT', '', 1, 1, 'fe@gmail.com', NULL, NULL),
('1902188', 'ESTRIBOR', 'MA. CASANDRA', '', 2, 1, 'estr@gmail.com', NULL, NULL),
('1902198', 'BADONG', 'CHRISTY MAY', '', 1, 1, 'may@gmail.com', NULL, NULL),
('1902250', 'ALMONIA', 'MARJUN CEDRIC', '', 1, 1, 'margs@gmail.com', NULL, NULL),
('1902251', 'ALASAGAS', 'ERICA MAY', '', 1, 1, 'erica@gmail.com', NULL, NULL),
('1902290', 'BATION', 'FRED ANGELOU', '', 1, 1, 'bats@gmail.com', NULL, NULL),
('1902347', 'SUMATRA', 'HERMIE JANE', '', 2, 1, 'hermie@gmail.com', NULL, NULL),
('1902602', 'EX', 'NIKKA', '', 2, 1, 'niks@gmail.com', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idnum`),
  ADD UNIQUE KEY `UNIQUE_EMAIL` (`email`),
  ADD KEY `COURSE_ID` (`course_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `COURSE_ID` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
