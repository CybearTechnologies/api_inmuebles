/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               ACCESS                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertAccess;
DELIMITER $$
CREATE PROCEDURE insertAccess(name varchar(45), abbreviation varchar(5), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO access (ac_name, ac_abbreviation, ac_user_created_fk, ac_user_modified_fk)
        VALUES (name, abbreviation, user, user);
    ELSE
        INSERT INTO access (ac_name, ac_abbreviation, ac_user_created_fk, ac_user_modified_fk,
                            ac_date_created, ac_date_modified)
        VALUES (name, abbreviation, user, user, dateCreated, dateCreated);
    END IF;
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = last_insert_id() ;
END$$

DROP PROCEDURE IF EXISTS getAllAccess;
DELIMITER $$
CREATE PROCEDURE getAllAccess()
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAccessByName;
DELIMITER $$
CREATE PROCEDURE getAccessByName(name_access varchar(30))
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_name = name_access
    AND ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAccessById;
DELIMITER $$
CREATE PROCEDURE getAccessById(id_access int)
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = id_access
    AND ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAccessByAbbreviation;
DELIMITER $$
CREATE PROCEDURE getAccessByAbbreviation(abbreviation_access varchar(30))
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_abbreviation = abbreviation_access
    AND ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteAccessById;
DELIMITER $$
CREATE PROCEDURE deleteAccessById(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE access
        SET ac_deleted=1, ac_user_modified_fk=user
        WHERE ac_id = id;
    ELSE
        UPDATE access
        SET ac_deleted=1, ac_user_modified_fk=user, ac_user_modified_fk = dateModified
        WHERE ac_id = id;
    END IF;
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = id;
END$$


DROP PROCEDURE IF EXISTS deactivateAccessById;
DELIMITER $$
CREATE PROCEDURE deactivateAccessById(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE access
        SET ac_active=0, ac_user_modified_fk=user
        WHERE ac_id = id AND ac_deleted = 0;
    ELSE
        UPDATE access
        SET ac_active=0, ac_user_modified_fk=user, ac_date_modified=dateModified
        WHERE ac_id = id AND ac_deleted = 0;
    END IF;
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = id
    AND ac_deleted = 0;
END$$
/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                              END  ACCESS                                                       ---
  ----------------------------------------------------------------------------------------------------------------------
 */