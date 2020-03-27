/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertPropertyPrice;
DELIMITER $$
CREATE PROCEDURE insertPropertyPrice(price double(20, 2), final tinyint, property int, user int,
                                     dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO property_price(pp_price, pp_final, pp_property_fk, pp_user_created_fk,
                                   pp_user_modified_fk)
        VALUES (price, final, property, user, user);
    ELSE
        INSERT INTO property_price(pp_price, pp_final, pp_property_fk, pp_user_created_fk,
                                   pp_user_modified_fk,pp_date_created,pp_date_modified)
        VALUES (price, final, property, user, user,dateCreated,dateCreated);
    END IF;
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updatePropertyPrice;
DELIMITER $$
CREATE PROCEDURE updatePropertyPrice(id int,price double(20, 2), final tinyint, property int, user int,
                                     dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE property_price SET pp_price=price, pp_final=final,pp_property_fk=property,pp_user_modified_fk=user
        WHERE pp_id=id;
    ELSE
        UPDATE property_price SET pp_price=price, pp_final=final,pp_property_fk=property,pp_user_modified_fk=user,
                                  pp_date_modified = dateModified
        WHERE pp_id=id;
    END IF;
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = id;
END$$

DROP PROCEDURE IF EXISTS getAllPropertyPrice;
DELIMITER $$
CREATE PROCEDURE getAllPropertyPrice()
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price;
END$$

DROP PROCEDURE IF EXISTS getPropertyPriceById;
DELIMITER $$
CREATE PROCEDURE getPropertyPriceById(id_property_price int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = id_property_price;
END$$

DROP PROCEDURE IF EXISTS getPropertyPriceByPropertyId;
DELIMITER $$
CREATE PROCEDURE getPropertyPriceByPropertyId(id_property int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_property_fk = id_property;
END$$

DROP PROCEDURE IF EXISTS getPropertyPriceByPropertyId;
DELIMITER $$
CREATE PROCEDURE getProperty2LastPriceByPropertyId(id_property int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_property_fk = id_property ORDER BY pp_date_created DESC limit 2;
END$$

DROP PROCEDURE IF EXISTS deletePropertyPrice;
DELIMITER $$
CREATE PROCEDURE deletePropertyPrice(id int,user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE property_price
        SET pp_deleted = 1, pp_user_modified_fk=user
        WHERE pp_id = id;
    ELSE
        UPDATE property_price
        SET pp_deleted = 1, pp_user_modified_fk=user, pp_date_modified = dateModified
        WHERE pp_id = id;
    END IF;
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/