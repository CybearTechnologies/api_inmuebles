/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               AGENCY                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */


DROP PROCEDURE IF EXISTS insertagency;
DELIMITER $$
CREATE PROCEDURE insertagency(name varchar(45), user int)
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


DROP PROCEDURE IF EXISTS getagencybyid;
DELIMITER $$
CREATE PROCEDURE getagencybyid(id_agency int)
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

DROP PROCEDURE IF EXISTS getallagencies;
DELIMITER $$
CREATE PROCEDURE getallagencies()
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

DROP PROCEDURE IF EXISTS getagencybyname;
DELIMITER $$
CREATE PROCEDURE getagencybyname(name_agency varchar(30))
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
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                              END AGENCY                                                       ---
 ----------------------------------------------------------------------------------------------------------------------
*/