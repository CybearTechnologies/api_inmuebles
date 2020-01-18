/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               ACCESS                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertaccess;
DELIMITER $$
CREATE PROCEDURE insertaccess(name varchar(45), abbreviation varchar(5), user int)
BEGIN
    INSERT INTO access (ac_name, ac_abbreviation, ac_user_created_fk, ac_user_modified_fk)
    VALUES (name, abbreviation, user, user);
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk user_created,
           ac_user_modified_fk user_modified,
           ac_date_created date_created,
           ac_date_modified date_modified
    FROM access
    WHERE ac_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getallaccess;
DELIMITER $$
CREATE PROCEDURE getallaccess()
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk user_created,
           ac_user_modified_fk user_modified,
           ac_date_created date_created,
           ac_date_modified date_modified
    FROM access;
END$$

DROP PROCEDURE IF EXISTS getaccessbyname;
DELIMITER $$
CREATE PROCEDURE getaccessbyname(name_access varchar(30))
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk user_created,
           ac_user_modified_fk user_modified,
           ac_date_created date_created,
           ac_date_modified date_modified
    FROM access
    WHERE ac_name = name_access;
END$$

DROP PROCEDURE IF EXISTS getaccessbyabbreviation;
DELIMITER $$
CREATE PROCEDURE getaccessbyabbreviation(abbreviation_access varchar(30))
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk user_created,
           ac_user_modified_fk user_modified,
           ac_date_created date_created,
           ac_date_modified date_modified
    FROM access
    WHERE ac_abbreviation = abbreviation_access;
END$$

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                              END  ACCESS                                                       ---
  ----------------------------------------------------------------------------------------------------------------------
 */