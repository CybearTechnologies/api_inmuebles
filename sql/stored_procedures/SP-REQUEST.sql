/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertRequest;
DELIMITER $$
CREATE PROCEDURE insertRequest(property int, user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk)
        VALUES (property, user, user);
    ELSE
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk,
                            re_date_created,re_date_modified)
        VALUES (property, user, user,dateCreated,dateCreated);
    END IF;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = last_insert_id() AND re_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS updateRequest;
DELIMITER $$
CREATE PROCEDURE updateRequest(id int,property int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE request set re_property_fk = property, re_user_modified_fk = user
        WHERE re_id = id AND re_deleted = 0;
    ELSE
        UPDATE request set re_property_fk = property, re_user_modified_fk = user,
                           re_date_modified = dateModified
        WHERE re_id = id AND re_deleted = 0;
    END IF;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id AND re_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getAllRequest;
DELIMITER $$
CREATE PROCEDURE getAllRequest()
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPendingRequest;
DELIMITER $$
CREATE PROCEDURE getPendingRequest(id_user int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM   request
    WHERE re_user_created_fk = id_user;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getRequestById;
DELIMITER $$
CREATE PROCEDURE getRequestById(id_req int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id_req AND re_deleted = 0;
END$$
DELIMITER ;
DROP PROCEDURE IF EXISTS getRequestByUserId;
DELIMITER $$
CREATE PROCEDURE getRequestByUserId(id_user int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request, property
    WHERE re_property_fk= pr_id AND pr_user_created_fk=id_user
    AND re_deleted = 0;
END$$
DELIMITER ;
DROP PROCEDURE IF EXISTS getRequestByPropertyId;
DELIMITER $$
CREATE PROCEDURE getRequestByPropertyId(id_property int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_property_fk = id_property
        AND re_deleted = 0;
END$$
DELIMITER ;
DROP PROCEDURE IF EXISTS deleteRequest;
DELIMITER $$
CREATE PROCEDURE deleteRequest(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE request SET re_deleted=1, re_date_modified=user
        WHERE  re_id=id AND re_deleted = 0;
    ELSE
        UPDATE request SET re_deleted=1, re_date_modified=user, re_date_modified = dateModified
        WHERE  re_id=id AND re_deleted = 0;
    END IF;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id AND re_deleted = 0;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/