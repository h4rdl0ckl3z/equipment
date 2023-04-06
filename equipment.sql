/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : equipment

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 06/04/2023 23:40:25
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
  `fullname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'profile.png',
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `access_level` int NULL DEFAULT NULL COMMENT '0.ผู้ดูแลระบบ\r\n1.ผู้บริหาร\r\n2.เจ้าหน้าที่\r\n3.ผู้ใช้งาน',
  `section_id` int NULL DEFAULT NULL,
  `agency_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`) USING BTREE,
  INDEX `account_section`(`section_id` ASC) USING BTREE,
  INDEX `account_agency`(`agency_id` ASC) USING BTREE,
  CONSTRAINT `account_agency` FOREIGN KEY (`agency_id`) REFERENCES `agencys` (`agency_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `account_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Avatart0Dev', '20230313_640f5f828453b.png', 'Bangkok', '0981111111', 0, 1, '22050000');
INSERT INTO `accounts` VALUES (2, 'tester', '202cb962ac59075b964b07152d234b70', 'Tester', 'profile.png', 'Bangkok', '0981111112', 1, 3, '22020000');
INSERT INTO `accounts` VALUES (3, 'asd', '7815696ecbf1c96e6894b779456d330e', 'asd eiei03', 'profile.png', 'asd', 'asd', 2, 2, '22050000');
INSERT INTO `accounts` VALUES (4, 'asd02', '7815696ecbf1c96e6894b779456d330e', 'asd eiei02', 'profile.png', 'asd', '123', 3, 4, '22050000');
INSERT INTO `accounts` VALUES (5, 'tester03', '202cb962ac59075b964b07152d234b70', 'Tester03', 'profile.png', 'BKK', '123', 3, 4, '22010000');

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
  CONSTRAINT `agency_community` FOREIGN KEY (`community_id`) REFERENCES `communitys` (`community_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of agencys
-- ----------------------------
INSERT INTO `agencys` VALUES ('22010000', 'สาขาวิชาเทคโนโลยีดิจิตอล', '013');
INSERT INTO `agencys` VALUES ('22020000', 'สาขาวิชาการจัดการภัยพิบัติ', '013');
INSERT INTO `agencys` VALUES ('22050000', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '013');

-- ----------------------------
-- Table structure for communitys
-- ----------------------------
DROP TABLE IF EXISTS `communitys`;
CREATE TABLE `communitys`  (
  `community_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `community_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`community_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of communitys
-- ----------------------------
INSERT INTO `communitys` VALUES ('013', 'คณะวิทยาศาสตร์และเทคโนโลยี');

-- ----------------------------
-- Table structure for da_brs
-- ----------------------------
DROP TABLE IF EXISTS `da_brs`;
CREATE TABLE `da_brs`  (
  `dabr_id` int NOT NULL AUTO_INCREMENT,
  `account_id` int NOT NULL,
  `da_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `da_borrow` datetime NULL DEFAULT NULL,
  `da_return` datetime NULL DEFAULT NULL,
  `allow_br` int NULL DEFAULT NULL,
  PRIMARY KEY (`dabr_id`) USING BTREE,
  INDEX `da_br_accounts`(`account_id` ASC) USING BTREE,
  INDEX `da_br_da_id`(`da_id` ASC) USING BTREE,
  CONSTRAINT `da_br_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_br_da_id` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
  `da_status_i` int NULL DEFAULT NULL COMMENT 'สภาพครุภัณฑ์\r\n0.ปกติ\r\n1.ชำรุด\r\n2.เสื่อมคุณถาพ\r\n3.สูญหาย',
  `da_unit` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'หน่วยนับ',
  `da_rates` decimal(10, 2) NOT NULL,
  `da_date` date NOT NULL COMMENT 'วันที่ได้มา',
  `da_source` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'แหล่งเงิน',
  `da_feature` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'คุณสมบัติ (ยี่ห้อ/รุ่น)',
  `da_annotation` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'หมายเหตุ/เลขครุภัณฑ์เดิม',
  `da_location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'สถานที่ตั้ง/จัดเก็บ',
  `da_status_ii` int NOT NULL COMMENT 'สถานะครุภัณฑ์\r\n0.ยืม\r\n1.แจ้งซ่อม\r\n2.ครุภัณฑ์ห้อง',
  `da_type_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสประเภทครุภัณฑ์',
  `room_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสห้อง',
  PRIMARY KEY (`da_id`) USING BTREE,
  INDEX `room_da`(`room_id` ASC) USING BTREE,
  INDEX `da_type`(`da_type_id` ASC) USING BTREE,
  CONSTRAINT `da_type` FOREIGN KEY (`da_type_id`) REFERENCES `da_types` (`da_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `room_da` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_items
-- ----------------------------
INSERT INTO `da_items` VALUES ('61-21-220500-201-00007-0010', 'เก้าอี้สํานักงาน', NULL, 0, 'ตัว', 1300.00, '2018-01-08', 'เงินรายได้ (งบ\r\nนโยบายต่อเนื่อง)', NULL, NULL, 'สาขาวิทยาการคอมพิวเตอร์', 2, '201', 'CS0201');
INSERT INTO `da_items` VALUES ('61-21-220500-201-00007-0011', 'เก้าอี้สํานักงาน', NULL, 0, 'ตัว', 1300.00, '2018-01-08', 'เงินรายได้ (งบ\r\nนโยบายต่อเนื่อง)', NULL, NULL, 'สาขาวิทยาการคอมพิวเตอร์', 2, '201', 'CS0201');

-- ----------------------------
-- Table structure for da_repairs
-- ----------------------------
DROP TABLE IF EXISTS `da_repairs`;
CREATE TABLE `da_repairs`  (
  `da_r_id` int NOT NULL,
  `account_id` int NOT NULL,
  `da_id` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `da_repair` datetime NULL DEFAULT NULL COMMENT 'วันแจ้งซ่อม',
  `da_repair_status` int NULL DEFAULT NULL COMMENT 'สถานะส่งซ่อม\r\n0.ปกติ\r\n1.ดำเนินการส่งซ่อม',
  PRIMARY KEY (`da_r_id`) USING BTREE,
  INDEX `da_repair_accounts`(`account_id` ASC) USING BTREE,
  INDEX `da_repair_da_id`(`da_id` ASC) USING BTREE,
  CONSTRAINT `da_repair_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_repair_da_id` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
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
INSERT INTO `da_types` VALUES ('201', 'ครุภัณฑ์สํานักงาน');

-- ----------------------------
-- Table structure for room_types
-- ----------------------------
DROP TABLE IF EXISTS `room_types`;
CREATE TABLE `room_types`  (
  `room_type_id` int NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทห้อง',
  `room_type_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ชื่อประเภทห้อง',
  PRIMARY KEY (`room_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of room_types
-- ----------------------------
INSERT INTO `room_types` VALUES (1, 'ห้องเรียน');
INSERT INTO `room_types` VALUES (2, 'ห้องสำนักงาน');
INSERT INTO `room_types` VALUES (3, 'ห้องคณบดี');
INSERT INTO `room_types` VALUES (4, 'ห้องนอน');

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms`  (
  `room_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสห้อง',
  `room_type_id` int NOT NULL COMMENT 'รหัสประเภทห้อง',
  `community_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '013',
  PRIMARY KEY (`room_id`) USING BTREE,
  INDEX `room_type`(`room_type_id` ASC) USING BTREE,
  INDEX `community_id`(`community_id` ASC) USING BTREE,
  CONSTRAINT `room_community` FOREIGN KEY (`community_id`) REFERENCES `communitys` (`community_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `room_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('CS0201', 2, '013');
INSERT INTO `rooms` VALUES ('CS0202', 2, '013');
INSERT INTO `rooms` VALUES ('SCI0301', 1, '013');
INSERT INTO `rooms` VALUES ('TEST01', 4, '013');

-- ----------------------------
-- Table structure for sections
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`  (
  `section_id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`section_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of sections
-- ----------------------------
INSERT INTO `sections` VALUES (1, 'ผู้ดุแลครุภัณฑ์คณะ');
INSERT INTO `sections` VALUES (2, 'ผู้ดูแลห้องเรียน');
INSERT INTO `sections` VALUES (3, 'ผู้บริหาร');
INSERT INTO `sections` VALUES (4, 'บุคลากร');

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
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of system_info
-- ----------------------------
INSERT INTO `system_info` VALUES (1, 'ระบบบริหารครุภัณฑ์', 'SciTech-G.png', 'วิทยาการคอมพิวเตอร์ คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏสุราษฎร์ธานี', 'http://cs.sci.sru.ac.th/', 'ระบบบริหารครุภัณฑ์ คณะวิทยาศาสตร์และเทคโนโลยี มหาวิทยาลัยราชภัฏสุราษฎร์ธานี');

SET FOREIGN_KEY_CHECKS = 1;
