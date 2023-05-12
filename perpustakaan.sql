-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2023 pada 19.19
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakaan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul_buku` varchar(500) NOT NULL,
  `penulis` varchar(500) NOT NULL,
  `penerbit` varchar(250) NOT NULL,
  `tahun_terbit` int(11) NOT NULL,
  `gambar_buku` blob DEFAULT NULL,
  `pdf_buku` blob DEFAULT NULL,
  `deskripsi_buku` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `penulis`, `penerbit`, `tahun_terbit`, `gambar_buku`, `pdf_buku`, `deskripsi_buku`) VALUES
(1, 'The Subtle Art of Not Giving a Fuck', 'Mark Manson', 'Harper', 2019, 0x312e6a7067, 0x73656c662e706466, 'Di suatu pagi yang cerah titan menyerang tembok kehidupan yang damai sudah tidak ada lagi dan mamaku dimakan titan'),
(2, 'Ego is the Enemy: The Fight to Master Our Greatest Opponent', 'Ryan Holiday', 'Profile selfs Ltd', 2016, 0x322e6a7067, 0x73656c662e706466, 'Tertawalah sebelum tertawa itu dilarang'),
(3, 'Everything Is F*cked: A self About Hope', 'Mark Manson', 'HarperCollins', 2019, 0x332e6a7067, 0x73656c662e706466, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor neque ut leo tempor, vitae malesuada quam ultricies. Curabitur pharetra nisi vel orci porta, at pharetra nibh posuere. Suspendisse potenti. Mauris id tincidunt mauris, nec cursus tellus. In sit amet interdum nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin non justo eget massa dignissim malesuada nec nec justo. Sed eu tellus ac turpis pellentesque rhoncus. Cras varius dolor vel tortor elementum, sit amet hendrerit metus vulputate.'),
(4, 'The Things You Can See Only When You Slow Down: How to Be Calm and Mindful in a Fast-Paced World', 'Haemin Sunim', 'Penguin selfs', 2017, 0x342e6a7067, 0x73656c662e706466, 'Deskripsi Buku 4'),
(5, 'Why We Sleep: Unlocking the Power of Sleep and Dreams', 'Matthew Walker, PhD', 'Scribner', 2017, 0x352e6a7067, 0x73656c662e706466, 'Deskripsi Buku 5'),
(6, 'dsfsdfsd', 'fdsfsdf', 'sdfsdfs', 234234, 0x32303233303531303137353235313236342e6a7067, 0x323737322d41727469636c6520546578742d373236302d312d31302d32303231303833302e706466, 'werwerwer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `user_photo` varchar(255) DEFAULT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `gender`, `birth_date`, `user_photo`, `role`) VALUES
(0, 'admin perpus', 'admin@admin.com', '$2y$10$4tGII67QvDZKtYpaPNkmd.2YkaL7T2ITVW5XvS0BDZSbFyjPk3to.', '', '0000-00-00', '', 'member');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
