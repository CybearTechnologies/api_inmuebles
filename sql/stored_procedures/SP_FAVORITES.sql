/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertFavorites;
DELIMITER $$
CREATE PROCEDURE insertFavorites(property int, user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO favorites(fa_property_fk, fa_user_created_fk, fa_user_modified_fk)
        VALUES (property, user, user);
    ELSE
        INSERT INTO favorites(fa_property_fk, fa_user_created_fk, fa_user_modified_fk,
                            fa_date_created,fa_date_modified)
        VALUES (property, user, user,dateCreated,dateCreated);
    END IF;
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorites
    WHERE fa_id = last_insert_id();
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS activeFavorites;
DELIMITER $$
CREATE PROCEDURE activeFavorites(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE favorites SET fa_active=1, fa_date_modified=user
        WHERE  fa_id=id AND fa_deleted = 0;
    ELSE
        UPDATE favorites SET fa_active=1, fa_date_modified=user, fa_date_modified = dateModified
        WHERE  fa_id=id AND fa_deleted = 0;
    END IF;
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorites
    WHERE re_id = id AND re_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS inactiveFavorites;
DELIMITER $$
CREATE PROCEDURE inactiveFavorites(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE favorites SET fa_active=0, fa_date_modified=user
        WHERE  fa_id=id AND fa_deleted = 0;
    ELSE
        UPDATE favorites SET fa_active=0, fa_date_modified=user, fa_date_modified = dateModified
        WHERE  fa_id=id AND fa_deleted = 0;
    END IF;
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorites
    WHERE fa_id = id AND fa_deleted = 0;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getFavoritesByUserId;
DELIMITER $$
CREATE PROCEDURE getFavoritesByUserId(id_user int)
BEGIN
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorites
    WHERE fa_user_created_fk = id_user
      AND fa_deleted = 0;
END$$


/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/