/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertPropertyType;
DELIMITER $$
CREATE PROCEDURE insertPropertyType(name varchar(30), image varchar(255), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO property_type(pt_name, pt_image, pt_user_created_fk, pt_user_modified_fk)
        VALUES (name, image, user, user);
    ELSE
        INSERT INTO property_type(pt_name, pt_image, pt_user_created_fk, pt_user_modified_fk, pt_date_created,
                                  pt_date_modified)
        VALUES (name, image, user, user, dateCreated, dateCreated);
    END IF;
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = last_insert_id();
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS updatePropertyType;
DELIMITER $$
CREATE PROCEDURE updatePropertyType(id int, name varchar(30), image varchar(30), user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property_type
        SET pt_name=name, pt_image=image, pt_user_modified_fk=user
        WHERE pt_id = id;
    ELSE
        UPDATE property_type
        SET pt_name=name, pt_image=image, pt_user_modified_fk=user, pt_date_modified=dateModified
        WHERE pt_id = id;
    END IF;
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = id;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getPropertyTypebyId;
DELIMITER $$
CREATE PROCEDURE getPropertyTypebyId(id int)
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = id;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getAllPropertyType;
DELIMITER $$
CREATE PROCEDURE getAllPropertyType()
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getPropertyTypeByName;
DELIMITER $$
CREATE PROCEDURE getPropertyTypeByName(name varchar(30))
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE lower(pt_name) = name;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS deletePropertyType;
DELIMITER $$
CREATE PROCEDURE deletePropertyType(id int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE
            property_type
        SET pt_deleted = TRUE, pt_user_modified_fk = user
        WHERE pt_id = id;
    ELSE
        UPDATE
            property_type
        SET pt_deleted = TRUE, pt_user_modified_fk = user, pt_date_modified = dateModified
        WHERE pt_id = id;
    END IF;
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = id;
END$$
DELIMITER ;
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/