/**
  ----------------------------------------------------------------------------------------------------------------------
  ---                                               BEGIN                                                           ---
  ----------------------------------------------------------------------------------------------------------------------
 */

DROP PROCEDURE IF EXISTS createSubscriptionDetail;
DELIMITER $$
CREATE PROCEDURE createSubscriptionDetail(subscription_id int,document varchar(255),dateCreated datetime)
BEGIN
    IF IsNull(dateCreated) THEN
        INSERT INTO subscription_detail(sd_document, sd_subscription_fk)
        VALUES (document,subscription_id);
    ELSE
        INSERT INTO subscription_detail(sd_document, sd_subscription_fk,sd_date_created)
        VALUES (document,subscription_id,dateCreated);
    END IF;
    SELECT sd_id id,
           sd_document document,
           sd_active active,
           sd_deleted 'delete',
           sd_date_created dateCreated,
           sd_user_modified_fk userModifier,
           sd_date_modified dateModified,
           sd_subscription_fk subscription
    FROM subscription_detail
    WHERE sd_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getSubscriptionDetailBySubscription;
DELIMITER $$
CREATE PROCEDURE getSubscriptionDetailBySubscription(subscriptionId int)
BEGIN
    SELECT sd_id id,
           sd_document document,
           sd_active active,
           sd_deleted 'delete',
           sd_date_created dateCreated,
           sd_user_modified_fk userModifier,
           sd_date_modified dateModified,
           sd_subscription_fk subscription
    FROM subscription_detail
    WHERE sd_subscription_fk = subscriptionId;
END$$

DROP PROCEDURE IF EXISTS getSubscriptionDetailById;
DELIMITER $$
CREATE PROCEDURE getSubscriptionDetailById(id int)
BEGIN
    SELECT sd_id id,
           sd_document document,
           sd_active active,
           sd_deleted 'delete',
           sd_date_created dateCreated,
           sd_user_modified_fk userModifier,
           sd_date_modified dateModified,
           sd_subscription_fk subscription
    FROM subscription_detail
    WHERE sd_id = id;
END$$

DROP PROCEDURE IF EXISTS deleteSubscriptionDetail;
DELIMITER $$
CREATE PROCEDURE deleteSubscriptionDetail(id int,dateModified datetime, userModified int)
BEGIN
    IF IsNull(dateModified) THEN
        UPDATE subscription_detail
        SET sd_deleted = 1, sd_user_modified_fk = userModified
        WHERE sd_id = id;
    ELSE
        UPDATE subscription_detail
        SET sd_deleted = 1, sd_user_modified_fk = userModified, sd_date_modified = dateModified
        WHERE sd_id = id;
    END IF;
    SELECT sd_id id,
           sd_document document,
           sd_active active,
           sd_deleted 'delete',
           sd_date_created dateCreated,
           sd_user_modified_fk userModifier,
           sd_date_modified dateModified,
           sd_subscription_fk subscription
    FROM subscription_detail
    WHERE sd_id = id;
END$$


 /**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/