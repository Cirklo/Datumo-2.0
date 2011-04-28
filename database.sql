
-- Base de Dados: `requisitions`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `access`
--

CREATE TABLE IF NOT EXISTS `access` (
  `access_id` int(11) NOT NULL,
  `access_permission` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `access`
--

INSERT INTO `access` (`access_id`, `access_permission`) VALUES
(0, 'View'),
(1, 'Update'),
(2, 'Delete'),
(3, 'Update, Delete'),
(4, 'Add'),
(5, 'Add, Update'),
(6, 'Add, Delete'),
(7, 'Add, Update, Delete'),
(8, 'Request'),
(9, 'Request, Update'),
(10, 'Request, Delete'),
(11, 'Request, Update, Delete'),
(12, 'Request. Add'),
(13, 'Request, Add, Update'),
(14, 'Request, Add, Delete'),
(15, 'Request, Add, Update, Delete');

-- --------------------------------------------------------

--
-- Estrutura da tabela `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_user` int(11) NOT NULL,
  `admin_table` varchar(20) CHARACTER SET latin1 NOT NULL,
  `admin_permission` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `admin_user` (`admin_user`),
  KEY `admin_permission` (`admin_permission`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='With this table you can give access to specific tables' AUTO_INCREMENT=1316 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_title` varchar(100) COLLATE utf8_bin NOT NULL,
  `announcement_message` text COLLATE utf8_bin,
  `announcement_date` date NOT NULL COMMENT 'Announcement date.',
  `announcement_end_date` date DEFAULT NULL COMMENT 'The announcement will no longer be available after the end date.',
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Announcements and promotions' AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `bool`
--

CREATE TABLE IF NOT EXISTS `bool` (
  `bool_id` int(11) NOT NULL,
  `bool_type` varchar(6) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`bool_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `bool`
--

INSERT INTO `bool` (`bool_id`, `bool_type`) VALUES
(0, 'FALSE'),
(1, 'TRUE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `confidentiality`
--

CREATE TABLE IF NOT EXISTS `confidentiality` (
  `confidentiality_id` int(11) NOT NULL AUTO_INCREMENT,
  `confidentiality_name` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`confidentiality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `confidentiality`
--

INSERT INTO `confidentiality` (`confidentiality_id`, `confidentiality_name`) VALUES
(0, 'Undefined'),
(1, 'Public'),
(2, 'Private');


-- Estrutura da tabela `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(40) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `department_inst` smallint(6) NOT NULL,
  `department_manager` int(11) NOT NULL,
  PRIMARY KEY (`department_id`),
  KEY `department_inst` (`department_inst`),
  KEY `department_manager` (`department_manager`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `institute`
--

CREATE TABLE IF NOT EXISTS `institute` (
  `institute_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `institute_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `institute_address` varchar(64) COLLATE utf8_bin NOT NULL,
  `institute_phone` int(11) NOT NULL,
  `institute_country` int(11) NOT NULL,
  `institute_vat` int(11) NOT NULL,
  PRIMARY KEY (`institute_id`),
  KEY `institute_country` (`institute_country`),
  KEY `institute_country_2` (`institute_country`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=9 ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `department`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `level`
--

CREATE TABLE IF NOT EXISTS `level` (
  `level_id` int(11) NOT NULL,
  `level_name` varchar(15) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `level`
--

INSERT INTO `level` (`level_id`, `level_name`) VALUES
(0, 'Administrator'),
(1, 'Manager'),
(2, 'Regular User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mainconfig`
--

CREATE TABLE IF NOT EXISTS `mainconfig` (
  `mainconfig_id` int(11) NOT NULL AUTO_INCREMENT,
  `mainconfig_institute` varchar(100) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_shortname` varchar(10) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_url` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_email` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_password` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_host` varchar(50) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_port` int(11) NOT NULL,
  `mainconfig_SMTPSecure` varchar(10) CHARACTER SET ucs2 COLLATE ucs2_bin NOT NULL,
  `mainconfig_SMTPAuth` tinyint(4) NOT NULL,
  PRIMARY KEY (`mainconfig_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `mainconfig`
--

INSERT INTO `mainconfig` (`mainconfig_id`, `mainconfig_institute`, `mainconfig_shortname`, `mainconfig_url`, `mainconfig_email`, `mainconfig_password`, `mainconfig_host`, `mainconfig_port`, `mainconfig_SMTPSecure`, `mainconfig_SMTPAuth`) VALUES
(1, 'IGC', 'IGC', 'www.igc.gulbenkian.pt', 'uicweb@igc.gulbenkian.pt', 'uicweb!2010', 'mail.igc.gulbenkian.pt', 25, 'none', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `menu_description` varchar(50) COLLATE utf8_bin NOT NULL,
  `menu_plugin` int(11) NOT NULL,
  `menu_url` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`menu_id`),
  KEY `menu_plugin` (`menu_plugin`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=5 ;

--

-- --------------------------------------------------------

--
-- Estrutura da tabela `param`
--

CREATE TABLE IF NOT EXISTS `param` (
  `param_id` int(11) NOT NULL AUTO_INCREMENT,
  `param_report` int(11) NOT NULL,
  `param_name` varchar(25) COLLATE utf8_bin NOT NULL,
  `param_datatype` varchar(25) COLLATE utf8_bin NOT NULL,
  `param_reference` varchar(25) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`param_id`),
  KEY `param_report` (`param_report`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `param`
---- --------------------------------------------------------

--
-- Estrutura da tabela `plugin`
--

CREATE TABLE IF NOT EXISTS `plugin` (
  `plugin_id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_name` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`plugin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `report_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `report_description` varchar(150) COLLATE utf8_bin NOT NULL,
  `report_query` varchar(1000) COLLATE utf8_bin NOT NULL,
  `report_user` int(11) NOT NULL,
  `report_conf` int(11) NOT NULL,
  PRIMARY KEY (`report_id`),
  KEY `report_user` (`report_user`),
  KEY `report_conf` (`report_conf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=8 ;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `resaccess`
--

CREATE TABLE IF NOT EXISTS `resaccess` (
  `resaccess_id` int(11) NOT NULL AUTO_INCREMENT,
  `resaccess_user` int(11) NOT NULL,
  `resaccess_table` varchar(30) NOT NULL,
  `resaccess_column` varchar(30) NOT NULL,
  `resaccess_value` varchar(30) NOT NULL,
  PRIMARY KEY (`resaccess_id`),
  KEY `resaccess_user` (`resaccess_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=283 ;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `restree`
--

CREATE TABLE IF NOT EXISTS `restree` (
  `restree_id` int(11) NOT NULL AUTO_INCREMENT,
  `restree_user` int(11) NOT NULL,
  `restree_name` int(11) NOT NULL,
  `restree_access` int(11) NOT NULL,
  PRIMARY KEY (`restree_id`),
  KEY `restree_user` (`restree_user`),
  KEY `restree_name` (`restree_name`),
  KEY `restree_access` (`restree_access`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `search`
--

CREATE TABLE IF NOT EXISTS `search` (
  `search_id` int(11) NOT NULL AUTO_INCREMENT,
  `search_table` varchar(20) COLLATE utf8_bin NOT NULL,
  `search_query` varchar(1000) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`search_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `treeview`
--

CREATE TABLE IF NOT EXISTS `treeview` (
  `treeview_id` int(11) NOT NULL AUTO_INCREMENT,
  `treeview_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `treeview_description` varchar(70) COLLATE utf8_bin NOT NULL,
  `treeview_table1` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `treeview_table2` varchar(30) COLLATE utf8_bin NOT NULL,
  `treeview_table3` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`treeview_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(20) COLLATE utf8_bin NOT NULL,
  `type_query` text COLLATE utf8_bin NOT NULL,
  `type_grouping` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

--
-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_passwd` varchar(64) COLLATE utf8_bin NOT NULL COMMENT 'pwd',
  `user_level` int(11) NOT NULL,
  `user_firstname` varchar(16) COLLATE utf8_bin NOT NULL,
  `user_lastname` varchar(16) COLLATE utf8_bin NOT NULL,
  `user_dep` int(11) NOT NULL,
  `user_phone` varchar(32) COLLATE utf8_bin NOT NULL,
  `user_phonext` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `user_mobile` varchar(16) COLLATE utf8_bin DEFAULT NULL,
  `user_email` varchar(64) COLLATE utf8_bin NOT NULL,
  `user_alert` int(11) NOT NULL COMMENT '1 - Alert by email<br />2 - Alert by SMS',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_login` (`user_login`),
  KEY `user_dep` (`user_dep`),
  KEY `user_alert` (`user_alert`),
  KEY `user_level` (`user_level`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users registered. You can change your personal data here' AUTO_INCREMENT=186 ;

--


--
-- Triggers `user`
--
DROP TRIGGER IF EXISTS `newuser`;
DELIMITER //
CREATE TRIGGER `newuser` AFTER INSERT ON `user`
 FOR EACH ROW BEGIN
IF NEW.user_level=0 THEN
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'user',5);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor',5);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'manufacturer',5);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'account',5);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'product',13);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'myproduct',15);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'accountperm',7);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'statepermission',7);
END IF;
IF new.user_level=1 THEN
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'user',1);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'manufacturer',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'account',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'product',8);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'myproduct',14);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'economato',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendors',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor_manufacturer',0);
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'department', 'department_id', new.user_dep);
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'productstate', 'productstate_id', 1);
INSERT INTO statepermission (statepermission_user, statepermission_state) VALUES (new.user_id, 6);
END IF;
IF new.user_level=2 THEN
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'manufacturer',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'product',8);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'myproduct',12);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'economato',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendors',0);
INSERT INTO admin (admin_user, admin_table, admin_permission) VALUES (new.user_id,'vendor_manufacturer',0);
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'department', 'department_id', new.user_dep);
INSERT INTO resaccess (resaccess_user, resaccess_table, resaccess_column, resaccess_value) VALUES (new.user_id, 'productstate', 'productstate_id', 1);
INSERT INTO statepermission (statepermission_user, statepermission_state) VALUES (new.user_id, 6);
END IF;
END
//
DELIMITER ;
DROP TRIGGER IF EXISTS `userupd`;
DELIMITER //
CREATE TRIGGER `userupd` BEFORE UPDATE ON `user`
 FOR EACH ROW BEGIN
IF OLD.user_level<>0 THEN
SET NEW.user_login=OLD.user_login;
SET NEW.user_dep=OLD.user_dep;
SET NEW.user_firstname=OLD.user_firstname;
SET NEW.user_lastname=OLD.user_lastname;
SET NEW.user_alert=OLD.user_alert;
END IF;
END
//
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`admin_permission`) REFERENCES `access` (`access_id`);


ALTER TABLE `department`
  ADD CONSTRAINT `department_ibfk_1` FOREIGN KEY (`department_inst`) REFERENCES `institute` (`institute_id`),
  ADD CONSTRAINT `department_ibfk_2` FOREIGN KEY (`department_manager`) REFERENCES `user` (`user_id`);

--
-- Limitadores para a tabela `institute`
--
ALTER TABLE `institute`
  ADD CONSTRAINT `institute_ibfk_1` FOREIGN KEY (`institute_country`) REFERENCES `country` (`country_id`);


--
-- Limitadores para a tabela `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`menu_plugin`) REFERENCES `plugin` (`plugin_id`);

--
-- Limitadores para a tabela `param`
--
ALTER TABLE `param`
  ADD CONSTRAINT `param_ibfk_1` FOREIGN KEY (`param_report`) REFERENCES `report` (`report_id`);

--
-- Limitadores para a tabela `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`report_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`report_conf`) REFERENCES `confidentiality` (`confidentiality_id`);

--
-- Limitadores para a tabela `resaccess`
--
ALTER TABLE `resaccess`
  ADD CONSTRAINT `resaccess_ibfk_1` FOREIGN KEY (`resaccess_user`) REFERENCES `user` (`user_id`);

--
-- Limitadores para a tabela `restree`
--
ALTER TABLE `restree`
  ADD CONSTRAINT `restree_ibfk_1` FOREIGN KEY (`restree_user`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `restree_ibfk_2` FOREIGN KEY (`restree_name`) REFERENCES `treeview` (`treeview_id`),
  ADD CONSTRAINT `restree_ibfk_3` FOREIGN KEY (`restree_access`) REFERENCES `access` (`access_id`);

--
-- Limitadores para a tabela `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_dep`) REFERENCES `department` (`department_id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`user_level`) REFERENCES `level` (`level_id`);


}
 