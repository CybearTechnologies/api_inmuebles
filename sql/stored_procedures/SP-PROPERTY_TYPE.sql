/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS getPropertyTypebyId;
DELIMITER $$
CREATE PROCEDURE getPropertyTypebyId(id_type int)
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk user_created,
           pt_user_modified_fk user_modifier,
           pt_date_created date_created,
           pt_date_modified date_modified
    FROM property_type
    WHERE pt_id = id_type;
END$$


DROP PROCEDURE IF EXISTS getAllPropertyType;
DELIMITER $$
CREATE PROCEDURE getAllPropertyType()
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk user_created,
           pt_user_modified_fk user_modifier,
           pt_date_created date_created,
           pt_date_modified date_modified
    FROM property_type;
END$$

DROP PROCEDURE IF EXISTS getPropertyTypeByName;
DELIMITER $$
CREATE PROCEDURE getPropertyTypeByName(name_pt varchar(30))
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk user_created,
           pt_user_modified_fk user_modifier,
           pt_date_created date_created,
           pt_date_modified date_modified
    FROM property_type
    WHERE lower(pt_name) = name_pt;
END$$

DROP PROCEDURE IF EXISTS insertPropertyType;
DELIMITER $$
CREATE PROCEDURE insertPropertyType(name varchar(30), user int)
BEGIN
    INSERT INTO property_type(pt_name, pt_user_created_fk, pt_user_modified_fk)
    VALUES (name, user, user);
    SELECT pt_id id,
           pt_name name,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk user_created,
           pt_date_created date_created,
           pt_user_modified_fk user_modifier,
           pt_date_modified date_modified
    FROM property_type
    WHERE pt_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS deleteProperyType;
DELIMITER $$
CREATE PROCEDURE deleteProperyType(id_type int, user int)
BEGIN
    UPDATE
        property_type
    SET pt_deleted = 1, pt_user_modified_fk = user
    WHERE pt_id = id_type;
    SELECT pt_id id,
           pt_name name,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk user_created,
           pt_user_modified_fk user_modifier,
           pt_date_created date_created,
           pt_date_modified date_modified
    FROM property_type
    WHERE pt_id = id_type;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/