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
    SELECT sd_id,
           sd_document,
           sd_active,
           sd_deleted,
           sd_date_created,
           sd_user_modified_fk,
           sd_date_modified,
           sd_subscription_fk
    FROM subscription_detail
    WHERE sd_id = last_insert_id();
END$$

DROP PROCEDURE IF EXISTS getSubscriptionDetailBySubscription;
DELIMITER $$
CREATE PROCEDURE getSubscriptionDetailBySubscription(subscriptionId int)
BEGIN
    SELECT sd_id,
           sd_document,
           sd_active,
           sd_deleted,
           sd_date_created,
           sd_user_modified_fk,
           sd_date_modified,
           sd_subscription_fk
    FROM subscription_detail
    WHERE sd_subscription_fk = subscriptionId;
END$$

DROP PROCEDURE IF EXISTS getSubscriptionDetailById;
DELIMITER $$
CREATE PROCEDURE getSubscriptionDetailById(id int)
BEGIN
    SELECT sd_id,
           sd_document,
           sd_active,
           sd_deleted,
           sd_date_created,
           sd_user_modified_fk,
           sd_date_modified,
           sd_subscription_fk
    FROM subscription_detail
    WHERE sd_id = id;
END$$

 /**
 ----------------------------------------------------------------------------------------------------------------------
 ---                                                    END                                                         ---
 ----------------------------------------------------------------------------------------------------------------------
*/