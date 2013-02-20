SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';



-- -----------------------------------------------------
-- Table `default_schema`.`users_universities`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `users_universities` (
  `id_users_universities` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NOT NULL ,
  `university_id` INT NOT NULL ,
  `visible_id` INT NULL DEFAULT NULL COMMENT 'Идентификатор настроек видимости профиля университета' ,
  PRIMARY KEY (`id_users_universities`) )
ENGINE = InnoDB
COMMENT = 'Таблица связывающая пользователей с университетами' ;


-- -----------------------------------------------------
-- Table `default_schema`.`profile_university_info`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `profile_university_info` (
  `id_profile_university_info` INT NOT NULL AUTO_INCREMENT ,
  `profile_id` INT NOT NULL ,
  `faculty_id` INT NOT NULL DEFAULT 0 ,
  `title` VARCHAR(255) NULL ,
  `content` TEXT NULL ,
  `status` TINYINT NULL DEFAULT 0 COMMENT 'Статус инфо блока' ,
  `type` VARCHAR(45) NULL COMMENT 'тип контента, типы берутся из конфига приложения' ,
  PRIMARY KEY (`id_profile_university_info`) )
ENGINE = InnoDB, 
COMMENT = 'Таблица информационных блоков университета в общем или факул' /* comment truncated */ ;


-- -----------------------------------------------------
-- Table `default_schema`.`schedule`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `schedule` (
  `id_schedule` INT NOT NULL AUTO_INCREMENT ,
  `lecture` VARCHAR(255) NULL COMMENT 'лекция' ,
  `dayofweek` TINYINT(1) NULL COMMENT 'номер дня недели' ,
  `teacher` VARCHAR(255) NULL COMMENT 'преподаватель' ,
  `faculty_id` INT NULL COMMENT 'id факультета' ,
  `university_id` INT NULL COMMENT 'id университета' ,
  `classroom` VARCHAR(45) NULL COMMENT 'аудитория' ,
  `group` VARCHAR(45) NULL COMMENT 'номер группы' ,
  `time` INT NULL COMMENT 'время проведения лекции' ,
  PRIMARY KEY (`id_schedule`) )
ENGINE = InnoDB, 
COMMENT = 'таблица расписания занятий' ;


-- -----------------------------------------------------
-- Table `default_schema`.`photos_university`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `photos_university` (
  `id_photos_university` INT NOT NULL AUTO_INCREMENT ,
  `profile_university_id` INT NULL ,
  `faculty_id` INT NULL ,
  `photo` VARCHAR(255) NULL ,
  `thumb` VARCHAR(255) NULL ,
  PRIMARY KEY (`id_photos_university`) )
ENGINE = InnoDB, 
COMMENT = 'Фотографии для профиля университета' ;


-- -----------------------------------------------------
-- Table `default_schema`.`faculties`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `faculties` (
  `id_faculty` INT NOT NULL AUTO_INCREMENT ,
  `profile_univesity_id` INT NOT NULL ,
  `name` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  PRIMARY KEY (`id_faculty`) ,
  CONSTRAINT `fk_faculties_profile_university_info1`
    FOREIGN KEY (`id_faculty` )
    REFERENCES `profile_university_info` (`faculty_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_faculties_schedule1`
    FOREIGN KEY (`id_faculty` )
    REFERENCES `schedule` (`faculty_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_faculties_photos_university1`
    FOREIGN KEY (`id_faculty` )
    REFERENCES `photos_university` (`faculty_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB, 
COMMENT = 'Таблица факультетов' ;


-- -----------------------------------------------------
-- Table `default_schema`.`profile_visibility`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `profile_visibility` (
  `id_visibility` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL ,
  `description` TEXT NULL ,
  `profile_university_id` INT NULL ,
  PRIMARY KEY (`id_visibility`) ,
  CONSTRAINT `fk_profile_visibility_users_universities1`
    FOREIGN KEY (`id_visibility` )
    REFERENCES `users_universities` (`visible_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB, 
COMMENT = 'Настройки видимости профиля университета. Применяются для ка' ;


-- -----------------------------------------------------
-- Table `default_schema`.`profile_university`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `profile_university` (
  `id_profile` INT NOT NULL AUTO_INCREMENT ,
  `university_id` INT NULL ,
  `address` TEXT NULL ,
  PRIMARY KEY (`id_profile`) ,
  CONSTRAINT `fk_profile_university_faculties1`
    FOREIGN KEY (`id_profile` )
    REFERENCES `faculties` (`profile_univesity_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_university_profile_university_info1`
    FOREIGN KEY (`id_profile` )
    REFERENCES `profile_university_info` (`profile_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_university_profile_visibility1`
    FOREIGN KEY (`id_profile` )
    REFERENCES `profile_visibility` (`profile_university_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_university_photos_university1`
    FOREIGN KEY (`id_profile` )
    REFERENCES `photos_university` (`profile_university_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_profile_university_schedule1`
    FOREIGN KEY (`id_profile` )
    REFERENCES `schedule` (`university_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB, 
COMMENT = 'Таблица расширенного профиля университета' ;
