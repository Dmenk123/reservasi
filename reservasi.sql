/*
 Navicat Premium Data Transfer

 Source Server         : local-mysql
 Source Server Type    : MySQL
 Source Server Version : 50736
 Source Host           : localhost:3306
 Source Schema         : reservasi

 Target Server Type    : MySQL
 Target Server Version : 50736
 File Encoding         : 65001

 Date: 15/08/2022 21:00:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_hak_akses_bo
-- ----------------------------
DROP TABLE IF EXISTS `m_hak_akses_bo`;
CREATE TABLE `m_hak_akses_bo`  (
  `id_m_hak_akses_bo` int(11) NOT NULL,
  `id_m_user_group_bo` int(11) NOT NULL,
  `id_m_menu_bo` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_m_hak_akses_bo`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of m_hak_akses_bo
-- ----------------------------
INSERT INTO `m_hak_akses_bo` VALUES (1, 1, 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (2, 1, 2, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (3, 1, 3, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (4, 1, 4, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (5, 1, 5, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (6, 1, 6, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (7, 1, 7, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (8, 1, 8, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (9, 1, 9, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (10, 1, 10, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (11, 1, 11, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (12, 1, 12, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (13, 1, 13, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_hak_akses_bo` VALUES (14, 1, 14, '2022-08-14 15:03:54', NULL, NULL);

-- ----------------------------
-- Table structure for m_interval
-- ----------------------------
DROP TABLE IF EXISTS `m_interval`;
CREATE TABLE `m_interval`  (
  `id_m_interval` int(11) NOT NULL,
  `durasi_m_interval` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_m_interval`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of m_interval
-- ----------------------------
INSERT INTO `m_interval` VALUES (1, 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_interval` VALUES (2, 2, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_interval` VALUES (3, 3, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_interval` VALUES (4, 4, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_interval` VALUES (5, 5, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_interval` VALUES (6, 6, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_interval` VALUES (7, 7, '2022-08-14 15:03:54', NULL, NULL);

-- ----------------------------
-- Table structure for m_menu_bo
-- ----------------------------
DROP TABLE IF EXISTS `m_menu_bo`;
CREATE TABLE `m_menu_bo`  (
  `id_m_menu_bo` int(11) NOT NULL,
  `nm_menu_bo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `aktif` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_parent` int(11) NULL DEFAULT NULL,
  `order_m_menu_bo` int(11) NULL DEFAULT NULL,
  `head_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `page_title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_menu_active` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `child_menu_active` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `id_m_process` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_m_menu_bo`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_menu_bo
-- ----------------------------
INSERT INTO `m_menu_bo` VALUES (1, 'Master Data', '1', 'database', NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_menu_bo` VALUES (2, 'User', '1', 'circle', 'admin.m_user_bo.index', 1, 98, NULL, NULL, NULL, NULL, NULL, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_menu_bo` VALUES (3, 'Admin Menu', '1', 'circle', 'admin.m_menu_bo.index', 1, 100, NULL, NULL, NULL, NULL, NULL, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_menu_bo` VALUES (4, 'User Group', '1', 'circle', 'admin.m_user_group_bo.index', 1, 99, NULL, NULL, NULL, NULL, NULL, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_menu_bo` VALUES (5, 'Transaksi', '1', 'trello', NULL, NULL, 2, NULL, NULL, NULL, NULL, NULL, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_menu_bo` VALUES (6, 'Reservasi', '1', 'circle', 'admin.t_reservasi.index', 5, 3, NULL, NULL, NULL, NULL, NULL, '2022-08-14 15:03:54', NULL, NULL);

-- ----------------------------
-- Table structure for m_proses
-- ----------------------------
DROP TABLE IF EXISTS `m_proses`;
CREATE TABLE `m_proses`  (
  `id_m_proses` int(11) NOT NULL,
  `nm_m_proses` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `urut_m_proses` smallint(6) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_m_proses`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_proses
-- ----------------------------
INSERT INTO `m_proses` VALUES (1, 'Pengisian Data Diri', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_proses` VALUES (2, 'Pengisian Metode Bayar', 2, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_proses` VALUES (3, 'Pembayaran', 3, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_proses` VALUES (4, 'Konfirmasi Pembayaran', 4, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_proses` VALUES (5, 'Verifikasi Pembayaran', 5, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_proses` VALUES (6, 'Transaksi Selesai', 6, '2022-08-14 15:03:54', NULL, NULL);

-- ----------------------------
-- Table structure for m_user_bo
-- ----------------------------
DROP TABLE IF EXISTS `m_user_bo`;
CREATE TABLE `m_user_bo`  (
  `id_m_user_bo` int(11) NOT NULL,
  `username` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_user_bo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_m_user_group_bo` bigint(20) UNSIGNED NOT NULL,
  `aktif` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_m_user_bo`) USING BTREE,
  INDEX `m_user_bo_id_m_user_group_bo_foreign`(`id_m_user_group_bo`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user_bo
-- ----------------------------
INSERT INTO `m_user_bo` VALUES (1, 'admin', 'Developer', '$2y$10$vT76weUY7fHgjPyZfflP7uqQipKWUn/hjfRsVXIXcXm6szwSMKeni', 1, '1', '2022-08-15 07:37:03', '2022-08-14 15:03:54', '2022-08-15 07:37:03', NULL);

-- ----------------------------
-- Table structure for m_user_group_bo
-- ----------------------------
DROP TABLE IF EXISTS `m_user_group_bo`;
CREATE TABLE `m_user_group_bo`  (
  `id_m_user_group_bo` int(11) NOT NULL,
  `nm_user_group_bo` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `aktif` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_m_user_group_bo`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user_group_bo
-- ----------------------------
INSERT INTO `m_user_group_bo` VALUES (1, 'developer', '1', NULL, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `m_user_group_bo` VALUES (2, 'admin', '1', NULL, '2022-08-14 15:03:54', NULL, NULL);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2021_07_25_120342_create_m_user_group_bo_table', 1);
INSERT INTO `migrations` VALUES (2, '2021_07_26_005829_create_m_user_bo_table', 1);
INSERT INTO `migrations` VALUES (3, '2021_07_26_014941_create_m_menu_bo_table', 1);
INSERT INTO `migrations` VALUES (4, '2021_07_26_024557_create_m_hak_akses_bo_table', 1);
INSERT INTO `migrations` VALUES (5, '2022_08_13_075241_create_t_jadwal_rutin_table', 1);
INSERT INTO `migrations` VALUES (6, '2022_08_13_080517_create_m_interval_table', 1);
INSERT INTO `migrations` VALUES (7, '2022_08_13_210051_create_m_proses_table', 1);
INSERT INTO `migrations` VALUES (8, '2022_08_13_211145_create_t_log_proses_table', 1);
INSERT INTO `migrations` VALUES (9, '2022_08_13_211623_create_t_reservasi_table', 1);
INSERT INTO `migrations` VALUES (10, '2022_08_13_225011_create_t_email_token', 1);
INSERT INTO `migrations` VALUES (11, '2022_08_14_201722_create_t_file_upload_table', 2);

-- ----------------------------
-- Table structure for t_email_token
-- ----------------------------
DROP TABLE IF EXISTS `t_email_token`;
CREATE TABLE `t_email_token`  (
  `id_t_email_token` int(11) NOT NULL,
  `id_t_reservasi` int(11) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expired_at` timestamp(0) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_email_token`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_email_token
-- ----------------------------

-- ----------------------------
-- Table structure for t_file_upload
-- ----------------------------
DROP TABLE IF EXISTS `t_file_upload`;
CREATE TABLE `t_file_upload`  (
  `id_t_file_upload` int(11) NOT NULL,
  `id_t_reservasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `path_t_file_upload` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mimetype` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_file_upload`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_file_upload
-- ----------------------------
INSERT INTO `t_file_upload` VALUES (1, '1', 'files/1/1629234291_index.jpg', 'jpg', '2022-08-14 20:43:46', NULL, NULL);

-- ----------------------------
-- Table structure for t_jadwal_rutin
-- ----------------------------
DROP TABLE IF EXISTS `t_jadwal_rutin`;
CREATE TABLE `t_jadwal_rutin`  (
  `id_t_jadwal_rutin` int(11) NOT NULL,
  `id_m_interval` int(11) NOT NULL,
  `jam_mulai` time(0) NOT NULL,
  `jam_akhir` time(0) NOT NULL,
  `hari` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_jadwal_rutin`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_jadwal_rutin
-- ----------------------------
INSERT INTO `t_jadwal_rutin` VALUES (1, 4, '07:00:00', '16:00:00', 'senin', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `t_jadwal_rutin` VALUES (2, 4, '07:00:00', '16:00:00', 'selasa', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `t_jadwal_rutin` VALUES (3, 4, '07:00:00', '16:00:00', 'rabu', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `t_jadwal_rutin` VALUES (4, 4, '07:00:00', '16:00:00', 'kamis', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `t_jadwal_rutin` VALUES (5, 4, '07:00:00', '16:00:00', 'jumat', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `t_jadwal_rutin` VALUES (6, 4, '07:00:00', '16:00:00', 'sabtu', 1, '2022-08-14 15:03:54', NULL, NULL);
INSERT INTO `t_jadwal_rutin` VALUES (7, 4, '07:00:00', '16:00:00', 'minggu', 1, '2022-08-14 15:03:54', NULL, NULL);

-- ----------------------------
-- Table structure for t_log_proses
-- ----------------------------
DROP TABLE IF EXISTS `t_log_proses`;
CREATE TABLE `t_log_proses`  (
  `id_t_log_proses` int(11) NOT NULL,
  `id_t_reservasi` int(11) NOT NULL,
  `id_m_proses` int(11) NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_log_proses`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Fixed;

-- ----------------------------
-- Records of t_log_proses
-- ----------------------------

-- ----------------------------
-- Table structure for t_reservasi
-- ----------------------------
DROP TABLE IF EXISTS `t_reservasi`;
CREATE TABLE `t_reservasi`  (
  `id_t_reservasi` int(11) NOT NULL,
  `nm_t_reservasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_reservasi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_t_reservasi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_t_reservasi` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_m_proses` int(11) NOT NULL,
  `hari_t_reservasi` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_t_reservasi` date NOT NULL,
  `jam_t_reservasi` time(0) NOT NULL,
  `jenis_t_reservasi` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `metode_pembayaran_t_reservasi` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_payment_t_reservasi` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `deleted_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id_t_reservasi`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_reservasi
-- ----------------------------
INSERT INTO `t_reservasi` VALUES (1, 'bambang', 'rizkiyuandaa@gmail.com', 'a11', '081111111111', 4, 'senin', '2022-08-15', '16:00:00', 'cash', 'upload', NULL, '2022-08-14 10:03:57', NULL, NULL);

SET FOREIGN_KEY_CHECKS = 1;
