/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS insertFavorite;
DELIMITER $$
CREATE PROCEDURE insertFavorite(property int, user int,dateCreated datetime)
BEGIN
    IF IsNull(dateCreated)THEN
        INSERT INTO favorite(fa_property_fk, fa_user_created_fk, fa_user_modified_fk)
        VALUES (property, user, user);
    ELSE
        INSERT INTO favorite(fa_property_fk, fa_user_created_fk, fa_user_modified_fk,
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
    FROM favorite
    WHERE fa_id = last_insert_id();
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS deleteFavorite;
DELIMITER $$
CREATE PROCEDURE deleteFavorite(property int,user int, dateModified datetime)
BEGIN
    SELECT fa_id id,
           fa_property_fk property,
           fa_active active,
           fa_deleted 'delete',
           fa_user_created_fk userCreator,
           fa_user_modified_fk userModifier,
           fa_date_created dateCreated,
           fa_date_modified dateModified
    FROM favorite
    WHERE fa_property_fk = property AND fa_user_created_fk=user;
    DELETE FROM favorite WHERE fa_property_fk = property AND fa_user_created_fk=user;
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
    FROM favorite
    WHERE fa_user_created_fk = id_user
      AND fa_deleted = 0;
END$$


/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/