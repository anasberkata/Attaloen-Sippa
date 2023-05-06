-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2023 at 09:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sippa`
--

-- --------------------------------------------------------

--
-- Table structure for table `alat_bahan`
--

CREATE TABLE `alat_bahan` (
  `id_alat_bahan` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `nama_alat_bahan` varchar(255) NOT NULL,
  `merk` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat_bahan`
--

INSERT INTO `alat_bahan` (`id_alat_bahan`, `kode`, `nama_alat_bahan`, `merk`, `id_kategori`, `qty`, `gambar`, `kondisi`, `keterangan`, `date_created`) VALUES
(3, '20190201', 'Gunting', 'Joyko SC-848', 1, 30, '64532303319ec.jpg', 'Baik', '', '2023-05-04'),
(4, '20210102', 'Zipper', '', 2, 30, '64532b5cdc94d.jpg', 'Baik', '', '2023-05-04'),
(6, '20190201', 'Jarum jahit', 'Regal', 1, 50, '64536b9b3756b.jpg', 'Baik', '', '2023-05-04'),
(7, '20210102', 'Benang', 'Cotton', 2, 50, '6454aa187bb64.jpg', 'Baik', '', '2023-05-05'),
(8, '20190201', 'Hakpen', 'Tulip Gold 2/3', 1, 50, '6454aa4239e1b.jpg', 'Baik', '', '2023-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Alat'),
(2, 'Bahan');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_karyawan` int(11) NOT NULL,
  `keperluan` text NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengambilan` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status_peminjaman` int(11) NOT NULL,
  `status_pengambilan` int(11) NOT NULL,
  `status_pengembalian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_karyawan`, `keperluan`, `tanggal_peminjaman`, `tanggal_pengambilan`, `tanggal_pengembalian`, `status_peminjaman`, `status_pengambilan`, `status_pengembalian`) VALUES
(9, 2, 'asd', '2023-05-07', '2023-05-29', '2023-05-08', 1, 1, 1),
(10, 4, 'ajkjhkaj', '2023-05-07', '2023-06-01', '2023-05-08', 1, 1, 1),
(11, 2, 'kajkajkaka', '2023-05-08', '2023-06-05', '2023-05-09', 1, 1, 1),
(12, 4, 'SDasfa', '2023-05-24', '2023-06-07', '2023-05-18', 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman_detail`
--

CREATE TABLE `peminjaman_detail` (
  `id_peminjaman_detail` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty_peminjaman` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman_detail`
--

INSERT INTO `peminjaman_detail` (`id_peminjaman_detail`, `id_peminjaman`, `id_barang`, `qty_peminjaman`) VALUES
(31, 9, 3, 10),
(32, 9, 4, 10),
(33, 10, 7, 20),
(34, 10, 6, 20),
(35, 11, 3, 10),
(36, 11, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(40) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role_id` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `email`, `password`, `phone`, `image`, `role_id`, `date_created`, `is_active`) VALUES
(1, 'Janjan Hari Sudrajat', 'admin', 'janjanhs@gmail.com', 'admin', '0678564574', 'default.jpg', 1, '2023-04-23', 1),
(2, 'Eka Anas Jatnika', 'anasberkata', 'ideanasdesain@gmail.com', 'Dean114119', '085156334607', 'default.jpg', 2, '2023-04-23', 1),
(4, 'Indra Lesmana', 'indra', 'indralesmana@gmail.com', 'indra', '085165245156', 'default.jpg', 2, '2023-04-30', 1),
(6, 'Karyawan 01', 'karyawan01', 'karyawan01@gmail.com', 'karyawan01', '09987i769876', 'default.jpg', 2, '2023-05-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_role`
--

CREATE TABLE `users_role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_role`
--

INSERT INTO `users_role` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat_bahan`
--
ALTER TABLE `alat_bahan`
  ADD PRIMARY KEY (`id_alat_bahan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`);

--
-- Indexes for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  ADD PRIMARY KEY (`id_peminjaman_detail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat_bahan`
--
ALTER TABLE `alat_bahan`
  MODIFY `id_alat_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `peminjaman_detail`
--
ALTER TABLE `peminjaman_detail`
  MODIFY `id_peminjaman_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
