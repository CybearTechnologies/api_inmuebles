/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS createPropertyDestiny;
DELIMITER $$
CREATE PROCEDURE createPropertyDestiny(name varchar(20),
                            user int,dateCreated datetime)
BEGIN
        IF IsNull(dateCreated) THEN
            INSERT INTO property_destiny(pd_name,pd_user_creator_fk,pd_user_modified_fk)
            VALUES (name,user,user);
        ELSE
            INSERT INTO property_destiny(pd_name,pd_user_creator_fk,pd_user_modified_fk,pd_date_created,pd_date_modified)
            VALUES (name,user,user,dateCreated,dateCreated);
        END IF;
        SELECT pd_id id,
               pd_name name,
               pd_active active,
               pd_delete 'delete',
               pd_user_creator_fk userCreator,
               pd_date_created dateCreated,
               pd_user_modified_fk userModifier,
               pd_date_modified dateModified
        FROM property_destiny
        WHERE pd_id= last_insert_id();
END $$

DROP PROCEDURE IF EXISTS getAllPropertyDestiny;
DELIMITER $$
CREATE PROCEDURE getAllPropertyDestiny()
BEGIN
    SELECT pd_id id,
           pd_name name,
           pd_active active,
           pd_delete 'delete',
           pd_user_creator_fk userCreator,
           pd_date_created dateCreated,
           pd_user_modified_fk userModifier,
           pd_date_modified dateModified
    FROM property_destiny WHERE pd_active=1 AND pd_delete=0;
END $$

DROP PROCEDURE IF EXISTS deletePropertyDestiny;
DELIMITER $$
CREATE PROCEDURE deletePropertyDestiny(id int, user int)
BEGIN
    UPDATE property_destiny SET pd_delete=1, pd_user_modified_fk=user WHERE pd_id=id;
    SELECT pd_id id,
           pd_name name,
           pd_active active,
           pd_delete 'delete',
           pd_user_creator_fk userCreator,
           pd_date_created dateCreated,
           pd_user_modified_fk userModifier,
           pd_date_modified dateModified
    FROM property_destiny
    WHERE pd_id=id;
END $$

/**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/