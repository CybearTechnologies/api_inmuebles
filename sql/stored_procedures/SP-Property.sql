/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertProperty;
DELIMITER $$
CREATE PROCEDURE insertProperty(name varchar(45), area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int)
BEGIN
    INSERT INTO property(pr_name, pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                         pr_user_created_fk, pr_user_modified_fk)
    VALUES (name, area, description, floor, type, location, user, user);
    SELECT pr_id id,
           pr_name name,
           pr_area area,
           pr_description description,
           pr_floor floor,
           pr_status status,
           pr_type_fk type,
           pr_active active,
           pr_deleted 'delete',
           pr_location_fk location,
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE pr_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getAllProperty;
DELIMITER $$
CREATE PROCEDURE getAllProperty()
BEGIN
    SELECT pr_id id,
           pr_name name,
           pr_area area,
           pr_description description,
           pr_floor floor,
           pr_status status,
           pr_type_fk type,
           pr_active active,
           pr_deleted 'delete',
           pr_location_fk location,
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property;
END$$



DROP PROCEDURE IF EXISTS getPropertyById;
DELIMITER $$
CREATE PROCEDURE getPropertyById(id_pro int)
BEGIN
    SELECT pr_id id,
           pr_name name,
           pr_area area,
           pr_description description,
           pr_floor floor,
           pr_status status,
           pr_type_fk type,
           pr_active active,
           pr_deleted 'delete',
           pr_location_fk location,
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$

DROP PROCEDURE IF EXISTS deletePropertyById;
DELIMITER $$
CREATE PROCEDURE deletePropertyById(id_pro int, id_user int)
BEGIN
    UPDATE property
    SET pr_deleted = 1,
        pr_user_modified_fk = id_user
    WHERE pr_id = id_pro;
    SELECT pr_id id,
           pr_name name,
           pr_area area,
           pr_description description,
           pr_floor floor,
           pr_status status,
           pr_type_fk type,
           pr_active active,
           pr_deleted 'delete',
           pr_location_fk location,
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$

DROP PROCEDURE IF EXISTS inactivePropertyById;
DELIMITER $$
CREATE PROCEDURE inactivePropertyById(id_pro int, id_user int)
BEGIN
    UPDATE property
    SET pr_active = 0,
        pr_user_modified_fk = id_user
    WHERE pr_id = id_pro;
    SELECT pr_id id,
           pr_name name,
           pr_area area,
           pr_description description,
           pr_floor floor,
           pr_status status,
           pr_type_fk type,
           pr_active active,
           pr_deleted 'delete',
           pr_location_fk location,
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$

DROP PROCEDURE IF EXISTS activePropertyById;
DELIMITER $$
CREATE PROCEDURE activePropertyById(id_pro int, id_user int)
BEGIN
    UPDATE property
    SET pr_active = 1,
        pr_user_modified_fk = id_user
    WHERE pr_id = id_pro;
    SELECT pr_id id,
           pr_name name,
           pr_area area,
           pr_description description,
           pr_floor floor,
           pr_status status,
           pr_type_fk type,
           pr_active active,
           pr_deleted 'delete',
           pr_location_fk location,
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/