/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertExtra;
DELIMITER $$
CREATE PROCEDURE insertExtra(name varchar(45), icon varchar(45), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO extra (ex_name, ex_icon, ex_user_created_fk, ex_user_modified_fk)
        VALUES (name, icon, user, user);
    ELSE
        INSERT INTO extra (ex_name, ex_icon, ex_user_created_fk, ex_user_modified_fk, ex_date_created,
                           ex_date_modified)
        VALUES (name, icon, user, user, dateCreated, dateCreated);
    END IF;

    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateExtra;
DELIMITER $$
CREATE PROCEDURE updateExtra(id int, name varchar(45), icon varchar(45), user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_name=name, ex_icon=icon, ex_user_modified_fk=user
        WHERE ex_id = id AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_name=name, ex_icon=icon, ex_user_modified_fk=user, ex_date_modified=dateModified
        WHERE ex_id = id AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllExtras;
DELIMITER $$
CREATE PROCEDURE getAllExtras()
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllExtrasByState;
DELIMITER $$
CREATE PROCEDURE getAllExtrasByState(ex_state int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_deleted = 0
    AND ex_active = ex_state;
END$$

DROP PROCEDURE IF EXISTS getExtraById;
DELIMITER $$
CREATE PROCEDURE getExtraById(id_extra int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllExtrasByPropertyId;
DELIMITER $$
CREATE PROCEDURE getAllExtrasByPropertyId(id_property int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra, property_extra, property
    WHERE ex_id = pe_extra_fk AND pe_property_fk = id_property AND ex_deleted = 0
    ;
END$$

DROP PROCEDURE IF EXISTS deleteExtraById;
DELIMITER $$
CREATE PROCEDURE deleteExtraById(id_extra int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_deleted = 1, ex_user_modified_fk = id_user
        WHERE ex_id = id_extra AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_deleted = 1, ex_user_modified_fk = id_user, ex_date_modified=dateModified
        WHERE ex_id = id_extra AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS inactiveExtraById;
DELIMITER $$
CREATE PROCEDURE inactiveExtraById(id_extra int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_active = 0, ex_user_modified_fk = id_user
        WHERE ex_id = id_extra AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_active = 0, ex_user_modified_fk = id_user, ex_date_modified = dateModified
        WHERE ex_id = id_extra AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS activeExtraById;
DELIMITER $$
CREATE PROCEDURE activeExtraById(id_extra int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_active = 1,
            ex_user_modified_fk = id_user
        WHERE ex_id = id_extra AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_active = 1,
            ex_user_modified_fk = id_user, ex_date_modified = dateModified
        WHERE ex_id = id_extra AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/