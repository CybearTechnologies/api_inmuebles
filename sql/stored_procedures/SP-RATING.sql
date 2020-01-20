/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertRating;
DELIMITER $$
CREATE PROCEDURE insertRating(score float, message varchar(200), user_target int, user_fk int)
BEGIN
    INSERT INTO rating(ra_score, ra_message, ra_user_fk, ra_user_created_fk, ra_user_modified_fk)
    VALUES (score, message, user_target, user_fk, user_fk);
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk user_created,
           ra_user_modified_fk user_modifier,
           ra_date_created date_created,
           ra_date_modified date_modified
    FROM rating
    WHERE ra_id = last_insert_id();
END$$


DROP PROCEDURE IF EXISTS getRatingById;
DELIMITER $$
CREATE PROCEDURE getRatingById(id int)
BEGIN
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk user_created,
           ra_user_modified_fk user_modifier,
           ra_date_created date_created,
           ra_date_modified date_modified
    FROM rating
    WHERE ra_id = id;
END$$

DROP PROCEDURE IF EXISTS deleteRating;
DELIMITER $$
CREATE PROCEDURE deleteRating(id int, user int)
BEGIN
    UPDATE rating
    SET ra_deleted = 0, ra_user_modified_fk = user
    WHERE ra_id = id;
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk user_created,
           ra_user_modified_fk user_modifier,
           ra_date_created date_created,
           ra_date_modified date_modified
    FROM rating
    WHERE ra_id = id;
END$$

DROP PROCEDURE IF EXISTS getAllRatingByUser;
DELIMITER $$
CREATE PROCEDURE getAllRatingByUser(id_user int)
BEGIN
    SELECT ra_id id,
           ra_score score,
           ra_message message,
           ra_active active,
           ra_deleted 'delete',
           ra_user_created_fk user_created,
           ra_user_modified_fk user_modifier,
           ra_date_created date_created,
           ra_date_modified date_modified
    FROM rating
    WHERE ra_user_fk = id_user;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/