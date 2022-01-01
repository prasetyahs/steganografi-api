-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Waktu pembuatan: 29 Des 2021 pada 19.34
-- Versi server: 5.7.34
-- Versi PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stegano`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `stegano_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `history`
--

INSERT INTO `history` (`id`, `users_id`, `stegano_id`, `date`) VALUES
(47, 2, 74, '2021-11-12'),
(48, 2, 75, '2021-11-12'),
(49, 2, 76, '2021-11-12'),
(50, 2, 77, '2021-11-12'),
(51, 2, 78, '2021-11-12'),
(52, 2, 79, '2021-11-12'),
(53, 2, 80, '2021-11-12'),
(54, 2, 81, '2021-11-12'),
(55, 2, 82, '2021-11-12'),
(56, 2, 83, '2021-11-12'),
(57, 2, 84, '2021-11-12'),
(58, 2, 85, '2021-11-12'),
(59, 2, 86, '2021-11-12'),
(60, 2, 87, '2021-11-12'),
(61, 2, 88, '2021-11-12'),
(62, 2, 89, '2021-11-12'),
(63, 2, 90, '2021-11-12'),
(64, 2, 91, '2021-11-12'),
(65, 2, 92, '2021-11-12'),
(66, 2, 93, '2021-11-12'),
(67, 2, 94, '2021-11-14'),
(68, 2, 95, '2021-11-14'),
(69, 2, 96, '2021-11-14'),
(70, 2, 97, '2021-11-14'),
(71, 2, 98, '2021-11-14'),
(72, 2, 99, '2021-11-14'),
(73, 2, 100, '2021-11-21'),
(74, 2, 101, '2021-11-21'),
(75, 2, 102, '2021-11-21'),
(76, 2, 103, '2021-11-21'),
(77, 2, 104, '2021-11-21'),
(78, 2, 105, '2021-11-21');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stegano`
--

CREATE TABLE `stegano` (
  `id` int(11) NOT NULL,
  `output` text NOT NULL,
  `original_file` text NOT NULL,
  `type` enum('encode','decode') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stegano`
--

INSERT INTO `stegano` (`id`, `output`, `original_file`, `type`) VALUES
(65, '618e1d755eb10082553.mp3', '618e1d755eb10082553.mp3', 'encode'),
(66, '618e20a9e9320090507.mp3', '618e20a9e9320090507.mp3', 'encode'),
(67, '618e222fa4c6a093513.mp3', '618e222fa4c6a093513.mp3', 'encode'),
(68, '618e24e53a90b090925.mp3', '618e24e53a90b090925.mp3', 'encode'),
(69, '618e2515a89e2095725.mp3', '618e2515a89e2095725.mp3', 'encode'),
(70, '618e253e5e79a093826.mp3', '618e253e5e79a093826.mp3', 'encode'),
(71, '618e2600d30a1095229.mp3', '618e2600d30a1095229.mp3', 'encode'),
(72, '618e26932cc66091932.mp3', '618e26932cc66091932.mp3', 'encode'),
(73, '618e272110b74094134.mp3', '618e272110b74094134.mp3', 'encode'),
(74, '618e2a3aa39b3095447.mp3', '618e2a3aa39b3095447.mp3', 'encode'),
(75, '618e2c775cbd3092757.mp3', '618e2c775cbd3092757.mp3', 'encode'),
(76, '618e2f2381989105108.mp3', '618e2f2381989105108.mp3', 'encode'),
(77, '618e2f309ad48100409.mp3', '618e2f309ad48100409.mp3', 'encode'),
(78, '618e2f46151f8102609.mp3', '618e2f46151f8102609.mp3', 'encode'),
(79, '618e2f60d7684105209.mp3', '618e2f60d7684105209.mp3', 'encode'),
(80, '618e2f702c985100810.mp3', '618e2f702c985100810.mp3', 'encode'),
(81, '618e2f7a0c731101810.mp3', '618e2f7a0c731101810.mp3', 'encode'),
(82, '618e33d743e1c105528.mp3', '618e33d743e1c105528.mp3', 'encode'),
(83, '618e33e0be0a0100429.mp3', '618e33e0be0a0100429.mp3', 'encode'),
(84, '618e3414ca637105629.mp3', '618e3414ca637105629.mp3', 'encode'),
(85, '618e341a4e865100230.mp3', '618e341a4e865100230.mp3', 'encode'),
(86, '618e341bb6925100330.mp3', '618e341bb6925100330.mp3', 'encode'),
(87, '618e34b8788a8104032.mp3', '618e34b8788a8104032.mp3', 'encode'),
(88, '618e34bdec752104532.mp3', '618e34bdec752104532.mp3', 'encode'),
(89, '618e34bf633cc104732.mp3', '618e34bf633cc104732.mp3', 'encode'),
(90, '618e34dbbf7fa101533.mp3', '618e34dbbf7fa101533.mp3', 'encode'),
(91, '618e3616c2b01103038.mp3', '618e3616c2b01103038.mp3', 'encode'),
(92, '618e369357859103540.mp3', '618e369357859103540.mp3', 'encode'),
(93, '618e40807d0b1115622.mp3', '618e40807d0b1115622.mp3', 'encode'),
(94, '6190e6ce110a4110237.mp3', '6190e6ce110a4110237.mp3', 'encode'),
(95, '6190e71b07653111938.mp3', '6190e71b07653111938.mp3', 'encode'),
(96, '6190e9a4eaac7110849.mp3', '6190e9a4eaac7110849.mp3', 'encode'),
(97, '61911deae3abe031132.mp3', '61911deae3abe031132.mp3', 'encode'),
(98, '61911e1ec9797030233.mp3', '61911e1ec9797030233.mp3', 'encode'),
(99, '61911e4fc5bd0035133.mp3', '61911e4fc5bd0035133.mp3', 'encode'),
(100, '6199e3a3f1ad4075513.mp3', '6199e3a3f1ad4075513.mp3', 'encode'),
(101, '6199e8071e2f1073932.mp3', '6199e8071e2f1073932.mp3', 'encode'),
(102, '6199f2a11d9a6085317.mp3', '6199f2a11d9a6085317.mp3', 'encode'),
(103, '6199f2c0e0d46082418.mp3', '6199f2c0e0d46082418.mp3', 'encode'),
(104, '6199f41e13ba6081424.mp3', '6199f41e13ba6081424.mp3', 'encode'),
(105, '6199f43cc32f4084424.mp3', '6199f43cc32f4084424.mp3', 'encode'),
(106, '61cb3fe167779043348.mp3', '61cb3fe167779043348.mp3', 'encode');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `personal_number` text NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `personal_number`, `name`, `password`, `role`) VALUES
(2, '14022', 'phs', 'google123', 1),
(7, '33', '33', '33', 0),
(8, 'kjkjk', 'jkjk', 'kjkjk', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`),
  ADD KEY `stegano_id` (`stegano_id`);

--
-- Indeks untuk tabel `stegano`
--
ALTER TABLE `stegano`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT untuk tabel `stegano`
--
ALTER TABLE `stegano`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `history_ibfk_2` FOREIGN KEY (`stegano_id`) REFERENCES `stegano` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
