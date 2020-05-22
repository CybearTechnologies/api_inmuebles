/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertProperty;
DELIMITER $$
CREATE PROCEDURE insertProperty(name varchar(45), area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO property(pr_name, pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                             pr_user_created_fk, pr_user_modified_fk)
        VALUES (name, area, description, floor, type, location, user, user);
    ELSE
        INSERT INTO property(pr_name, pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                             pr_user_created_fk, pr_user_modified_fk, pr_date_created, pr_date_modified)
        VALUES (name, area, description, floor, type, location, user, user, dateCreated, dateCreated);
    END IF;
    SELECT pr_id id,
           0 favorite,
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
    LEFT JOIN favorite ON (pr_id)
    WHERE pr_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateProperty;
DELIMITER $$
CREATE PROCEDURE updateProperty(id int, name varchar(45), area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_name=name, pr_area = area, pr_description= description, pr_floor = floor,
            pr_type_fk= type, pr_location_fk= location,
            pr_user_modified_fk=user
        WHERE pr_id = id;
    ELSE
        UPDATE property
        SET pr_name=name, pr_area = area, pr_description= description, pr_floor = floor, pr_type_fk= type,
            pr_location_fk= location, pr_user_modified_fk=user, pr_date_modified= dateModified
        WHERE pr_id = id;
    END IF;
    SELECT pr_id id,
           0 favorite,
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
    WHERE pr_id = id;
END$$

DROP PROCEDURE IF EXISTS getAllPropertyActives;

DROP PROCEDURE IF EXISTS getAllProperty;
DELIMITER $$
CREATE PROCEDURE getAllProperty(userRequestId int)
BEGIN
    SELECT pr_id id,
           IF(fa_property_fk IS NOT NULL, TRUE,FALSE ) favorite,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk AND fa_user_created_fk=userRequestId)
    WHERE pr_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPropertyById;
DELIMITER $$
CREATE PROCEDURE getPropertyById(id_pro int,userRequestId int)
BEGIN
    SELECT pr_id id,
           IF(NOT(fa_property_fk IS NULL) AND fa_user_created_fk=userRequestId, TRUE, FALSE) favorite,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk)
    WHERE id_pro = pr_id AND pr_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByType;
DELIMITER $$
CREATE PROCEDURE getPropertiesByType(id_type int,userRequestId int)
BEGIN
    SELECT pr_id id,
           IF(NOT(fa_property_fk IS NULL) AND fa_user_created_fk=userRequestId, TRUE, FALSE) favorite,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk)
    WHERE pr_type_fk = id_type AND pr_deleted = 0 AND pr_active = 1;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByUserCreator;
DELIMITER $$
CREATE PROCEDURE getPropertiesByUserCreator(id_user int,userRequestId int)
BEGIN
    SELECT pr_id id,
           IF(NOT(fa_property_fk IS NULL) AND fa_user_created_fk=userRequestId, TRUE, FALSE) favorite,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk)
    WHERE pr_user_created_fk = id_user AND pr_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByUserCreatorAndState;


DROP PROCEDURE IF EXISTS deletePropertyById;
DELIMITER $$
CREATE PROCEDURE deletePropertyById(id_pro int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_deleted = 1,
            pr_user_modified_fk = id_user
        WHERE pr_id = id_pro;
    ELSE
        UPDATE property
        SET pr_deleted = 1,
            pr_user_modified_fk = id_user, pr_date_modified = dateModified
        WHERE pr_id = id_pro;
    END IF;
    SELECT pr_id id,
           0 favorite,
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
CREATE PROCEDURE inactivePropertyById(id_pro int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_active = 0,
            pr_user_modified_fk = id_user
        WHERE pr_id = id_pro;
    ELSE
        UPDATE property
        SET pr_active = 0,
            pr_user_modified_fk = id_user, pr_date_modified = dateModified
        WHERE pr_id = id_pro;
    END IF;
    SELECT pr_id id,
           0 favorite,
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
CREATE PROCEDURE activePropertyById(id_pro int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_active = 1,
            pr_user_modified_fk = id_user
        WHERE pr_id = id_pro;
    ELSE
        UPDATE property
        SET pr_active = 1,
            pr_user_modified_fk = id_user, pr_date_modified = dateModified
        WHERE pr_id = id_pro;
    END IF;
    SELECT pr_id id,
           0 favorite,
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