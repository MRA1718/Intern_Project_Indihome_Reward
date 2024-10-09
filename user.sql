-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jul 2019 pada 12.31
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

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`nik`, `kode_sales`, `first_name`, `last_name`, `password_user`, `email_user`, `role`, `foto_user`, `user_is_active`) VALUES
('090909', 'NONE', 'Tri', 'Sugiharti', '$2y$10$Pm1dSdZ8gqyJdgygWAfPp.WjMD1FqT5y1rFeDRkf6ItN3p5fFQz2O', 'tri.s@gmail.com', 'Manager', 'default.jpg', 'active'),
('632423', 'SPYNR80', 'Yudhi', 'Abwibi', '$2y$10$mVP2nvTBa6p2egW0XmkdyekzImInL7lbMcFDQpo5R9J1oc0cQA.IS', '632423@telkom.co.id', 'Sales', '1564127791681.jpg', 'active'),
('790026', 'SPYNR80', 'Ika', 'Riny', '$2y$10$zKkKzQAnS4E/h481ZSmsnuSMWVvlcHqmxoTNUbdIabsiJCPytqC4W', '790026@gmail.com', 'Sales', '1564130338363.jpg', 'active'),
('960050', 'SPYNR80', 'Andre', 'Rizal Sinaga', '$2y$10$TYGizA.AH614Lh20svp9oe72CBEV9U6gKHbh57VBxd1jY2uur6pqq', 'andre.rizal@gmail.com', 'Sales', 'default.jpg', 'active'),
('admin', 'NONE', 'Sinaga', 'Andre', '$2y$10$R/y8ZKY5FqBBshM5ZbWrM.G76gytSHitJM3fWrO4N/T.nE07RdLR6', '960050', 'Administrator', '1564130024604.jpg', 'active'),
('SPAAA80', 'SPAAA80', 'Andi', 'Aditya', '$2y$10$sj5BDpz5luw0NfZ0/UiG4.jCWgpV8SkXP5tNAlVIlEjpIS0p3bZu.', 'andi.aditya@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPADA80', 'SPADA80', 'Angga', 'Dwi Aditya', '$2y$10$HQXcMY85EdKiixzynb5F8erTYvJGdlrL48/bRs5K0GkFavi/wOYK6', 'angga.dwi@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPANF80', 'SPANF80', 'Akhmad', 'Nur Fahrozi Rosi', '$2y$10$UFZx2GQ/WQr1Q.BoKSlFJeO/nZkMiUhL.8MN3qPbvUp7UA5tVUncG', 'akhmad.nur@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPARF80', 'SPARF80', 'Arif', 'Wiratama', '$2y$10$7i/j.zjhoWv3c/xTymWk8u6b5jus1WdSeL2wxMNK8IrWqm2cdLoo6', 'arif.w@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPASB80', 'SPASB80', 'Arif', 'Setiyo Budi', '$2y$10$OwliLf3xIojufl9NzvpkMe6VxX5REyRTgVDtd5KFFMLf/tx7utsQK', 'arif.seityo@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPDAP80', 'SPDAP80', 'Dicky Andika', 'Putra Aliansyah', '$2y$10$9835T.rALQfTMPTALXJzfOfcL8u9AbIT7aGIFAFRubkKrjaUm28/C', 'dicky.andika@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPDJK80', 'SPDJK80', 'Djoko', 'Hardjanto', '$2y$10$djM4FaP7bZy7AuSp8h6UK.75HrKHLMXvTPzP7yrNvSJ/R42XNxiey', 'djoko.h@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPDKP80', 'SPDKP80', 'Danang', 'Kandi Purnomo', '$2y$10$Xn.hSGAwBiuboZw/W.7KH.VOI7.JW7QDxGt6KU5fgTFpMKNrNP.c.', 'danang.kandi@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPDPY80', 'SPDPY80', 'Dicky', 'Prasetyo Hadi', '$2y$10$.UuBHTQe6xjyqr4zpZn/x.0iq.r3/bangwpteylgSiITpLQYzIyaG', 'dicky.prasetyo@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPFAA80', 'SPFAA80', 'Firman', 'Arief Akbar', '$2y$10$6TfAMrFLAw5zGwEszuQwyOIqx6uYksZvGaYsIg.l.Z2BJSUleNgf.', 'firman.arief@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPFAF80', 'SPFAF80', 'Muhammad Saeful', 'Fafa', '$2y$10$PukCFS2gvajYFiizhwcrjOVluPOFHV8/urhulvsHgMICkDMt5w3HW', 'saeful.fafa@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPFFR80', 'SPFFR80', 'Firdaus', 'Vilavano', '$2y$10$PYs3nYpYBkAkLAB9nDj4AuSMTWd7YLsP8Rw4arCjCgKbrTN8f.gdC', 'firdaus.vilavano@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPHFD80', 'SPHFD80', 'Moh. Hafid', 'Ma\'sum Romli', '$2y$10$ETTbBLSScJ5Ely2IEp572uo7ilLI1.zo2eFkzsc4LHADa9jN3NloC', 'hafid.romli@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPIYY80', 'SPIYY80', 'Budi', 'Sulistiono', '$2y$10$NgxrY3fe5/Kx8bWFR8iEueC56LMqVpOZ2QAEXW6T0hKa28lvTkg0y', 'budi.s@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPMAZ80', 'SPMAZ80', 'Achmad', 'Zaenuri Susilo', '$2y$10$uCtCYNbtnabyjtofsucsYOp51yi.up0vWRSNYDLN6GEF6cQy9NJCO', 'achmad@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPMHD80', 'SPMHD80', 'Muhadi', '', '$2y$10$A9y/AjQ5ogbxCBkzd1eUZuUbNJZmkqh6RE1B80om4VNKmyS47bbbO', 'muhadi@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPMSF80', 'SPMSF80', 'Muhammad Sony', 'Fajar Agustiar', '$2y$10$P57EiWJt4pPFwLiM/oTecOD3gG3eZiT5pdwQh6OwNUGfmIcXMWDsG', 'sony.fajar@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPMUM80', 'SPMUM80', 'M. Umar', 'Syamsul Hadi', '$2y$10$V2vx2qDD0ShXO5dDSaRRKe4Pb56gN3rmlKMOJiZ5aA689ZLJjIBpu', 'umar.syamsul@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPQSQ80', 'SPQSQ80', 'M. Najmus', 'Shiddiq', '$2y$10$9grA8tBvqdE.kXT2BB0dyufgTFi/msLkXw.Zx0zjwlr4TDYuwwuee', 'najmus@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPRBT80', 'SPRBT80', 'Rahadian', 'Bakhtiar', '$2y$10$15wmP.JcJykywp8r67KNQ.1WIhZ7EL.a1jCaunUZRdqhUYaxxD2Qy', 'rahadian.b@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPRGP80', 'SPRGP80', 'Agus', 'Pramono', '$2y$10$ohFzS0mqY2d3ZkSvy1VfpucKurT8yj972V52NZP6KTBMxaVjompdK', 'agus.pramono@gmail.com', 'Sales', '1564130797142.jpg', 'active'),
('SPXAK80', 'SPXAK80', 'Abdul', 'Kholiq', '$2y$10$RRnp/dZCoF9JW/ib3xW5weFH62qvU5iB2pk4VRuXlW9z2rQLSRIBK', 'abdul.kholiq@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXAR80', 'SPXAR80', 'Agus', 'Supriono', '$2y$10$clT9.RZqIV/YfDp7RYDQM.ZY1EOPhPBoHiGYQsU2f57PbqtC908.u', 'agus.supriono@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXBK80', 'SPXBK80', 'Baihaki', '', '$2y$10$G1Y2WQKCqve89Vmhy3aQ/.Vb9PGtJ6nkmR8Nb0v9Mj0UXJBrmkv5y', 'baihaki@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXFL80', 'SPXFL80', 'Mohammad Fadil', 'Lillah', '$2y$10$LN7WkFsW9Ncl1kP6a1fep.yBhTEoA9jezxN2IneucuZ0kf80EaCxC', 'muh.fadil@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXRS80', 'SPXRS80', 'Rony', 'Bakhtiar', '$2y$10$uZnrzr5sXySt2Vq4ongIte5K76keOu1aXj72bV8Fv0H2GRUuZcFKW', 'rony.b@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXSA80', 'SPXSA80', 'Agus ', 'Susilo', '$2y$10$K5raNT74enAgUEyjby1THeI2S.tKmY5zRsYrwmaCRDpviDC9Chkym', 'agus.susilo@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXSW80', 'SPXSW80', 'Suwarso', '', '$2y$10$xUbB7ZV8EZ7cc7mq8rxYeO0RAnqsERKfwjOQy6b3O.bUilb.kF4xa', 'suwarso@gmail.com', 'Sales', 'default.jpg', 'active'),
('SPXYS80', 'SPXYS80', 'Hariyono', '', '$2y$10$gGrMepp/XgT5U7XXK7FcsOstIEoTQnPDCp3r3p3iNLu.DVznOtkNK', 'hariyono@gmail.com', 'Sales', 'default.jpg', 'active');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
