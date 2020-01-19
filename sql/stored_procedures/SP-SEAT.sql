/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertseat;
DELIMITER $$
CREATE PROCEDURE insertseat(name varchar(100), rif varchar(20), location int, agency int,
                            active tinyint, user int)
BEGIN
    INSERT INTO seat(se_name, se_rif, se_location_fk, se_agency_fk, se_active,
                     se_user_created_fk, se_user_modified_fk)
    VALUES (name, rif, location, agency, active, user, user);
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk user_created,
           se_user_modified_fk user_modifier,
           se_date_created date_created,
           se_date_modified date_modified
    FROM seat
    WHERE se_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getallseats;
DELIMITER $$
CREATE PROCEDURE getallseats()
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk user_created,
           se_user_modified_fk user_modifier,
           se_date_created date_created,
           se_date_modified date_modified
    FROM seat;
END$$

DROP PROCEDURE IF EXISTS getseatbyid;
DELIMITER $$
CREATE PROCEDURE getseatbyid(id_seat int)
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk user_created,
           se_user_modified_fk user_modifier,
           se_date_created date_created,
           se_date_modified date_modified
    FROM seat
    WHERE se_id = id_seat;
END$$

DROP PROCEDURE IF EXISTS deleteseat;
DELIMITER $$
CREATE PROCEDURE deleteseat(id int, user int)
BEGIN

    UPDATE seat
    SET se_deleted = 1,
        se_user_modified_fk = user
    WHERE se_id = id;

    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk user_created,
           se_user_modified_fk user_modifier,
           se_date_created date_created,
           se_date_modified date_modified
    FROM seat
    WHERE se_id = id;
END$$

DROP PROCEDURE IF EXISTS getseatsbyagency;
DELIMITER $$
CREATE PROCEDURE getseatsbyagency(agency_id int)
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk user_created,
           se_user_modified_fk user_modifier,
           se_date_created date_created,
           se_date_modified date_modified
    FROM seat se,
         agency ag
    WHERE ag.ag_id = agency_id
      AND se.se_agency_fk = ag.ag_id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/