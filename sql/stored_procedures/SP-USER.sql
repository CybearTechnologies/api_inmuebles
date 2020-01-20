/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS getuserbyid;
DELIMITER $$
CREATE PROCEDURE getuserbyid(user_id int)
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
           us.us_user_created_fk usercreator,
           us.us_user_modified_fk usermodifier,
           us.us_date_created datecreated,
           us.us_date_modified datemodified
    FROM user us
    WHERE us_id = user_id;
END$$

DROP PROCEDURE IF EXISTS getuserbyemail;
DELIMITER $$
CREATE PROCEDURE getuserbyemail(user_email varchar(45))
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
           us.us_user_created_fk usercreator,
           us.us_user_modified_fk usermodifier,
           us.us_date_created datecreated,
           us.us_date_modified datemodified
    FROM user us
    WHERE lower(us.us_email) = user_email;
END$$


DROP PROCEDURE IF EXISTS getallusers;
DELIMITER $$
CREATE PROCEDURE getallusers()
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

DROP PROCEDURE IF EXISTS deleteuser;
DELIMITER $$
CREATE PROCEDURE deleteuser(id int, user int)
BEGIN
    UPDATE user
    SET us_deleted = 1, us_user_modified_fk = user
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
           us.us_user_created_fk usercreator,
           us.us_user_modified_fk usermodifier,
           us.us_date_created datecreated,
           us.us_date_modified datemodified
    FROM user us
    WHERE us.us_id = user;

END$$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/