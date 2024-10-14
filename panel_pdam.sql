-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Okt 2024 pada 06.02
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `panel_pdam`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tarif_air`
--

CREATE TABLE `tarif_air` (
  `id` int(11) NOT NULL,
  `kelompok` varchar(20) DEFAULT NULL,
  `klasifikasi` varchar(50) DEFAULT NULL,
  `pemakaian_0_10` decimal(10,2) DEFAULT NULL,
  `pemakaian_11_20` decimal(10,2) DEFAULT NULL,
  `pemakaian_21_30` decimal(10,2) DEFAULT NULL,
  `pemakaian_gt_30` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tarif_air`
--

INSERT INTO `tarif_air` (`id`, `kelompok`, `klasifikasi`, `pemakaian_0_10`, `pemakaian_11_20`, `pemakaian_21_30`, `pemakaian_gt_30`) VALUES
(1, 'Kelompok I', 'Sosial Umum', 1400.00, 1400.00, 1400.00, 1400.00),
(2, 'Kelompok I', 'Sosial Khusus', 1400.00, 2100.00, 2400.00, 2900.00),
(3, 'Kelompok I', 'Rumah Tangga 1', 2200.00, 3000.00, 4700.00, 5600.00),
(4, 'Kelompok II', 'Rumah Tangga 2', 3000.00, 3800.00, 5300.00, 6200.00),
(5, 'Kelompok II', 'Rumah Tangga 3', 3900.00, 5300.00, 6400.00, 7100.00),
(6, 'Kelompok III', 'Rumah Tangga 4', 4500.00, 5800.00, 7500.00, 7900.00),
(7, 'Kelompok III', 'Instansi Pemerintah', 6400.00, 7100.00, 7500.00, 8200.00),
(8, 'Kelompok III', 'Niaga Kecil', 7500.00, 8000.00, 9000.00, 10000.00),
(9, 'Kelompok III', 'Niaga Besar', 8500.00, 9000.00, 10000.00, 11000.00),
(10, 'Kelompok III', 'Industri', NULL, 10500.00, 11000.00, 12100.00),
(11, 'Kelompok IV', 'Komersial', NULL, NULL, NULL, NULL),
(12, 'Kelompok IV', 'Non-Komersial', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_berita`
--

CREATE TABLE `tb_berita` (
  `id` int(111) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `tanggal_input` date NOT NULL,
  `deskripsi_berita` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_berita`
--

INSERT INTO `tb_berita` (`id`, `judul`, `tanggal_input`, `deskripsi_berita`, `foto`) VALUES
(7, 'ini percobaan yang kesekian kalinya', '2024-09-05', 'ini percobaan yang kesekian kalinya', 'Screenshot 2024-05-23 163329.png'),
(9, 'Ini percobaan ke 3 untuk tampilan berita di frontend 2', '2024-09-09', 'Ini percobaan ke 3 untuk tampilan berita di frontend', 'WhatsApp Image 2024-05-01 at 21.20.16 (1).jpeg'),
(11, 'Ini adalah uji coba menampilkan berita yang ada di index part 1', '2024-09-12', 'Ini adalah uji coba menampilkan berita yang ada di index part 1', 'WhatsApp Image 2024-09-01 at 19.34.17.jpeg'),
(12, 'Ini adalah uji coba menampilkan berita yang ada di index part 2', '2024-09-12', 'Ini adalah uji coba menampilkan berita yang ada di index part 2', 'WhatsApp Image 2024-09-01 at 19.34.16 (1).jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_gambar`
--

CREATE TABLE `tb_gambar` (
  `id` int(111) NOT NULL,
  `gambar1` varchar(255) NOT NULL,
  `judul_pertama` varchar(255) NOT NULL,
  `judul_kedua` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_gambar`
--

INSERT INTO `tb_gambar` (`id`, `gambar1`, `judul_pertama`, `judul_kedua`, `link`) VALUES
(7, 'Cuplikan web_14-6-2023_14631_tapspace.000webhostapp.com.jpeg', 'ini adalah judul ke dua', 'ini adalah judul ke dua', 'about.php'),
(8, 'Ungu berilustrasi lucu spanduk kegiatan sekolah (1).png', 'Slide ke dua ', 'Slide ke dua ', 'about.php');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_misi`
--

CREATE TABLE `tb_misi` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_misi`
--

INSERT INTO `tb_misi` (`id`, `isi`) VALUES
(1, 'Menjalankan bisnis dengan menerapkan prinsp Good Corprate Governance (GCG).'),
(2, 'Meningkatkan cakupan pelayanan dalam penyediaan air bersih yang mengacu pada kualitas, kuantitas, kontinuitas, dan keterjangkauan.'),
(3, 'Memberikan pelayanan pelanggan yang optimal.'),
(4, 'Meningkatkan kompetensi sumber daya manusia yang profesional.'),
(5, 'Menjalankan kegiatan usaha secara berkelanjutan dan berwawasan lingkungan.'),
(6, 'Memberikan kontribusi bagi kesejahteraan masyarakat dan pembangunan daerah.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_payment`
--

CREATE TABLE `tb_payment` (
  `id` int(11) NOT NULL,
  `nama_payment` varchar(255) NOT NULL,
  `gambar_payment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_payment`
--

INSERT INTO `tb_payment` (`id`, `nama_payment`, `gambar_payment`) VALUES
(1, 'Bukalapak', 'bukalapak-logodownload-38807.png'),
(2, 'Pospay Agen', 'Download-Logo-Pospay-Agen-PNG.png'),
(5, 'Kios Bank', 'kiosbank.png'),
(6, 'Shopee', 'pngwing.com (5).png'),
(8, 'Tokopedia', 'pngwing.com (4).png'),
(10, 'Briva', 'download-logo-briva-bri-0.jpg'),
(11, 'Link Aja', 'Logo LinkAja  -  (Koleksilogo.com).png'),
(12, 'OVO', 'GKL14_OVO - Koleksilogo.com.png'),
(13, 'Alfamaret', 'logo_alfamart_transparent.png'),
(14, 'Gopay', 'Logo GoPay  -  (Koleksilogo.com).png'),
(15, 'PayFazz', 'PayFazz -(Koleksilogo.com).png'),
(17, 'GrabPay', 'GrabPay Wallet.png'),
(18, 'Indomaret', 'pngwing.com (6).png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_profile`
--

CREATE TABLE `tb_profile` (
  `id` int(11) NOT NULL,
  `sejarah` text NOT NULL,
  `visi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_profile`
--

INSERT INTO `tb_profile` (`id`, `sejarah`, `visi`) VALUES
(1, 'ini Percobaan kedelapan edit data pada sejarah perusahaan', 'Menjadi perusahaan penyedia air minum terbaik yang fokus pada pelayanan pelanggan dan memenuhi harapan stakeholders.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `nama`, `username`, `password`, `profile`) VALUES
(15, 'Kemal Ibnu Ramadhan', 'kemal', '$2y$10$Y.78Z3b4l/FcFoVoNhJbTOyzJ22oh6scLxSTGcvlgOJURqymn8o5K', ''),
(19, 'Kemal Ibnu Ramadhan', 'ibnu', '$2y$10$1AVq9JTX65A67R4ruAtq6OnKMuGiqJeMYPj90R/IaRs0G2Kgnr8Ke', 'WhatsApp Image 2024-06-14 at 13.33.54.jpeg'),
(21, 'Kemal Ibnu Ramadhan', 'suka', '$2y$10$wpWbChi8ZCHz1kAGS/QavO0gJerzLS4hUKrhv1vVbnCHcua5NpYjC', 'pngwing.com (2).png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tarif_air`
--
ALTER TABLE `tarif_air`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_misi`
--
ALTER TABLE `tb_misi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_payment`
--
ALTER TABLE `tb_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_profile`
--
ALTER TABLE `tb_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tarif_air`
--
ALTER TABLE `tarif_air`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_berita`
--
ALTER TABLE `tb_berita`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_gambar`
--
ALTER TABLE `tb_gambar`
  MODIFY `id` int(111) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_misi`
--
ALTER TABLE `tb_misi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tb_payment`
--
ALTER TABLE `tb_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tb_profile`
--
ALTER TABLE `tb_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
