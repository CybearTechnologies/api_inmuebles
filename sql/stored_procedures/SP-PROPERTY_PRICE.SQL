/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertPropertyPrice;
DELIMITER $$
CREATE PROCEDURE insertPropertyPrice(price double(20, 2), final tinyint, property int, user int)
BEGIN
    INSERT INTO property_price(pp_price, pp_final, pp_property_fk, pp_user_created_fk,
                               pp_user_modified_fk)
    VALUES (price, final, property, user, user);
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

DROP PROCEDURE IF EXISTS getPropertyPricebyId;
DELIMITER $$
CREATE PROCEDURE getPropertyPricebyId(id_property_price int)
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

DROP PROCEDURE IF EXISTS deletePropertyPrice;
DELIMITER $$
CREATE PROCEDURE deletePropertyPrice(id int,user int)
BEGIN
    UPDATE property_price
    SET pp_deleted = 1, pp_user_modified_fk=user
    WHERE pp_id = id;
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