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

DROP PROCEDURE IF EXISTS activeFavorite;
DELIMITER $$
CREATE PROCEDURE deleteFavorite(id int,user int, dateModified datetime)
BEGIN
    IF IsNull(dateModified)THEN
        UPDATE favorite SET fa_deleted=1, fa_user_modified_fk=user
        WHERE  fa_id=id;
    ELSE
        UPDATE favorite SET fa_deleted=1, fa_user_modified_fk=user, fa_date_modified = dateModified
        WHERE  fa_id=id;
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
    WHERE fa_id = id;
END $$
DELIMITER ;

DROP PROCEDURE IF EXISTS getFavoriteByUserId;
DELIMITER $$
CREATE PROCEDURE getFavoriteByUserId(id_user int)
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