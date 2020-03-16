

DROP PROCEDURE IF EXISTS insertAccess;
DELIMITER $$
CREATE PROCEDURE insertAccess(name varchar(45), abbreviation varchar(5), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO access (ac_name, ac_abbreviation, ac_user_created_fk, ac_user_modified_fk)
        VALUES (name, abbreviation, user, user);
    ELSE
        INSERT INTO access (ac_name, ac_abbreviation, ac_user_created_fk, ac_user_modified_fk,
                            ac_date_created, ac_date_modified)
        VALUES (name, abbreviation, user, user, dateCreated, dateCreated);
    END IF;
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = last_insert_id() ;
END$$

DROP PROCEDURE IF EXISTS getAllAccess;
DELIMITER $$
CREATE PROCEDURE getAllAccess()
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAccessByName;
DELIMITER $$
CREATE PROCEDURE getAccessByName(name_access varchar(30))
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_name = name_access
    AND ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAccessById;
DELIMITER $$
CREATE PROCEDURE getAccessById(id_access int)
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = id_access
    AND ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAccessByAbbreviation;
DELIMITER $$
CREATE PROCEDURE getAccessByAbbreviation(abbreviation_access varchar(30))
BEGIN
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_abbreviation = abbreviation_access
    AND ac_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteAccessById;
DELIMITER $$
CREATE PROCEDURE deleteAccessById(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE access
        SET ac_deleted=1, ac_user_modified_fk=user
        WHERE ac_id = id;
    ELSE
        UPDATE access
        SET ac_deleted=1, ac_user_modified_fk=user, ac_user_modified_fk = dateModified
        WHERE ac_id = id;
    END IF;
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = id;
END$$


DROP PROCEDURE IF EXISTS deactivateAccessById;
DELIMITER $$
CREATE PROCEDURE deactivateAccessById(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE access
        SET ac_active=0, ac_user_modified_fk=user
        WHERE ac_id = id AND ac_deleted = 0;
    ELSE
        UPDATE access
        SET ac_active=0, ac_user_modified_fk=user, ac_date_modified=dateModified
        WHERE ac_id = id AND ac_deleted = 0;
    END IF;
    SELECT ac_id id,
           ac_name name,
           ac_abbreviation abbreviation,
           ac_active active,
           ac_deleted 'delete',
           ac_user_created_fk userCreator,
           ac_user_modified_fk userModifier,
           ac_user_modified_fk userModifier,
           ac_date_created dateCreated,
           ac_date_modified dateModified
    FROM access
    WHERE ac_id = id
    AND ac_deleted = 0;
END$$


DROP PROCEDURE IF EXISTS insertAgency;
DELIMITER $$
CREATE PROCEDURE insertAgency(name varchar(45), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO agency(ag_name, ag_user_created_fk, ag_user_modified_fk)
        VALUES (name, user, user);
    ELSE
        INSERT INTO agency(ag_name, ag_user_created_fk, ag_user_modified_fk, ag_date_created, ag_date_modified)
        VALUES (name, user, user, dateCreated, dateCreated);
    END IF;
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

DROP PROCEDURE IF EXISTS updateAgency;
DELIMITER $$
CREATE PROCEDURE updateAgency(id int, name varchar(45), user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE agency
        SET ag_name=name, ag_user_modified_fk=user
        WHERE ag_id = id
          AND ag_deleted = 0;
    ELSE
        UPDATE agency
        SET ag_name=name, ag_user_modified_fk=user, ag_date_modified=dateModified
        WHERE ag_id = id
          AND ag_deleted = 0;
    END IF;
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_id = id
      AND ag_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS activeAgency;
DELIMITER $$
CREATE PROCEDURE activeAgency(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE agency
        SET ag_active = 1, ag_user_modified_fk=user
        WHERE ag_id = id
          AND ag_deleted = 0;;
    ELSE
        UPDATE agency
        SET ag_active=1, ag_user_modified_fk=user, ag_date_modified=dateModified
        WHERE ag_id = id
          AND ag_deleted = 0;
    END IF;
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_id = id AND ag_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS inactiveAgency;
DELIMITER $$
CREATE PROCEDURE inactiveAgency(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE agency
        SET ag_active = 0, ag_user_modified_fk = user
        WHERE ag_id = id AND ag_deleted = 0;;
    ELSE
        UPDATE agency
        SET ag_active = 0, ag_user_modified_fk = user, ag_date_modified = dateModified
        WHERE ag_id = id;
    END IF;
    SELECT ag_id id,
           ag_name name,
           ag_active active,
           ag_deleted 'delete',
           ag_user_created_fk userCreator,
           ag_date_created dateCreated,
           ag_user_modified_fk userModifier,
           ag_date_modified dateModified
    FROM agency
    WHERE ag_id = id
      AND ag_deleted = 0 AND ag_deleted = 0;
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
    WHERE ag_id = id_agency
      AND ag_deleted = 0;
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
    FROM agency
    WHERE ag_deleted = 0;
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
    WHERE ag_name = name_agency AND ag_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteAgency;
DELIMITER $$
CREATE PROCEDURE deleteAgency(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE agency
        SET ag_deleted = 1, ag_user_modified_fk = user
        WHERE ag_id = id AND ag_deleted = 0;;
    ELSE
        UPDATE agency
        SET ag_deleted = 1, ag_user_modified_fk = user, ag_date_modified=dateModified
        WHERE ag_id = id AND ag_deleted = 0;;
    END IF;
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


DROP PROCEDURE IF EXISTS insertExtra;
DELIMITER $$
CREATE PROCEDURE insertExtra(name varchar(45), icon varchar(45), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO extra (ex_name, ex_icon, ex_user_created_fk, ex_user_modified_fk)
        VALUES (name, icon, user, user);
    ELSE
        INSERT INTO extra (ex_name, ex_icon, ex_user_created_fk, ex_user_modified_fk, ex_date_created,
                           ex_date_modified)
        VALUES (name, icon, user, user, dateCreated, dateCreated);
    END IF;

    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateExtra;
DELIMITER $$
CREATE PROCEDURE updateExtra(id int, name varchar(45), icon varchar(45), user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_name=name, ex_icon=icon, ex_user_modified_fk=user
        WHERE ex_id = id AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_name=name, ex_icon=icon, ex_user_modified_fk=user, ex_date_modified=dateModified
        WHERE ex_id = id AND ex_deleted = 0;;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id AND ex_deleted = 0;;
END$$

DROP PROCEDURE IF EXISTS getAllExtras;
DELIMITER $$
CREATE PROCEDURE getAllExtras()
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllExtrasByState;
DELIMITER $$
CREATE PROCEDURE getAllExtrasByState(ex_state int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_deleted = 0
      AND ex_active = ex_state;
END$$

DROP PROCEDURE IF EXISTS getExtraById;
DELIMITER $$
CREATE PROCEDURE getExtraById(id_extra int)
BEGIN
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteExtraById;
DELIMITER $$
CREATE PROCEDURE deleteExtraById(id_extra int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_deleted = 1, ex_user_modified_fk = id_user
        WHERE ex_id = id_extra AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_deleted = 1, ex_user_modified_fk = id_user, ex_date_modified=dateModified
        WHERE ex_id = id_extra AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS inactiveExtraById;
DELIMITER $$
CREATE PROCEDURE inactiveExtraById(id_extra int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_active = 0, ex_user_modified_fk = id_user
        WHERE ex_id = id_extra AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_active = 0, ex_user_modified_fk = id_user, ex_date_modified = dateModified
        WHERE ex_id = id_extra AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS activeExtraById;
DELIMITER $$
CREATE PROCEDURE activeExtraById(id_extra int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE extra
        SET ex_active = 1,
            ex_user_modified_fk = id_user
        WHERE ex_id = id_extra AND ex_deleted = 0;
    ELSE
        UPDATE extra
        SET ex_active = 1,
            ex_user_modified_fk = id_user, ex_date_modified = dateModified
        WHERE ex_id = id_extra AND ex_deleted = 0;
    END IF;
    SELECT ex_id id,
           ex_name name,
           ex_active active,
           ex_deleted 'delete',
           ex_icon icon,
           ex_user_created_fk userCreator,
           ex_date_created dateCreated,
           ex_user_modified_fk userModifier,
           ex_date_modified dateModified
    FROM extra
    WHERE ex_id = id_extra AND ex_deleted = 0;
END$$



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


DROP PROCEDURE IF EXISTS insertOrigin;
DELIMITER $$
CREATE PROCEDURE insertOrigin(name varchar(50), private varchar(512), public varchar(256),
                              user int)
BEGIN
    INSERT INTO origin(or_name, or_private_key, or_public_key, or_user_created_fk,
                       or_user_modified_fk)
    VALUES (name, private, public, user, user);
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getOriginByPublicKey;
DELIMITER $$
CREATE PROCEDURE getOriginByPublicKey(public varchar(256))
BEGIN
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk userCreator,
           or_date_created dateCreated,
           or_user_modified_fk userModifier,
           or_date_modified dateModified
    FROM origin
    WHERE or_public_key = public;
END$$

DROP PROCEDURE IF EXISTS getOriginById;
DELIMITER $$
CREATE PROCEDURE getOriginById(origin_id int)
BEGIN
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk userCreator,
           or_date_created dateCreated,
           or_user_modified_fk userModifier,
           or_date_modified dateModified
    FROM origin
    WHERE or_id = origin_id;
END$$

DROP PROCEDURE IF EXISTS deleteOriginById;
DELIMITER $$
CREATE PROCEDURE deleteOriginById(id_origin int, id_user int)
BEGIN
    UPDATE origin
    SET or_deleted = 1,
        or_user_modified_fk = id_user
    WHERE or_id = id_origin;
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk userCreator,
           or_date_created dateCreated,
           or_user_modified_fk userModifier,
           or_date_modified dateModified
    FROM origin
    WHERE or_id = id_origin;
END$$

DROP PROCEDURE IF EXISTS inactiveOriginById;
DELIMITER $$
CREATE PROCEDURE inactiveOriginById(id_origin int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE origin
        SET or_active = 0,
            or_user_modified_fk = id_user
        WHERE or_id = id_origin;
    ELSE
        UPDATE origin
        SET or_active = 0,
            or_user_modified_fk = id_user, or_date_modified=dateModified
        WHERE or_id = id_origin;
    END IF;
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk userCreator,
           or_date_created dateCreated,
           or_user_modified_fk userModifier,
           or_date_modified dateModified
    FROM origin
    WHERE or_id = id_origin;
END$$

DROP PROCEDURE IF EXISTS activeOriginById;
DELIMITER $$
CREATE PROCEDURE activeOriginById(id_origin int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE origin
        SET or_active = 1,
            or_user_modified_fk = id_user
        WHERE or_id = id_origin;
    ELSE
        UPDATE origin
        SET or_active = 1,
            or_user_modified_fk = id_user, or_date_modified = dateModified
        WHERE or_id = id_origin;
    END IF;
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk userCreator,
           or_date_created dateCreated,
           or_user_modified_fk userModifier,
           or_date_modified dateModified
    FROM origin
    WHERE or_id = id_origin;
END$$


/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertPlan;
DELIMITER $$
CREATE PROCEDURE insertPlan(name varchar(45), price double(10, 2), user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO plan (pl_name, pl_price, pl_user_created_fk, pl_user_modified_fk)
        VALUES (name, price, user, user);
    ELSE
        INSERT INTO plan (pl_name, pl_price, pl_user_created_fk, pl_user_modified_fk,pl_date_created,
                          pl_date_modified)
        VALUES (name, price, user, user,dateCreated,dateCreated);
    END IF;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_id = LAST_INSERT_ID()
      AND pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS updatePlan;
DELIMITER $$
CREATE PROCEDURE updatePlan(id_plan int, name varchar(45), price double(10, 2), user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE plan SET pl_name = name, pl_price = price, pl_user_modified_fk = user
        WHERE pl_id = id_plan AND pl_deleted = 0;
    ELSE
        UPDATE plan SET pl_name = name, pl_price = price, pl_user_modified_fk = user,
                        pl_date_modified = dateModified
        WHERE pl_id = id_plan AND pl_deleted = 0;
    END IF;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_id = id_plan AND pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deletePlan;
DELIMITER $$
CREATE PROCEDURE deletePlan(id_plan int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE plan
        SET pl_deleted = 1, pl_user_modified_fk = id_user
        WHERE pl_id = id_plan AND pl_deleted = 0;
    ELSE
        UPDATE plan
        SET pl_deleted = 1, pl_user_modified_fk = id_user, pl_date_modified = dateModified
        WHERE pl_id = id_plan AND pl_deleted = 0;
    END IF;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_id = id_plan AND pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS inactivePlan;
DELIMITER $$
CREATE PROCEDURE inactivePlan(id_plan int, id_user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE plan
        SET pl_active = 0,
            pl_user_modified_fk = id_user
        WHERE pl_id = id_plan AND pl_deleted = 0;
    ELSE
        UPDATE plan
        SET pl_active = 0,
            pl_user_modified_fk = id_user, pl_date_modified = dateModified
        WHERE pl_id = id_plan AND pl_deleted = 0;
    END IF;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_id = id_plan AND pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS activePlan;
DELIMITER $$
CREATE PROCEDURE activePlan(id_plan int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE plan
        SET pl_active = 1,
            pl_user_modified_fk = id_user
        WHERE pl_id = id_plan AND pl_deleted = 0;
    ELSE
        UPDATE plan
        SET pl_active = 1,
            pl_user_modified_fk = id_user, pl_date_modified = dateModified
        WHERE pl_id = id_plan AND pl_deleted = 0;
    END IF;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_id = id_plan AND pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllPlans;
DELIMITER $$
CREATE PROCEDURE getAllPlans()
BEGIN
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPlanById;
DELIMITER $$
CREATE PROCEDURE getPlanById(plan_id int)
BEGIN
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE pl_id = plan_id AND pl_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPlanByName;
DELIMITER $$
CREATE PROCEDURE getPlanByName(plan_name varchar(45))
BEGIN
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk userCreator,
           pl_user_modified_fk userModifier,
           pl_date_created dateCreated,
           pl_date_modified dateModified
    FROM plan
    WHERE lower(pl_name) = plan_name AND pl_deleted = 0;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertProperty;
DELIMITER $$
CREATE PROCEDURE insertProperty(name varchar(45), area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO property(pr_name, pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                             pr_user_created_fk, pr_user_modified_fk)
        VALUES (name, area, description, floor, type, location, user, user);
    ELSE
        INSERT INTO property(pr_name, pr_area, pr_description, pr_floor, pr_type_fk, pr_location_fk,
                             pr_user_created_fk, pr_user_modified_fk, pr_date_created, pr_date_modified)
        VALUES (name, area, description, floor, type, location, user, user, dateCreated, dateCreated);
    END IF;
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE pr_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateProperty;
DELIMITER $$
CREATE PROCEDURE updateProperty(id int, name varchar(45), area double(20, 2), description varchar(500),
                                floor tinyint, type int, location int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_name=name, pr_area = area, pr_description= description, pr_floor = floor,
            pr_type_fk= type, pr_location_fk= location,
            pr_user_modified_fk=user
        WHERE pr_id = id;
    ELSE
        UPDATE property
        SET pr_name=name, pr_area = area, pr_description= description, pr_floor = floor, pr_type_fk= type,
            pr_location_fk= location, pr_user_modified_fk=user, pr_date_modified= dateModified
        WHERE pr_id = id;
    END IF;
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE pr_id = id;
END$$

DROP PROCEDURE IF EXISTS getAllPropertyActives;

DROP PROCEDURE IF EXISTS getAllProperty;
DELIMITER $$
CREATE PROCEDURE getAllProperty()
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE pr_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPropertyById;
DELIMITER $$
CREATE PROCEDURE getPropertyById(id_pro int)
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id AND pr_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByType;
DELIMITER $$
CREATE PROCEDURE getPropertiesByType(id_type int)
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE pr_type_fk = id_type AND pr_deleted = 0 AND pr_active = 1;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByUserCreator;
DELIMITER $$
CREATE PROCEDURE getPropertiesByUserCreator(id_user int)
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE pr_user_created_fk = id_user AND pr_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getPropertiesByUserCreatorAndState;


DROP PROCEDURE IF EXISTS deletePropertyById;
DELIMITER $$
CREATE PROCEDURE deletePropertyById(id_pro int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_deleted = 1,
            pr_user_modified_fk = id_user
        WHERE pr_id = id_pro;
    ELSE
        UPDATE property
        SET pr_deleted = 1,
            pr_user_modified_fk = id_user, pr_date_modified = dateModified
        WHERE pr_id = id_pro;
    END IF;
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$

DROP PROCEDURE IF EXISTS inactivePropertyById;
DELIMITER $$
CREATE PROCEDURE inactivePropertyById(id_pro int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_active = 0,
            pr_user_modified_fk = id_user
        WHERE pr_id = id_pro;
    ELSE
        UPDATE property
        SET pr_active = 0,
            pr_user_modified_fk = id_user, pr_date_modified = dateModified
        WHERE pr_id = id_pro;
    END IF;
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$

DROP PROCEDURE IF EXISTS activePropertyById;
DELIMITER $$
CREATE PROCEDURE activePropertyById(id_pro int, id_user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property
        SET pr_active = 1,
            pr_user_modified_fk = id_user
        WHERE pr_id = id_pro;
    ELSE
        UPDATE property
        SET pr_active = 1,
            pr_user_modified_fk = id_user, pr_date_modified = dateModified
        WHERE pr_id = id_pro;
    END IF;
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
           pr_user_created_fk userCreator,
           pr_date_created dateCreated,
           pr_user_modified_fk userModifier,
           pr_date_modified dateModified
    FROM property
    WHERE id_pro = pr_id;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/


/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertPropertyPrice;
DELIMITER $$
CREATE PROCEDURE insertPropertyPrice(price double(20, 2), final tinyint, property int, user int,
                                     dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO property_price(pp_price, pp_final, pp_property_fk, pp_user_created_fk,
                                   pp_user_modified_fk)
        VALUES (price, final, property, user, user);
    ELSE
        INSERT INTO property_price(pp_price, pp_final, pp_property_fk, pp_user_created_fk,
                                   pp_user_modified_fk,pp_date_created,pp_date_modified)
        VALUES (price, final, property, user, user,dateCreated,dateCreated);
    END IF;
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updatePropertyPrice;
DELIMITER $$
CREATE PROCEDURE updatePropertyPrice(id int,price double(20, 2), final tinyint, property int, user int,
                                     dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE property_price SET pp_price=price, pp_final=final,pp_property_fk=property,pp_user_modified_fk=user
        WHERE pp_id=id;
    ELSE
        UPDATE property_price SET pp_price=price, pp_final=final,pp_property_fk=property,pp_user_modified_fk=user,
                                  pp_date_modified = dateModified
        WHERE pp_id=id;
    END IF;
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = id;
END$$

DROP PROCEDURE IF EXISTS getAllPropertyPrice;
DELIMITER $$
CREATE PROCEDURE getAllPropertyPrice()
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price;
END$$

DROP PROCEDURE IF EXISTS getPropertyPriceById;
DELIMITER $$
CREATE PROCEDURE getPropertyPriceById(id_property_price int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = id_property_price;
END$$

DROP PROCEDURE IF EXISTS getPropertyPriceByPropertyId;
DELIMITER $$
CREATE PROCEDURE getPropertyPriceByPropertyId(id_property int)
BEGIN
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_property_fk = id_property;
END$$

DROP PROCEDURE IF EXISTS deletePropertyPrice;
DELIMITER $$
CREATE PROCEDURE deletePropertyPrice(id int,user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE property_price
        SET pp_deleted = 1, pp_user_modified_fk=user
        WHERE pp_id = id;
    ELSE
        UPDATE property_price
        SET pp_deleted = 1, pp_user_modified_fk=user, pp_date_modified = dateModified
        WHERE pp_id = id;
    END IF;
    SELECT pp_id id,
           pp_price price,
           pp_final final,
           pp_active active,
           pp_deleted 'delete',
           pp_property_fk property,
           pp_user_created_fk userCreator,
           pp_date_created dateCreated,
           pp_user_modified_fk userModifier,
           pp_date_modified dateModified
    FROM property_price
    WHERE pp_id = id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertPropertyType;
DELIMITER $$
CREATE PROCEDURE insertPropertyType(name varchar(30), image varchar(30), user int, dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO property_type(pt_name, pt_image, pt_user_created_fk, pt_user_modified_fk)
        VALUES (name, image, user, user);
    ELSE
        INSERT INTO property_type(pt_name, pt_image, pt_user_created_fk, pt_user_modified_fk, pt_date_created,
                                  pt_date_modified)
        VALUES (name, image, user, user, dateCreated, dateCreated);
    END IF;
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updatePropertyType;
DELIMITER $$
CREATE PROCEDURE updatePropertyType(id int, name varchar(30), image varchar(30), user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE property_type
        SET pt_name=name, pt_image=image, pt_user_modified_fk=user
        WHERE pt_id = id;
    ELSE
        UPDATE property_type
        SET pt_name=name, pt_image=image, pt_user_modified_fk=user, pt_date_modified=dateModified
        WHERE pt_id = id;
    END IF;
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = id;
END$$

DROP PROCEDURE IF EXISTS getPropertyTypebyId;
DELIMITER $$
CREATE PROCEDURE getPropertyTypebyId(id int)
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = id;
END$$


DROP PROCEDURE IF EXISTS getAllPropertyType;
DELIMITER $$
CREATE PROCEDURE getAllPropertyType()
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type;
END$$

DROP PROCEDURE IF EXISTS getPropertyTypeByName;
DELIMITER $$
CREATE PROCEDURE getPropertyTypeByName(name varchar(30))
BEGIN
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE lower(pt_name) = name;
END$$

DROP PROCEDURE IF EXISTS deletePropertyType;
DELIMITER $$
CREATE PROCEDURE deletePropertyType(id int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE
            property_type
        SET pt_deleted = TRUE, pt_user_modified_fk = user
        WHERE pt_id = id;
    ELSE
        UPDATE
            property_type
        SET pt_deleted = TRUE, pt_user_modified_fk = user, pt_date_modified = dateModified
        WHERE pt_id = id;
    END IF;
    SELECT pt_id id,
           pt_name name,
           pt_image image,
           pt_active active,
           pt_deleted 'delete',
           pt_user_created_fk userCreator,
           pt_user_modified_fk userModifier,
           pt_date_created dateCreated,
           pt_date_modified dateModified
    FROM property_type
    WHERE pt_id = id;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertRating;
DELIMITER $$
CREATE PROCEDURE insertRating(score float, message varchar(200), user_target int, userCreated int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO rating(ra_score, ra_message, ra_user_fk, ra_user_created_fk, ra_user_modified_fk)
        VALUES (score, message, user_target, userCreated, userCreated);
    ELSE
        INSERT INTO rating(ra_score, ra_message, ra_user_fk, ra_user_created_fk, ra_user_modified_fk,ra_date_created,ra_date_modified)
        VALUES (score, message, user_target, userCreated, userCreated,dateCreated,dateCreated);
    END IF;
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_user_fk userTarget,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_user_modified_fk userModifier,
           ra_date_created dateCreated,
           ra_date_modified dateModified
    FROM rating
    WHERE ra_id = last_insert_id() AND ra_deleted = 0;
END$$

DELIMITER ;

DROP PROCEDURE IF EXISTS updateRating;
DELIMITER $$
CREATE PROCEDURE updateRating(id int,score float, message varchar(200), userModifier int,
                              dateModified DATE)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE rating SET ra_score = score, ra_message = message,
                          ra_user_modified_fk = userModifier
        WHERE ra_id = id AND ra_deleted = 0;
    ELSE
        UPDATE rating SET ra_score = score, ra_message = message,
                          ra_user_modified_fk = userModifier, ra_date_modified = dateModified
        WHERE ra_id = id AND ra_deleted = 0;
    END IF;
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_user_fk userTarget,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_user_modified_fk userModifier,
           ra_date_created dateCreated,
           ra_date_modified dateModified
    FROM rating
    WHERE ra_id = id AND ra_deleted = 0;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS getRatingById;
DELIMITER $$
CREATE PROCEDURE getRatingById(id int)
BEGIN
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_user_fk userTarget,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_user_modified_fk userModifier,
           ra_date_created dateCreated,
           ra_date_modified dateModified
    FROM rating
    WHERE ra_id = id AND ra_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteRatingById;
DELIMITER $$
CREATE PROCEDURE deleteRatingById(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE rating
        SET ra_deleted = 1, ra_user_modified_fk = user
        WHERE ra_id = id AND ra_deleted = 0;
    ELSE
        UPDATE rating
        SET ra_deleted = 1, ra_user_modified_fk = user, ra_date_modified = dateModified
        WHERE ra_id = id AND ra_deleted = 0;
    END IF;
    SELECT ra_id id,
           ra_score score,
           ra_user_fk userTarget,
           ra_message message,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_user_modified_fk userModifier,
           ra_date_created dateCreated,
           ra_date_modified dateModified
    FROM rating
    WHERE ra_id = id AND ra_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllRatingByUser;
DELIMITER $$
CREATE PROCEDURE getAllRatingByUser(id_user int)
BEGIN
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_user_fk userTarget,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_user_modified_fk userModifier,
           ra_date_created dateCreated,
           ra_date_modified dateModified
    FROM rating
    WHERE ra_user_fk = id_user AND ra_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllRating;
DELIMITER $$
CREATE PROCEDURE getAllRating()
BEGIN
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_user_fk userTarget,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_user_modified_fk userModifier,
           ra_date_created dateCreated,
           ra_date_modified dateModified
    FROM rating
    WHERE ra_deleted = 0;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertRequest;
DELIMITER $$
CREATE PROCEDURE insertRequest(property int, user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk)
        VALUES (property, user, user);
    ELSE
        INSERT INTO request(re_property_fk, re_user_created_fk, re_user_modified_fk,
                            re_date_created,re_date_modified)
        VALUES (property, user, user,dateCreated,dateCreated);
    END IF;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = last_insert_id() AND re_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS updateRequest;
DELIMITER $$
CREATE PROCEDURE updateRequest(id int,property int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE request set re_property_fk = property, re_user_modified_fk = user
        WHERE re_id = id AND re_deleted = 0;
    ELSE
        UPDATE request set re_property_fk = property, re_user_modified_fk = user,
                           re_date_modified = dateModified
        WHERE re_id = id AND re_deleted = 0;
    END IF;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id AND re_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getAllRequest;
DELIMITER $$
CREATE PROCEDURE getAllRequest()
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getRequestById;
DELIMITER $$
CREATE PROCEDURE getRequestById(id_req int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id_req AND re_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getRequestByUserId;
DELIMITER $$
CREATE PROCEDURE getRequestByUserId(id_user int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_user_created_fk = id_user
      AND re_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getRequestByPropertyId;
DELIMITER $$
CREATE PROCEDURE getRequestByPropertyId(id_property int)
BEGIN
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           CONCAT(us_first_name, us_last_name) userCreator,
           CONCAT(us_first_name, us_last_name) userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request, user
    WHERE re_property_fk = id_property
      AND re_user_created_fk = us_id
      AND re_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteRequest;
DELIMITER $$
CREATE PROCEDURE deleteRequest(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE request SET re_deleted=1, re_date_modified=user
        WHERE  re_id=id AND re_deleted = 0;
    ELSE
        UPDATE request SET re_deleted=1, re_date_modified=user, re_date_modified = dateModified
        WHERE  re_id=id AND re_deleted = 0;
    END IF;
    SELECT re_id id,
           re_property_fk property,
           re_active active,
           re_deleted 'delete',
           re_user_created_fk userCreator,
           re_user_modified_fk userModifier,
           re_date_created dateCreated,
           re_date_modified dateModified
    FROM request
    WHERE re_id = id AND re_deleted = 0;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertRol;
DELIMITER $$
CREATE PROCEDURE insertRol(name varchar(45), user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO rol(ro_name, ro_user_created_fk, ro_user_modified_fk)
        VALUES (name, user, user);
    ELSE
        INSERT INTO rol(ro_name, ro_user_created_fk, ro_user_modified_fk,ro_date_created,
                        ro_date_modified)
        VALUES (name, user, user,dateCreated,dateCreated);
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateRol;
DELIMITER $$
CREATE PROCEDURE updateRol(id int,name varchar(45), user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE rol SET ro_name=name,ro_user_modified_fk=user
        WHERE ro_id=id AND ro_deleted = 0;
    ELSE
        UPDATE rol SET ro_name=name,ro_user_modified_fk=user,ro_date_modified=dateModified
        WHERE ro_id=id AND ro_deleted = 0;
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = id AND ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getRolById;
DELIMITER $$
CREATE PROCEDURE getRolById(id int)
BEGIN
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = id AND ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deleteRolById;
DELIMITER $$
CREATE PROCEDURE deleteRolById(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE rol
        SET ro_deleted = 1,
            ro_user_modified_fk = user
        WHERE ro_id = id AND ro_deleted = 0;
    ELSE
        UPDATE rol
        SET ro_deleted = 1,
            ro_user_modified_fk = user, ro_date_modified = dateModified
        WHERE ro_id = id AND ro_deleted = 0;
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_id = id AND ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS getAllRoles;
DELIMITER $$
CREATE PROCEDURE getAllRoles()
BEGIN
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS activateRol;
DELIMITER $$
CREATE PROCEDURE activateRol(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE rol
        SET ro_active = 1,
            ro_user_modified_fk = user
        WHERE ro_id = id;
    ELSE
        UPDATE rol
        SET ro_active = 1,
            ro_user_modified_fk = user, ro_date_modified = dateModified
        WHERE ro_id = id;
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_deleted = 0 AND ro_id = id;
END$$

DROP PROCEDURE IF EXISTS inactiveRol;
DELIMITER $$
CREATE PROCEDURE inactiveRol(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE rol
        SET ro_active = 0,
            ro_user_modified_fk = user
        WHERE ro_id = id;
    ELSE
        UPDATE rol
        SET ro_active = 0,
            ro_user_modified_fk = user, ro_date_modified = dateModified
        WHERE ro_id = id;
    END IF;
    SELECT ro_id id,
           ro_name name,
           ro_active active,
           ro_deleted 'delete',
           ro_user_created_fk userCreator,
           ro_date_created dateCreated,
           ro_user_modified_fk userModifier,
           ro_date_modified dateModified
    FROM rol
    WHERE ro_deleted = 0 AND ro_id = id;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

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
    WHERE se_id = last_insert_id() AND se_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS updateSeat;
DELIMITER $$
CREATE PROCEDURE updateSeat(id int,name varchar(100), rif varchar(20), location int, agency int,
                            user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE seat set se_name=name, se_rif=rif, se_location_fk=location,se_agency_fk=agency,
                        se_user_modified_fk=user
        WHERE se_id = id AND se_deleted = 0;
    ELSE
        UPDATE seat set se_name=name, se_rif=rif, se_location_fk=location,se_agency_fk=agency,
                        se_user_modified_fk=user, se_date_modified=dateModified
        WHERE se_id = id AND se_deleted = 0;
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
    WHERE se_id = id AND se_deleted = 0;
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
    FROM seat
    WHERE se_deleted = 0;
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
    WHERE se_id = id_seat AND se_deleted = 0;
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

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS createUser;
DELIMITER $$
CREATE PROCEDURE createUser(firstName varchar(45), lastName varchar(45), address varchar(255), email varchar(60),
                            password varchar(60), seat int, rol int, plan int, location int, userCreator int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO user(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk)
        VALUES (firstName, lastName, address, email, password, seat, rol, plan, location, userCreator, userCreator);
    ELSE
        INSERT INTO user(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk, us_date_modified,
                         us_date_created)
        VALUES (firstName, lastName, address, email, password, seat, rol, plan, location, userCreator, userCreator,
                dateCreated, dateCreated);
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS updateUser;
DELIMITER $$
CREATE PROCEDURE updateUser(id int, firstName varchar(45), lastName varchar(45), address varchar(255), email varchar(60),
                            password varchar(60), seat int, rol int, location int, user int,
                            dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address,
            us_email = email, us_password = password, us_seat_fk=seat, us_rol_fk = rol,
            us_location_fk = location, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address,
            us_email = email, us_password = password, us_seat_fk=seat, us_rol_fk = rol,
            us_location_fk = location, us_user_modified_fk = user, us_date_modified=dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;
END$$

DROP PROCEDURE IF EXISTS updateUserProfile;
DELIMITER $$
CREATE PROCEDURE updateUserProfile(id int, firstName varchar(45), lastName varchar(45),
                                   address varchar(200))
BEGIN
    UPDATE user
    SET us_first_name = firstName, us_last_name = lastName, us_address = address
    WHERE us_id = id;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;
END$$

DROP PROCEDURE IF EXISTS getUserById;
DELIMITER $$
CREATE PROCEDURE getUserById(user_id int)
BEGIN
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = user_id;
END$$

DROP PROCEDURE IF EXISTS getUserByEmail;
DELIMITER $$
CREATE PROCEDURE getUserByEmail(user_email varchar(45))
BEGIN
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND lower(us.us_email) = user_email;
END$$


DROP PROCEDURE IF EXISTS getAllUsers;
DELIMITER $$
CREATE PROCEDURE getAllUsers()
BEGIN
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id;
END$$

DROP PROCEDURE IF EXISTS deleteUser;
DELIMITER $$
CREATE PROCEDURE deleteUser(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_deleted = 1, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_deleted = 1, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;

END$$

DROP PROCEDURE IF EXISTS activeUser;
DELIMITER $$
CREATE PROCEDURE activeUser(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_active = 1, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_active = 1, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;

END$$

DROP PROCEDURE IF EXISTS inactiveUser;
DELIMITER $$
CREATE PROCEDURE inactiveUser(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_active = 0, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_active = 0, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;

END$$

DROP PROCEDURE IF EXISTS changePassword;
DELIMITER $$
CREATE PROCEDURE changePassword(id int, password varchar (255),user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_password = password, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_password = password, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;
END$$

DROP PROCEDURE IF EXISTS blockUser;
DELIMITER $$
CREATE PROCEDURE blockUser(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_blocked = 1, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_blocked = 1, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;

END$$


DROP PROCEDURE IF EXISTS unlockUser;
DELIMITER $$
CREATE PROCEDURE unlockUser(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_blocked = 0, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_blocked = 0, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_location_fk = lo.lo_id
      AND us.us_plan_fk = pl.pl_id
      AND us.us_rol_fk = ro.ro_id
      AND us.us_seat_fk = se.se_id
      AND us.us_id = id;

END$$


/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertFavorite;
DELIMITER $$
CREATE PROCEDURE insertFavorite(property int, user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO favorite(fa_property_fk, fa_user_created_fk, fa_user_modified_fk)
        VALUES (property, user, user);
    ELSE
        INSERT INTO favorite(fa_property_fk, fa_user_created_fk, fa_user_modified_fk,
                             fa_date_created,fa_date_modified)
        VALUES (property, user, user,dateCreated,dateCreated);
    END IF;
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorite
    WHERE fa_id = last_insert_id();
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS activeFavorite;
DELIMITER $$
CREATE PROCEDURE activeFavorite(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE favorites SET fa_active=1, fa_date_modified=user
        WHERE  fa_id=id AND fa_deleted = 0;
    ELSE
        UPDATE favorites SET fa_active=1, fa_date_modified=user, fa_date_modified = dateModified
        WHERE  fa_id=id AND fa_deleted = 0;
    END IF;
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorites
    WHERE re_id = id AND re_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getFavoriteByUserId;
DELIMITER $$
CREATE PROCEDURE getFavoriteByUserId(id_user int)
BEGIN
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorite
    WHERE fa_user_created_fk = id_user
      AND fa_deleted = 0;
END$$


/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

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

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertAccessRol;
DELIMITER $$
CREATE PROCEDURE insertAccessRol(rol_fk int, access_fk int, user int, datecreated datetime)
BEGIN
    IF IsNull(datecreated) THEN
        INSERT INTO rol_access (ra_rol_fk, ra_access_fk, ra_user_created_fk, ra_user_modified_fk)
        VALUES (rol_fk, access_fk, user, user);
    ELSE
        INSERT INTO rol_access (ra_rol_fk, ra_access_fk, ra_user_created_fk, ra_user_modified_fk,
                                ra_date_created, ra_date_modified)
        VALUES (ra_rol_fk, ra_access_fk, user, user, datecreated, datecreated);
    END IF;
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ra_active active,
           ac_name accessName,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access, access
    WHERE ra_id = last_insert_id() AND ac_id = ra_access_fk;
END$$

DROP PROCEDURE IF EXISTS getAccessByRol;
DELIMITER $$
CREATE PROCEDURE getAccessByRol(id_rol int)
BEGIN
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ac_name accessName,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access,
         access
    WHERE ra_rol_fk = id_rol
      AND ra_active = 1
      AND ra_deleted = 0;
END$$

DROP PROCEDURE IF EXISTS deactivateRolAccessById;
DELIMITER $$
CREATE PROCEDURE deactivateRolAccessById(id int, user int, datemodified datetime)
BEGIN
    IF IsNull(datemodified) THEN
        UPDATE rol_access
        SET ra_active = 0, ra_user_modified_fk = user
        WHERE ra_id = id;
    ELSE
        UPDATE rol_access
        SET ra_active = 0, ra_user_modified_fk = user, ra_date_modified = datemodified
        WHERE ra_id = id;
    END IF;
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ac_name accessName,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access,
         access
    WHERE ra_id = id
      AND ra_access_fk = ac_id;
END$$

DROP PROCEDURE IF EXISTS activateRolAccessById;
DELIMITER $$
CREATE PROCEDURE activateRolAccessById(id int, user int, datemodified datetime)
BEGIN
    IF IsNull(datemodified) THEN
        UPDATE rol_access
        SET ra_active = 1, ra_user_modified_fk = user
        WHERE ra_id = id;
    ELSE
        UPDATE rol_access
        SET ra_active = 1, ra_user_modified_fk = user, ra_date_modified = datemodified
        WHERE ra_id = id;
    END IF;
    SELECT ra_id id,
           ra_rol_fk rol,
           ra_access_fk access,
           ac_name accessName,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk userCreator,
           ra_date_created dateCreated,
           ra_user_modified_fk userModifier,
           ra_date_modified dateModified
    FROM rol_access,
         access
    WHERE ra_id = id
      AND ra_access_fk = ac_id;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS createSubscription;
DELIMITER $$
CREATE PROCEDURE createSubscription(ci int(10), passport varchar(50), email varchar(60),
                                    password varchar(60), seat int, plan int, location int,
                                    dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO subscription(su_ci, su_passport, su_email, su_password,
                                 su_seat_fk, su_plan_fk,su_location_fk)
        VALUES (ci, passport, email, password, seat, plan, location);
    ELSE
        INSERT INTO subscription(su_ci, su_passport, su_email, su_password,
                                 su_seat_fk, su_plan_fk,su_location_fk, su_date_created)
        VALUES (ci, passport, email, password, seat, plan, location,dateCreated);
    END IF;
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription
    WHERE su_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS inactiveSubscription;
DELIMITER $$
CREATE PROCEDURE inactiveSubscription(id int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE subscription
        SET su_active = 0, su_user_modified_fk= user
        WHERE su_id=id;
    ELSE
        UPDATE subscription
        SET su_active = 0, su_user_modified_fk= user, su_date_modified = dateModified
        WHERE su_id=id;
    END IF;
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription
    WHERE su_id = id;
END$$

DROP PROCEDURE IF EXISTS activeSubscription;
DELIMITER $$
CREATE PROCEDURE activeSubscription(id int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE subscription
        SET su_active = 1, su_user_modified_fk= user
        WHERE su_id=id;
    ELSE
        UPDATE subscription
        SET su_active = 0, su_user_modified_fk= user, su_date_modified = dateModified
        WHERE su_id=id;
    END IF;
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription
    WHERE su_id = id;
END$$

DROP PROCEDURE IF EXISTS deleteSubscription;
DELIMITER $$
CREATE PROCEDURE deleteSubscription(id int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE subscription
        SET su_deleted = 1, su_user_modified_fk= user
        WHERE su_id=id;
    ELSE
        UPDATE subscription
        SET su_active = 0, su_user_modified_fk= user, su_date_modified = dateModified
        WHERE su_id=id;
    END IF;
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription
    WHERE su_id = id;
END$$

DROP PROCEDURE IF EXISTS deleteSubscription;
DELIMITER $$
CREATE PROCEDURE getAllSubscription()
BEGIN
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription;
END$$

DROP PROCEDURE IF EXISTS getSubscriptionById;
DELIMITER $$
CREATE PROCEDURE getSubscriptionById(id int)
BEGIN
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription
    WHERE su_id = id;
END$$

DROP PROCEDURE IF EXISTS getSubscriptionById;
DELIMITER $$
CREATE PROCEDURE getSubscriptionByEmail(email varchar(50))
BEGIN
    SELECT su_id, su_ci,
           su_passport,
           su_email,
           su_password,
           su_deleted,
           su_date_created,
           su_user_modified_fk,
           su_date_modified,
           su_plan_fk,
           su_seat_fk,
           su_location_fk
    FROM subscription
    WHERE su_email = email;
END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/

/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS createSubscriptionDetail;
DELIMITER $$
CREATE PROCEDURE createSubscriptionDetail(subscription_id int,document varchar(255),dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO subscription_detail(sd_document, sd_subscription_fk)
        VALUES (document,subscription_id);
    ELSE
        INSERT INTO subscription_detail(sd_document, sd_subscription_fk,sd_date_created)
        VALUES (document,subscription_id,dateCreated);
    END IF;
    SELECT sd_id,
           sd_document,
           sd_active,
           sd_deleted,
           sd_date_created,
           sd_user_modified_fk,
           sd_date_modified,
           sd_subscription_fk
    FROM subscription_detail
    WHERE sd_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getSubscriptionDetailBySubscription;
DELIMITER $$
CREATE PROCEDURE getSubscriptionDetailBySubscription(subscriptionId int)
BEGIN
    SELECT sd_id,
           sd_document,
           sd_active,
           sd_deleted,
           sd_date_created,
           sd_user_modified_fk,
           sd_date_modified,
           sd_subscription_fk
    FROM subscription_detail
    WHERE sd_subscription_fk = subscriptionId;
END$$

DROP PROCEDURE IF EXISTS getSubscriptionDetailById;
DELIMITER $$
CREATE PROCEDURE getSubscriptionDetailById(id int)
BEGIN
    SELECT sd_id,
           sd_document,
           sd_active,
           sd_deleted,
           sd_date_created,
           sd_user_modified_fk,
           sd_date_modified,
           sd_subscription_fk
    FROM subscription_detail
    WHERE sd_id = id;
END$$

/**
----------------------------------------------------------------------------------------------------------------------
---                                                    END                                                         ---
----------------------------------------------------------------------------------------------------------------------
*/