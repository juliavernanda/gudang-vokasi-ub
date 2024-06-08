/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 100428
 Source Host           : localhost:3306
 Source Schema         : gudang

 Target Server Type    : MySQL
 Target Server Version : 100428
 File Encoding         : 65001

 Date: 09/12/2023 20:57:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for m_barang
-- ----------------------------
DROP TABLE IF EXISTS `m_barang`;
CREATE TABLE `m_barang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `kode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `harga` bigint(255) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_barang
-- ----------------------------
INSERT INTO `m_barang` VALUES (1, 'Tube Lem', '115110101000023', 'Buah', 50000);
INSERT INTO `m_barang` VALUES (2, 'Baterai AA', '115110104300004', 'Buah', 20000);
INSERT INTO `m_barang` VALUES (3, 'Bolpoint', '115110100100002', 'Buah', 30000);
INSERT INTO `m_barang` VALUES (4, 'Hvs a4 70gr', '115110101300005', 'Rim', 75000);
INSERT INTO `m_barang` VALUES (5, 'Plakban 2 inc(5cm)', '115110101000008', 'Roll', 90000);

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user`  (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of m_user
-- ----------------------------
INSERT INTO `m_user` VALUES (1, 'Superadmin', 'admin', 'admin', 'Superadmin');
INSERT INTO `m_user` VALUES (2, 'User', 'user', 'user', 'User');

-- ----------------------------
-- Table structure for t_barang_keluar
-- ----------------------------
DROP TABLE IF EXISTS `t_barang_keluar`;
CREATE TABLE `t_barang_keluar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah` int(255) NULL DEFAULT NULL,
  `tanggal` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_barang_keluar
-- ----------------------------
INSERT INTO `t_barang_keluar` VALUES (1, '1', 2, '2023-12-09 00:33:39');
INSERT INTO `t_barang_keluar` VALUES (2, '1', 3, '2023-12-09 00:33:39');
INSERT INTO `t_barang_keluar` VALUES (3, '5', 12312, '2023-12-09 19:44:00');

-- ----------------------------
-- Table structure for t_barang_masuk
-- ----------------------------
DROP TABLE IF EXISTS `t_barang_masuk`;
CREATE TABLE `t_barang_masuk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `jumlah` int(255) NULL DEFAULT NULL,
  `tanggal` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of t_barang_masuk
-- ----------------------------
INSERT INTO `t_barang_masuk` VALUES (1, '1', 3, '2023-12-09 00:33:39');
INSERT INTO `t_barang_masuk` VALUES (3, '1', 3, '2023-12-09 00:33:39');
INSERT INTO `t_barang_masuk` VALUES (4, '2', 5, '2023-12-09 00:33:39');

-- ----------------------------
-- View structure for sisa_stok
-- ----------------------------
DROP VIEW IF EXISTS `sisa_stok`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `sisa_stok` AS SELECT
	m_barang.id,
	m_barang.nama,
	m_barang.kode,
	m_barang.satuan,
	m_barang.harga,
	( SELECT SUM( t_barang_masuk.jumlah ) FROM t_barang_masuk WHERE t_barang_masuk.id_barang = m_barang.id ) AS jumlah_masuk,
	( SELECT SUM( t_barang_keluar.jumlah ) FROM t_barang_keluar WHERE t_barang_keluar.id_barang = m_barang.id ) AS jumlah_keluar,
	( SELECT SUM( t_barang_masuk.jumlah ) FROM t_barang_masuk WHERE t_barang_masuk.id_barang = m_barang.id ) - ( SELECT SUM( t_barang_keluar.jumlah ) FROM t_barang_keluar WHERE t_barang_keluar.id_barang = m_barang.id ) AS sisa_stok 
FROM
	m_barang ;

SET FOREIGN_KEY_CHECKS = 1;
