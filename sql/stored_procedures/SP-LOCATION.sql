/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS getlocationsbyid;
DELIMITER $$
CREATE PROCEDURE getlocationsbyid(id_location int)
BEGIN
    SELECT lo_id id, lo_name name, lo_type type, lo_location_fk location
    FROM location
    WHERE lo_id = id_location;
END$$

DROP PROCEDURE IF EXISTS getlocationsbytype;
DELIMITER $$
CREATE PROCEDURE getlocationsbytype(type_loc varchar(30))
BEGIN
    SELECT lo_id id, lo_name name, lo_location_fk location
    FROM location
    WHERE lower(lo_type) = type_loc;
END$$

DROP PROCEDURE IF EXISTS getlocationsbyname;
DELIMITER $$
CREATE PROCEDURE getlocationsbyname(name_loc varchar(30))
BEGIN
    SELECT lo_id id,
           lo_name name,
           lo_location_fk location
    FROM location
    WHERE lower(lo_name) = name_loc;
END$$

DROP PROCEDURE IF EXISTS getalllocations;
DELIMITER $$
CREATE PROCEDURE getalllocations()
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