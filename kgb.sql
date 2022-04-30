------- Table Admin --------------------------------
 DROP TABLE IF EXISTS `admin`;

 CREATE TABLE `admin` (
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(180) NOT NULL UNIQUE,
    `last_name` VARCHAR(255) NOT NULL,
    `first_name` VARCHAR(255) NOT NULL,
    `roles` LONGTEXT NOT NULL COMMENT '(DC2Type:json)',
    `password` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--------- Table agent -----------------------------------
DROP TABLE IF EXISTS `agent`;

CREATE TABLE `agent` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `code_name` VARCHAR(255) NOT NULL,
  `first_name` VARCHAR(50) NOT NULL,
  `last_name` VARCHAR(50)  NOT NULL,
  `birthday` DATE NOT NULL,
  `nationality` VARCHAR(50) NOT NULL,
  `image_name` VARCHAR(255) DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--------- Table contact ----------------------

DROP TABLE IF EXISTS `contact`;

CREATE TABLE `contact` (
	`id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`alias` VARCHAR(255) NOT NULL,
	`first_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50)  NOT NULL,
	`birthday` DATE NOT NULL,
	`nationality` VARCHAR(50) NOT NULL,
	`image_name` VARCHAR(255) DEFAULT NULL,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	`updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


------ Table Target ---------------------------------

DROP TABLE IF EXISTS `target`;

CREATE TABLE `target` (
	`id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`alias` VARCHAR(255) NOT NULL,
	`first_name` VARCHAR(50) NOT NULL,
	`last_name` VARCHAR(50) NOT NULL,
	`birthday` DATE NOT NULL,
	`nationality` VARCHAR(50) NOT NULL,
	`image_name` VARCHAR(255) DEFAULT NULL,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	`updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--------- Table skill -----------------

DROP TABLE IF EXISTS `skill`;

CREATE TABLE `skill` (
	`id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
	`created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	`updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

------ Table agent_skill -----------

DROP TABLE IF EXISTS `agent_skill`;

CREATE TABLE `agent_skill` (
    `agent_id` INTEGER(11) NOT NULL, 
    `skill_id` INTEGER(11) NOT NULL,
    INDEX IDX_agent (agent_id),
    INDEX IDX_skill (skill_id),
    PRIMARY KEY(agent_id, skill_id),
	FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE,
	FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


-------- Table country ------------

DROP TABLE IF EXISTS `country`;

CREATE TABLE `country` (
  `id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

--------- Table hideoutType --------------

DROP TABLE IF EXISTS `hideout_type`;

CREATE TABLE `hideout_type`(
    `id` INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;



--------- Table hideout ---------

DROP TABLE IF EXISTS `hideout`;

CREATE TABLE `hideout` (
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `type_id` INTEGER(11) NOT NULL,
    `country_id` INTEGER(11) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `code` VARCHAR(255) NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    INDEX IDX_type (type_id),
    INDEX IDX_country (country_id),
    FOREIGN KEY (type_id) REFERENCES hideout_type (id),
    FOREIGN KEY (country_id) REFERENCES country (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


------- Table missionGender ----------
DROP TABLE IF EXISTS `mission_gender`;

CREATE TABLE `mission_gender` (
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

---- Table Mission -------
DROP TABLE IF EXISTS `mission`;

CREATE TABLE `mission` (
    `id` INTEGER(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `country_id` INTEGER(11) NOT NULL,
    `skills_id` INTEGER(11) NOT NULL,
    `hideout_id` INTEGER(11) NOT NULL,
    `mission_gender_id` INTEGER(11) NOT NULL,
    `title` VARCHAR(255) NOT NULL,
    `description` LONGTEXT NOT NULL,
    `code_name` VARCHAR(255) NOT NULL,
    `start_date` DATE NOT NULL,
    `end_date` DATE NOT NULL,
    `status` VARCHAR(255) NOT NULL ,
    INDEX IDX_country (country_id),
    INDEX IDX_skills (skills_id),
    INDEX IDX_hideout (hideout_id),
    INDEX IDX_mission_gender (mission_gender_id),
    FOREIGN KEY (country_id) REFERENCES country (id),
    FOREIGN KEY (skills_id) REFERENCES skill (id),
    FOREIGN KEY (hideout_id) REFERENCES hideout (id),
    FOREIGN KEY (mission_gender_id) REFERENCES mission_gender (id)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


-------- Table missionAgent --------------
DROP TABLE IF EXISTS `mission_agent`;

CREATE TABLE `mission_agent` (
    `mission_id` INTEGER(11) NOT NULL,
    `agent_id` INTEGER(11) NOT NULL,
    INDEX IDX_mission (mission_id),
    INDEX IDX_agent (agent_id),
    PRIMARY KEY(mission_id, agent_id),
    FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE,
    FOREIGN KEY (agent_id) REFERENCES agent (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;


-------- Table missionContact --------------

DROP TABLE IF EXISTS `mission_contact`;

CREATE TABLE `mission_contact` (
	`mission_id` INTEGER(11) NOT NULL,
	`contact_id` INTEGER(11) NOT NULL,
	INDEX IDX_mission (mission_id),
	INDEX IDX_contact (contact_id),
	PRIMARY KEY(mission_id, contact_id),
	FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE,
	FOREIGN KEY (contact_id) REFERENCES contact (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;

-------- Table missionTarget --------------

DROP TABLE IF EXISTS `mission_target`;

CREATE TABLE `mission_target` (
	`mission_id` INTEGER(11) NOT NULL,
	`target_id` INTEGER(11) NOT NULL,
	INDEX IDX_mission (mission_id),
	INDEX IDX_target (target_id),
	PRIMARY KEY(mission_id, target_id),
	FOREIGN KEY (mission_id) REFERENCES mission (id) ON DELETE CASCADE,
	FOREIGN KEY (target_id) REFERENCES target (id) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_unicode_ci;
