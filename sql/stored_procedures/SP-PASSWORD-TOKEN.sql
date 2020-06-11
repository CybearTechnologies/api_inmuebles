

DROP PROCEDURE IF EXISTS createPasswordToken;
DELIMITER $$
CREATE PROCEDURE createPasswordToken(token varchar(500),userCreator int,
                            dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO password_token(pt_token, pt_user_creator_fk, pt_user_modified_fk)
        VALUES (token,userCreator,userCreator);
    ELSE
        INSERT INTO password_token(pt_token, pt_user_creator_fk, pt_user_modified_fk,pt_date_created,pt_date_modified)
        VALUES (token,userCreator,userCreator,dateCreated,dateCreated);
    END IF;
    SELECT pt_id id,
           pt_token token,
           pt_user_creator_fk userCreator,
           pt_date_created dateCreated,
           pt_user_modified_fk userModifier,
           pt_date_modified dateModified,
           pt_active active,
           pt_delete 'delete'
    FROM password_token
    WHERE pt_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getPasswordTokenByUserId;
DELIMITER $$
CREATE PROCEDURE getPasswordTokenByUserId(user int)
BEGIN
    SELECT pt_id id,
           pt_token token,
           pt_user_creator_fk userCreator,
           pt_date_created dateCreated,
           pt_user_modified_fk userModifier,
           pt_date_modified dateModified
    FROM password_token
    WHERE pt_user_creator_fk=user;
END$$

DROP PROCEDURE IF EXISTS getPasswordTokenById;
DELIMITER $$
CREATE PROCEDURE getPasswordTokenById(id int)
BEGIN
    SELECT pt_id id,
           pt_token token,
           pt_user_creator_fk userCreator,
           pt_date_created dateCreated,
           pt_user_modified_fk userModifier,
           pt_date_modified dateModified
    FROM password_token
    WHERE pt_id = id;
END$$

DROP PROCEDURE IF EXISTS getPasswordTokenByToken;
DELIMITER $$
CREATE PROCEDURE getPasswordTokenByToken(token VARCHAR(500))
BEGIN
    SELECT pt_id id,
           pt_token token,
           pt_user_creator_fk userCreator,
           pt_date_created dateCreated,
           pt_user_modified_fk userModifier,
           pt_date_modified dateModified
    FROM password_token
    WHERE pt_token = token;
END$$

DROP PROCEDURE IF EXISTS deletePasswordToken;
DELIMITER $$
CREATE PROCEDURE deletePasswordToken(id int)
BEGIN
    DELETE FROM password_token WHERE pt_user_creator_fk=id;
END$$





