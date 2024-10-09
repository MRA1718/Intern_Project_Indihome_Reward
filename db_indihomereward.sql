-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 31 Jul 2019 pada 14.20
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_indihomereward`
--
CREATE DATABASE IF NOT EXISTS `db_indihomereward` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_indihomereward`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_ps`
--

CREATE TABLE `data_ps` (
  `order_id` varchar(10) NOT NULL,
  `tanggal_ps` date DEFAULT NULL,
  `kcontact` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_point`
--

CREATE TABLE `histori_point` (
  `id_histori_point` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tgl_histori_point` datetime NOT NULL,
  `deskripsi` varchar(50) NOT NULL,
  `perubahan_point` int(11) DEFAULT NULL,
  `last_total_point` int(11) NOT NULL DEFAULT '0',
  `last_point_belanja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `histori_point`
--
DELIMITER $$
CREATE TRIGGER `update_total_point` AFTER INSERT ON `histori_point` FOR EACH ROW BEGIN
        SET @check := (SELECT nik FROM total_point WHERE nik = new.nik LIMIT 1); 
        
        IF(@check IS NULL) THEN
        INSERT INTO total_point
        SET nik = new.nik,
            total_pt = new.last_total_point,
            pt_belanja = new.last_point_belanja;
        ELSE
		UPDATE total_point
		SET total_pt = new.last_total_point,
        	pt_belanja = new.last_point_belanja
		WHERE nik = new.nik;
        END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `histori_reset`
--

CREATE TABLE `histori_reset` (
  `id_histori_reset` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `tanggal_reset_pt` date NOT NULL,
  `hr_total_pt` int(11) NOT NULL,
  `hr_pt_belanja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_reward`
--

CREATE TABLE `list_reward` (
  `id_reward` int(11) NOT NULL,
  `nama_reward` varchar(25) DEFAULT NULL,
  `point_reward` int(11) DEFAULT NULL,
  `gambar_reward` varchar(128) DEFAULT NULL,
  `deskripsi_reward` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_multip_point`
--

CREATE TABLE `log_multip_point` (
  `id_log_point` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `deskripsi_multip_point` varchar(64) NOT NULL,
  `tgl_log_point` date DEFAULT NULL,
  `tgl_for_ps` date NOT NULL,
  `multiplier_point` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `point_sales`
--

CREATE TABLE `point_sales` (
  `id_point` int(11) NOT NULL,
  `nik` varchar(10) DEFAULT NULL,
  `tanggal_point` date DEFAULT NULL,
  `total_ps` int(11) DEFAULT NULL,
  `point_ps` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `point_sales`
--
DELIMITER $$
CREATE TRIGGER `plus_total_point` AFTER INSERT ON `point_sales` FOR EACH ROW BEGIN
	DECLARE total_tambah integer;

	SET @total_tambah := (SELECT last_total_point FROM histori_point WHERE nik = new.nik ORDER BY id_histori_point DESC LIMIT 1);
	SET @belanja_tambah := (SELECT last_point_belanja FROM histori_point WHERE nik = new.nik ORDER BY id_histori_point DESC LIMIT 1);

	IF (@total_tambah IS NULL) THEN
		SET @total_tambah = 0;
	END IF;
	
	IF (@belanja_tambah IS NULL OR @belanja = '0') THEN
		SET @belanja_tambah = @total_tambah;
	END IF;

	INSERT INTO histori_point
	SET nik = new.nik,
		tgl_histori_point = now(),
		deskripsi = 'Point Bertambah',
		perubahan_point = new.point_ps,
		last_total_point = @total_tambah + new.point_ps,
		last_point_belanja = @belanja_tambah + new.point_ps;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `redeem_reward`
--

CREATE TABLE `redeem_reward` (
  `id_redeem` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `id_reward` int(11) NOT NULL,
  `tanggal_choose` date NOT NULL,
  `tanggal_approval` date DEFAULT NULL,
  `status_redeem` varchar(15) NOT NULL DEFAULT 'waiting'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `redeem_reward`
--
DELIMITER $$
CREATE TRIGGER `minus_total_point` AFTER INSERT ON `redeem_reward` FOR EACH ROW BEGIN
	DECLARE temp_point_reward integer;
	DECLARE total_kurang integer;
	SET @temp_point_reward := (SELECT lr.point_reward FROM redeem_reward rr, list_reward lr WHERE lr.id_reward=rr.id_reward AND rr.nik = new.nik ORDER BY rr.id_redeem DESC LIMIT 1);
	SET @total_kurang := (SELECT last_total_point FROM histori_point WHERE nik = new.nik ORDER BY id_histori_point DESC LIMIT 1);
	SET @belanja_kurang := (SELECT last_point_belanja FROM histori_point WHERE nik = new.nik ORDER BY id_histori_point DESC LIMIT 1);

	IF (@total_kurang IS NULL) THEN
		SET @total_kurang = 0;
	END IF;

	IF (@belanja_kurang IS NULL) THEN
		SET @belanja_kurang = 0;
	END IF;

	INSERT INTO histori_point
	SET nik = new.nik,
		tgl_histori_point = now(),
		deskripsi = 'Point Berkurang',
		perubahan_point = @temp_point_reward,
		last_total_point = @total_kurang,
		last_point_belanja = @belanja_kurang - @temp_point_reward;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `total_point`
--

CREATE TABLE `total_point` (
  `id_total_point` int(11) NOT NULL,
  `nik` varchar(10) NOT NULL,
  `total_pt` int(11) NOT NULL DEFAULT '0',
  `pt_belanja` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `nik` varchar(10) NOT NULL,
  `kode_sales` varchar(10) NOT NULL DEFAULT 'NONE',
  `first_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `password_user` varchar(256) DEFAULT NULL,
  `email_user` varchar(128) DEFAULT NULL,
  `role` varchar(15) DEFAULT NULL,
  `foto_user` varchar(128) NOT NULL DEFAULT 'default.jpg',
  `user_is_active` varchar(10) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

--
-- Trigger `user`
--
DELIMITER $$
CREATE TRIGGER `insert_total_pt` AFTER INSERT ON `user` FOR EACH ROW BEGIN
	IF (new.role = 'Sales') THEN
		INSERT INTO total_point
		SET nik = new.nik;
	END IF;

END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `data_ps`
--
ALTER TABLE `data_ps`
  ADD PRIMARY KEY (`order_id`);

--
-- Indeks untuk tabel `histori_point`
--
ALTER TABLE `histori_point`
  ADD PRIMARY KEY (`id_histori_point`),
  ADD KEY `FK_HP_NIK` (`nik`);

--
-- Indeks untuk tabel `histori_reset`
--
ALTER TABLE `histori_reset`
  ADD PRIMARY KEY (`id_histori_reset`),
  ADD KEY `FK_HR_NIK` (`nik`);

--
-- Indeks untuk tabel `list_reward`
--
ALTER TABLE `list_reward`
  ADD PRIMARY KEY (`id_reward`);

--
-- Indeks untuk tabel `log_multip_point`
--
ALTER TABLE `log_multip_point`
  ADD PRIMARY KEY (`id_log_point`),
  ADD KEY `FK_LMP_NIK` (`nik`);

--
-- Indeks untuk tabel `point_sales`
--
ALTER TABLE `point_sales`
  ADD PRIMARY KEY (`id_point`),
  ADD KEY `FK_POINT_SALES_NIK` (`nik`);

--
-- Indeks untuk tabel `redeem_reward`
--
ALTER TABLE `redeem_reward`
  ADD PRIMARY KEY (`id_redeem`),
  ADD KEY `FK_RR_NIK` (`nik`),
  ADD KEY `FK_RR_ID_REWARD` (`id_reward`);

--
-- Indeks untuk tabel `total_point`
--
ALTER TABLE `total_point`
  ADD PRIMARY KEY (`id_total_point`),
  ADD KEY `FK_TOTAL_POINT_NIK` (`nik`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`nik`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `histori_point`
--
ALTER TABLE `histori_point`
  MODIFY `id_histori_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=750;

--
-- AUTO_INCREMENT untuk tabel `histori_reset`
--
ALTER TABLE `histori_reset`
  MODIFY `id_histori_reset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `list_reward`
--
ALTER TABLE `list_reward`
  MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log_multip_point`
--
ALTER TABLE `log_multip_point`
  MODIFY `id_log_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT untuk tabel `point_sales`
--
ALTER TABLE `point_sales`
  MODIFY `id_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=650;

--
-- AUTO_INCREMENT untuk tabel `redeem_reward`
--
ALTER TABLE `redeem_reward`
  MODIFY `id_redeem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `total_point`
--
ALTER TABLE `total_point`
  MODIFY `id_total_point` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `point_sales`
--
ALTER TABLE `point_sales`
  ADD CONSTRAINT `FK_POINT_SALES_NIK` FOREIGN KEY (`nik`) REFERENCES `user` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `redeem_reward`
--
ALTER TABLE `redeem_reward`
  ADD CONSTRAINT `FK_RR_ID_REWARD` FOREIGN KEY (`id_reward`) REFERENCES `list_reward` (`ID_REWARD`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RR_NIK` FOREIGN KEY (`nik`) REFERENCES `user` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `total_point`
--
ALTER TABLE `total_point`
  ADD CONSTRAINT `FK_TOTAL_POINT_NIK` FOREIGN KEY (`nik`) REFERENCES `user` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
