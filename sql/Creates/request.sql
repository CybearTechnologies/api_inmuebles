CREATE TABLE request
(
    re_id               int(10) AUTO_INCREMENT COMMENT 'ID Solicitud'
        PRIMARY KEY,
    re_property_fk      int(10)                            NOT NULL COMMENT 'ID Propiedad',
    re_user_created_fk  int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    re_date_created     datetime DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    re_user_modified_fk int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    re_date_modified    datetime DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT request_ibfk_1 FOREIGN KEY (re_property_fk) REFERENCES property (pr_id),
    CONSTRAINT request_ibfk_2 FOREIGN KEY (re_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT request_ibfk_3 FOREIGN KEY (re_user_modified_fk) REFERENCES user (us_id)
);