/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertAccessRol;
DELIMITER $$
CREATE PROCEDURE insertAccessRol(rol_fk int, access_fk int, user int, datecreated datetime)
BEGIN
    IF IsNull(datecreated) THEN
        INSERT INTO rol_access (ra_rol_fk, ra_access_fk, ra_user_created_fk, ra_user_modified_fk)
        VALUES (rol_fk, access_fk, user, user);
    ELSE
        INSERT INTO rol_access (ra_rol_fk, ra_access_fk, ra_user_created_fk, ra_user_modified_fk,
                                ra_date_created, ra_date_modified)
        VALUES (ra_rol_fk, ra_access_fk, user, user, datecreated, datecreated);
    END IF;
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ra_active active,
           ac_name accessName,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access, access
    WHERE ra_id = last_insert_id() AND ac_id = ra_access_fk;
END$$

DROP PROCEDURE IF EXISTS getAccessByRol;
DELIMITER $$
CREATE PROCEDURE getAccessByRol(id_rol int)
BEGIN
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access,
         access
    WHERE ra_rol_fk = id_rol
      AND ra_access_fk = ac_id
      AND ra_active = 1
      AND ra_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deactivateRolAccessById;
DELIMITER $$
CREATE PROCEDURE deactivateRolAccessById(id int, user int, datemodified datetime)
BEGIN
    IF IsNull(datemodified) THEN
        UPDATE rol_access
        SET ra_active = 0, ra_user_modified_fk = user
        WHERE ra_id = id;
    ELSE
        UPDATE rol_access
        SET ra_active = 0, ra_user_modified_fk = user, ra_date_modified = datemodified
        WHERE ra_id = id;
    END IF;
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ac_name accessName,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access,
         access
    WHERE ra_id = id
      AND ra_access_fk = ac_id;
END$$

DROP PROCEDURE IF EXISTS activateRolAccessById;
DELIMITER $$
CREATE PROCEDURE activateRolAccessById(id int, user int, datemodified datetime)
BEGIN
    IF IsNull(datemodified) THEN
        UPDATE rol_access
        SET ra_active = 1, ra_user_modified_fk = user
        WHERE ra_id = id;
    ELSE
        UPDATE rol_access
        SET ra_active = 1, ra_user_modified_fk = user, ra_date_modified = datemodified
        WHERE ra_id = id;
    END IF;
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ac_name accessName,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access,
         access
    WHERE ra_id = id
      AND ra_access_fk = ac_id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/