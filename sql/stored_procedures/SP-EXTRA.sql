/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertExtra;
DELIMITER $$
CREATE PROCEDURE insertExtra(name_extra varchar(45), id_user int)
BEGIN
    INSERT INTO extra (ex_name, ex_user_created_fk)
    VALUES (name_extra, id_user);
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getAllExtras;
DELIMITER $$
CREATE PROCEDURE getAllExtras()
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra;
END$$

DROP PROCEDURE IF EXISTS getExtraById;
DELIMITER $$
CREATE PROCEDURE getExtraById(id_extra int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra;
END$$

DROP PROCEDURE IF EXISTS getAllExtraByPropertyId;
DELIMITER $$
CREATE PROCEDURE getAllExtraByPropertyId(id_pr int)
BEGIN
    SELECT pe.pe_id id,
           ex.ex_name name,
           ex.ex_active active,
           pe.pe_value value,
           ex.ex_id extra,
           ex.ex_deleted 'delete',
           pe.pe_property_fk property,
           ex.ex_user_created_fk userCreator,
           ex.ex_date_created dateCreated,
           ex.ex_user_modified_fk userModifier,
           ex.ex_date_modified dateModified
    FROM extra ex,
         property_extra pe
    WHERE pe.pe_extra_fk = ex_id
      AND pe.pe_property_fk = id_pr;
END$$

DROP PROCEDURE IF EXISTS deleteExtraById;
DELIMITER $$
CREATE PROCEDURE deleteExtraById(id_extra int, id_user int)
BEGIN
    UPDATE extra
    SET ex_deleted = 1, ex_user_modified_fk = id_user
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra;
END$$

DROP PROCEDURE IF EXISTS inactiveExtraById;
DELIMITER $$
CREATE PROCEDURE inactiveExtraById(id_extra int, id_user int)
BEGIN
    UPDATE extra
    SET ex_active = 0,
        ex_user_modified_fk = id_user
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra;
END$$

DROP PROCEDURE IF EXISTS activeExtraById;
DELIMITER $$
CREATE PROCEDURE activeExtraById(id_extra int, id_user int)
BEGIN
    UPDATE extra
    SET ex_active = 1,
        ex_user_modified_fk = id_user
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/