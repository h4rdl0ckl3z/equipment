/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : test

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 08/10/2023 18:27:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for accounts
-- ----------------------------
DROP TABLE IF EXISTS `accounts`;
CREATE TABLE `accounts`  (
  `account_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `passwd` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `name_title` enum('นาย','นาง','นางสาว') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'profile.png',
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `access_level` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '0.ผู้ดูแลระบบ\r\n1.ผู้บริหาร\r\n2.เจ้าหน้าที่\r\n3.ผู้ใช้งาน',
  `section_id` int NULL DEFAULT NULL,
  `agency_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`) USING BTREE,
  INDEX `account_section`(`section_id` ASC) USING BTREE,
  INDEX `account_agency`(`agency_id` ASC) USING BTREE,
  CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencys` (`agency_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `accounts_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'นาย', 'Admin', 'profile.png', NULL, NULL, '0', NULL, NULL);

-- ----------------------------
-- Table structure for agencys
-- ----------------------------
DROP TABLE IF EXISTS `agencys`;
CREATE TABLE `agencys`  (
  `agency_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `agency_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `community_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '013',
  PRIMARY KEY (`agency_id`) USING BTREE,
  INDEX `agency_community`(`community_id` ASC) USING BTREE,
  CONSTRAINT `agencys_ibfk_1` FOREIGN KEY (`community_id`) REFERENCES `communitys` (`community_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of agencys
-- ----------------------------

-- ----------------------------
-- Table structure for communitys
-- ----------------------------
DROP TABLE IF EXISTS `communitys`;
CREATE TABLE `communitys`  (
  `community_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `community_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`community_id`) USING BTREE,
  INDEX `community_name`(`community_name` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of communitys
-- ----------------------------

-- ----------------------------
-- Table structure for da_brs
-- ----------------------------
DROP TABLE IF EXISTS `da_brs`;
CREATE TABLE `da_brs`  (
  `dabr_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `da_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `da_br_location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ที่อยู่ปัจจุบัน ในการยืม',
  `da_br_status` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT 'สภาพครุภัณฑ์\r\n0.ปกติ\r\n1.ชำรุด\r\n2.เสื่อมสภาพ\r\n3.สูญหาย',
  `da_borrow` date NULL DEFAULT NULL,
  `da_return` date NULL DEFAULT NULL,
  `allow_br` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT 'สถานะการยืม\r\n0.รอดำเนินการ\r\n1.ยืม',
  PRIMARY KEY (`dabr_id`) USING BTREE,
  INDEX `da_br_accounts`(`account_id` ASC) USING BTREE,
  INDEX `da_br_da_id`(`da_id` ASC) USING BTREE,
  CONSTRAINT `da_brs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_brs_ibfk_2` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_brs
-- ----------------------------

-- ----------------------------
-- Table structure for da_items
-- ----------------------------
DROP TABLE IF EXISTS `da_items`;
CREATE TABLE `da_items`  (
  `da_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสครุภัณฑ์',
  `da_lists` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รายการครุภัณฑ์',
  `da_img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'รูปภาพครุภัณฑ์',
  `da_status_i` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT 'สภาพครุภัณฑ์\r\n0.ปกติ\r\n1.ชำรุด\r\n2.เสื่อมสภาพ\r\n3.สูญหาย',
  `da_unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'หน่วยนับ',
  `da_rates` decimal(10, 2) NOT NULL,
  `da_date` date NOT NULL COMMENT 'วันที่ได้มา',
  `da_source` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'แหล่งเงิน',
  `da_feature` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'คุณสมบัติ (ยี่ห้อ/รุ่น)',
  `da_annotation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'หมายเหตุ/เลขครุภัณฑ์เดิม',
  `da_location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'สถานที่ตั้ง/จัดเก็บ',
  `da_status_ii` enum('0','1','2','3','4','5') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT 'สถานะครุภัณฑ์\r\n0.ปกติ\r\n1.ยืม\r\n2.แจ้งซ่อม\r\n3.การตัดจำหน่าย\r\n4.ตรวจสอบสภาพ\r\n5.ดำเนินการซ่อม',
  `da_type_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสประเภทครุภัณฑ์',
  `room_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสห้อง',
  `qrcode_status` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`da_id`) USING BTREE,
  INDEX `room_da`(`room_id` ASC) USING BTREE,
  INDEX `da_type`(`da_type_id` ASC) USING BTREE,
  CONSTRAINT `da_items_ibfk_1` FOREIGN KEY (`da_type_id`) REFERENCES `da_types` (`da_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_items_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_items
-- ----------------------------

-- ----------------------------
-- Table structure for da_repairs
-- ----------------------------
DROP TABLE IF EXISTS `da_repairs`;
CREATE TABLE `da_repairs`  (
  `da_r_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `da_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `da_repair_location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'สถานที่ซ้อม/จัดเก็บ',
  `da_repair` date NOT NULL COMMENT 'วันแจ้งซ่อม',
  `da_repair_status` enum('0','1','2') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT 'สถานะส่งซ่อม\r\n0.แจ้งซ่อม\r\n1.ดำเนินการส่งซ่อม\r\n2.สำเร็จ',
  PRIMARY KEY (`da_r_id`) USING BTREE,
  INDEX `da_repair_accounts`(`account_id` ASC) USING BTREE,
  INDEX `da_repair_da_id`(`da_id` ASC) USING BTREE,
  CONSTRAINT `da_repairs_ibfk_1` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_repairs_ibfk_2` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_repairs
-- ----------------------------

-- ----------------------------
-- Table structure for da_types
-- ----------------------------
DROP TABLE IF EXISTS `da_types`;
CREATE TABLE `da_types`  (
  `da_type_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `da_type_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`da_type_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_types
-- ----------------------------

-- ----------------------------
-- Table structure for qrcodes
-- ----------------------------
DROP TABLE IF EXISTS `qrcodes`;
CREATE TABLE `qrcodes`  (
  `qrcode_id` int NOT NULL AUTO_INCREMENT,
  `qrcode_img` varbinary(200) NULL DEFAULT NULL,
  `da_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qrcode_date` date NOT NULL,
  PRIMARY KEY (`qrcode_id`) USING BTREE,
  INDEX `qrcode_da_id`(`da_id` ASC) USING BTREE,
  CONSTRAINT `qrcodes_ibfk_1` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of qrcodes
-- ----------------------------

-- ----------------------------
-- Table structure for room_types
-- ----------------------------
DROP TABLE IF EXISTS `room_types`;
CREATE TABLE `room_types`  (
  `room_type_id` int NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทห้อง',
  `room_type_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ชื่อประเภทห้อง',
  PRIMARY KEY (`room_type_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of room_types
-- ----------------------------

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms`  (
  `room_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสห้อง',
  `room_type_id` int NOT NULL COMMENT 'รหัสประเภทห้อง',
  `agency_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`room_id`) USING BTREE,
  INDEX `room_type`(`room_type_id` ASC) USING BTREE,
  INDEX `room_agency`(`agency_id` ASC) USING BTREE,
  CONSTRAINT `rooms_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `room_agency` FOREIGN KEY (`agency_id`) REFERENCES `agencys` (`agency_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rooms
-- ----------------------------

-- ----------------------------
-- Table structure for sections
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`  (
  `section_id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`section_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sections
-- ----------------------------

-- ----------------------------
-- Table structure for system_info
-- ----------------------------
DROP TABLE IF EXISTS `system_info`;
CREATE TABLE `system_info`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `title_system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img_system` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `system_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of system_info
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
