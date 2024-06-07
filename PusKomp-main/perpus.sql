-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2024 at 11:06 AM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `cover` text NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `kategori` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` date NOT NULL,
  `jumlah_halaman` int(11) NOT NULL,
  `buku_deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`cover`, `id_buku`, `kategori`, `judul`, `pengarang`, `penerbit`, `tahun_terbit`, `jumlah_halaman`, `buku_deskripsi`) VALUES
('6657198885ea6.png', 'ppl01', 'Pemrograman', 'Pemrograman Web Dengan Node.Js Dan Javascript', 'Budi Raharjo', 'Informatika', '2019-04-23', 300, 'Buku ini membahas tentang komunikasi yang terjalin antara sistem database Node.Js dan JavaScript. Dibahas juga mengenai pembangunan aplikasi web yang menggunakan MariaDB dan MongoDB melalui platform Node.js yang dilengkapi dengan panduan yang bisa diterapkan pada sistem operasi seperti Microsoft dan lainnya.. ⁣ Selain itu, buku ini juga membahas tentang penggunaan Express, framework paling populer untuk Node.js, yang memudahkan kita dalam mengembangkan aplikasi web dengan Node.js.'),
('6656dd3129778.jpg', 'pro01', 'Pemrograman', 'Kursus Mandiri Python', 'Budi Raharjo', 'Informatika', '2022-07-08', 550, 'Python merupakan bahasa pemrograman multifungsi yang dapat digunakan untuk membuat berbagai jenis program, seperti program layanan (service) yang ditempatkan di mesin server, program desktop, program berbasis web, maupun program antarmuka untuk mengontrol jalannya perangkat keras tertentu. Kesederhanaan sintaks dan kelengkapan pustaka yang dimiliki Python menjadikan bahasa ini semakin populer dan digemari oleh para programmer sebagai alat bantu untuk menyelesaikan tugas-tugas pemrograman tertentu.'),
('66597738ce47f.jpg', 'pro03', 'Pemrograman', 'Dasar-Dasar Pemrograman Web', 'Sandika Galih', 'INKARA', '2019-06-04', 150, 'HTML &amp; CSS'),
('6656ebe95539d.jpg', 'so01', 'Sistem Operasi', 'Panduan Lengkap Ubuntu', 'Muhammad Ullil Fahri', 'CV Cipta Swakarya Surya', '2021-07-18', 79, 'Tutorial Ubuntu');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`kategori`) VALUES
('Basis Data'),
('Jaringan & Keamanan'),
('Kecerdasan Buatan'),
('Pemrograman'),
('Pengembangan Perangkat Lunak'),
('Robotik & IoT'),
('Sistem Operasi');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `npm` bigint(20) NOT NULL,
  `nama` text NOT NULL,
  `password` text NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan','','') NOT NULL,
  `no_tlp` text NOT NULL,
  `foto` varchar(255) DEFAULT 'assets/memberLogo.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`npm`, `nama`, `password`, `jenis_kelamin`, `no_tlp`, `foto`) VALUES
(2217051017, 'Oca', '$2y$10$7yzroD95Kr9vCrYgYx0N9O7gi8c8a7U7.G//FhTMXXoPcEV2dpj5C', 'Perempuan', '1234567899', 'assets/memberLogo.png'),
(2217051018, 'oca', '$2y$10$NeMFR4f.Fqq07Q6J0D9Ir.wNSHGnMv6Lw3i/6YG1AjuW/wYJ3XisO', 'Perempuan', '082282126810', 'assets/memberLogo.png'),
(2217051149, 'Zainab Aqilah', '$2y$10$b1jKa5iq0YuUKHoLcTDSKuBPw6o5KwCAFCXRoYrqyFVJHxh0yC.3y', 'Laki-laki', '082299227722', 'assets/memberLogo.png'),
(2217051150, 'zainab', '$2y$10$gQXfJtJ6IYQy7EMlZf8kL.HEReubOavaTOU4PlLr9pfwhI5Q0Fh52', 'Perempuan', '2257051018', 'assets/memberLogo.png'),
(2217051163, 'Nurwahid Muslim', '$2y$10$GEp/26BjlbmWzTAxcKD0yeRYSO3L6c4cP3Q9DbQ66oq2yLIQBVv7i', 'Laki-laki', '089515323978', 'foto/2217051163.jpg'),
(2257051018, 'Septia Rosalia', '$2y$10$.5ivay/xEnW3GIh/ZZYW1.2zUPIoKgkZ9fzeDDfbLFMW1uUpzgohO', 'Perempuan', '082282126810', 'assets/memberLogo.png');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `npm` bigint(20) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_buku`, `npm`, `tgl_peminjaman`, `tgl_pengembalian`) VALUES
(1, 'ppl01', 2257051018, '2024-06-21', '2024-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `id_buku` varchar(20) NOT NULL,
  `npm` bigint(20) NOT NULL,
  `buku_kembali` date NOT NULL,
  `keterlambatan` enum('YA','TIDAK','','') NOT NULL,
  `denda` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD KEY `kategori` (`kategori`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`npm`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `npm` (`npm`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `npm` (`npm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`kategori`) REFERENCES `kategori_buku` (`kategori`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`npm`) REFERENCES `member` (`npm`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`),
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `pengembalian_ibfk_3` FOREIGN KEY (`npm`) REFERENCES `member` (`npm`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
