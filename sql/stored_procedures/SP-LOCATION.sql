/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS getLocationsById;
DELIMITER $$
CREATE PROCEDURE getLocationsById(id_location int)
BEGIN
    SELECT lo_id id,
           lo_name name,
           lo_type type,
           lo_active active,
           lo_deleted 'delete',
           lo_date_created dateCreated,
           lo_date_modified dateModified,
           lo_user_created_fk userCreator,
           lo_user_modified_fk userModifier,
           lo_location_fk location
    FROM location
    WHERE lo_id = id_location;
END$$

DROP PROCEDURE IF EXISTS getLocationsByType;
DELIMITER $$
CREATE PROCEDURE getLocationsByType(type_loc varchar(30))
BEGIN
    SELECT lo_id id,
           lo_name name,
           lo_active active,
           lo_type type,
           lo_deleted 'delete',
           lo_date_created dateCreated,
           lo_date_modified dateModified,
           lo_user_created_fk userCreator,
           lo_user_modified_fk userModifier,
           lo_location_fk location
    FROM location
    WHERE lower(lo_type) = type_loc;
END$$

DROP PROCEDURE IF EXISTS getLocationsByName;
DELIMITER $$
CREATE PROCEDURE getLocationsByName(name_loc varchar(30))
BEGIN
    SELECT lo_id id,
           lo_name name,
           lo_active active,
           lo_type type,
           lo_deleted 'delete',
           lo_date_created dateCreated,
           lo_date_modified dateModified,
           lo_user_created_fk userCreator,
           lo_user_modified_fk userModifier,
           lo_location_fk location
    FROM location
    WHERE lower(lo_name) = name_loc;
END$$

DROP PROCEDURE IF EXISTS getAllLocations;
DELIMITER $$
CREATE PROCEDURE getAllLocations()
BEGIN
    SELECT lo_id id,
           lo_name name,
           lo_type type,
           lo_active active,
           lo_deleted 'delete',
           lo_date_created dateCreated,
           lo_date_modified dateModified,
           lo_user_created_fk userCreator,
           lo_user_modified_fk userModifier,
           lo_location_fk location
    FROM location;
END$$

DROP PROCEDURE IF EXISTS getLocationsByMunicipalityId;
DELIMITER $$
CREATE PROCEDURE getLocationsByMunicipalityId(id int)
BEGIN
    SELECT lo_id id,
           lo_name name,
           lo_type type,
           lo_active active,
           lo_deleted 'delete',
           lo_date_created dateCreated,
           lo_date_modified dateModified,
           lo_user_created_fk userCreator,
           lo_user_modified_fk userModifier,
           lo_location_fk location
    FROM location
    WHERE lo_type = 'Municipio' AND lo_id = id;
END$$

    DROP PROCEDURE IF EXISTS getLocationsByStateId;
    DELIMITER $$
    CREATE PROCEDURE getLocationsByStateId(id int)
    BEGIN
        SELECT lo_id id,
               lo_name name,
               lo_type type,
               lo_active active,
               lo_deleted 'delete',
               lo_date_created dateCreated,
               lo_date_modified dateModified,
               lo_user_created_fk userCreator,
               lo_user_modified_fk userModifier,
               lo_location_fk location
        FROM location
        WHERE lo_type = 'Municipio' AND lo_location_fk = id;
    END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/