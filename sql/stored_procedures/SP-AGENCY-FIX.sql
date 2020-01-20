/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               AGENCY                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertAgency;
DELIMITER $$
CREATE PROCEDURE insertAgency(name varchar(45), user int)
BEGIN
    INSERT INTO agency(ag_name, ag_user_created_fk, ag_user_modified_fk)
    VALUES (name, user, user);
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_id = last_insert_id();
END$$


DROP PROCEDURE IF EXISTS getAgencyById;
DELIMITER $$
CREATE PROCEDURE getAgencyById(id_agency int)
BEGIN
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_id = id_agency;
END$$

DROP PROCEDURE IF EXISTS getAllAgencies;
DELIMITER $$
CREATE PROCEDURE getAllAgencies()
BEGIN
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency;
END$$

DROP PROCEDURE IF EXISTS getAgencyByName;
DELIMITER $$
CREATE PROCEDURE getAgencyByName(name_agency varchar(30))
BEGIN
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_name = name_agency;
END$$

DROP PROCEDURE IF EXISTS deleteAgency;
DELIMITER $$
CREATE PROCEDURE deleteAgency(id int)
BEGIN
    UPDATE agency SET ag_deleted = 1;
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_id = id;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                              END AGENCY                                                       ---
 ----------------------------------------------------------------------------------------------------------------------
*/