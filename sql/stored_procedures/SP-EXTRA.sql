/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertextra;
DELIMITER $$
CREATE PROCEDURE insertextra(name_extra varchar(45))
BEGIN
    INSERT INTO extra (ex_name)
    VALUES (name_extra);
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk user_created,
           ex_date_created date_created,
           ex_user_modified_fk user_modified,
           ex_date_modified date_modified
    FROM extra
    WHERE ex_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getallextras;
DELIMITER $$
CREATE PROCEDURE getallextras()
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk user_created,
           ex_date_created date_created,
           ex_user_modified_fk user_modified,
           ex_date_modified date_modified
    FROM extra;
END$$

DROP PROCEDURE IF EXISTS getextrabyid;
DELIMITER $$
CREATE PROCEDURE getextrabyid(id_extra int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk user_created,
           ex_date_created date_created,
           ex_user_modified_fk user_modified,
           ex_date_modified date_modified
    FROM extra
    WHERE ex_id = id_extra;
END$$

DROP PROCEDURE IF EXISTS getallextrabypropertyid;
DELIMITER $$
CREATE PROCEDURE getallextrabypropertyid(id_pr int)
BEGIN
    SELECT pe.pe_id id,
           ex.ex_name name,
           ex.ex_active active,
           pe.pe_value value,
           ex.ex_id extra,
           pe.pe_property_fk property
    FROM extra ex,
         property_extra pe
    WHERE pe.pe_extra_fk = ex_id
      AND pe.pe_property_fk = id_pr;
END$$

DROP PROCEDURE IF EXISTS deleteextrabyid;
DELIMITER $$
CREATE PROCEDURE deleteextrabyid(id_extra int)
BEGIN
    UPDATE extra
    SET ex_deleted = 1
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk user_created,
           ex_date_created date_created,
           ex_user_modified_fk user_modified,
           ex_date_modified date_modified
    FROM extra
    WHERE ex_id = id_extra;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/