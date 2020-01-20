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
           lo_location_fk location
    FROM location;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/