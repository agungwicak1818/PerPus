-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2023 at 07:28 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpusk1`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_anggota`
--

CREATE TABLE `tb_anggota` (
  `nim` int(9) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `password` varchar(100) NOT NULL,
  `gambar` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_anggota`
--

INSERT INTO `tb_anggota` (`nim`, `nama`, `status`, `alamat`, `no_hp`, `password`, `gambar`) VALUES
(202250001, 'Andi Budiman', 'Admin', 'Jepara', '089647974901', '1234', '649b75aa8f4ed.png'),
(202251188, 'Priyo Agung Wicaksono', 'Anggota', 'Nalumsari', '089627162876', '12345', '649b753de9e8b.jpg'),
(202251190, 'Ahmad Nurul Fanny', 'Anggota', 'Jepara', '089647823984', '1234', '649b755474e86.jpg'),
(202251195, 'Ridho Yus Setiawan', 'Anggota', 'Kudus', '089649382746', '12345678', '649b756e5b8de.jpeg'),
(202251196, 'Dwi Saputra Nur Sugiono', 'Anggota', 'Demak', '089612783918', '1234', '649b75796c2a8.jpg'),
(202251198, 'Muhammad Lutfi Fanani', 'Anggota', 'Kudus', '089620192830', '12345', '649b75902bffa.jpg'),
(202251200, 'Ardhan Hasyim Ashari', 'Anggota', 'Keling', '089647974111', '12345', '649b759c1c3fa.jpeg'),
(202251209, 'Putri Maharani', 'Anggota', 'Pati', '089643212376', '1234', '649b8752b453e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_buku`
--

CREATE TABLE `tb_buku` (
  `id_buku` varchar(10) NOT NULL,
  `judul` varchar(30) NOT NULL,
  `pengarang` varchar(30) NOT NULL,
  `tahun_terbit` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_buku`
--

INSERT INTO `tb_buku` (`id_buku`, `judul`, `pengarang`, `tahun_terbit`) VALUES
('B-001', 'Akuntansi Biaya', 'Dwi Nur', 2003),
('B-002', 'Java Tutorial', 'Fanny', 2000),
('B-003', 'Pancasila', 'Adi', 1999),
('B-004', 'Tata Krama', 'Afandi', 2000),
('B-005', 'Panduan Solat', 'Lutfi', 2012),
('B-006', 'Bulan & Bintang', 'Sutena Empu', 2003),
('B-007', 'Java Script Pemula', 'Sugiono', 2000),
('B-008', 'Kewarganegaraan', 'Mpu Supri', 2001),
('B-009', 'Python Basic', 'Fian', 1999),
('B-010', 'Html & CSS Pemula', 'Fanani', 1998),
('B-011', 'Pendidikan Pancasila', 'Budi', 2006),
('B-012', 'Perahu Sampan', 'Muhtari', 2007),
('B-013', 'Jago PHP', 'Dika', 2005),
('B-014', 'Logika Pemrograman Python', 'Abdul Kadir', 2023),
('B-015', 'Dasar-Dasar Pemrograman Web', 'Tri Dwi', 2015);

-- --------------------------------------------------------

--
-- Table structure for table `tb_peminjaman`
--

CREATE TABLE `tb_peminjaman` (
  `id_peminjaman` varchar(5) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `jam` varchar(20) NOT NULL,
  `nim` int(9) NOT NULL,
  `id_buku` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_peminjaman`
--

INSERT INTO `tb_peminjaman` (`id_peminjaman`, `tgl_peminjaman`, `tgl_pengembalian`, `jam`, `nim`, `id_buku`) VALUES
('P-001', '2023-06-28', '2023-07-05', '07:07:09 am', 202251188, 'B-004'),
('P-002', '2023-06-28', '2023-07-05', '07:07:17 am', 202251190, 'B-014'),
('P-003', '2023-06-28', '2023-07-05', '07:08:39 am', 202251200, 'B-006'),
('P-004', '2023-06-28', '2023-07-05', '07:08:52 am', 202251196, 'B-010'),
('P-005', '2023-06-28', '2023-07-05', '08:15:02 am', 202251196, 'B-009'),
('P-006', '2023-06-28', '2023-07-05', '08:15:27 am', 202251195, 'B-001'),
('P-007', '2023-06-28', '2023-07-05', '08:15:46 am', 202251188, 'B-012'),
('P-008', '2023-06-28', '2023-07-05', '08:16:11 am', 202251195, 'B-007'),
('P-009', '2023-06-28', '2023-07-05', '08:16:38 am', 202251196, 'B-014'),
('P-010', '2023-06-28', '2023-07-05', '08:16:49 am', 202251195, 'B-006'),
('P-011', '2023-06-28', '2023-07-05', '08:17:02 am', 202251195, 'B-002'),
('P-012', '2023-06-28', '2023-07-05', '08:17:19 am', 202251200, 'B-007'),
('P-013', '2023-06-28', '2023-07-05', '08:17:29 am', 202251195, 'B-013'),
('P-014', '2023-06-28', '2023-07-05', '08:17:46 am', 202251198, 'B-008'),
('P-015', '2023-06-28', '2023-07-05', '08:18:07 am', 202251198, 'B-011');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_anggota`
--
ALTER TABLE `tb_anggota`
  ADD PRIMARY KEY (`nim`);

--
-- Indexes for table `tb_buku`
--
ALTER TABLE `tb_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `nim` (`nim`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_buku_2` (`id_buku`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_peminjaman`
--
ALTER TABLE `tb_peminjaman`
  ADD CONSTRAINT `tb_peminjaman_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tb_anggota` (`nim`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `tb_buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
