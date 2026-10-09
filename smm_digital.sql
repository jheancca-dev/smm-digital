-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-10-2026 a las 18:07:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `smm_digital_v2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_09_27_015229_create_solicitudes_table', 1),
(5, '2026_09_27_020956_add_role_to_users_table', 1),
(6, '2026_09_27_171938_add_multiple_archivos_to_solicitudes_table', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('L9vrt2MU7EeN9HiMGVpEW8SQ5xleoxZNDyLiqbCA', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:158.0) Gecko/20100101 Firefox/158.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNHo2cUJsSkI1M0MxME5wV2RyTXViZWJTV29XazBObVlqTUhsQWVJZCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9wYW5lbC1hbmFsaXN0YXMiO3M6NToicm91dGUiO3M6MTQ6ImFuYWxpc3RhLmluZGV4Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1791470962),
('VI1ymZYxo0CIuHYxyntZv1vnx7Ajo0UaCLpUJB58', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:158.0) Gecko/20100101 Firefox/158.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTm40cENmT1Bkb1VJd0gxT2lneTRRd3lwUnd6ZE1YNktTN2ZEZExHZSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6OTY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9kb2N1bWVudG9zL2RvY3VtZW50b3MvYm9sZXRhcy9VWVhZeXRsbjd3UnVaU0VvelZOWThSWjd6bDVOUnRwbE1tczJlV3JELnBuZyI7czo1OiJyb3V0ZSI7czoxNToiZG9jdW1lbnRvcy5zaG93Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1791560065);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `monto_solicitado` decimal(12,2) NOT NULL,
  `plazo_meses` int(11) NOT NULL,
  `ingreso_mensual` decimal(12,2) NOT NULL,
  `egresos_mensuales` decimal(12,2) NOT NULL,
  `carga_familiar` int(11) NOT NULL,
  `antiguedad_laboral` varchar(255) NOT NULL,
  `dni_archivos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dni_archivos`)),
  `boleta_archivos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`boleta_archivos`)),
  `ratio_deuda_ingreso` decimal(5,2) DEFAULT NULL,
  `calificacion` varchar(255) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `user_id`, `monto_solicitado`, `plazo_meses`, `ingreso_mensual`, `egresos_mensuales`, `carga_familiar`, `antiguedad_laboral`, `dni_archivos`, `boleta_archivos`, `ratio_deuda_ingreso`, `calificacion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 15000.00, 8, 1500.00, 700.00, 1, '1 a 3 años', NULL, NULL, 179.81, 'Rechazado', 'rechazado', '2026-09-27 22:06:32', '2026-09-27 22:48:40'),
(2, 1, 1500.00, 2, 2000.00, 2000.00, 1, 'Menos de 1 año', NULL, NULL, 138.30, 'Rechazado', 'aprobado', '2026-09-27 22:09:14', '2026-09-27 22:49:50'),
(3, 1, 1500.00, 2000, 1000.00, 1000.00, 1, 'Menos de 1 año', NULL, NULL, 102.14, 'Rechazado', 'aprobado', '2026-09-27 22:12:24', '2026-09-27 22:49:47'),
(4, 1, 15000.00, 12, 1000.00, 500.00, 1, '1 a 3 años', '[\"documentos\\/dni\\/hV2ohI8vOyaOp7XJugilcL7RhC2Us7cmbYy0v4Xq.png\",\"documentos\\/dni\\/q4NK7ercsxcijGTJSnTHKYxtPDGoB6jigLQ7MvAb.png\",\"documentos\\/dni\\/YRp6B1Jol25bfdBU76iACqKbZHF1IHttAHchoSXF.png\"]', '[\"documentos\\/boletas\\/MbCMgmTB2mjkm62MZkoCLORuygMHKP6b5WaPIOwn.pdf\",\"documentos\\/boletas\\/bgdk3v97cTZATkkzfBKObuchrz426AiI8EzrNGmd.pdf\",\"documentos\\/boletas\\/8NcdvodkWwkN2rxK9jwwWL3C6wRrjhDTSZaywyic.pdf\"]', 186.87, 'Rechazado', 'observado', '2026-09-27 22:31:52', '2026-09-27 22:49:36'),
(5, 1, 20000.00, 12, 1500.00, 600.00, 0, 'Menos de 1 año', '[\"documentos\\/dni\\/J7bJOE1cN92l3LLXI5VwXRqFFMSsZZQIhq8s2RG8.png\",\"documentos\\/dni\\/I59uJIPK2cz6RHyjoInotPkkoCfZAmPEmWmDiiMM.png\",\"documentos\\/dni\\/kf6XPyxr8HeBNGKptWk6lo0Wi0rOV2K1nPH0MVdF.png\"]', '[\"documentos\\/boletas\\/t4uGznuMpBwZH4KJYhb6l0aSo15KaGXuRNdavVYZ.pdf\",\"documentos\\/boletas\\/8wcCKiKsUh9dbdhBc5cy9v1F2cmW1ke8ZMdULQNh.pdf\"]', 161.67, 'Rechazado', 'pendiente', '2026-09-27 22:38:22', '2026-09-27 22:49:24'),
(6, 1, 1500.00, 2000, 1000.00, 200.00, 0, 'Menos de 1 año', '[\"documentos\\/dni\\/Fge41Ma3K4lHEyoJD01ZzEaJuBU4r58gNtHoA6bY.pdf\"]', '[\"documentos\\/boletas\\/NHoUW9Fyuz2DNKjGvm9vk1oRSr6HVufNgFf93q3H.pdf\"]', 22.14, 'Preaprobado', 'pendiente', '2026-09-27 22:56:16', '2026-09-27 22:56:16'),
(7, 1, 3000.00, 8, 1000.00, 200.00, 0, 'Menos de 1 año', '[\"documentos\\/dni\\/VUwamgkx3zx3oDHgzKnGkv22fIi3stL5G1xpt5gK.pdf\"]', '[\"documentos\\/boletas\\/6QOHXgUyNoWekVEL0hle7bo8m2578heMBDigLiE2.pdf\"]', 59.94, 'Rechazado', 'rechazado', '2026-09-27 23:00:55', '2026-09-27 23:00:55'),
(8, 1, 3000.00, 8, 1000.00, 200.00, 0, 'Menos de 1 año', '[\"documentos\\/dni\\/kXlBR9ocwQSgIgunHtM0K56DIBn50UlXmWlIUsTH.pdf\"]', '[\"documentos\\/boletas\\/A4fCReTxrl6KDCJQXQxyGzvFHZ66eAPfrhm5uMqs.pdf\"]', 59.94, 'Rechazado', 'rechazado', '2026-09-27 23:01:49', '2026-09-27 23:01:49'),
(9, 1, 5000.00, 12, 3000.00, 300.00, 0, '1 a 3 años', '[\"documentos\\/dni\\/w2PdPBqwd4L21xxuxHyIodAqVkUIVPQyXlsAVtVQ.pdf\"]', '[\"documentos\\/boletas\\/uLfx4lh7hxOBFGGxfDzfOHv9WFzHz2oIeiNZ5Ose.pdf\"]', 25.21, 'Preaprobado', 'aprobado', '2026-09-27 23:03:45', '2026-10-09 20:32:16'),
(10, 1, 10000.00, 24, 2000.00, 200.00, 1, '1 a 3 años', '[\"documentos\\/dni\\/rY84j9lcAF1DnstFbQVUrcOcoqqJKvkGCwvKOr1Q.pdf\"]', '[\"documentos\\/boletas\\/HOYoox2KlXB9nmQogVf1r1E68nvoULBuIm5h7Mwq.pdf\"]', 34.74, 'Observado', 'aprobado', '2026-09-27 23:06:24', '2026-09-27 23:09:25'),
(11, 1, 5000.00, 10, 1000.00, 200.00, 2, '1 a 3 años', '[\"documentos\\/dni\\/Ee35ITSj3pCLYwvJnigbO6gpgoBSOxqIv66jhNL8.png\"]', '[\"documentos\\/boletas\\/RyU2YoZ2BSbDAe8U5fyRe4wO1aoLG6NTGXlBBLps.pdf\"]', 74.00, 'Rechazado', 'rechazado', '2026-09-27 23:19:10', '2026-09-27 23:19:10'),
(12, 3, 8000.00, 18, 2500.00, 500.00, 1, '1 a 3 años', '[\"documentos\\/dni\\/hziNZw4UJktRHR2wb5aOND1rXmWd3httasVW6BCI.png\"]', '[\"documentos\\/boletas\\/OcVpYiFBp6MGwejskeanjxfANau0yoWbkA04yrYD.png\"]', 40.28, 'Rechazado', 'rechazado', '2026-10-08 19:44:39', '2026-10-08 19:44:39'),
(13, 3, 8000.00, 18, 2500.00, 500.00, 1, '1 a 3 años', '[\"documentos\\/dni\\/GEqUdEk4aCTkxNE4VkwIlDRvVFqjVEjrh7ENo64k.png\"]', '[\"documentos\\/boletas\\/UYXYytln7wRuZSEozVNY8RZ7zl5NRtplMms2eWrD.png\"]', 40.28, 'Rechazado', 'rechazado', '2026-10-09 20:28:24', '2026-10-09 20:28:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'socio',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Zasmi', 'zasmi@test.com', 'analista', NULL, '$2y$12$TLq57Re9.Xyo.wnid4rkGOtp6Tmpf9N5eg0BFaGG41bu8pWOM5r2u', 'UDEXpJdg9qZk70d24KsPH0gAqqp9Y1p4ltGUqMK67Ti6i3rbWzn5KSXvfLdn', '2026-09-27 21:48:58', '2026-09-27 21:49:49'),
(2, 'Paquito', 'paquin@boti.com', 'socio', NULL, '$2y$12$MeMKhAJ0jz.Fuq9HxQz42.YSY/dW24jmrj5U4QgFwCvfQyf6ffKr.', NULL, '2026-09-27 23:37:58', '2026-09-27 23:37:58'),
(3, 'Jhean Carlos', 'jhean@test.com', 'analista', NULL, '$2y$12$GKLzwkEtoO241CPlI9rqy.lEGCqp.27S5k1PPpc3ntni1zrONMGCK', 'Z3rTvuaDmjXU2ScdpSsBSFIImhL1h6XxNMpvm9e7NYFYr2Ce1fCcFz05B4NX', '2026-10-08 19:30:20', '2026-10-08 19:31:39'),
(4, 'Usuario Prueba', 'prueba@test.com', 'socio', NULL, '$2y$12$BLrjmsreVJn44DVih/ZPDODpgxCByzvDY5YZ1f6nGhE9dC1laKm1a', NULL, '2026-10-09 20:24:16', '2026-10-09 20:24:16');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solicitudes_user_id_foreign` (`user_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
