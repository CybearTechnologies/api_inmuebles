/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertRol;
DELIMITER $$
CREATE PROCEDURE insertRol(name varchar(45), active tinyint, user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO rol(ro_name, ro_active, ro_user_created_fk, ro_user_modified_fk)
        VALUES (name, active, user, user);
    ELSE
        INSERT INTO rol(ro_name, ro_active, ro_user_created_fk, ro_user_modified_fk,ro_date_created,
                        ro_date_modified)
        VALUES (name, active, user, user,dateCreated,dateCreated);
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateRol;
DELIMITER $$
CREATE PROCEDURE updateRol(id int,name varchar(45), active tinyint, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE rol SET ro_name=name,ro_active=active,ro_user_modified_fk=user
        WHERE ro_id=id AND ro_deleted = 0;
    ELSE
        UPDATE rol SET ro_name=name,ro_active=active,ro_user_modified_fk=user,ro_date_modified=dateModified
        WHERE ro_id=id AND ro_deleted = 0;
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = id AND ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getRolById;
DELIMITER $$
CREATE PROCEDURE getRolById(id int)
BEGIN
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = id AND ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteRolById;
DELIMITER $$
CREATE PROCEDURE deleteRolById(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE rol
        SET ro_deleted = 1,
            ro_user_modified_fk = user
        WHERE ro_id = id AND ro_deleted = 0;
    ELSE
        UPDATE rol
        SET ro_deleted = 1,
            ro_user_modified_fk = user, ro_date_modified = dateModified
        WHERE ro_id = id AND ro_deleted = 0;
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = id AND ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllRols;
DELIMITER $$
CREATE PROCEDURE getAllRols()
BEGIN
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_deleted = 0;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/