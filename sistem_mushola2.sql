/*
SQLyog Ultimate v12.4.1 (64 bit)
MySQL - 10.4.24-MariaDB : Database - sistem_mushola
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sistem_mushola` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `sistem_mushola`;

/*Table structure for table `absensi` */

DROP TABLE IF EXISTS `absensi`;

CREATE TABLE `absensi` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(20) DEFAULT NULL,
  `status` enum('hadir','izin','alpa','sakit') DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `absensi` */

insert  into `absensi`(`id`,`id_siswa`,`status`,`tgl`) values 
(1,1,'hadir','2022-07-16'),
(2,1,'hadir','2022-07-17'),
(3,1,'alpa','2022-07-18'),
(4,1,'izin','2022-07-20'),
(5,2,'hadir','2022-07-16'),
(6,1,'sakit','2022-07-22'),
(7,2,'sakit','2022-07-17'),
(8,6,'hadir','2022-07-17'),
(9,1,'sakit','2022-07-28'),
(10,2,'izin','2022-07-28'),
(11,6,'alpa','2022-07-28'),
(14,6,'izin','2022-09-03'),
(16,9,'alpa','2022-09-03'),
(17,1,'sakit','2022-09-03'),
(19,2,'hadir','2022-09-03'),
(20,8,'sakit','2022-09-03'),
(21,1,'hadir','2022-09-04'),
(22,2,'sakit','2022-09-04'),
(24,8,'alpa','2022-09-04'),
(26,9,'sakit','2022-09-04');

/*Table structure for table `anggota_kelas` */

DROP TABLE IF EXISTS `anggota_kelas`;

CREATE TABLE `anggota_kelas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_kelas` bigint(20) DEFAULT NULL,
  `id_siswa` bigint(20) DEFAULT NULL,
  `id_semester` bigint(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_siswa` (`id_siswa`),
  KEY `id_semester` (`id_semester`),
  KEY `id_kelas` (`id_kelas`),
  CONSTRAINT `anggota_kelas_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`),
  CONSTRAINT `anggota_kelas_ibfk_2` FOREIGN KEY (`id_semester`) REFERENCES `semester` (`id`),
  CONSTRAINT `anggota_kelas_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `anggota_kelas` */

insert  into `anggota_kelas`(`id`,`id_kelas`,`id_siswa`,`id_semester`,`status`) values 
(1,2,1,2,1),
(2,1,2,2,1),
(4,2,6,2,1),
(5,1,8,2,1),
(6,3,9,2,1);

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `jadwal_pengajian` */

DROP TABLE IF EXISTS `jadwal_pengajian`;

CREATE TABLE `jadwal_pengajian` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `jadwal_pengajian` */

insert  into `jadwal_pengajian`(`id`,`title`,`start`) values 
(1,'Pengajian','2022-03-22 00:00:00'),
(2,'Pengajian','2022-06-20 20:25:00');

/*Table structure for table `kelas` */

DROP TABLE IF EXISTS `kelas`;

CREATE TABLE `kelas` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kelas` */

insert  into `kelas`(`id`,`nama_kelas`) values 
(1,'a'),
(2,'b'),
(3,'c'),
(4,'d');

/*Table structure for table `mata_pelajaran` */

DROP TABLE IF EXISTS `mata_pelajaran`;

CREATE TABLE `mata_pelajaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelajaran` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `mata_pelajaran` */

insert  into `mata_pelajaran`(`id`,`nama_pelajaran`) values 
(1,'Al-Quran'),
(2,'Iqro'),
(3,'Aqidah Akhlak'),
(4,'Hafalan Surat'),
(5,'PAI'),
(6,'Tajwid'),
(7,'Khot');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),
(4,'2019_08_19_000000_create_failed_jobs_table',1),
(5,'2019_12_14_000001_create_personal_access_tokens_table',1),
(6,'2022_02_20_132414_create_sessions_table',1);

/*Table structure for table `nilai` */

DROP TABLE IF EXISTS `nilai`;

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_anggota_kelas` int(11) DEFAULT NULL,
  `id_mata_pelajaran` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

/*Data for the table `nilai` */

insert  into `nilai`(`id`,`id_anggota_kelas`,`id_mata_pelajaran`,`nilai`) values 
(3,1,3,90),
(4,1,4,95),
(5,1,5,79),
(6,1,6,90),
(7,1,7,96),
(8,2,1,90),
(9,2,2,79),
(10,2,3,87),
(11,2,4,87),
(12,2,5,79),
(13,2,6,92),
(14,2,7,78),
(18,6,4,90),
(19,8,1,79),
(20,9,1,95);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `pengajar` */

DROP TABLE IF EXISTS `pengajar`;

CREATE TABLE `pengajar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_semester` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `pengajar` */

insert  into `pengajar`(`id`,`id_user`,`id_kelas`,`id_semester`) values 
(1,3,1,2),
(2,4,1,2),
(3,4,2,2);

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `semester` */

DROP TABLE IF EXISTS `semester`;

CREATE TABLE `semester` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `tahun_ajaran` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `semester` */

insert  into `semester`(`id`,`tahun_ajaran`,`status`) values 
(1,'Ganjil 2022/2023','0'),
(2,'Genap 2022/2023','1');

/*Table structure for table `sessions` */

DROP TABLE IF EXISTS `sessions`;

CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sessions` */

insert  into `sessions`(`id`,`user_id`,`ip_address`,`user_agent`,`payload`,`last_activity`) values 
('fyFq8NIEjwqQhrx66xg8HwEKHZQwDc1XQ2vhwX41',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/104.0.0.0 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiYVdQWU95SllDWUR3VGVpTGppZm9oYktZM3FuT2dGem9ER0xkT2FheSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9rZWxhcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCR2Q0IuMTZKVXBVL1U1TXBRSTBZT3hPTEx5OGpjNE05eXRkdXhOelRBRzBlRW1oWnNqUXlGQyI7fQ==',1662386505);

/*Table structure for table `siswa` */

DROP TABLE IF EXISTS `siswa`;

CREATE TABLE `siswa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `no_induk` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan') DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `telepon` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `siswa` */

insert  into `siswa`(`id`,`no_induk`,`nama`,`tgl_lahir`,`jenis_kelamin`,`alamat`,`telepon`,`status`,`updated_at`,`created_at`) values 
(1,'1234567890','Komang 2','2022-03-15','perempuan','Jl. Raya 2','087654567653',1,'2022-09-03 16:48:47','2022-03-03 16:05:26'),
(2,'213213123','Ketut','2022-03-14','perempuan','Jl. Bypass','082146576289',1,'2022-06-30 16:42:58','2022-03-03 16:51:41'),
(6,'531232134','Putu','2022-07-03','laki-laki','Jl Sesetan','082948193818',1,'2022-06-30 16:43:07','2022-06-30 16:38:22'),
(8,'1234443','Wayan','2022-07-31','laki-laki','Sesetan','0812461827581',1,'2022-08-21 09:02:26','2022-08-21 09:02:26'),
(9,'12344435234','Nyoman','2022-08-09','laki-laki','Renon','089518682869',1,'2022-08-21 09:06:33','2022-08-21 09:06:33');

/*Table structure for table `spp` */

DROP TABLE IF EXISTS `spp`;

CREATE TABLE `spp` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_siswa` bigint(20) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `spp` */

insert  into `spp`(`id`,`id_siswa`,`tgl`) values 
(2,2,'2022-03-22');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint(20) unsigned DEFAULT NULL,
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`telepon`,`role`,`slug`,`two_factor_secret`,`two_factor_recovery_codes`,`remember_token`,`current_team_id`,`profile_photo_path`,`created_at`,`updated_at`) values 
(1,'Admin','admin@gmail.com',NULL,'$2y$10$vCB.16JUpU/U5MpQI0YOxOLLy8jc4M9ytduxNzTAG0eEmhZsjQyFC','08690104223','Admin','admin',NULL,NULL,NULL,NULL,NULL,'2022-06-30 15:26:11','2022-09-03 17:07:54'),
(2,'Pengurus','pengurus@gmail.com',NULL,'$2y$10$Vth0mtFMfDlKSFxEzZIQrelTJeJN.1WVafinBuW/8tmJTW5NpAUCW','060486294961','Pengurus','pengurus',NULL,NULL,NULL,NULL,NULL,'2022-06-30 15:26:11','2022-09-03 17:07:17'),
(3,'Guru','guru@gmail.com',NULL,'$2y$10$gpnPe7J/t2cNWepmqLadsusF/MPEBzty05NvNKisIEoeeKjBVvCIK','089657182948','Guru','guru',NULL,NULL,NULL,NULL,NULL,'2022-06-30 15:26:11','2022-06-30 17:56:18'),
(4,'Guru 2','guru2@gmail.com',NULL,'$2y$10$S1dK6CZ7oV03LWVAfmwyCOIeQfN780mEnFyb2.HOZhQX3Z.mr3UtK','089586728572','Guru','guru-2',NULL,NULL,NULL,NULL,NULL,'2022-09-04 17:12:27','2022-09-04 17:12:27'),
(5,'Guru 3','guru3@gmail.com',NULL,'$2y$10$7Prn092UN6GTnbh3bAopLudtis88nqdU9SqzTajona1uRbA6tdeZC','085768275862','Guru','guru-3',NULL,NULL,NULL,NULL,NULL,'2022-09-04 17:13:05','2022-09-04 17:13:05'),
(6,'Guru 4','guru4@gmail.com',NULL,'$2y$10$7K9ZFYzbptQjPu32ebp8IuQFa4AODj4kyOmeJW7znmh2B/o2iZH7y','089581758245','Guru','guru-4',NULL,NULL,NULL,NULL,NULL,'2022-09-04 17:22:22','2022-09-04 17:22:22');

/*Table structure for table `zakat` */

DROP TABLE IF EXISTS `zakat`;

CREATE TABLE `zakat` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `ket` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `zakat` */

insert  into `zakat`(`id`,`nama`,`tgl`,`ket`) values 
(2,'Komang','2022-03-07',200002);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
