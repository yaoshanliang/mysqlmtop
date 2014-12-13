/*
Navicat MySQL Data Transfer

Source Server         : 10.0.2.47
Source Server Version : 50518
Source Host           : 10.0.2.47:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50518
File Encoding         : 65001

Date: 2014-02-15 21:16:16
*/

SET FOREIGN_KEY_CHECKS=0;


-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('1', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'all', '管理员', '', '', '1', '127.0.0.1', '2014-02-15 20:47:47', '1', '2013-12-25 15:58:34');


-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES ('monitor', '1', '开启全局监控', 'mysql');
INSERT INTO `options` VALUES ('monitor_status', '1', '开启状态监控', 'mysql');
INSERT INTO `options` VALUES ('monitor_replication', '1', '开启复制监控', 'mysql');
INSERT INTO `options` VALUES ('monitor_process', '1', '开启进程监控', 'mysql');
INSERT INTO `options` VALUES ('alarm', '1', '开启报警', 'mysql');
INSERT INTO `options` VALUES ('send_alarm_mail', '0', '发生报警邮件', 'mysql');
INSERT INTO `options` VALUES ('frequency_monitor', '60', '监控频率', 'mysql');
INSERT INTO `options` VALUES ('frequency_alarm', '300', '报警通知频率', 'mysql');
INSERT INTO `options` VALUES ('slow_query_time', '5', '慢查询记录时间', 'mysql');
INSERT INTO `options` VALUES ('mail_to_list', 'test@126.com', '报警邮件通知人员', 'mysql');
INSERT INTO `options` VALUES ('big_table_size', '5', '大表检查大于几GB的表', 'mysql');
INSERT INTO `options` VALUES ('kill_process', '1', '开启进程管理', 'mysql');
INSERT INTO `options` VALUES ('widget_bigtable_run', '0', '大表查询进程状态', 'mysql');
INSERT INTO `options` VALUES ('widget_hit_rate_run', '0', '命中率查询进程状态', 'mysql');
INSERT INTO `options` VALUES ('widget_connect_run', '0', '连接来源查询进程状态', 'mysql');
