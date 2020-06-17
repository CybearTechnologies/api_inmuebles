/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertProperty;
DELIMITER $$
CREATE PROCEDURE insertProperty(name varchar(45), destiny int,area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO property(pr_name, pr_destiny_fk,pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                             pr_user_created_fk, pr_user_modified_fk)
        VALUES (name, 1,area, description, floor, type, location, user, user);
    ELSE
        INSERT INTO property(pr_name, pr_destiny_fk,pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                             pr_user_created_fk, pr_user_modified_fk, pr_date_created, pr_date_modified)
        VALUES (name, 1,area, description, floor, type, location, user, user, dateCreated, dateCreated);
    END IF;
    SELECT pr_id id,
           pd.pd_name destiny,
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
    FROM property, property_destiny pd
    WHERE pr_id = last_insert_id() AND pr_destiny_fk=pd_id;
END$$

DROP PROCEDURE IF EXISTS updateProperty;
DELIMITER $$
CREATE PROCEDURE updateProperty(id int, destiny int,name varchar(45), area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_name=name, pr_destiny_fk = destiny,pr_area = area, pr_description= description, pr_floor = floor,
            pr_type_fk= type, pr_location_fk= location,
            pr_user_modified_fk=user
        WHERE pr_id = id;
    ELSE
        UPDATE property
        SET pr_name=name, pr_destiny_fk=destiny,pr_area = area, pr_description= description, pr_floor = floor, pr_type_fk= type,
            pr_location_fk= location, pr_user_modified_fk=user, pr_date_modified= dateModified
        WHERE pr_id = id;
    END IF;
    SELECT pr_id id,
           pd.pd_name destiny,
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
    FROM property, property_destiny pd
    WHERE pr_id = id AND pr_destiny_fk=pd_id;
END$$

DROP PROCEDURE IF EXISTS getAllPropertyActives;

DROP PROCEDURE IF EXISTS getAllProperty;
DELIMITER $$
CREATE PROCEDURE getAllProperty(userRequestId int)
BEGIN
    SELECT pr_id id,
           pd.pd_name destiny,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk AND fa_user_created_fk=userRequestId), property_destiny pd
    WHERE pr_deleted = 0 AND pr_destiny_fk=pd_id;
END$$

DROP PROCEDURE IF EXISTS getPropertyById;
DELIMITER $$
CREATE PROCEDURE getPropertyById(id_pro int,userRequestId int)
BEGIN
    SELECT pr_id id,
           pd.pd_name destiny,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk), property_destiny pd
    WHERE id_pro = pr_id AND pr_deleted = 0 AND pr_destiny_fk=pd_id;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByType;
DELIMITER $$
CREATE PROCEDURE getPropertiesByType(id_type int,userRequestId int)
BEGIN
    SELECT pr_id id,
           pd.pd_name destiny,
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
    FROM property LEFT JOIN favorite ON (pr_id=fa_property_fk), property_destiny pd
    WHERE pr_type_fk = id_type AND pr_deleted = 0 AND pr_active = 1 AND pr_destiny_fk=pd_id;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByUserCreator;
DELIMITER $$
CREATE PROCEDURE getPropertiesByUserCreator(id_user int)
BEGIN
    SELECT pr_id id,
           pd.pd_name destiny,
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
    FROM property, property_destiny pd
    WHERE pr_user_created_fk = id_user AND pr_deleted = 0 AND pr_destiny_fk=pd_id;
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
           pd.pd_name destiny,
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
    FROM property, property_destiny pd
    WHERE id_pro = pr_id AND pr_destiny_fk=pd_id;
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
           pd.pd_name destiny,
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
    FROM property, property_destiny pd
    WHERE id_pro = pr_id AND pr_destiny_fk=pd_id;
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
           pd.pd_name destiny,
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
    FROM property, property_destiny pd
    WHERE id_pro = pr_id AND pr_destiny_fk=pd_id;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/