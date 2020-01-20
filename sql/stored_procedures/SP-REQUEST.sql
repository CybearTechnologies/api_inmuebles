/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertRequest;
DELIMITER $$
CREATE PROCEDURE insertRequest(property int, user int)
BEGIN
    INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk)
    VALUES (property, user, user);
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk user_created,
           re_user_modified_fk user_modifier,
           re_date_created date_created,
           re_date_modified date_modified
    FROM request
    WHERE re_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getAllRequest;
DELIMITER $$
CREATE PROCEDURE getAllRequest()
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk user_created,
           re_user_modified_fk user_modifier,
           re_date_created date_created,
           re_date_modified date_modified
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
           re_user_created_fk user_created,
           re_user_modified_fk user_modifier,
           re_date_created date_created,
           re_date_modified date_modified
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
           re_user_created_fk user_created,
           re_user_modified_fk user_modifier,
           re_date_created date_created,
           re_date_modified date_modified
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
           re_user_created_fk user_created,
           re_user_modified_fk user_modifier,
           re_date_created date_created,
           re_date_modified date_modified
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
           re_user_created_fk user_created,
           re_user_modified_fk user_modifier,
           re_date_created date_created,
           re_date_modified date_modified
    FROM request
    WHERE re_id = id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/