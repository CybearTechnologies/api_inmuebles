DROP PROCEDURE IF EXISTS insertPropertyExtra;
DELIMITER $$
CREATE PROCEDURE insertPropertyExtra(amount int, propertyId int, extraId int,user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO property_extra (pe_value, pe_property_fk, pe_extra_fk, pe_user_created_fk,pe_user_modified_fk)
        VALUES (amount, propertyId, extraId, user,user);
    ELSE
        INSERT INTO property_extra (pe_value, pe_property_fk, pe_extra_fk, pe_user_created_fk,pe_user_modified_fk,pe_date_created,pe_date_modified)
        VALUES (amount, propertyId, extraId, user,user,datecreated,datecreated);
    END IF;
    SELECT pe.pe_id id,
           pe.pe_active active,
           pe.pe_value value,
           pe.pe_extra_fk extra,
           pe.pe_deleted 'delete',
           pe.pe_property_fk property,
           pe.pe_user_created_fk userCreator,
           pe.pe_date_created dateCreated,
           pe.pe_user_modified_fk userModifier,
           pe.pe_date_modified dateModified
    FROM   property_extra pe
    WHERE pe.pe_deleted = 0
      AND pe.pe_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getPropertyExtraByPropertyId;
DELIMITER $$
CREATE PROCEDURE getPropertyExtraByPropertyId(id_pr int)
BEGIN
    SELECT pe.pe_id id,
           pe.pe_active active,
           pe.pe_value value,
           pe.pe_extra_fk extra,
           pe.pe_deleted 'delete',
           pe.pe_property_fk property,
           pe.pe_user_created_fk userCreator,
           pe.pe_date_created dateCreated,
           pe.pe_user_modified_fk userModifier,
           pe.pe_date_modified dateModified
    FROM   property_extra pe
    WHERE  pe.pe_property_fk = id_pr
      AND pe.pe_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deletePropertyExtraByPropertyId;
DELIMITER $$
CREATE PROCEDURE deletePropertyExtraByPropertyId(id int)
BEGIN
    DELETE FROM property_extra WHERE pe_id = id;
END$$

DROP PROCEDURE IF EXISTS deleteAllExtraByPropertyId;
DELIMITER $$
CREATE PROCEDURE deleteAllExtraByPropertyId(id int)
BEGIN
    DELETE FROM property_extra WHERE pe_property_fk = id;
END;
DELIMITER $$;
