/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertextra;
DELIMITER $$
CREATE PROCEDURE insertextra(name_extra varchar(45), id_user int)
BEGIN
    INSERT INTO extra (ex_name, ex_user_created_fk)
    VALUES (name_extra, id_user);
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk usercreator,
           ex_date_created datecreated,
           ex_user_modified_fk usermodifier,
           ex_date_modified datemodified
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
           ex_user_created_fk usercreator,
           ex_date_created datecreated,
           ex_user_modified_fk usermodifier,
           ex_date_modified datemodified
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
           ex_user_created_fk usercreator,
           ex_date_created datecreated,
           ex_user_modified_fk usermodifier,
           ex_date_modified datemodified
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
           pe.pe_property_fk property,
           ex.ex_user_created_fk usercreator,
           ex.ex_date_created datecreated,
           ex.ex_user_modified_fk usermodifier,
           ex.ex_date_modified datemodified
    FROM extra ex,
         property_extra pe
    WHERE pe.pe_extra_fk = ex_id
      AND pe.pe_property_fk = id_pr;
END$$

DROP PROCEDURE IF EXISTS deleteextrabyid;
DELIMITER $$
CREATE PROCEDURE deleteextrabyid(id_extra int, id_user int)
BEGIN
    UPDATE extra
    SET ex_deleted = 1, ex_user_modified_fk = id_user
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk usercreator,
           ex_date_created datecreated,
           ex_user_modified_fk usermodifier,
           ex_date_modified datemodified
    FROM extra
    WHERE ex_id = id_extra;
END$$

DROP PROCEDURE IF EXISTS inactiveextrabyid;
DELIMITER $$
CREATE PROCEDURE inactiveextrabyid(id_extra int, id_user int)
BEGIN
    UPDATE extra
    SET ex_active = 0,
        ex_user_modified_fk = id_user
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk usercreator,
           ex_date_created datecreated,
           ex_user_modified_fk usermodifier,
           ex_date_modified datemodified
    FROM extra
    WHERE ex_id = id_extra;
END$$

DROP PROCEDURE IF EXISTS activeextrabyid;
DELIMITER $$
CREATE PROCEDURE activeextrabyid(id_extra int, id_user int)
BEGIN
    UPDATE extra
    SET ex_active = 1,
        ex_user_modified_fk = id_user
    WHERE ex_id = id_extra;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_user_created_fk usercreator,
           ex_date_created datecreated,
           ex_user_modified_fk usermodifier,
           ex_date_modified datemodified
    FROM extra
    WHERE ex_id = id_extra;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/