<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.4
 * @ Decoder version: 1.0.2
 * @ Release: 10/08/2022
 */

// Decoded file for php version 74.
namespace App\Console\Commands;

class MigrateToAikoPanel extends \Illuminate\Console\Command
{
    protected $signature = "migrateToAikoPanel {version?}";
    protected $description = "Migrate to AikoPanel";
    public function handle()
    {
        $_obfuscated_0D0F2A231C0B2D09300B3D3639400C2B5B080F25233E01_ = $this->argument("version");
        $_obfuscated_0D27080A0229231D251E3C1D0B210E291F403610231D11_ = ["xflash" => ["DROP TABLE IF EXISTS `migrations`;", ""], "aikopanelv1" => ["DROP TABLE IF EXISTS `migrations`;", "ALTER TABLE `v2_knowledge` DROP `free`;", "ALTER TABLE `v2_plan` DROP `idapple_max_count`;", "ALTER TABLE `v2_plan` DROP `user_sni`;", "ALTER TABLE `v2_plan` DROP `renew_count_idapple`;", "ALTER TABLE `v2_plan` DROP `two_month_price`;", "ALTER TABLE `v2_server_hysteria` DROP `report_status`;", "ALTER TABLE `v2_server_hysteria` DROP `node_speedlimit`;", "ALTER TABLE `v2_server_hysteria` ADD `version` INT NOT NULL AFTER `id`;", "ALTER TABLE `v2_server_hysteria` ADD `obfs` VARCHAR(64) NULL DEFAULT NULL AFTER `down_mbps`;", "ALTER TABLE `v2_server_hysteria` ADD `obfs_password` VARCHAR(255) NULL DEFAULT NULL AFTER `obfs`;", "ALTER TABLE `v2_server_shadowsocks` DROP `report_status`;", "ALTER TABLE `v2_server_shadowsocks` DROP `node_speedlimit`;", "ALTER TABLE `v2_server_trojan` DROP `report_status`;", "ALTER TABLE `v2_server_trojan` DROP `node_speedlimit`;", "ALTER TABLE `v2_server_trojan` ADD `network` VARCHAR(11) NULL DEFAULT NULL AFTER `server_port`;", "ALTER TABLE `v2_server_trojan` ADD `network_settings` TEXT NULL AFTER `network`;", "ALTER TABLE `v2_server_vmess` DROP `report_status`;", "ALTER TABLE `v2_server_vmess` DROP `node_speedlimit`;", "ALTER TABLE `v2_user` DROP `idapple_max_count`;", "ALTER TABLE `v2_user` DROP `user_sni`;", "ALTER TABLE `v2_user` DROP `count_idapple`;", "CREATE TABLE `v2_server_vless` ( \n                    `id` INT AUTO_INCREMENT PRIMARY KEY, \n                    `group_id` TEXT NOT NULL, \n                    `route_id` TEXT NULL, \n                    `name` VARCHAR(255) NOT NULL,\n                    `parent_id` INT NULL, \n                    `host` VARCHAR(255) NOT NULL, \n                    `port` INT NOT NULL, \n                    `server_port` INT NOT NULL, \n                    `tls` BOOLEAN NOT NULL, \n                    `tls_settings` TEXT NULL, \n                    `flow` VARCHAR(64) NULL, \n                    `network` VARCHAR(11) NOT NULL, \n                    `network_settings` TEXT NULL, \n                    `tags` TEXT NULL, \n                    `rate` VARCHAR(11) NOT NULL, \n                    `show` BOOLEAN DEFAULT 0, \n                    `sort` INT NULL, \n                    `created_at` INT NOT NULL, \n                    `updated_at` INT NOT NULL\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"], "nflash" => ["DROP TABLE `v2_failed_jobs`;", "DROP TABLE `v2_lsgd`;", "DROP TABLE `v2_mail_log`;", "DROP TABLE `v2_migrations`;", "DROP TABLE `v2_notice`;", "DROP TABLE `v2_online_ip`;", "DROP TABLE `v2_order`;", "DROP TABLE `v2_order_stat`;", "DROP TABLE `v2_payment`;", "DROP TABLE `v2_server_area`;", "DROP TABLE `v2_server_hysteria`;", "DROP TABLE `v2_server_shadowsocks`;", "DROP TABLE `v2_server_trojan`;", "DROP TABLE `v2_server_vmess`;", "DROP TABLE `v2_subscribe`;", "DROP TABLE `v2_sub_log`;", "DROP TABLE `v2_ticket`;", "DROP TABLE `v2_ticket_message`;", "DROP TABLE `v2_traffic_server_log`;", "DROP TABLE `v2_traffic_user_log`;", "ALTER TABLE `v2_coupon` DROP INDEX `code`;", "ALTER TABLE `v2_coupon` ADD `show` TINYINT(1) NOT NULL DEFAULT '0' AFTER `value`;", "ALTER TABLE `v2_coupon` ADD `limit_period` VARCHAR(255) NULL DEFAULT NULL AFTER `limit_plan_ids`;", "ALTER TABLE `v2_knowledge` DROP `free`;", "ALTER TABLE `v2_plan` DROP `transfer_enable_value`;", "ALTER TABLE `v2_plan` DROP `limit_device`;", "ALTER TABLE `v2_plan` DROP `end_sec`;", "ALTER TABLE `v2_plan` DROP `start_sec`;", "ALTER TABLE `v2_plan` DROP `time_limit`;", "ALTER TABLE `v2_plan` DROP `allow_ids`;", "ALTER TABLE `v2_plan` DROP `prices`;", "ALTER TABLE `v2_plan` ADD `group_id` INT NOT NULL AFTER `id`;", "ALTER TABLE `v2_plan` ADD `speed_limit` INT(11) NULL DEFAULT NULL AFTER `name`;", "ALTER TABLE `v2_plan` ADD `device_limit` INT(11) NULL DEFAULT NULL AFTER `speed_limit`;", "ALTER TABLE `v2_plan` ADD `month_price` INT(11) NULL DEFAULT NULL AFTER `content`;", "ALTER TABLE `v2_plan` ADD `quarter_price` INT(11) NULL DEFAULT NULL AFTER `month_price`;", "ALTER TABLE `v2_plan` ADD `half_year_price` INT(11) NULL DEFAULT NULL AFTER `quarter_price`;", "ALTER TABLE `v2_plan` ADD `year_price` INT(11) NULL DEFAULT NULL AFTER `half_year_price`;", "ALTER TABLE `v2_plan` ADD `two_year_price` INT(11) NULL DEFAULT NULL AFTER `year_price`;", "ALTER TABLE `v2_plan` ADD `three_year_price` INT(11) NULL DEFAULT NULL AFTER `two_year_price`;", "ALTER TABLE `v2_plan` ADD `onetime_price` INT(11) NULL DEFAULT NULL AFTER `three_year_price`;", "ALTER TABLE `v2_plan` ADD `reset_price` INT(11) NULL DEFAULT NULL AFTER `three_year_price`;", "ALTER TABLE `v2_plan` ADD `capacity_limit` INT(11) NULL DEFAULT NULL AFTER `reset_price`;", "ALTER TABLE `v2_user` DROP `limit_device`;", "ALTER TABLE `v2_user` DROP `sni`;", "ALTER TABLE `v2_user` DROP `level`;", "ALTER TABLE `v2_user` DROP `total_balance`;", "ALTER TABLE `v2_user` DROP `device_online`;", "ALTER TABLE `v2_user` DROP `ip_online`;", "ALTER TABLE `v2_user` DROP `time_share_subscribe`;", "ALTER TABLE `v2_user` DROP `limit_speed`;", "ALTER TABLE `v2_user` DROP INDEX `created_at`;", "ALTER TABLE `v2_user` DROP INDEX `updated_at`;", "ALTER TABLE `v2_user` DROP INDEX `v2_user_suspend_at_index`;", "ALTER TABLE `v2_user` DROP INDEX `expired_at`;", "ALTER TABLE `v2_user` DROP INDEX `token`;", "ALTER TABLE `v2_user` DROP INDEX `plan_id`;", "ALTER TABLE `v2_user` DROP INDEX `telegram_id`;", "ALTER TABLE `v2_user` DROP INDEX `password_email`;", "ALTER TABLE `v2_user` DROP INDEX `email`;", "ALTER TABLE `v2_user` DROP `last_submit_ip`;", "ALTER TABLE `v2_user` DROP `register_ip`;", "ALTER TABLE `v2_user` DROP `order_day`;", "ALTER TABLE `v2_user` DROP `suspend_at`;", "ALTER TABLE `v2_user` DROP `suspend_type`;", "ALTER TABLE `v2_user` ADD `transfer_enable` BIGINT(20) NOT NULL DEFAULT '0' AFTER `d`;", "ALTER TABLE `v2_user` ADD `group_id` INT(11) NULL DEFAULT NULL AFTER `uuid`;", "ALTER TABLE `v2_user` ADD `speed_limit` INT(11) NULL DEFAULT NULL AFTER `group_id`;", "ALTER TABLE `v2_user` ADD `device_limit` INT(11) NULL DEFAULT NULL AFTER `speed_limit`;", "CREATE TABLE `failed_jobs` (\n                    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,\n                    `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,\n                    `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,\n                    `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,\n                    `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,\n                    `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;", "CREATE TABLE `v2_commission_log` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `invite_user_id` int(11) NOT NULL,\n                    `user_id` int(11) NOT NULL,\n                    `trade_no` char(36) NOT NULL,\n                    `order_amount` int(11) NOT NULL,\n                    `get_amount` int(11) NOT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_log` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `title` text NOT NULL,\n                    `level` varchar(11) DEFAULT NULL,\n                    `host` varchar(255) DEFAULT NULL,\n                    `uri` varchar(255) NOT NULL,\n                    `method` varchar(11) NOT NULL,\n                    `data` text,\n                    `ip` varchar(128) DEFAULT NULL,\n                    `context` text,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_mail_log` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `email` varchar(64) NOT NULL,\n                    `subject` varchar(255) NOT NULL,\n                    `template_name` varchar(255) NOT NULL,\n                    `error` text,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_notice` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `title` varchar(255) NOT NULL,\n                    `content` text NOT NULL,\n                    `show` tinyint(1) NOT NULL DEFAULT '0',\n                    `img_url` varchar(255) DEFAULT NULL,\n                    `tags` varchar(255) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_order` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `invite_user_id` int(11) DEFAULT NULL,\n                    `user_id` int(11) NOT NULL,\n                    `plan_id` int(11) NOT NULL,\n                    `coupon_id` int(11) DEFAULT NULL,\n                    `payment_id` int(11) DEFAULT NULL,\n                    `type` int(11) NOT NULL ,\n                    `period` varchar(255) NOT NULL,\n                    `trade_no` varchar(36) NOT NULL,\n                    `callback_no` varchar(255) DEFAULT NULL,\n                    `total_amount` int(11) NOT NULL,\n                    `handling_amount` int(11) DEFAULT NULL,\n                    `discount_amount` int(11) DEFAULT NULL,\n                    `surplus_amount` int(11) DEFAULT NULL ,\n                    `refund_amount` int(11) DEFAULT NULL ,\n                    `balance_amount` int(11) DEFAULT NULL ,\n                    `surplus_order_ids` text ,\n                    `status` tinyint(1) NOT NULL DEFAULT '0',\n                    `commission_status` tinyint(1) NOT NULL DEFAULT '0',\n                    `commission_balance` int(11) NOT NULL DEFAULT '0',\n                    `actual_commission_balance` int(11) DEFAULT NULL,\n                    `paid_at` int(11) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`),\n                    UNIQUE KEY `trade_no` (`trade_no`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_payment` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `uuid` char(32) NOT NULL,\n                    `payment` varchar(16) NOT NULL,\n                    `name` varchar(255) NOT NULL,\n                    `icon` varchar(255) DEFAULT NULL,\n                    `config` text NOT NULL,\n                    `notify_domain` varchar(128) DEFAULT NULL,\n                    `handling_fee_fixed` int(11) DEFAULT NULL,\n                    `handling_fee_percent` decimal(5,2) DEFAULT NULL,\n                    `enable` tinyint(1) NOT NULL DEFAULT '0',\n                    `sort` int(11) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_server_group` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `name` varchar(255) NOT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_server_hysteria` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `version` int(11) NOT NULL,\n                    `group_id` varchar(255) NOT NULL,\n                    `route_id` varchar(255) DEFAULT NULL,\n                    `name` varchar(255) NOT NULL,\n                    `parent_id` int(11) DEFAULT NULL,\n                    `host` varchar(255) NOT NULL,\n                    `port` varchar(11) NOT NULL,\n                    `server_port` int(11) NOT NULL,\n                    `tags` varchar(255) DEFAULT NULL,\n                    `rate` varchar(11) NOT NULL,\n                    `show` tinyint(1) NOT NULL DEFAULT '0',\n                    `sort` int(11) DEFAULT NULL,\n                    `up_mbps` int(11) NOT NULL,\n                    `down_mbps` int(11) NOT NULL,\n                    `obfs` varchar(64) DEFAULT NULL,\n                    `obfs_password` varchar(255) DEFAULT NULL,\n                    `server_name` varchar(64) DEFAULT NULL,\n                    `insecure` tinyint(1) NOT NULL DEFAULT '0',\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_server_route` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `remarks` varchar(255) NOT NULL,\n                    `match` text NOT NULL,\n                    `action` varchar(11) NOT NULL,\n                    `action_value` varchar(255) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_server_shadowsocks` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `group_id` varchar(255) NOT NULL,\n                    `route_id` varchar(255) DEFAULT NULL,\n                    `parent_id` int(11) DEFAULT NULL,\n                    `tags` varchar(255) DEFAULT NULL,\n                    `name` varchar(255) NOT NULL,\n                    `rate` varchar(11) NOT NULL,\n                    `host` varchar(255) NOT NULL,\n                    `port` varchar(11) NOT NULL,\n                    `server_port` int(11) NOT NULL,\n                    `cipher` varchar(255) NOT NULL,\n                    `obfs` char(11) DEFAULT NULL,\n                    `obfs_settings` varchar(255) DEFAULT NULL,\n                    `show` tinyint(4) NOT NULL DEFAULT '0',\n                    `sort` int(11) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_server_trojan` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT ,\n                    `group_id` varchar(255) NOT NULL ,\n                    `route_id` varchar(255) DEFAULT NULL,\n                    `parent_id` int(11) DEFAULT NULL ,\n                    `tags` varchar(255) DEFAULT NULL ,\n                    `name` varchar(255) NOT NULL ,\n                    `rate` varchar(11) NOT NULL ,\n                    `host` varchar(255) NOT NULL ,\n                    `port` varchar(11) NOT NULL ,\n                    `server_port` int(11) NOT NULL ,\n                    `network` varchar(11) DEFAULT NULL ,\n                    `network_settings` text ,\n                    `allow_insecure` tinyint(1) NOT NULL DEFAULT '0' ,\n                    `server_name` varchar(255) DEFAULT NULL,\n                    `show` tinyint(1) NOT NULL DEFAULT '0' ,\n                    `sort` int(11) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_server_vless` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `group_id` text NOT NULL,\n                    `route_id` text,\n                    `name` varchar(255) NOT NULL,\n                    `parent_id` int(11) DEFAULT NULL,\n                    `host` varchar(255) NOT NULL,\n                    `port` int(11) NOT NULL,\n                    `server_port` int(11) NOT NULL,\n                    `tls` tinyint(1) NOT NULL,\n                    `tls_settings` text,\n                    `flow` varchar(64) DEFAULT NULL,\n                    `network` varchar(11) NOT NULL,\n                    `network_settings` text,\n                    `tags` text,\n                    `rate` varchar(11) NOT NULL,\n                    `show` tinyint(1) NOT NULL DEFAULT '0',\n                    `sort` int(11) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_server_vmess` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `group_id` varchar(255) NOT NULL,\n                    `route_id` varchar(255) DEFAULT NULL,\n                    `name` varchar(255) NOT NULL,\n                    `parent_id` int(11) DEFAULT NULL,\n                    `host` varchar(255) NOT NULL,\n                    `port` varchar(11) NOT NULL,\n                    `server_port` int(11) NOT NULL,\n                    `tls` tinyint(4) NOT NULL DEFAULT '0',\n                    `tags` varchar(255) DEFAULT NULL,\n                    `rate` varchar(11) NOT NULL,\n                    `network` varchar(11) NOT NULL,\n                    `rules` text,\n                    `networkSettings` text,\n                    `tlsSettings` text,\n                    `ruleSettings` text,\n                    `dnsSettings` text,\n                    `show` tinyint(1) NOT NULL DEFAULT '0',\n                    `sort` int(11) DEFAULT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_stat` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `record_at` int(11) NOT NULL,\n                    `record_type` char(1) NOT NULL,\n                    `order_count` int(11) NOT NULL ,\n                    `order_total` int(11) NOT NULL ,\n                    `commission_count` int(11) NOT NULL,\n                    `commission_total` int(11) NOT NULL ,\n                    `paid_count` int(11) NOT NULL,\n                    `paid_total` int(11) NOT NULL,\n                    `register_count` int(11) NOT NULL,\n                    `invite_count` int(11) NOT NULL,\n                    `transfer_used_total` varchar(32) NOT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`),\n                    UNIQUE KEY `record_at` (`record_at`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_stat_server` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `server_id` int(11) NOT NULL ,\n                    `server_type` char(11) NOT NULL ,\n                    `u` bigint(20) NOT NULL,\n                    `d` bigint(20) NOT NULL,\n                    `record_type` char(1) NOT NULL ,\n                    `record_at` int(11) NOT NULL ,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`),\n                    UNIQUE KEY `server_id_server_type_record_at` (`server_id`,`server_type`,`record_at`),\n                    KEY `record_at` (`record_at`),\n                    KEY `server_id` (`server_id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_stat_user` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `user_id` int(11) NOT NULL,\n                    `server_rate` decimal(10,2) NOT NULL,\n                    `u` bigint(20) NOT NULL,\n                    `d` bigint(20) NOT NULL,\n                    `record_type` char(2) NOT NULL,\n                    `record_at` int(11) NOT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`),\n                    UNIQUE KEY `server_rate_user_id_record_at` (`server_rate`,`user_id`,`record_at`),\n                    KEY `user_id` (`user_id`),\n                    KEY `record_at` (`record_at`),\n                    KEY `server_rate` (`server_rate`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;", "CREATE TABLE `v2_ticket` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `user_id` int(11) NOT NULL,\n                    `subject` varchar(255) NOT NULL,\n                    `level` tinyint(1) NOT NULL,\n                    `status` tinyint(1) NOT NULL DEFAULT '0',\n                    `reply_status` tinyint(1) NOT NULL DEFAULT '1',\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_ticket_message` (\n                    `id` int(11) NOT NULL AUTO_INCREMENT,\n                    `user_id` int(11) NOT NULL,\n                    `ticket_id` int(11) NOT NULL,\n                    `message` text CHARACTER SET utf8mb4 NOT NULL,\n                    `created_at` int(11) NOT NULL,\n                    `updated_at` int(11) NOT NULL,\n                    PRIMARY KEY (`id`)\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"], "v2b1.7.4" => ["ALTER TABLE `v2_server_trojan` ADD `network` VARCHAR(11) NULL DEFAULT NULL AFTER `server_port`;", "ALTER TABLE `v2_server_trojan` ADD `network_settings` TEXT NULL AFTER `network`;", "CREATE TABLE `v2_server_vless` ( \n                    `id` INT AUTO_INCREMENT PRIMARY KEY, \n                    `group_id` TEXT NOT NULL, \n                    `route_id` TEXT NULL, \n                    `name` VARCHAR(255) NOT NULL,\n                    `parent_id` INT NULL, \n                    `host` VARCHAR(255) NOT NULL, \n                    `port` INT NOT NULL, \n                    `server_port` INT NOT NULL, \n                    `tls` BOOLEAN NOT NULL, \n                    `tls_settings` TEXT NULL, \n                    `flow` VARCHAR(64) NULL, \n                    `network` VARCHAR(11) NOT NULL, \n                    `network_settings` TEXT NULL, \n                    `tags` TEXT NULL, \n                    `rate` VARCHAR(11) NOT NULL, \n                    `show` BOOLEAN DEFAULT 0, \n                    `sort` INT NULL, \n                    `created_at` INT NOT NULL, \n                    `updated_at` INT NOT NULL\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"], "v2b1.7.3" => ["ALTER TABLE `v2_server_trojan` ADD `network` VARCHAR(11) NULL DEFAULT NULL AFTER `server_port`;", "ALTER TABLE `v2_server_trojan` ADD `network_settings` TEXT NULL AFTER `network`;", "ALTER TABLE `v2_stat_order` RENAME TO `v2_stat`;", "ALTER TABLE `v2_stat` CHANGE COLUMN order_amount order_total INT COMMENT 'Tổng số đơn đặt hàng';", "ALTER TABLE `v2_stat` CHANGE COLUMN commission_amount commission_total INT COMMENT 'Tổng hoa hồng';", "ALTER TABLE `v2_stat`\n                    ADD COLUMN paid_count INT NULL,\n                    ADD COLUMN paid_total INT NULL,\n                    ADD COLUMN register_count INT NULL,\n                    ADD COLUMN invite_count INT NULL,\n                    ADD COLUMN transfer_used_total VARCHAR(32) NULL;\n                ", "CREATE TABLE `v2_log` (\n                    `id` INT AUTO_INCREMENT PRIMARY KEY,\n                    `title` TEXT NOT NULL,\n                    `level` VARCHAR(11) NULL,\n                    `host` VARCHAR(255) NULL,\n                    `uri` VARCHAR(255) NOT NULL,\n                    `method` VARCHAR(11) NOT NULL,\n                    `data` TEXT NULL,\n                    `ip` VARCHAR(128) NULL,\n                    `context` TEXT NULL,\n                    `created_at` INT NOT NULL,\n                    `updated_at` INT NOT NULL\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_server_hysteria` (\n                    `id` INT AUTO_INCREMENT PRIMARY KEY,\n                    `group_id` VARCHAR(255) NOT NULL,\n                    `route_id` VARCHAR(255) NULL,\n                    `name` VARCHAR(255) NOT NULL,\n                    `parent_id` INT NULL,\n                    `host` VARCHAR(255) NOT NULL,\n                    `port` VARCHAR(11) NOT NULL,\n                    `server_port` INT NOT NULL,\n                    `tags` VARCHAR(255) NULL,\n                    `rate` VARCHAR(11) NOT NULL,\n                    `show` BOOLEAN DEFAULT FALSE,\n                    `sort` INT NULL,\n                    `up_mbps` INT NOT NULL,\n                    `down_mbps` INT NOT NULL,\n                    `server_name` VARCHAR(64) NULL,\n                    `insecure` BOOLEAN DEFAULT FALSE,\n                    `created_at` INT NOT NULL,\n                    `updated_at` INT NOT NULL\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;", "CREATE TABLE `v2_server_vless` (\n                    `id` INT AUTO_INCREMENT PRIMARY KEY, \n                    `group_id` TEXT NOT NULL, \n                    `route_id` TEXT NULL, \n                    `name` VARCHAR(255) NOT NULL, \n                    `parent_id` INT NULL, \n                    `host` VARCHAR(255) NOT NULL, \n                    `port` INT NOT NULL, \n                    `server_port` INT NOT NULL, \n                    `tls` BOOLEAN NOT NULL, \n                    `tls_settings` TEXT NULL, \n                    `flow` VARCHAR(64) NULL, \n                    `network` VARCHAR(11) NOT NULL, \n                    `network_settings` TEXT NULL, \n                    `tags` TEXT NULL, \n                    `rate` VARCHAR(11) NOT NULL, \n                    `show` BOOLEAN DEFAULT FALSE, \n                    `sort` INT NULL, \n                    `created_at` INT NOT NULL, \n                    `updated_at` INT NOT NULL\n                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"]];
        if(!$_obfuscated_0D0F2A231C0B2D09300B3D3639400C2B5B080F25233E01_) {
            $_obfuscated_0D0F2A231C0B2D09300B3D3639400C2B5B080F25233E01_ = $this->choice("Vui lòng chọn phiên bản Panel trước khi bạn di chuyển:", array_keys($_obfuscated_0D27080A0229231D251E3C1D0B210E291F403610231D11_));
        }
        if(array_key_exists($_obfuscated_0D0F2A231C0B2D09300B3D3639400C2B5B080F25233E01_, $_obfuscated_0D27080A0229231D251E3C1D0B210E291F403610231D11_)) {
            try {
                foreach ($_obfuscated_0D27080A0229231D251E3C1D0B210E291F403610231D11_[$_obfuscated_0D0F2A231C0B2D09300B3D3639400C2B5B080F25233E01_] as $_obfuscated_0D041D1E35302611330610073C2807090405091F032532_) {
                    \DB::statement($_obfuscated_0D041D1E35302611330610073C2807090405091F032532_);
                }
                $this->info("1️⃣、Sửa lỗi chênh lệch cơ sở dữ liệu thành công");
                $this->info("2️⃣、Cập nhật tệp thành công");
                $this->call("Database\\Seeders\\AikoPanelMigrations");
                $this->info("3️⃣、Hồ sơ convert DB liệu thành công");
                $this->call("aikopanel:update");
                $this->info("4️⃣、Cập nhật thành công");
                $this->info("🎉：Chuyển thành công từ phiên bản " . $_obfuscated_0D0F2A231C0B2D09300B3D3639400C2B5B080F25233E01_);
            } catch (\Exception $ex) {
                $this->info("🚨：Chuyển đổi DB thất bại");
                $this->error("Lỗi: " . $_obfuscated_0D39113705281E271206151E01101F0A27123C24394011_->getMessage());
            }
        } else {
            $this->error("Phiên bản bạn đã nhập không được tìm thấy");
        }
    }
}

?>