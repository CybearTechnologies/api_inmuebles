/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertPlan;
DELIMITER $$
CREATE PROCEDURE insertPlan(name varchar(45), price double(10, 2), user int)
BEGIN
    INSERT INTO plan (pl_name, pl_price, pl_user_created_fk, pl_user_modified_fk)
    VALUES (name, price, user, user);
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted,
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE pl_id = LAST_INSERT_ID();
END$$

DROP PROCEDURE IF EXISTS updatePlan;
DELIMITER $$
CREATE PROCEDURE updatePlan(id_plan int, name varchar(45), price double(10, 2), user int)
BEGIN
    UPDATE plan
    SET pl_name = name,
        pl_price = price,
        pl_user_modified_fk = user
    WHERE pl_id = id_plan;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE pl_id = id_plan;
END$$

DROP PROCEDURE IF EXISTS deletePlan;
DELIMITER $$
CREATE PROCEDURE deletePlan(id_plan int, id_user int)
BEGIN
    UPDATE plan
    SET pl_deleted = 1, pl_user_modified_fk = id_user
    WHERE pl_id = id_plan;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE pl_id = id_plan;
END$$

DROP PROCEDURE IF EXISTS inactivePlan;
DELIMITER $$
CREATE PROCEDURE inactivePlan(id_plan int, id_user int)
BEGIN
    UPDATE plan
    SET pl_active = 0,
        pl_user_modified_fk = id_user
    WHERE pl_id = id_plan;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE pl_id = id_plan;
END$$

DROP PROCEDURE IF EXISTS activePlan;
DELIMITER $$
CREATE PROCEDURE activePlan(id_plan int, id_user int)
BEGIN
    UPDATE plan
    SET pl_active = 1,
        pl_user_modified_fk = id_user
    WHERE pl_id = id_plan;
    SELECT pl_id id,
           pl_name name,
           pl_price price,
           pl_active active,
           pl_deleted 'delete',
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE pl_id = id_plan;
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
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan;
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
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE pl_id = plan_id;
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
           pl_user_created_fk usercreated,
           pl_user_modified_fk usermodified,
           pl_date_created datecreated,
           pl_date_modified datemodified
    FROM plan
    WHERE lower(pl_name) = plan_name;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/