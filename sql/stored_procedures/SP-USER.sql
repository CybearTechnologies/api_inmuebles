/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS createUser;
DELIMITER $$
CREATE PROCEDURE createUser(firstName varchar, lastName varchar, address varchar, email varchar,
                            password varchar, seat int, rol int, plan int, location int, userCreator int,
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
           us.us_deleted deleted,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS modifyUser;
DELIMITER $$
CREATE PROCEDURE modifyUser(id int, firstName varchar, lastName varchar, address varchar, email varchar,
                            password varchar, seat int, rol int, plan int, location int, user int,
                            dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address,
            us_email = email, us_password = password, us_seat_fk=seat, us_rol_fk = rol,
            us_plan_fk=plan, us_location_fk = location, us_user_modified_fk = user
        WHERE us_id = user;
    ELSE
        UPDATE user
        SET us_first_name = firstName, us_last_name = lastName, us_address = address,
            us_email = email, us_password = password, us_seat_fk=seat, us_rol_fk = rol,
            us_plan_fk=plan, us_location_fk = location, us_user_modified_fk = user, us_date_modified=dateModified
        WHERE us_id = user;
    END IF;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted deleted,
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted deleted,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us_id = last_insert_id();
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
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us_id = user_id;
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
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE lower(us.us_email) = user_email;
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
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
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
CREATE PROCEDURE deleteUser(id int, user int)
BEGIN
    UPDATE user
    SET us_deleted = 1, us_user_modified_fk = user
    WHERE us_id = id;
    SELECT us.us_id id,
           us.us_first_name first_name,
           us.us_last_name last_name,
           us.us_address address,
           us.us_deleted 'delete',
           us.us_email email,
           us.us_password password,
           us.us_blocked blocked,
           us.us_deleted 'delete',
           us.us_active active,
           us.us_plan_fk plan,
           us.us_rol_fk rol,
           us.us_location_fk location,
           us.us_seat_fk seat,
           us.us_user_created_fk userCreator,
           us.us_user_modified_fk userModifier,
           us.us_date_created dateCreated,
           us.us_date_modified dateModified
    FROM user us
    WHERE us.us_id = user;

END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/