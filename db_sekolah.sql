-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2021 at 11:18 AM
-- Server version: 10.3.29-MariaDB-0ubuntu0.20.04.1
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
-- Database: `db_sekolah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbkelassiswa`
--

CREATE TABLE `tbkelassiswa` (
  `idklssiswa` int(11) NOT NULL,
  `nis` int(11) NOT NULL,
  `kdkls` char(11) NOT NULL,
  `jurusan` enum('RPL','MM') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbkelassiswa`
--

INSERT INTO `tbkelassiswa` (`idklssiswa`, `nis`, `kdkls`, `jurusan`) VALUES
(3, 111, 'X-RPL', 'RPL'),
(4, 222, 'X-RPL', 'RPL');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `kdkelas` char(5) NOT NULL,
  `kelas` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_kelas`
--

INSERT INTO `tb_kelas` (`kdkelas`, `kelas`) VALUES
('X-MM1', 'X'),
('X-RPL', 'X');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` int(20) NOT NULL,
  `nama` char(30) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama`, `alamat`) VALUES
(111, 'Rudi Edukasi', 'Bogor-Cibinong'),
(222, 'Edukasi Rudi', 'Cibinong-Bogor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbkelassiswa`
--
ALTER TABLE `tbkelassiswa`
  ADD PRIMARY KEY (`idklssiswa`),
  ADD KEY `nis` (`nis`),
  ADD KEY `kdkls` (`kdkls`);

--
-- Indexes for table `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`kdkelas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbkelassiswa`
--
ALTER TABLE `tbkelassiswa`
  MODIFY `idklssiswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbkelassiswa`
--
ALTER TABLE `tbkelassiswa`
  ADD CONSTRAINT `tbkelassiswa_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `tb_siswa` (`nis`),
  ADD CONSTRAINT `tbkelassiswa_ibfk_2` FOREIGN KEY (`kdkls`) REFERENCES `tb_kelas` (`kdkelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
