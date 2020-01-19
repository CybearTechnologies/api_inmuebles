/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */
DROP PROCEDURE IF EXISTS insertorigin;
DELIMITER $$
CREATE PROCEDURE insertorigin(name varchar(50), private varchar(512), public varchar(256),
                              user int)
BEGIN
    INSERT INTO origin(or_name, or_private_key, or_public_key, or_user_created_fk,
                       or_user_modified_fk)
    VALUES (name, private, public, user, user);
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getoriginbypublickey;
DELIMITER $$
CREATE PROCEDURE getoriginbypublickey(public varchar(256))
BEGIN
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_public_key = public;
END$$

DROP PROCEDURE IF EXISTS getoriginbyid;
DELIMITER $$
CREATE PROCEDURE getoriginbyid(origin_id int)
BEGIN
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_id = origin_id;
END$$

DROP PROCEDURE IF EXISTS deleteoriginbyid;
DELIMITER $$
CREATE PROCEDURE deleteoriginbyid(id_origin int, id_user int)
BEGIN
    UPDATE origin
    SET or_deleted = 1,
        or_user_modified_fk = id_user
    WHERE or_id = id_origin;
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_id = id_origin;
END$$

DROP PROCEDURE IF EXISTS inactiveoriginbyid;
DELIMITER $$
CREATE PROCEDURE inactiveoriginbyid(id_origin int, id_user int)
BEGIN
    UPDATE origin
    SET or_active = 0,
        or_user_modified_fk = id_user
    WHERE or_id = id_origin;
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_id = id_origin;
END$$

DROP PROCEDURE IF EXISTS activeoriginbyid;
DELIMITER $$
CREATE PROCEDURE activeoriginbyid(id_origin int, id_user int)
BEGIN
    UPDATE origin
    SET or_active = 0,
        or_user_modified_fk = id_user
    WHERE or_id = id_origin;
    SELECT or_id id,
           or_name name,
           or_private_key privatekey,
           or_public_key publickkey,
           or_active active,
           or_deleted 'delete',
           or_user_created_fk usercreator,
           or_date_created datecreated,
           or_user_modified_fk usermodifier,
           or_date_modified datemodified
    FROM origin
    WHERE or_id = id_origin;
END$$
/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/