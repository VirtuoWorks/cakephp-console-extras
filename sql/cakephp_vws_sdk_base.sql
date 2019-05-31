SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS,  UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS,  FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE,  SQL_MODE='TRADITIONAL, ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema cake_console_extras
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema cake_console_extras
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `cake_console_extras` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `cake_console_extras` ;

-- -----------------------------------------------------
-- Table `cake_console_extras`.`blacklisted_ips`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_console_extras`.`blacklisted_ips` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT, 
    `ip_address` VARCHAR(45) NOT NULL, 
    `ip_access_count` BIGINT(20) NULL DEFAULT '0', 
    `is_blacklisted_ip_address` TINYINT(1) NOT NULL DEFAULT '1', 
    PRIMARY KEY (`id`,  `ip_address`))
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cake_console_extras`.`blacklisted_mails`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_console_extras`.`blacklisted_mails` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT, 
    `mail_account` VARCHAR(80) NOT NULL, 
    `is_blacklisted_mail_account` TINYINT(1) NOT NULL DEFAULT '1', 
    PRIMARY KEY (`id`,  `mail_account`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cake_console_extras`.`blacklisted_providers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_console_extras`.`blacklisted_providers` (
    `id` BIGINT(20) NOT NULL AUTO_INCREMENT, 
    `provider_host` VARCHAR(255) NOT NULL, 
    `is_blacklisted_host` TINYINT(1) NOT NULL DEFAULT '1', 
    PRIMARY KEY (`id`,  `provider_host`))
ENGINE = InnoDB
AUTO_INCREMENT = 572
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `cake_console_extras`.`server_sessions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cake_console_extras`.`server_sessions` (
    `id` VARCHAR(255) NOT NULL, 
    `data` TEXT NULL DEFAULT NULL, 
    `expires` INT(11) NULL DEFAULT NULL, 
    PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
