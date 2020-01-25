/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertRequest;
DELIMITER $$
CREATE PROCEDURE insertRequest(property int, user int,dateCreated datetime,dateModified datetime)
BEGIN
    IF IsNull(dateCreated) AND IsNull(dateModified) THEN
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk)
        VALUES (property, user, user);
    ELSEIF IsNull(dateCreated) THEN
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk,re_date_modified)
        VALUES (property, user, user,dateModified);
    ELSEIF IsNull(dateModified) THEN
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk, re_date_created)
        VALUES (property, user, user,dateCreated);
    ELSE
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk, re_date_created,re_date_modified)
        VALUES (property, user, user,dateCreated,dateModified);
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
    WHERE re_id = last_insert_id();
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
    FROM request;
END$$

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
    WHERE re_id = id_req;
END$$

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
    FROM request
    WHERE re_user_created_fk = id_user;
END$$

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
    WHERE re_property_fk = id_property;
END$$

DROP PROCEDURE IF EXISTS deleteRequest;
DELIMITER $$
CREATE PROCEDURE deleteRequest(id int,user int)
BEGIN
    UPDATE request SET re_deleted=1, re_date_modified=user
    WHERE  re_id=id;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/