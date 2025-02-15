/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS createUser;
DELIMITER $$
CREATE PROCEDURE createUser(firstName varchar(45), lastName varchar(45), address varchar(255), email varchar(60),
                            password varchar(60), seat int, agency int,rol int, plan int, location int, userCreator int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO user(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_agency_fk,us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk)
        VALUES (firstName, lastName, address, email, password, seat, agency,rol, plan, location, userCreator, userCreator);
    ELSE
        INSERT INTO user(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_agency_fk,us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk, us_date_modified,
                         us_date_created)
        VALUES (firstName, lastName, address, email, password, seat, agency,rol, plan, location, userCreator, userCreator,
                dateCreated, dateCreated);
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us_id = last_insert_id();
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS createOnlyUser;
DELIMITER $$
CREATE PROCEDURE createOnlyUser(firstName varchar(45), lastName varchar(45), address varchar(255), email varchar(60),
                            password varchar(60), seat int, agency int,rol int, plan int, location int, userCreator int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO user(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_agency_fk ,us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk)
        VALUES (firstName, lastName, address, email, password, seat, agency,rol, plan, location, userCreator, userCreator);
    ELSE
        INSERT INTO user(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_agency_fk ,us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk, us_date_modified,
                         us_date_created)
        VALUES (firstName, lastName, address, email, password, seat, agency,rol, plan, location, userCreator, userCreator,
                dateCreated, dateCreated);
    END IF;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS createMinUser;
DELIMITER $$
CREATE PROCEDURE createMinUser(email varchar(60),
                            password varchar(60), seat int, agency int,rol int, plan int, location int, userCreator int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO user(us_email, us_password, us_seat_fk, us_agency_fk,us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk)
        VALUES (email, password, seat, agency,rol, plan, location, userCreator, userCreator);
    ELSE
        INSERT INTO user( us_email, us_password, us_seat_fk, us_agency_fk,us_rol_fk,
                         us_plan_fk, us_location_fk, us_user_created_fk, us_user_modified_fk, us_date_modified,
                         us_date_created)
        VALUES (email, password, seat, agency,rol, plan, location, userCreator, userCreator,
                dateCreated, dateCreated);
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           pl.pl_name plan,
           ro.ro_name rol,
           lo.lo_name location,
           se.se_name seat,
           us.us_agency_fk agency,
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
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS updateUser;
DELIMITER $$
CREATE PROCEDURE updateUser(id int, firstName varchar(45), lastName varchar(45), address varchar(255), email varchar(60),
                            phone varchar(50),seat int, agency int ,plan int, location int, user int,
                            dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address,
            us_email = email, us_seat_fk=seat, us_agency_fk=agency,us_plan_fk = plan,
            us_location_fk = location, us_user_modified_fk = user, us_phone = phone
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address,
            us_email = email, us_seat_fk=seat, us_agency_fk=agency ,us_plan_fk = plan,
            us_location_fk = location, us_user_modified_fk = user, us_date_modified=dateModified, us_phone = phone
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us,
         plan pl,
         rol ro,
         location lo,
         seat se
    WHERE us.us_id = id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS updateUserProfile;
DELIMITER $$
CREATE PROCEDURE updateUserProfile(id int, firstName varchar(45), lastName varchar(45),
                            address varchar(200),email varchar(255),user int,dateModified datetime,phone varchar(50))
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
            SET us_first_name = firstName, us_last_name = lastName, us_address = address, us_email = lower(email),us_phone = phone
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address, us_email = lower(email),
            us_date_modified=dateModified,us_phone = phone
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;
END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = user_id;
END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE lower(us.us_email) = user_email;
END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us;
END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;

END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;

END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;

END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS changeRol;
DELIMITER $$
CREATE PROCEDURE changeRol(id int, rol int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_rol_fk = rol, us_user_modified_fk = user
        WHERE us_id = id;
    ELSE
        UPDATE user
        SET us_rol_fk = rol, us_user_modified_fk = user, us_date_modified = dateModified
        WHERE us_id = id;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS recoverPassword;
DELIMITER $$
CREATE PROCEDURE recoverPassword(email varchar(255), password varchar (255), dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_password = password
        WHERE us_email = lower(email);
    ELSE
        UPDATE user
        SET us_password = password, us_date_modified = dateModified
        WHERE us_email = lower(email);
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_email = email;
END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;

END $$
DELIMITER ;

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
           us.us_phone phone,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_agency_fk agency,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = id;
END $$
DELIMITER ;

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/