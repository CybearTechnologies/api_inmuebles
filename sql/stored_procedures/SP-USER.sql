/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
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
           us.us_deleted deleted,
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
    SET us_deleted = 1,us_user_modified_fk = user
    WHERE us_id = id;
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
    WHERE us.us_id = user;

END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/