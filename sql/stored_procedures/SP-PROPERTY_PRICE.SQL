/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertpropertyprice;
DELIMITER $$
CREATE PROCEDURE insertpropertyprice(price double(20, 2), final tinyint, property int, user int)
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
           pp_user_created_fk usercreator,
           pp_date_created datecreated,
           pp_user_modified_fk usermodifier,
           pp_date_modified datemodified
    FROM property_price
    WHERE pp_id = last_insert_id();
END$$


DROP PROCEDURE IF EXISTS getallpropertyprice;
DELIMITER $$
CREATE PROCEDURE getallpropertyprice()
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk user_creator,
           pp_date_created datecreated,
           pp_user_modified_fk usermodifier,
           pp_date_modified datemodified
    FROM property_price;
END$$

DROP PROCEDURE IF EXISTS getpropertypricebyid;
DELIMITER $$
CREATE PROCEDURE getpropertypricebyid(id_property_price int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk user_creator,
           pp_date_created datecreated,
           pp_user_modified_fk usermodifier,
           pp_date_modified datemodified
    FROM property_price
    WHERE pp_id = id_property_price;
END$$

DROP PROCEDURE IF EXISTS getpropertypricebypropertyid;
DELIMITER $$
CREATE PROCEDURE getpropertypricebypropertyid(id_property int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk user_creator,
           pp_date_created datecreated,
           pp_user_modified_fk usermodifier,
           pp_date_modified datemodified
    FROM property_price
    WHERE pp_property_fk = id_property;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/