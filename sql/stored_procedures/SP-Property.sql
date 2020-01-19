/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertproperty;
DELIMITER $$
CREATE PROCEDURE insertproperty(name varchar(45), area double(20, 2), description varchar(500),
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
           pr_user_created_fk usercreator,
           pr_date_created datecreated,
           pr_user_modified_fk usermodifier,
           pr_date_modified datemodified
    FROM property
    WHERE pr_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getallproperty;
DELIMITER $$
CREATE PROCEDURE getallproperty()
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
           pr_user_created_fk user_created,
           pr_date_created date_created,
           pr_user_modified_fk user_modifier,
           pr_date_modified date_modified
    FROM property;
END$$

DROP PROCEDURE IF EXISTS getpropertybyid;
DELIMITER $$
CREATE PROCEDURE getpropertybyid(id_pro int)
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
           pr_user_created_fk user_created,
           pr_date_created date_created,
           pr_user_modified_fk user_modifier,
           pr_date_modified date_modified
    FROM property
    WHERE id_pro = pr_id;
END$$

DROP PROCEDURE IF EXISTS deletepropertybyid;
DELIMITER $$
CREATE PROCEDURE deletepropertybyid(id int)
BEGIN
    UPDATE property
    SET pr_deleted = 1
    WHERE pr_id = id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/