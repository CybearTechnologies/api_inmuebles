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