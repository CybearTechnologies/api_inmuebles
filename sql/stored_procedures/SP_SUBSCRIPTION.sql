/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS createSubscription;
DELIMITER $$
CREATE PROCEDURE createSubscription(ci int(10), firstName varchar(45),lastName varchar(45),
                            address varchar(200),passport varchar(50), email varchar(60),
                            password varchar(60), seat int, agency int,plan int, location int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO subscription(su_ci, su_first_name,su_last_name,su_address,su_passport,
                                 su_email, su_password, su_seat_fk, su_agency_fk,su_plan_fk,su_location_fk)
        VALUES (ci, firstName,lastName,address,passport, email, password, seat, agency,plan, location);
    ELSE
        INSERT INTO subscription(su_ci, su_first_name, su_last_name, su_address,
                                 su_passport, su_email, su_password,
                                 su_seat_fk, su_agency_fk,su_plan_fk,su_location_fk, su_date_created)
        VALUES (ci, firstName,lastName,address,passport, email, password, seat, agency,plan, location,
                dateCreated);
    END IF;
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_id = last_insert_id();
END$$
DELIMITER ;
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
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_id = id;
END$$
DELIMITER ;
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
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_id = id;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS deleteSubscription;
DELIMITER $$
CREATE PROCEDURE deleteSubscription(id int)
BEGIN
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_id = id;
    DELETE FROM subscription_detail WHERE sd_subscription_fk = id;
    DELETE FROM subscription WHERE su_id = id;
END$$
DELIMITER ;

DROP PROCEDURE IF EXISTS approveSubscription;
DELIMITER $$
CREATE PROCEDURE approveSubscription(id int, user int,dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE subscription
        SET su_status = 1, su_user_modified_fk= user
        WHERE su_id=id;
    ELSE
        UPDATE subscription
        SET su_status = 1, su_user_modified_fk= user, su_date_modified = dateModified
        WHERE su_id=id;
    END IF;
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_id = id;
END$$
DELIMITER ;
DROP PROCEDURE IF EXISTS getAllSubscription;
DELIMITER $$
CREATE PROCEDURE getAllSubscription()
BEGIN
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_status = false;
END$$
DELIMITER ;
DROP PROCEDURE IF EXISTS getSubscriptionById;
DELIMITER $$
CREATE PROCEDURE getSubscriptionById(id int)
BEGIN
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_active active,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_id = id
    AND su_status = FALSE;
END$$
DELIMITER ;
DROP PROCEDURE IF EXISTS getSubscriptionByEmail;
DELIMITER $$
CREATE PROCEDURE getSubscriptionByEmail(email varchar(50))
BEGIN
    SELECT su_id id,
           su_ci ci,
           su_first_name firstName,
           su_last_name lastName,
           su_address address,
           su_passport passport,
           su_email email,
           su_password password,
           su_deleted 'delete',
           su_status status,
           su_active active,
           su_date_created dateCreated,
           su_user_modified_fk userModifier,
           su_date_modified dateModified,
           su_plan_fk plan,
           su_seat_fk seat,
           su_agency_fk agency,
           su_location_fk location
    FROM subscription
    WHERE su_email = email;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/