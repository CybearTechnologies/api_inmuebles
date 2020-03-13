/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS createUser;
DELIMITER $$
CREATE PROCEDURE createUser(ci int(10), passport varchar(50), email varchar(60),
                            password varchar(60), seat int, plan int, location int, userCreator int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO subscription(us_first_name, us_last_name, us_address, us_email, us_password, us_seat_fk, us_rol_fk,
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


/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/