/*
Navicat MySQL Data Transfer

Source Server         : 10.0.2.47-gos-log-slave
Source Server Version : 50518
Source Host           : 10.0.2.47:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50518
File Encoding         : 65001

Date: 2014-02-28 13:50:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `permission` varchar(500) DEFAULT NULL,
  `realname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `login_count` int(11) DEFAULT '0',
  `last_login_ip` varchar(100) DEFAULT NULL,
  `last_login_time` datetime DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for alarm
-- ----------------------------
DROP TABLE IF EXISTS `alarm`;
CREATE TABLE `alarm` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` smallint(4) DEFAULT NULL,
  `server_id` smallint(4) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `db_type` varchar(30) DEFAULT NULL,
  `alarm_type` varchar(50) DEFAULT NULL,
  `alarm_value` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `send_mail` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for alarm_history
-- ----------------------------
DROP TABLE IF EXISTS `alarm_history`;
CREATE TABLE `alarm_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `application_id` smallint(4) DEFAULT NULL,
  `server_id` smallint(4) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `db_type` varchar(30) DEFAULT NULL,
  `alarm_type` varchar(50) DEFAULT NULL,
  `alarm_value` varchar(50) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `send_mail` tinyint(2) DEFAULT NULL,
  `send_mail_status` tinyint(2) DEFAULT NULL,
  `send_mail_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_application_id` (`application_id`),
  KEY `idx_server_id` (`server_id`),
  KEY `idx_create_time` (`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for application
-- ----------------------------
DROP TABLE IF EXISTS `application`;
CREATE TABLE `application` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `display_name` varchar(100) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1',
  `is_delete` tinyint(2) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for linux_resource
-- ----------------------------
DROP TABLE IF EXISTS `linux_resource`;
CREATE TABLE `linux_resource` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `hostname` varchar(50) NOT NULL,
  `kernel` varchar(50) DEFAULT NULL,
  `load1` varchar(10) DEFAULT NULL,
  `load5` varchar(10) DEFAULT NULL,
  `load15` varchar(10) DEFAULT NULL,
  `disk_use_root` varchar(50) DEFAULT NULL,
  `disk_use_home` varchar(50) DEFAULT NULL,
  `disk_use_data` varchar(50) DEFAULT NULL,
  `mem_total` varchar(20) DEFAULT NULL,
  `mem_use` varchar(20) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for linux_resource_history
-- ----------------------------
DROP TABLE IF EXISTS `linux_resource_history`;
CREATE TABLE `linux_resource_history` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) DEFAULT NULL,
  `hostname` varchar(50) NOT NULL,
  `kernel` varchar(50) DEFAULT NULL,
  `load1` varchar(10) DEFAULT NULL,
  `load5` varchar(10) DEFAULT NULL,
  `load15` varchar(10) DEFAULT NULL,
  `disk_use_root` varchar(50) DEFAULT NULL,
  `disk_use_home` varchar(50) DEFAULT NULL,
  `disk_use_data` varchar(50) DEFAULT NULL,
  `mem_total` varchar(20) DEFAULT NULL,
  `mem_use` varchar(20) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_union_1` (`ip`,`create_time`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_process
-- ----------------------------
DROP TABLE IF EXISTS `mysql_process`;
CREATE TABLE `mysql_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) DEFAULT NULL,
  `application_id` smallint(4) DEFAULT NULL,
  `pid` int(10) DEFAULT NULL,
  `user` varchar(50) DEFAULT NULL,
  `host` varchar(50) DEFAULT NULL,
  `db` varchar(30) DEFAULT NULL,
  `command` varchar(30) DEFAULT NULL,
  `time` varchar(200) NOT NULL DEFAULT '0',
  `status` varchar(50) DEFAULT NULL,
  `info` text,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_create_time` (`create_time`) USING BTREE,
  KEY `idx_server_id` (`server_id`) USING BTREE,
  KEY `idx_application_id` (`application_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_process_killed
-- ----------------------------
DROP TABLE IF EXISTS `mysql_process_killed`;
CREATE TABLE `mysql_process_killed` (
  `server_id` smallint(4) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_replication
-- ----------------------------
DROP TABLE IF EXISTS `mysql_replication`;
CREATE TABLE `mysql_replication` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) DEFAULT NULL,
  `application_id` smallint(4) DEFAULT NULL,
  `is_master` tinyint(2) DEFAULT '0',
  `is_slave` tinyint(2) unsigned DEFAULT '0',
  `read_only` varchar(10) DEFAULT NULL,
  `master_server` varchar(30) DEFAULT NULL,
  `master_port` varchar(20) DEFAULT NULL,
  `slave_io_run` varchar(20) DEFAULT NULL,
  `slave_sql_run` varchar(20) DEFAULT NULL,
  `delay` varchar(20) DEFAULT NULL,
  `current_binlog_file` varchar(30) DEFAULT NULL,
  `current_binlog_pos` varchar(30) DEFAULT NULL,
  `master_binlog_file` varchar(30) DEFAULT NULL,
  `master_binlog_pos` varchar(30) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_replication_history
-- ----------------------------
DROP TABLE IF EXISTS `mysql_replication_history`;
CREATE TABLE `mysql_replication_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) NOT NULL,
  `application_id` smallint(4) DEFAULT NULL,
  `is_master` tinyint(2) DEFAULT '0',
  `is_slave` tinyint(2) DEFAULT '0',
  `read_only` varchar(10) DEFAULT NULL,
  `master_server` varchar(30) DEFAULT NULL,
  `master_port` varchar(20) DEFAULT NULL,
  `slave_io_run` varchar(20) DEFAULT NULL,
  `slave_sql_run` varchar(20) DEFAULT NULL,
  `delay` varchar(20) DEFAULT NULL,
  `current_binlog_file` varchar(30) DEFAULT NULL,
  `current_binlog_pos` varchar(30) DEFAULT NULL,
  `master_binlog_file` varchar(30) DEFAULT NULL,
  `master_binlog_pos` varchar(30) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `YmdHi` bigint(18) DEFAULT NULL,
  PRIMARY KEY (`id`,`server_id`),
  KEY `idx_application_id` (`application_id`),
  KEY `idx_create_time` (`create_time`),
  KEY `idx_union_1` (`server_id`,`YmdHi`) USING BTREE,
  KEY `idx_ymdhi` (`YmdHi`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
/*!50500 PARTITION BY RANGE  COLUMNS(server_id)
(PARTITION server_1 VALUES LESS THAN (2) ENGINE = InnoDB,
 PARTITION server_2 VALUES LESS THAN (3) ENGINE = InnoDB,
 PARTITION server_3 VALUES LESS THAN (4) ENGINE = InnoDB,
 PARTITION server_4 VALUES LESS THAN (5) ENGINE = InnoDB,
 PARTITION server_5 VALUES LESS THAN (6) ENGINE = InnoDB,
 PARTITION server_6 VALUES LESS THAN (7) ENGINE = InnoDB,
 PARTITION server_7 VALUES LESS THAN (8) ENGINE = InnoDB,
 PARTITION server_8 VALUES LESS THAN (9) ENGINE = InnoDB,
 PARTITION server_9 VALUES LESS THAN (10) ENGINE = InnoDB,
 PARTITION server_10 VALUES LESS THAN (11) ENGINE = InnoDB,
 PARTITION server_11 VALUES LESS THAN (12) ENGINE = InnoDB,
 PARTITION server_12 VALUES LESS THAN (13) ENGINE = InnoDB,
 PARTITION server_13 VALUES LESS THAN (14) ENGINE = InnoDB,
 PARTITION server_14 VALUES LESS THAN (15) ENGINE = InnoDB,
 PARTITION server_15 VALUES LESS THAN (16) ENGINE = InnoDB,
 PARTITION server_16 VALUES LESS THAN (17) ENGINE = InnoDB,
 PARTITION server_17 VALUES LESS THAN (18) ENGINE = InnoDB,
 PARTITION server_18 VALUES LESS THAN (19) ENGINE = InnoDB,
 PARTITION server_19 VALUES LESS THAN (20) ENGINE = InnoDB,
 PARTITION server_20 VALUES LESS THAN (21) ENGINE = InnoDB,
 PARTITION server_other VALUES LESS THAN (MAXVALUE) ENGINE = InnoDB) */;

-- ----------------------------
-- Table structure for mysql_slow_query_review
-- ----------------------------
DROP TABLE IF EXISTS `mysql_slow_query_review`;
CREATE TABLE `mysql_slow_query_review` (
  `checksum` bigint(20) unsigned NOT NULL,
  `fingerprint` text NOT NULL,
  `sample` longtext NOT NULL,
  `first_seen` datetime DEFAULT NULL,
  `last_seen` datetime DEFAULT NULL,
  `reviewed_by` varchar(20) DEFAULT NULL,
  `reviewed_on` datetime DEFAULT NULL,
  `comments` text,
  `reviewed_status` tinyint(2) DEFAULT '0',
  `reviewed_star` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`checksum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_slow_query_review_history
-- ----------------------------
DROP TABLE IF EXISTS `mysql_slow_query_review_history`;
CREATE TABLE `mysql_slow_query_review_history` (
  `checksum` bigint(20) unsigned NOT NULL,
  `sample` text NOT NULL,
  `ts_min` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_max` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ts_cnt` float DEFAULT NULL,
  `Query_time_sum` float DEFAULT NULL,
  `Query_time_min` float DEFAULT NULL,
  `Query_time_max` float DEFAULT NULL,
  `Query_time_pct_95` float DEFAULT NULL,
  `Query_time_stddev` float DEFAULT NULL,
  `Query_time_median` float DEFAULT NULL,
  `Lock_time_sum` float DEFAULT NULL,
  `Lock_time_min` float DEFAULT NULL,
  `Lock_time_max` float DEFAULT NULL,
  `Lock_time_pct_95` float DEFAULT NULL,
  `Lock_time_stddev` float DEFAULT NULL,
  `Lock_time_median` float DEFAULT NULL,
  `Rows_sent_sum` float DEFAULT NULL,
  `Rows_sent_min` float DEFAULT NULL,
  `Rows_sent_max` float DEFAULT NULL,
  `Rows_sent_pct_95` float DEFAULT NULL,
  `Rows_sent_stddev` float DEFAULT NULL,
  `Rows_sent_median` float DEFAULT NULL,
  `Rows_examined_sum` float DEFAULT NULL,
  `Rows_examined_min` float DEFAULT NULL,
  `Rows_examined_max` float DEFAULT NULL,
  `Rows_examined_pct_95` float DEFAULT NULL,
  `Rows_examined_stddev` float DEFAULT NULL,
  `Rows_examined_median` float DEFAULT NULL,
  `Rows_affected_sum` float DEFAULT NULL,
  `Rows_affected_min` float DEFAULT NULL,
  `Rows_affected_max` float DEFAULT NULL,
  `Rows_affected_pct_95` float DEFAULT NULL,
  `Rows_affected_stddev` float DEFAULT NULL,
  `Rows_affected_median` float DEFAULT NULL,
  `Rows_read_sum` float DEFAULT NULL,
  `Rows_read_min` float DEFAULT NULL,
  `Rows_read_max` float DEFAULT NULL,
  `Rows_read_pct_95` float DEFAULT NULL,
  `Rows_read_stddev` float DEFAULT NULL,
  `Rows_read_median` float DEFAULT NULL,
  `Merge_passes_sum` float DEFAULT NULL,
  `Merge_passes_min` float DEFAULT NULL,
  `Merge_passes_max` float DEFAULT NULL,
  `Merge_passes_pct_95` float DEFAULT NULL,
  `Merge_passes_stddev` float DEFAULT NULL,
  `Merge_passes_median` float DEFAULT NULL,
  `InnoDB_IO_r_ops_min` float DEFAULT NULL,
  `InnoDB_IO_r_ops_max` float DEFAULT NULL,
  `InnoDB_IO_r_ops_pct_95` float DEFAULT NULL,
  `InnoDB_IO_r_ops_stddev` float DEFAULT NULL,
  `InnoDB_IO_r_ops_median` float DEFAULT NULL,
  `InnoDB_IO_r_bytes_min` float DEFAULT NULL,
  `InnoDB_IO_r_bytes_max` float DEFAULT NULL,
  `InnoDB_IO_r_bytes_pct_95` float DEFAULT NULL,
  `InnoDB_IO_r_bytes_stddev` float DEFAULT NULL,
  `InnoDB_IO_r_bytes_median` float DEFAULT NULL,
  `InnoDB_IO_r_wait_min` float DEFAULT NULL,
  `InnoDB_IO_r_wait_max` float DEFAULT NULL,
  `InnoDB_IO_r_wait_pct_95` float DEFAULT NULL,
  `InnoDB_IO_r_wait_stddev` float DEFAULT NULL,
  `InnoDB_IO_r_wait_median` float DEFAULT NULL,
  `InnoDB_rec_lock_wait_min` float DEFAULT NULL,
  `InnoDB_rec_lock_wait_max` float DEFAULT NULL,
  `InnoDB_rec_lock_wait_pct_95` float DEFAULT NULL,
  `InnoDB_rec_lock_wait_stddev` float DEFAULT NULL,
  `InnoDB_rec_lock_wait_median` float DEFAULT NULL,
  `InnoDB_queue_wait_min` float DEFAULT NULL,
  `InnoDB_queue_wait_max` float DEFAULT NULL,
  `InnoDB_queue_wait_pct_95` float DEFAULT NULL,
  `InnoDB_queue_wait_stddev` float DEFAULT NULL,
  `InnoDB_queue_wait_median` float DEFAULT NULL,
  `InnoDB_pages_distinct_min` float DEFAULT NULL,
  `InnoDB_pages_distinct_max` float DEFAULT NULL,
  `InnoDB_pages_distinct_pct_95` float DEFAULT NULL,
  `InnoDB_pages_distinct_stddev` float DEFAULT NULL,
  `InnoDB_pages_distinct_median` float DEFAULT NULL,
  `QC_Hit_cnt` float DEFAULT NULL,
  `QC_Hit_sum` float DEFAULT NULL,
  `Full_scan_cnt` float DEFAULT NULL,
  `Full_scan_sum` float DEFAULT NULL,
  `Full_join_cnt` float DEFAULT NULL,
  `Full_join_sum` float DEFAULT NULL,
  `Tmp_table_cnt` float DEFAULT NULL,
  `Tmp_table_sum` float DEFAULT NULL,
  `Tmp_table_on_disk_cnt` float DEFAULT NULL,
  `Tmp_table_on_disk_sum` float DEFAULT NULL,
  `Filesort_cnt` float DEFAULT NULL,
  `Filesort_sum` float DEFAULT NULL,
  `Filesort_on_disk_cnt` float DEFAULT NULL,
  `Filesort_on_disk_sum` float DEFAULT NULL,
  PRIMARY KEY (`checksum`,`ts_min`,`ts_max`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_status
-- ----------------------------
DROP TABLE IF EXISTS `mysql_status`;
CREATE TABLE `mysql_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` tinyint(4) DEFAULT NULL,
  `application_id` smallint(4) DEFAULT NULL,
  `connect` varchar(20) DEFAULT NULL,
  `uptime` int(11) NOT NULL DEFAULT '0',
  `version` varchar(30) DEFAULT NULL,
  `connections` varchar(20) DEFAULT NULL,
  `active` varchar(20) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_connections` (`connections`) USING BTREE,
  KEY `idx_active` (`active`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_status_ext
-- ----------------------------
DROP TABLE IF EXISTS `mysql_status_ext`;
CREATE TABLE `mysql_status_ext` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) DEFAULT NULL,
  `QPS` int(10) DEFAULT NULL,
  `TPS` int(10) DEFAULT NULL,
  `Bytes_received` int(10) DEFAULT NULL,
  `Bytes_sent` int(10) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_status_ext_history
-- ----------------------------
DROP TABLE IF EXISTS `mysql_status_ext_history`;
CREATE TABLE `mysql_status_ext_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) NOT NULL,
  `QPS` int(10) DEFAULT NULL,
  `TPS` int(10) DEFAULT NULL,
  `Bytes_received` int(10) DEFAULT NULL,
  `Bytes_sent` int(10) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `YmdHi` bigint(18) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`server_id`),
  KEY `idx_ymdhi` (`YmdHi`) USING BTREE,
  KEY `idx_union_1` (`server_id`,`YmdHi`) USING BTREE,
  KEY `idx_create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
/*!50500 PARTITION BY RANGE  COLUMNS(server_id)
(PARTITION server_1 VALUES LESS THAN (2) ENGINE = InnoDB,
 PARTITION server_2 VALUES LESS THAN (3) ENGINE = InnoDB,
 PARTITION server_3 VALUES LESS THAN (4) ENGINE = InnoDB,
 PARTITION server_4 VALUES LESS THAN (5) ENGINE = InnoDB,
 PARTITION server_5 VALUES LESS THAN (6) ENGINE = InnoDB,
 PARTITION server_6 VALUES LESS THAN (7) ENGINE = InnoDB,
 PARTITION server_7 VALUES LESS THAN (8) ENGINE = InnoDB,
 PARTITION server_8 VALUES LESS THAN (9) ENGINE = InnoDB,
 PARTITION server_9 VALUES LESS THAN (10) ENGINE = InnoDB,
 PARTITION server_10 VALUES LESS THAN (11) ENGINE = InnoDB,
 PARTITION server_11 VALUES LESS THAN (12) ENGINE = InnoDB,
 PARTITION server_12 VALUES LESS THAN (13) ENGINE = InnoDB,
 PARTITION server_13 VALUES LESS THAN (14) ENGINE = InnoDB,
 PARTITION server_14 VALUES LESS THAN (15) ENGINE = InnoDB,
 PARTITION server_15 VALUES LESS THAN (16) ENGINE = InnoDB,
 PARTITION server_16 VALUES LESS THAN (17) ENGINE = InnoDB,
 PARTITION server_17 VALUES LESS THAN (18) ENGINE = InnoDB,
 PARTITION server_18 VALUES LESS THAN (19) ENGINE = InnoDB,
 PARTITION server_19 VALUES LESS THAN (20) ENGINE = InnoDB,
 PARTITION server_20 VALUES LESS THAN (21) ENGINE = InnoDB,
 PARTITION server_other VALUES LESS THAN (MAXVALUE) ENGINE = InnoDB) */;

-- ----------------------------
-- Table structure for mysql_status_history
-- ----------------------------
DROP TABLE IF EXISTS `mysql_status_history`;
CREATE TABLE `mysql_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) NOT NULL,
  `application_id` smallint(4) DEFAULT NULL,
  `connect` varchar(20) DEFAULT NULL,
  `uptime` int(11) NOT NULL DEFAULT '0',
  `version` varchar(20) DEFAULT NULL,
  `connections` varchar(20) DEFAULT NULL,
  `active` varchar(20) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `YmdHi` bigint(18) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`,`server_id`),
  KEY `idx_ymdhi` (`YmdHi`) USING BTREE,
  KEY `idx_union_1` (`server_id`,`YmdHi`) USING BTREE,
  KEY `idx_create_time` (`create_time`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8
/*!50500 PARTITION BY RANGE  COLUMNS(server_id)
(PARTITION server_1 VALUES LESS THAN (2) ENGINE = InnoDB,
 PARTITION server_2 VALUES LESS THAN (3) ENGINE = InnoDB,
 PARTITION server_3 VALUES LESS THAN (4) ENGINE = InnoDB,
 PARTITION server_4 VALUES LESS THAN (5) ENGINE = InnoDB,
 PARTITION server_5 VALUES LESS THAN (6) ENGINE = InnoDB,
 PARTITION server_6 VALUES LESS THAN (7) ENGINE = InnoDB,
 PARTITION server_7 VALUES LESS THAN (8) ENGINE = InnoDB,
 PARTITION server_8 VALUES LESS THAN (9) ENGINE = InnoDB,
 PARTITION server_9 VALUES LESS THAN (10) ENGINE = InnoDB,
 PARTITION server_10 VALUES LESS THAN (11) ENGINE = InnoDB,
 PARTITION server_11 VALUES LESS THAN (12) ENGINE = InnoDB,
 PARTITION server_12 VALUES LESS THAN (13) ENGINE = InnoDB,
 PARTITION server_13 VALUES LESS THAN (14) ENGINE = InnoDB,
 PARTITION server_14 VALUES LESS THAN (15) ENGINE = InnoDB,
 PARTITION server_15 VALUES LESS THAN (16) ENGINE = InnoDB,
 PARTITION server_16 VALUES LESS THAN (17) ENGINE = InnoDB,
 PARTITION server_17 VALUES LESS THAN (18) ENGINE = InnoDB,
 PARTITION server_18 VALUES LESS THAN (19) ENGINE = InnoDB,
 PARTITION server_19 VALUES LESS THAN (20) ENGINE = InnoDB,
 PARTITION server_20 VALUES LESS THAN (21) ENGINE = InnoDB,
 PARTITION server_other VALUES LESS THAN (MAXVALUE) ENGINE = InnoDB) */;

-- ----------------------------
-- Table structure for mysql_widget_bigtable
-- ----------------------------
DROP TABLE IF EXISTS `mysql_widget_bigtable`;
CREATE TABLE `mysql_widget_bigtable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) DEFAULT NULL,
  `db_name` varchar(50) DEFAULT NULL,
  `table_name` varchar(100) DEFAULT NULL,
  `table_size` decimal(6,2) DEFAULT NULL,
  `table_comment` varchar(50) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_widget_connect
-- ----------------------------
DROP TABLE IF EXISTS `mysql_widget_connect`;
CREATE TABLE `mysql_widget_connect` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) NOT NULL,
  `connect_server` varchar(100) NOT NULL,
  `connect_user` varchar(50) DEFAULT NULL,
  `connect_db` varchar(50) DEFAULT NULL,
  `connect_count` int(10) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mysql_widget_hit_rate
-- ----------------------------
DROP TABLE IF EXISTS `mysql_widget_hit_rate`;
CREATE TABLE `mysql_widget_hit_rate` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `server_id` smallint(4) DEFAULT NULL,
  `Query_cache_hits` varchar(100) DEFAULT NULL,
  `Key_buffer_read_hits` varchar(100) DEFAULT NULL,
  `Key_buffer_write_hits` varchar(100) DEFAULT NULL,
  `Thread_cache_hits` varchar(100) DEFAULT NULL,
  `Key_blocks_used_rate` varchar(100) DEFAULT NULL,
  `Created_tmp_disk_tables_rate` varchar(100) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options` (
  `name` varchar(50) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `group` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for servers
-- ----------------------------
DROP TABLE IF EXISTS `servers`;
CREATE TABLE `servers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `host` varchar(30) DEFAULT NULL,
  `port` varchar(10) DEFAULT NULL,
  `status` tinyint(2) DEFAULT '1' COMMENT '1:监控 0：不监控',
  `application_id` smallint(4) DEFAULT NULL,
  `send_mail` tinyint(2) DEFAULT '1',
  `alarm_connections` tinyint(2) DEFAULT '1',
  `alarm_active` tinyint(2) DEFAULT '1',
  `alarm_repl_status` tinyint(2) DEFAULT NULL,
  `alarm_repl_delay` tinyint(2) DEFAULT '1',
  `threshold_connections` varchar(20) DEFAULT NULL,
  `threshold_active` varchar(20) DEFAULT NULL,
  `threshold_repl_delay` varchar(20) DEFAULT NULL,
  `slow_query` tinyint(2) DEFAULT '0',
  `is_delete` tinyint(1) DEFAULT '0',
  `display_order` smallint(4) DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_host` (`host`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
