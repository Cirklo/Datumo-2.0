{\rtf1\ansi\ansicpg1252\deff0\deflang1033{\fonttbl{\f0\fnil\fcharset0 Courier New;}{\f1\fswiss\fcharset0 Arial;}}
{\*\generator Msftedit 5.41.15.1515;}\viewkind4\uc1\pard\f0\fs20 -- phpMyAdmin SQL Dump\par
-- version 3.3.7deb3build0.10.10.1\par
-- http://www.phpmyadmin.net\par
--\par
-- M\'c3\'a1quina: localhost\par
-- Data de Cria\'c3\'a7\'c3\'a3o: 11-Abr-2011 \'c3\~s 11:53\par
-- Vers\'c3\'a3o do servidor: 5.1.49\par
-- vers\'c3\'a3o do PHP: 5.3.3-1ubuntu9.3\par
\par
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";\par
\par
\par
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\par
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\par
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\par
/*!40101 SET NAMES utf8 */;\par
\par
--\par
-- Base de Dados: `requisitions`\par
--\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `access`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `access` (\par
  `access_id` int(11) NOT NULL,\par
  `access_permission` varchar(50) CHARACTER SET latin1 NOT NULL,\par
  PRIMARY KEY (`access_id`)\par
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;\par
\par
--\par
-- Extraindo dados da tabela `access`\par
--\par
\par
INSERT INTO `access` (`access_id`, `access_permission`) VALUES\par
(0, 'View'),\par
(1, 'Update'),\par
(2, 'Delete'),\par
(3, 'Update, Delete'),\par
(4, 'Add'),\par
(5, 'Add, Update'),\par
(6, 'Add, Delete'),\par
(7, 'Add, Update, Delete'),\par
(8, 'Request'),\par
(9, 'Request, Update'),\par
(10, 'Request, Delete'),\par
(11, 'Request, Update, Delete'),\par
(12, 'Request. Add'),\par
(13, 'Request, Add, Update'),\par
(14, 'Request, Add, Delete'),\par
(15, 'Request, Add, Update, Delete');\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `admin`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `admin` (\par
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `admin_user` int(11) NOT NULL,\par
  `admin_table` varchar(20) CHARACTER SET latin1 NOT NULL,\par
  `admin_permission` int(11) NOT NULL,\par
  PRIMARY KEY (`admin_id`),\par
  KEY `admin_user` (`admin_user`),\par
  KEY `admin_permission` (`admin_permission`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='With this table you can give access to specific tables' AUTO_INCREMENT=1316 ;\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `announcement`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `announcement` (\par
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `announcement_title` varchar(100) COLLATE utf8_bin NOT NULL,\par
  `announcement_message` text COLLATE utf8_bin,\par
  `announcement_date` date NOT NULL COMMENT 'Announcement date.',\par
  `announcement_end_date` date DEFAULT NULL COMMENT 'The announcement will no longer be available after the end date.',\par
  PRIMARY KEY (`announcement_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Announcements and promotions' AUTO_INCREMENT=4 ;\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `bool`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `bool` (\par
  `bool_id` int(11) NOT NULL,\par
  `bool_type` varchar(6) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`bool_id`)\par
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;\par
\par
--\par
-- Extraindo dados da tabela `bool`\par
--\par
\par
INSERT INTO `bool` (`bool_id`, `bool_type`) VALUES\par
(0, 'FALSE'),\par
(1, 'TRUE');\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `confidentiality`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `confidentiality` (\par
  `confidentiality_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `confidentiality_name` varchar(10) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`confidentiality_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;\par
\par
--\par
-- Extraindo dados da tabela `confidentiality`\par
--\par
\par
INSERT INTO `confidentiality` (`confidentiality_id`, `confidentiality_name`) VALUES\par
(0, 'Undefined'),\par
(1, 'Public'),\par
(2, 'Private');\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `level`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `level` (\par
  `level_id` int(11) NOT NULL,\par
  `level_name` varchar(15) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`level_id`)\par
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;\par
\par
--\par
-- Extraindo dados da tabela `level`\par
--\par
\par
INSERT INTO `level` (`level_id`, `level_name`) VALUES\par
(0, 'Administrator'),\par
(1, 'Manager'),\par
(2, 'Regular User');\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `mainconfig`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `mainconfig` (\par
  `mainconfig_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `mainconfig_institute` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_shortname` varchar(10) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_url` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_email` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_password` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_host` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_port` int(11) NOT NULL,\par
  `mainconfig_SMTPSecure` varchar(10) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,\par
  `mainconfig_SMTPAuth` tinyint(4) NOT NULL,\par
  PRIMARY KEY (`mainconfig_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;\par
\par
--\par
-- Extraindo dados da tabela `mainconfig`\par
--\par
\par
INSERT INTO `mainconfig` (`mainconfig_id`, `mainconfig_institute`, `mainconfig_shortname`, `mainconfig_url`, `mainconfig_email`, `mainconfig_password`, `mainconfig_host`, `mainconfig_port`, `mainconfig_SMTPSecure`, `mainconfig_SMTPAuth`) VALUES\par
(1, 'IGC', 'IGC', 'www.igc.gulbenkian.pt', 'uicweb@igc.gulbenkian.pt', 'uicweb!2010', 'mail.igc.gulbenkian.pt', 25, 'none', 0);\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `menu`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `menu` (\par
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `menu_name` varchar(20) COLLATE utf8_bin NOT NULL,\par
  `menu_description` varchar(50) COLLATE utf8_bin NOT NULL,\par
  `menu_plugin` int(11) NOT NULL,\par
  `menu_url` varchar(50) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`menu_id`),\par
  KEY `menu_plugin` (`menu_plugin`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;\par
\par
--\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `param`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `param` (\par
  `param_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `param_report` int(11) NOT NULL,\par
  `param_name` varchar(25) COLLATE utf8_bin NOT NULL,\par
  `param_datatype` varchar(25) COLLATE utf8_bin NOT NULL,\par
  `param_reference` varchar(25) COLLATE utf8_bin DEFAULT NULL,\par
  PRIMARY KEY (`param_id`),\par
  KEY `param_report` (`param_report`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;\par
\par
--\par
-- Extraindo dados da tabela `param`\par
---- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `plugin`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `plugin` (\par
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `plugin_name` varchar(20) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`plugin_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;\par
\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `report`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `report` (\par
  `report_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `report_name` varchar(20) COLLATE utf8_bin NOT NULL,\par
  `report_description` varchar(150) COLLATE utf8_bin NOT NULL,\par
  `report_query` varchar(1000) COLLATE utf8_bin NOT NULL,\par
  `report_user` int(11) NOT NULL,\par
  `report_conf` int(11) NOT NULL,\par
  PRIMARY KEY (`report_id`),\par
  KEY `report_user` (`report_user`),\par
  KEY `report_conf` (`report_conf`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;\par
\par
--\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `resaccess`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `resaccess` (\par
  `resaccess_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `resaccess_user` int(11) NOT NULL,\par
  `resaccess_table` varchar(30) NOT NULL,\par
  `resaccess_column` varchar(30) NOT NULL,\par
  `resaccess_value` varchar(30) NOT NULL,\par
  PRIMARY KEY (`resaccess_id`),\par
  KEY `resaccess_user` (`resaccess_user`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;\par
\par
--\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `restree`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `restree` (\par
  `restree_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `restree_user` int(11) NOT NULL,\par
  `restree_name` int(11) NOT NULL,\par
  `restree_access` int(11) NOT NULL,\par
  PRIMARY KEY (`restree_id`),\par
  KEY `restree_user` (`restree_user`),\par
  KEY `restree_name` (`restree_name`),\par
  KEY `restree_access` (`restree_access`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;\par
\par
--\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `search`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `search` (\par
  `search_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `search_table` varchar(20) COLLATE utf8_bin NOT NULL,\par
  `search_query` varchar(1000) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`search_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;\par
\par
--\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `treeview`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `treeview` (\par
  `treeview_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `treeview_name` varchar(20) COLLATE utf8_bin NOT NULL,\par
  `treeview_description` varchar(70) COLLATE utf8_bin NOT NULL,\par
  `treeview_table1` varchar(30) COLLATE utf8_bin DEFAULT NULL,\par
  `treeview_table2` varchar(30) COLLATE utf8_bin NOT NULL,\par
  `treeview_table3` varchar(30) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`treeview_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;\par
\par
--\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `type`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `type` (\par
  `type_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `type_name` varchar(20) COLLATE utf8_bin NOT NULL,\par
  `type_query` text COLLATE utf8_bin NOT NULL,\par
  `type_grouping` varchar(20) COLLATE utf8_bin NOT NULL,\par
  PRIMARY KEY (`type_id`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;\par
\par
--\par
-- --------------------------------------------------------\par
\par
--\par
-- Estrutura da tabela `user`\par
--\par
\par
CREATE TABLE IF NOT EXISTS `user` (\par
  `user_id` int(11) NOT NULL AUTO_INCREMENT,\par
  `user_login` varchar(32) COLLATE utf8_bin NOT NULL,\par
  `user_passwd` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'pwd',\par
  `user_level` int(11) NOT NULL,\par
  `user_firstname` varchar(16) COLLATE utf8_bin NOT NULL,\par
  `user_lastname` varchar(16) COLLATE utf8_bin NOT NULL,\par
  `user_dep` int(11) NOT NULL,\par
  `user_phone` varchar(32) COLLATE utf8_bin NOT NULL,\par
  `user_phonext` varchar(8) COLLATE utf8_bin DEFAULT NULL,\par
  `user_mobile` varchar(16) COLLATE utf8_bin DEFAULT NULL,\par
  `user_email` varchar(64) COLLATE utf8_bin NOT NULL,\par
  `user_alert` int(11) NOT NULL COMMENT '1 - Alert by email<br />2 - Alert by SMS',\par
  PRIMARY KEY (`user_id`),\par
  UNIQUE KEY `user_login` (`user_login`),\par
  KEY `user_dep` (`user_dep`),\par
  KEY `user_alert` (`user_alert`),\par
  KEY `user_level` (`user_level`)\par
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users registered. You can change your personal data here' AUTO_INCREMENT=186 ;\par
\par
--\par
\par
\par
--\par
-- Triggers `user`\par
--\par
DROP TRIGGER IF EXISTS `newuser`;\par
DELIMITER //\par
CREATE TRIGGER `newuser` AFTER INSERT ON `user`\par
 FOR EACH ROW BEGIN\par
IF NEW.user_level=0 THEN\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'user',5);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor',5);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'manufacturer',5);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'account',5);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'product',13);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'myproduct',15);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'accountperm',7);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'statepermission',7);\par
END IF;\par
IF new.user_level=1 THEN\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'user',1);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'manufacturer',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'account',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'product',8);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'myproduct',14);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'economato',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendors',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor_manufacturer',0);\par
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'department', 'department_id', new.user_dep);\par
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'productstate', 'productstate_id', 1);\par
INSERT INTO statepermission (statepermission_user, statepermission_state) VALUES (new.user_id, 6);\par
END IF;\par
IF new.user_level=2 THEN\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'manufacturer',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'product',8);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'myproduct',12);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'economato',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendors',0);\par
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor_manufacturer',0);\par
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'department', 'department_id', new.user_dep);\par
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'productstate', 'productstate_id', 1);\par
INSERT INTO statepermission (statepermission_user, statepermission_state) VALUES (new.user_id, 6);\par
END IF;\par
END\par
//\par
DELIMITER ;\par
DROP TRIGGER IF EXISTS `userupd`;\par
DELIMITER //\par
CREATE TRIGGER `userupd` BEFORE UPDATE ON `user`\par
 FOR EACH ROW BEGIN\par
IF OLD.user_level<>0 THEN\par
SET NEW.user_login=OLD.user_login;\par
SET NEW.user_dep=OLD.user_dep;\par
SET NEW.user_firstname=OLD.user_firstname;\par
SET NEW.user_lastname=OLD.user_lastname;\par
SET NEW.user_alert=OLD.user_alert;\par
END IF;\par
END\par
//\par
DELIMITER ;\par
\par
--\par
-- Constraints for dumped tables\par
--\par
\par
--\par
-- Limitadores para a tabela `admin`\par
--\par
ALTER TABLE `admin`\par
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_user`) REFERENCES `user` (`user_id`),\par
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`admin_permission`) REFERENCES `access` (`access_id`);\par
\par
--\par
-- Limitadores para a tabela `menu`\par
--\par
ALTER TABLE `menu`\par
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menu_plugin`) REFERENCES `plugin` (`plugin_id`);\par
\par
--\par
-- Limitadores para a tabela `param`\par
--\par
ALTER TABLE `param`\par
  ADD CONSTRAINT `param_ibfk_1` FOREIGN KEY (`param_report`) REFERENCES `report` (`report_id`);\par
\par
--\par
-- Limitadores para a tabela `report`\par
--\par
ALTER TABLE `report`\par
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`report_user`) REFERENCES `user` (`user_id`),\par
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`report_conf`) REFERENCES `confidentiality` (`confidentiality_id`);\par
\par
--\par
-- Limitadores para a tabela `resaccess`\par
--\par
ALTER TABLE `resaccess`\par
  ADD CONSTRAINT `resaccess_ibfk_1` FOREIGN KEY (`resaccess_user`) REFERENCES `user` (`user_id`);\par
\par
--\par
-- Limitadores para a tabela `restree`\par
--\par
ALTER TABLE `restree`\par
  ADD CONSTRAINT `restree_ibfk_1` FOREIGN KEY (`restree_user`) REFERENCES `user` (`user_id`),\par
  ADD CONSTRAINT `restree_ibfk_2` FOREIGN KEY (`restree_name`) REFERENCES `treeview` (`treeview_id`),\par
  ADD CONSTRAINT `restree_ibfk_3` FOREIGN KEY (`restree_access`) REFERENCES `access` (`access_id`);\par
\par
--\par
-- Limitadores para a tabela `user`\par
--\par
ALTER TABLE `user`\par
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_dep`) REFERENCES `department` (`department_id`),\par
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_level`) REFERENCES `level` (`level_id`);\par
\par
\f1\par
}
 