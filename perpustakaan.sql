-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
<<<<<<< HEAD
-- Waktu pembuatan: 14 Bulan Mei 2023 pada 14.37
=======
-- Waktu pembuatan: 15 Bulan Mei 2023 pada 06.02
>>>>>>> 5bd9f4d4e78a83facf217b01d87cbe01247b317a
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
<<<<<<< HEAD
(1, 'The Subtle Art of Not Giving a Fuck', 'Mark Manson', 'Harper', 2019, 0x312e6a7067, 0x73656c662e706466, 'Di suatu pagi yang cerah titan menyerang tembok kehidupan yang damai sudah tidak ada lagi dan mamaku dimakan titan'),
(2, 'Ego is the Enemy: The Fight to Master Our Greatest Opponent', 'Ryan Holiday', 'Profile selfs Ltd', 2016, 0x322e6a7067, 0x73656c662e706466, 'Tertawalah sebelum tertawa itu dilarang'),
(3, 'Everything Is F*cked: A self About Hope', 'Mark Manson', 'HarperCollins', 2019, 0x332e6a7067, 0x73656c662e706466, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor neque ut leo tempor, vitae malesuada quam ultricies. Curabitur pharetra nisi vel orci porta, at pharetra nibh posuere. Suspendisse potenti. Mauris id tincidunt mauris, nec cursus tellus. In sit amet interdum nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin non justo eget massa dignissim malesuada nec nec justo. Sed eu tellus ac turpis pellentesque rhoncus. Cras varius dolor vel tortor elementum, sit amet hendrerit metus vulputate.'),
(4, 'The Things You Can See Only When You Slow Down: How to Be Calm and Mindful in a Fast-Paced World', 'Haemin Sunim', 'Penguin selfs', 2017, 0x342e6a7067, 0x73656c662e706466, 'Deskripsi Buku 4'),
(5, 'Why We Sleep: Unlocking the Power of Sleep and Dreams', 'Matthew Walker, PhD', 'Scribner', 2017, 0x352e6a7067, 0x73656c662e706466, 'Deskripsi Buku 5'),
(6, 'dsfsdfsd', 'fdsfsdf', 'sdfsdfs', 234234, 0x32303233303531303137353235313236342e6a7067, 0x323737322d41727469636c6520546578742d373236302d312d31302d32303231303833302e706466, 'werwerwer');
=======
(1, 'The Subtle Art of Not Giving a Fuck', 'Mark Manson', 'Harper', 2019, 0x626f6f6b2d636f7665722d7468652d737562746c652d6172742d6f662d6e6f742d676976696e672d612d6675636b2e77656270, 0x73656c662e706466, 'Di suatu pagi yang cerah titan menyerang tembok kehidupan yang damai sudah tidak ada lagi dan mamaku dimakan titan'),
(2, 'Ego is the Enemy: The Fight to Master Our Greatest Opponent', 'Ryan Holiday', 'Profile selfs Ltd', 2016, 0x65676f2e6a7067, 0x73656c662e706466, 'Tertawalah sebelum tertawa itu dilarang'),
(3, 'Everything Is F*cked: A self About Hope', 'Mark Manson', 'HarperCollins', 2019, 0x34333830383732332e6a7067, 0x73656c662e706466, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas auctor neque ut leo tempor, vitae malesuada quam ultricies. Curabitur pharetra nisi vel orci porta, at pharetra nibh posuere. Suspendisse potenti. Mauris id tincidunt mauris, nec cursus tellus. In sit amet interdum nunc. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin non justo eget massa dignissim malesuada nec nec justo. Sed eu tellus ac turpis pellentesque rhoncus. Cras varius dolor vel tortor elementum, sit amet hendrerit metus vulputate.'),
(4, 'The Things You Can See Only When You Slow Down: How to Be Calm and Mindful in a Fast-Paced World', 'Haemin Sunim', 'Penguin selfs', 2017, 0x626f6f6b2d636f7665722d7468652d7468696e67732d796f752d63616e2d7365652d6f6e6c792d7768656e2d796f752d736c6f772d646f776e2e77656270, 0x73656c662e706466, 'Deskripsi Buku 4'),
(5, 'Why We Sleep: Unlocking the Power of Sleep and Dreams', 'Matthew Walker, PhD', 'Scribner', 2017, 0x626f6f6b2d636f7665722d7768792d77652d736c6565702d38303637322e77656270, 0x73656c662e706466, 'Deskripsi Buku 5'),
(7, ' Information Technology In The Service Society: A Twenty-first Century Lever', 'kkkk', 'kkk', 1999, 0x626f6f6b2d636f7665722d696e666f726d6174696f6e2d746563686e6f6c6f67792d696e2d7468652d736572766963652d736f63696574792e77656270, 0x6a61776162616e2066696e616c204578616d205453412e706466, 'kkkkkk');
>>>>>>> 5bd9f4d4e78a83facf217b01d87cbe01247b317a

-- --------------------------------------------------------

--
-- Struktur dari tabel `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `id_buku` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(0, 'admin perpus', 'admin@admin.com', '$2y$10$4tGII67QvDZKtYpaPNkmd.2YkaL7T2ITVW5XvS0BDZSbFyjPk3to.', '', '0000-00-00', '', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_user` (`id_user`);

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
<<<<<<< HEAD
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
=======
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
>>>>>>> 5bd9f4d4e78a83facf217b01d87cbe01247b317a

--
-- AUTO_INCREMENT untuk tabel `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `favorit_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `favorit_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
