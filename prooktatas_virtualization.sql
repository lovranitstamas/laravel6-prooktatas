-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2021. Már 07. 18:44
-- Kiszolgáló verziója: 10.4.13-MariaDB
-- PHP verzió: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `prooktatas_virtualization`
--
CREATE DATABASE IF NOT EXISTS `prooktatas_virtualization` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `prooktatas_virtualization`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `note_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `comments`
--

INSERT INTO `comments` (`id`, `customer_id`, `note_id`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'poszt 11 komment', '2021-03-07 14:19:22', '2021-03-07 14:19:22');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `customers`
--

INSERT INTO `customers` (`id`, `name`, `description`, `phone`, `password`, `created_at`, `updated_at`, `email`) VALUES
(1, 'Lovranits Tamás', 'kklk', NULL, '$2y$10$i4HG.k0JSKa4wc.31V/fz.reFtMK/.3M2ONT4QaLIFhHMruqMsf9O', '2021-03-03 15:24:04', '2021-03-06 21:26:23', 'kk@kk.hu'),
(2, 'Kovranits Tamáss', 'szerver', NULL, '$2y$10$2k.5ZjBWQlSWuJp3RAXVreXdrttuNFuihKZqGR/7z5ExNrd3rd82u', '2021-02-06 10:41:06', '2021-03-06 10:41:06', 'gtfoto@freemail.huh'),
(7, 'kalinka', 'kalnikna', NULL, '$2y$10$i4HG.k0JSKa4wc.31V/fz.reFtMK/.3M2ONT4QaLIFhHMruqMsf9O', '2021-03-10 03:15:48', '2021-03-09 03:15:54', 'kalainka@gg.hu');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_02_20_151627_create_customers_table', 1),
(5, '2021_02_20_154315_update_customers_table', 1),
(6, '2021_03_02_005433_create_notes_table', 1),
(7, '2021_03_02_132238_update_users_table', 1),
(8, '2021_03_02_132342_update_notes_table', 1),
(9, '2021_03_06_125245_create_tags_table', 2),
(10, '2021_03_06_130721_create_note_tag_table', 2),
(11, '2021_03_07_125859_add_public_at_to_notes', 3),
(12, '2021_03_07_131911_create_comments_table', 4);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `public_at` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `content`, `created_at`, `updated_at`, `public_at`, `title`) VALUES
(1, 2, 'post 1', '2021-03-03 15:25:01', '2021-03-03 15:25:01', '2021-03-03 14:22:04', 'title 1'),
(4, 1, 'post 4', '2021-03-06 10:38:48', '2021-03-06 10:38:48', '2021-03-04 14:22:10', 'title 4'),
(5, 1, 'post 5', '2021-03-06 10:39:46', '2021-03-06 10:39:46', '2021-03-07 14:22:15', 'title 5'),
(6, 1, 'post 6', '2021-03-06 12:39:45', '2021-03-06 12:39:45', '2021-03-07 14:22:18', 'title 6'),
(7, 1, 'post 7', '2021-03-06 13:13:52', '2021-03-06 13:13:52', '2021-03-07 14:22:20', 'title 7'),
(8, 1, 'post 8', '2021-03-06 13:16:34', '2021-03-06 13:16:34', '2021-03-07 14:22:23', '8'),
(9, 1, 'post 9', '2021-03-06 13:17:50', '2021-03-06 13:17:50', '2021-03-07 14:22:27', 'title 9'),
(10, 1, 'pos 10', '2021-03-06 13:24:37', '2021-03-06 13:24:37', '2021-03-07 14:22:29', 'title 10'),
(11, 1, 'pos 11 tt tt  tt t t tt tt t t df', '2021-03-06 13:27:39', '2021-03-07 14:06:22', '2021-03-07 00:00:00', 'title 11'),
(12, 1, 'pos 12', '2021-03-06 13:37:43', '2021-03-06 13:37:43', NULL, 'v 12');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `note_tag`
--

CREATE TABLE `note_tag` (
  `note_id` bigint(20) NOT NULL,
  `tag_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `weight` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `note_tag`
--

INSERT INTO `note_tag` (`note_id`, `tag_id`, `created_at`, `updated_at`, `weight`) VALUES
(6, 1, '2021-03-06 10:39:45', '2021-03-06 10:39:45', 1),
(6, 3, '2021-03-06 10:39:45', '2021-03-06 10:39:45', 1),
(11, 2, '2021-03-06 11:27:40', '2021-03-07 00:23:20', 1),
(12, 1, '2021-03-06 11:37:43', '2021-03-06 11:37:43', 1),
(11, 3, '2021-03-07 13:06:22', '2021-03-07 13:06:22', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cimke #1', '2021-03-06 12:13:55', '2021-03-06 12:14:49'),
(2, 'Cimke #2', '2021-03-06 12:15:18', '2021-03-06 12:15:18'),
(3, 'Cimke #3', '2021-03-06 12:15:48', '2021-03-06 12:15:48'),
(4, 'cimke #4', '2021-03-06 12:23:21', '2021-03-06 12:23:21');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tamas', 'kk@kk.hu', NULL, '$2y$10$i4HG.k0JSKa4wc.31V/fz.reFtMK/.3M2ONT4QaLIFhHMruqMsf9O', NULL, '2021-03-17 21:07:24', '2021-03-18 21:07:24');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_description_unique` (`description`) USING HASH;

--
-- A tábla indexei `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_user_id_foreign` (`user_id`);

--
-- A tábla indexei `note_tag`
--
ALTER TABLE `note_tag`
  ADD KEY `note_tag_note_id_foreign` (`note_id`),
  ADD KEY `note_tag_tag_id_foreign` (`tag_id`);

--
-- A tábla indexei `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- A tábla indexei `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT a táblához `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `customers` (`id`);

--
-- Megkötések a táblához `note_tag`
--
ALTER TABLE `note_tag`
  ADD CONSTRAINT `note_tag_note_id_foreign` FOREIGN KEY (`note_id`) REFERENCES `notes` (`id`),
  ADD CONSTRAINT `note_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
