/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertSeat;
DELIMITER $$
CREATE PROCEDURE insertSeat(name varchar(100), rif varchar(20), location int, agency int,
                            user int,dateCreated datetime)
BEGIN
        IF IsNull(dateCreated) THEN
            INSERT INTO seat(se_name, se_rif, se_location_fk, se_agency_fk,
                         se_user_created_fk, se_user_modified_fk)
            VALUES (name, rif, location, agency, user, user);
        ELSE
            INSERT INTO seat(se_name, se_rif, se_location_fk, se_agency_fk,
                             se_user_created_fk, se_user_modified_fk,se_date_created,se_date_modified)
            VALUES (name, rif, location, agency, user, user,dateCreated,dateCreated);
        END IF;
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE se_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateSeat;
DELIMITER $$
CREATE PROCEDURE updateSeat(id int,name varchar(100), rif varchar(20), location int, agency int,
                            user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE seat set se_name=name, se_rif=rif, se_location_fk=location,se_agency_fk=agency,
                        se_user_modified_fk=user
        WHERE se_id = id;
    ELSE
        UPDATE seat set se_name=name, se_rif=rif, se_location_fk=location,se_agency_fk=agency,
                        se_user_modified_fk=user, se_date_modified=dateModified
        WHERE se_id = id;
    END IF;
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE se_id = id;
END$$

DROP PROCEDURE IF EXISTS getAllSeats;
DELIMITER $$
CREATE PROCEDURE getAllSeats()
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat;
END$$

DROP PROCEDURE IF EXISTS getSeatById;
DELIMITER $$
CREATE PROCEDURE getSeatById(id_seat int)
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE se_id = id_seat;
END$$

DROP PROCEDURE IF EXISTS getSeatByName;
DELIMITER $$
CREATE PROCEDURE getSeatByName(name varchar(100))
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE lower(se_name) = name;
END$$

DROP PROCEDURE IF EXISTS deleteSeat;
DELIMITER $$
CREATE PROCEDURE deleteSeat(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE seat
        SET se_deleted = 1,
            se_user_modified_fk = user
        WHERE se_id = id;
    ELSE
        UPDATE seat
        SET se_deleted = 1,
            se_user_modified_fk = user, se_date_modified = dateModified
        WHERE se_id = id;
    END IF;
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE se_id = id;
END$$

DROP PROCEDURE IF EXISTS getSeatsByAgency;
DELIMITER $$
CREATE PROCEDURE getSeatsByAgency(agency_id int)
BEGIN
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat se,
         agency ag
    WHERE ag.ag_id = agency_id
      AND se.se_agency_fk = ag.ag_id;
END$$

DROP PROCEDURE IF EXISTS activeSeat;
DELIMITER $$
CREATE PROCEDURE activeSeat(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE seat
        SET se_active = 1,
            se_user_modified_fk = user
        WHERE se_id = id;
    ELSE
        UPDATE seat
        SET se_active = 1,
            se_user_modified_fk = user, se_date_modified = dateModified
        WHERE se_id = id;
    END IF;
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE se_id = id;
END$$

DROP PROCEDURE IF EXISTS inactiveSeat;
DELIMITER $$
CREATE PROCEDURE inactiveSeat(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE seat
        SET se_active = 0,
            se_user_modified_fk = user
        WHERE se_id = id;
    ELSE
        UPDATE seat
        SET se_active = 0,
            se_user_modified_fk = user, se_date_modified = dateModified
        WHERE se_id = id;
    END IF;
    SELECT se_id id,
           se_name name,
           se_rif rif,
           se_location_fk location,
           se_agency_fk agency,
           se_active active,
           se_deleted 'delete',
           se_user_created_fk userCreator,
           se_user_modified_fk userModifier,
           se_date_created dateCreated,
           se_date_modified dateModified
    FROM seat
    WHERE se_id = id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/