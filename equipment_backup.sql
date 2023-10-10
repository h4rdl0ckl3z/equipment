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

 Date: 10/10/2023 15:40:52
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
  `address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `access_level` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '0.ผู้ดูแลระบบ\r\n1.ผู้บริหาร\r\n2.เจ้าหน้าที่\r\n3.ผู้ใช้งาน',
  `section_id` int NULL DEFAULT NULL,
  `agency_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`account_id`) USING BTREE,
  INDEX `account_section`(`section_id` ASC) USING BTREE,
  INDEX `account_agency`(`agency_id` ASC) USING BTREE,
  CONSTRAINT `account_agency` FOREIGN KEY (`agency_id`) REFERENCES `agencys` (`agency_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `account_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`section_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of accounts
-- ----------------------------
INSERT INTO `accounts` VALUES (1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'นาย', 'วีระเทพ ชัยพัฒน์', 'profile.png', '272 ถ. สุราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง สุราษฎร์ธานี 84100', '0981111111', '0', NULL, NULL);
INSERT INTO `accounts` VALUES (2, 'tester', '202cb962ac59075b964b07152d234b70', 'นาย', 'ไกรวิทย์ ฉิมแก้ว', 'profile.png', '272 ถ. สุราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง สุราษฎร์ธานี 84100', '0981111112', '1', 3, '22020000');
INSERT INTO `accounts` VALUES (3, 'asd', '202cb962ac59075b964b07152d234b70', 'นาย', 'ณัฐวุฒิ ทองเพชร', 'profile.png', '272 ถ. สุราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง สุราษฎร์ธานี 84100', '0981111113', '2', 2, '22010000');
INSERT INTO `accounts` VALUES (4, 'asd02', '202cb962ac59075b964b07152d234b70', 'นาย', 'ธนถัทร เหลาทอง', 'profile.png', '272 ถ. สุราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง สุราษฎร์ธานี 84100', '0981111114', '1', 4, '22050000');
INSERT INTO `accounts` VALUES (5, 'tester', '202cb962ac59075b964b07152d234b70', 'นาย', 'ธีระภัทร์ ภักดี', 'profile.png', '272 ถ. สุราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง สุราษฎร์ธานี 84100', '0981111115', '2', 4, '22050000');
INSERT INTO `accounts` VALUES (6, 'bankz', '202cb962ac59075b964b07152d234b70', 'นาย', 'ศุภโชค พิเคราะห์', 'profile.png', '272 ถ. สุราษฎร์-นาสาร ต.ขุนทะเล อ.เมือง สุราษฎร์ธานี 84100', '0980499700', '3', 4, '22050000');

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
INSERT INTO `agencys` VALUES ('22000000', 'คณะวิทยาศาสตร์และเทคโนโลยี', '013');
INSERT INTO `agencys` VALUES ('22010000', 'สาขาวิชาคณิตศาสตร์', '013');
INSERT INTO `agencys` VALUES ('22020000', 'สาขาวิชาคณิตศาสตร์', '013');
INSERT INTO `agencys` VALUES ('22050000', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '013');
INSERT INTO `agencys` VALUES ('22060000', 'สาขาวิชาเทคโนโลยีดิจิทัล', '013');
INSERT INTO `agencys` VALUES ('22070000', 'สาขาวิชาวิทยาศาสตร์และเทคโนโลยีสิ่งแวดล้อม', '013');
INSERT INTO `agencys` VALUES ('22080000', 'สาขาวิชาอนามัยสิ่งแวดล้อม', '013');
INSERT INTO `agencys` VALUES ('22090000', 'สาขาวิชาสาธารณสุขศาสตร์', '013');
INSERT INTO `agencys` VALUES ('22100000', 'สาขาวิชาการจัดการภัยพิบัติ', '013');
INSERT INTO `agencys` VALUES ('22110000', 'สาขาวิชาเทคโนโลยีไฟฟ้าอุตสาหกรรม', '013');
INSERT INTO `agencys` VALUES ('22120000', 'สาขาวิชาเทคโนโลยีการประมง', '013');
INSERT INTO `agencys` VALUES ('22130000', 'สาขาวิชาพืชศาสตร์', '013');
INSERT INTO `agencys` VALUES ('22140000', 'สาขาวิชาสัตวศาสตร์', '013');
INSERT INTO `agencys` VALUES ('22150000', 'สาขาวิชานวัตกรรมอาหารและโภชนาการ', '013');
INSERT INTO `agencys` VALUES ('22160000', 'สาขาวิชาเทคโนโลยีอุตสาหกรรม', '013');

-- ----------------------------
-- Table structure for communitys
-- ----------------------------
DROP TABLE IF EXISTS `communitys`;
CREATE TABLE `communitys`  (
  `community_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `community_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`community_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
  `da_br_location` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ที่อยู่ปัจจุบัน ในการยืม',
  `da_br_status` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT '0' COMMENT 'สภาพครุภัณฑ์\r\n0.ปกติ\r\n1.ชำรุด\r\n2.เสื่อมสภาพ\r\n3.สูญหาย',
  `da_borrow` date NULL DEFAULT NULL,
  `da_return` date NULL DEFAULT NULL,
  `dabr_status` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0' COMMENT 'สถานะการยืม\r\n0.รอดำเนินการ\r\n1.ยืม\r\n2.คืน\r\n3.ไม่อนุมัติ',
  `allow_br` enum('0','1') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '0.ไม่อนุมัติ\r\n1.อนุมัติ',
  PRIMARY KEY (`dabr_id`) USING BTREE,
  INDEX `da_br_accounts`(`account_id` ASC) USING BTREE,
  INDEX `da_br_da_id`(`da_id` ASC) USING BTREE,
  CONSTRAINT `da_br_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_br_da_id` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_brs
-- ----------------------------
INSERT INTO `da_brs` VALUES (49, 1, '4921110000201002850004', 'ert', '0', '2023-10-10', '2023-10-28', '2', '0');
INSERT INTO `da_brs` VALUES (50, 1, '4921110000201002850004', 'wer', '0', '2023-10-10', '2023-10-20', '3', '0');
INSERT INTO `da_brs` VALUES (51, 1, '4921110000201002850004', 'wer', '0', '2023-10-10', '2023-10-20', '3', '0');
INSERT INTO `da_brs` VALUES (52, 1, '5721410000201004570010', 'dsf', '0', '2023-10-10', '2023-10-28', '3', '0');

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
  CONSTRAINT `da_type` FOREIGN KEY (`da_type_id`) REFERENCES `da_types` (`da_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `room_da` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_items
-- ----------------------------
INSERT INTO `da_items` VALUES ('4921110000201002850004', 'โต๊ะทํางาน ระดับ 3-6 - สําหรับเจ้าหน้าที่', NULL, '0', 'ตัว', 5986.00, '2022-10-08', 'งบประมาณเงินรายได้', '', '1-01-002-002-00070', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0202', '0');
INSERT INTO `da_items` VALUES ('5721410000201004570010', 'ชั้นวางหนังสือโลหะ ๒ ช่วงชั้น', NULL, '0', 'ชุด', 9800.00, '2023-10-05', 'งบประมาณเงินรายได้', 'ยี่ห้อ LPI', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0201', '0');
INSERT INTO `da_items` VALUES ('6121220500201000070001', 'เก้าอี้สํานักงาน', NULL, '0', 'ตัว', 1300.00, '2023-04-18', 'งบประมาณเงินรายได้', '', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0201', '0');
INSERT INTO `da_items` VALUES ('6121220500201000070002', 'เก้าอี้สํานักงาน', NULL, '0', 'ตัว', 1300.00, '2023-04-18', 'งบประมาณเงินรายได้', '', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0201', '0');
INSERT INTO `da_items` VALUES ('6121220500201000070003', 'เก้าอี้สํานักงาน', NULL, '0', 'ตัว', 1300.00, '2023-04-18', 'งบประมาณเงินรายได้', '', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0201', '0');
INSERT INTO `da_items` VALUES ('6121220500201000070008', 'pinter', NULL, '0', 'ชุด', 30000.00, '2023-10-09', 'งบประมาณเงินรายได้', '', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'CS0203', '0');
INSERT INTO `da_items` VALUES ('6121220500201000070010', 'เก้าอี้สํานักงาน', NULL, '0', 'ชุด', 13000.00, '2022-10-09', 'งบประมาณเงินรายได้', '', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'CS0203', '0');
INSERT INTO `da_items` VALUES ('6223900000201000070004', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 250000.00, '2022-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0203', '1');
INSERT INTO `da_items` VALUES ('6223900000201000070005', 'acer laptop', NULL, '0', 'ชุด', 250000.00, '2022-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0203', '1');
INSERT INTO `da_items` VALUES ('6223900000201000070006', 'mac 1 ชุด', NULL, '0', 'ชุด', 300000.00, '2022-10-09', 'งบประมาณเงินรายได้', 'Mac', '', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0203', '1');
INSERT INTO `da_items` VALUES ('6223900000201000070007', 'desktop pc 1 ชุด', NULL, '0', 'ชุด', 300000.00, '2023-10-05', 'งบประมาณเงินรายได้', 'PC ยี่ห้อ HP', '', 'ห้องเรียนคณะ', '0', '203', 'SCI0501', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070001', 'การเขียนโปรแกรมเบื้องต้น', NULL, '0', 'เล่ม', 150.00, '2023-10-08', 'งบประมาณเงินรายได้', '', '', '	สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'CS0203', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070002', 'การเขียนโปรแกรม PHP', NULL, '0', 'เล่ม', 200.00, '2023-10-09', 'งบประมาณเงินรายได้', NULL, NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'CS0203', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070003', 'pinter', NULL, '0', 'ชุด', 3000.00, '2023-10-09', 'งบประมาณเงินรายได้', NULL, NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0203', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070004', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070005', 'กระดาษ A4 1 หลัง', NULL, '0', 'หลัง', 800.00, '2023-10-09', 'งบประมาณเงินรายได้', NULL, NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0202', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070006', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '201', 'CS0202', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070007', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070008', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070009', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070010', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070011', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070012', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070013', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070014', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070015', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');
INSERT INTO `da_items` VALUES ('6323900000201000070016', 'คอมพิวเตอร์ 1 ชุด', NULL, '0', 'ชุด', 25000.00, '2023-10-09', 'งบประมาณเงินรายได้', 'Acer', NULL, 'สาขาวิชาวิทยาการคอมพิวเตอร์', '0', '200', 'SCI0401', '0');

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
  CONSTRAINT `da_repair_accounts` FOREIGN KEY (`account_id`) REFERENCES `accounts` (`account_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `da_repair_da_id` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of da_repairs
-- ----------------------------
INSERT INTO `da_repairs` VALUES (21, 3, '4921110000201002850004', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '2023-10-08', '2');
INSERT INTO `da_repairs` VALUES (23, 3, '5721410000201004570010', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '2023-10-08', '2');
INSERT INTO `da_repairs` VALUES (24, 1, '5721410000201004570010', 'สาขาวิชาวิทยาการคอมพิวเตอร์', '2023-10-08', '2');

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
INSERT INTO `da_types` VALUES ('200', 'ครุภัณฑ์สาขา');
INSERT INTO `da_types` VALUES ('201', 'ครุภัณฑ์สํานักงาน');
INSERT INTO `da_types` VALUES ('202', 'ครุภัณฑ์คณะ');
INSERT INTO `da_types` VALUES ('203', 'ครุภัณฑ์ห้องเรียน');

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
  CONSTRAINT `qrcode_da_id` FOREIGN KEY (`da_id`) REFERENCES `da_items` (`da_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of qrcodes
-- ----------------------------
INSERT INTO `qrcodes` VALUES (26, 0x32303233313030375F363532316465343734656238622E706E67, '6223900000201000070004', '2023-10-08');
INSERT INTO `qrcodes` VALUES (27, 0x32303233313030375F363532316535323231623138312E706E67, '6223900000201000070005', '2023-10-08');
INSERT INTO `qrcodes` VALUES (28, 0x32303233313030375F363532316535323232306162662E706E67, '6223900000201000070006', '2023-10-08');

-- ----------------------------
-- Table structure for room_types
-- ----------------------------
DROP TABLE IF EXISTS `room_types`;
CREATE TABLE `room_types`  (
  `room_type_id` int NOT NULL AUTO_INCREMENT COMMENT 'รหัสประเภทห้อง',
  `room_type_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'ชื่อประเภทห้อง',
  PRIMARY KEY (`room_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of room_types
-- ----------------------------
INSERT INTO `room_types` VALUES (1, 'ห้องเรียน');
INSERT INTO `room_types` VALUES (2, 'ห้องสำนักงาน');
INSERT INTO `room_types` VALUES (3, 'ห้องคณบดี');
INSERT INTO `room_types` VALUES (4, 'ห้องสำนักงานคณะ');
INSERT INTO `room_types` VALUES (5, 'ห้องสาขา');

-- ----------------------------
-- Table structure for rooms
-- ----------------------------
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE `rooms`  (
  `room_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'รหัสห้อง',
  `room_type_id` int NOT NULL COMMENT 'รหัสประเภทห้อง',
  `agency_id` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`room_id`) USING BTREE,
  INDEX `room_type`(`room_type_id` ASC) USING BTREE,
  INDEX `room_agency`(`agency_id` ASC) USING BTREE,
  CONSTRAINT `room_agency` FOREIGN KEY (`agency_id`) REFERENCES `agencys` (`agency_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `room_type` FOREIGN KEY (`room_type_id`) REFERENCES `room_types` (`room_type_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of rooms
-- ----------------------------
INSERT INTO `rooms` VALUES ('CS0201', 2, '22050000');
INSERT INTO `rooms` VALUES ('CS0202', 2, '22050000');
INSERT INTO `rooms` VALUES ('CS0203', 2, '22050000');
INSERT INTO `rooms` VALUES ('SCI0301', 1, '22000000');
INSERT INTO `rooms` VALUES ('SCI0401', 5, '22050000');
INSERT INTO `rooms` VALUES ('SCI0402', 2, '22000000');
INSERT INTO `rooms` VALUES ('SCI0403', 1, '22000000');
INSERT INTO `rooms` VALUES ('SCI0501', 1, '22000000');
INSERT INTO `rooms` VALUES ('SCI0601', 1, '22000000');

-- ----------------------------
-- Table structure for sections
-- ----------------------------
DROP TABLE IF EXISTS `sections`;
CREATE TABLE `sections`  (
  `section_id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`section_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

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
