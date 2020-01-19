/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertrol;
DELIMITER $$
CREATE PROCEDURE insertrol(name varchar(45), active tinyint, user int)
BEGIN
    INSERT INTO rol(ro_name, ro_active, ro_user_created_fk, ro_user_modified_fk)
    VALUES (name, active, user, user);
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk user_created,
           ro_date_created date_created,
           ro_user_modified_fk user_modifier,
           ro_date_modified date_modified
    FROM rol
    WHERE ro_id = last_insert_id();
END$$


DROP PROCEDURE IF EXISTS getrolbyid;
DELIMITER $$
CREATE PROCEDURE getrolbyid(id int)
BEGIN
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk usercreator,
           ro_date_created datecreated,
           ro_user_modified_fk usermodifier,
           ro_date_modified datemodified
    FROM rol
    WHERE ro_id = id;
END$$

DROP PROCEDURE IF EXISTS deleterolbyid;
DELIMITER $$
CREATE PROCEDURE deleterolbyid(id int, user int)
BEGIN
    UPDATE rol
    SET ro_deleted = 1,
        ro_user_modified_fk = user
    WHERE ro_id = id;
END$$

DROP PROCEDURE IF EXISTS getallrols;
DELIMITER $$
CREATE PROCEDURE getallrols()
BEGIN
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk usercreator,
           ro_date_created datecreated,
           ro_user_modified_fk usermodifier,
           ro_date_modified datemodified
    FROM rol;
END$$


/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/