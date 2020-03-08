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
           ex.ex_name name,
           ex.ex_active active,
           pe.pe_value value,
           ex.ex_id extra,
           ex.ex_deleted 'delete',
           ex_icon icon,
           pe.pe_property_fk property,
           ex.ex_user_created_fk userCreator,
           ex.ex_date_created dateCreated,
           ex.ex_user_modified_fk userModifier,
           ex.ex_date_modified dateModified
    FROM extra ex,
         property_extra pe
    WHERE pe.pe_extra_fk = ex_id
      AND pe.pe_property_fk = propertyid
      AND pe.pe_deleted = 0
      AND pe.pe_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getPropertyExtraByPropertyId;
DELIMITER $$
CREATE PROCEDURE getPropertyExtraByPropertyId(id_pr int)
BEGIN
    SELECT pe.pe_id id,
           ex.ex_name name,
           ex.ex_active active,
           pe.pe_value value,
           ex.ex_id extra,
           ex.ex_deleted 'delete',
           ex_icon icon,
           pe.pe_property_fk property,
           ex.ex_user_created_fk userCreator,
           ex.ex_date_created dateCreated,
           ex.ex_user_modified_fk userModifier,
           ex.ex_date_modified dateModified
    FROM extra ex,
         property_extra pe
    WHERE pe.pe_extra_fk = ex_id
      AND pe.pe_property_fk = id_pr
      AND pe.pe_deleted = 0;
END$$