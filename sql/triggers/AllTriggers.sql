DROP TRIGGER IF EXISTS afterChangeActiveAgency;
DELIMITER $$
CREATE TRIGGER afterChangeActiveAgency
    AFTER UPDATE
    ON agency FOR EACH ROW
BEGIN
    IF NEW.ag_active <> OLD.ag_active
    THEN
        IF NEW.ag_active=1 THEN
            UPDATE seat SET se_active=1 WHERE se_agency_fk=OLD.ag_id;
        ELSEIF NEW.ag_active=0 THEN
            UPDATE seat SET se_active=0 WHERE se_agency_fk=OLD.ag_id;
        END IF;
    END IF;
END;
DELIMITER $$ ;

DROP TRIGGER IF EXISTS afterChangeActiveSeat;
DELIMITER $$
CREATE TRIGGER afterChangeActiveSeat
    AFTER UPDATE
    ON seat FOR EACH ROW
BEGIN
    IF NEW.se_active <> OLD.se_active
    THEN
        IF NEW.se_active=1 THEN
            UPDATE user SET us_active=1 WHERE us_seat_fk=OLD.se_id;
        ELSEIF NEW.se_active=0 THEN
            UPDATE user SET us_active=0 WHERE us_seat_fk=OLD.se_id;
        END IF;
    END IF;
END;
DELIMITER $$ ;

DROP TRIGGER IF EXISTS afterChangeActiveUser;
DELIMITER $$
CREATE TRIGGER afterChangeActiveUser
    AFTER UPDATE
    ON user FOR EACH ROW
BEGIN
    IF NEW.us_active <> OLD.us_active
    THEN
        IF NEW.us_active=1 THEN
            UPDATE property SET pr_active=1 WHERE pr_user_created_fk=OLD.us_id;
        ELSEIF NEW.us_active=0 THEN
            UPDATE property SET pr_active=0 WHERE pr_user_created_fk=OLD.us_id;
        END IF;
    END IF;
END;
DELIMITER $$ ;

DROP TRIGGER IF EXISTS afterChangeActiveRol;
DELIMITER $$
CREATE TRIGGER afterChangeActiveRol
    AFTER UPDATE
    ON rol FOR EACH ROW
BEGIN
    IF NEW.ro_active <> OLD.ro_active
    THEN
        IF NEW.ro_active=1 THEN
            UPDATE user SET us_active=1 WHERE us_rol_fk=OLD.ro_id;
        ELSEIF NEW.ro_active=0 THEN
            UPDATE user SET us_active=0 WHERE us_rol_fk=OLD.ro_id;
        END IF;
    END IF;
END;
DELIMITER $$ ;

DROP TRIGGER IF EXISTS afterChangeBlockedUser;
DELIMITER $$
CREATE TRIGGER afterChangeBlockedUser
    AFTER UPDATE
    ON user FOR EACH ROW
BEGIN
    IF NEW.us_blocked <> OLD.us_blocked
    THEN
        IF NEW.us_blocked=1 THEN
            UPDATE property SET pr_active=0 WHERE pr_user_created_fk=OLD.us_id;
        ELSEIF NEW.us_blocked=0 THEN
            UPDATE property SET pr_active=1 WHERE pr_user_created_fk=OLD.us_id;
        END IF;
    END IF;
END;
DELIMITER $$;

DROP TRIGGER IF EXISTS afterChangeActiveSubscription;
DELIMITER $$
CREATE TRIGGER afterChangeActiveSubscription
    AFTER UPDATE
    ON subscription FOR EACH ROW
BEGIN
    IF NEW.su_active <> OLD.su_active
    THEN
        IF NEW.su_active=1 THEN
            UPDATE subscription_detail SET sd_active=1 WHERE sd_subscription_fk=OLD.su_id;
        ELSEIF NEW.su_active=0 THEN
            UPDATE subscription_detail SET sd_active=0 WHERE sd_subscription_fk=OLD.su_id;
        END IF;
    END IF;
END;
DELIMITER $$ ;

DROP TRIGGER IF EXISTS afterModifySubscription;
DELIMITER $$
CREATE TRIGGER afterModifySubscription
    AFTER UPDATE
    ON subscription FOR EACH ROW
BEGIN
    IF NEW.su_status <> OLD.su_status AND NEW.su_status = 1
    THEN
        CALL createOnlyUser(OLD.su_first_name,OLD.su_last_name,OLD.su_address,
            OLD.su_email,OLD.su_password,OLD.su_seat_fk,
            (Select ro_id FROM rol WHERE ro_name='Corredor'),
            OLD.su_plan_fk,OLD.su_location_fk,NEW.su_user_modified_fk,
            NEW.su_date_modified);
    ELSEIF NEW.su_deleted <> OLD.su_deleted AND NEW.su_deleted = 1
    THEN
        IF NEW.su_deleted=1 THEN
            UPDATE subscription_detail SET sd_deleted=1 WHERE sd_subscription_fk=OLD.su_id;
        ELSEIF NEW.su_deleted=0 THEN
            UPDATE subscription_detail SET sd_deleted=1 WHERE sd_subscription_fk=OLD.su_id;
        END IF;
    END IF;
END;
DELIMITER $$ ;
