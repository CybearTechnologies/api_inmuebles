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
    WHERE ra_id = last_insert_id();
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
        WHERE ra_id = id;
    ELSE
        UPDATE rating SET ra_score = score, ra_message = message,
                          ra_user_modified_fk = userModifier, ra_date_modified = dateModified
        WHERE ra_id = id;
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
    WHERE ra_id = id;
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
    WHERE ra_id = id;
END$$

DROP PROCEDURE IF EXISTS deleteRatingById;
DELIMITER $$
CREATE PROCEDURE deleteRatingById(id int, user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE rating
        SET ra_deleted = 1, ra_user_modified_fk = user
        WHERE ra_id = id;
    ELSE
        UPDATE rating
        SET ra_deleted = 1, ra_user_modified_fk = user, ra_date_modified = dateModified
        WHERE ra_id = id;
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
    WHERE ra_id = id;
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
    WHERE ra_user_fk = id_user;
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
    FROM rating;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/