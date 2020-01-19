CREATE TABLE rol_access
(
    ra_id               int(10) AUTO_INCREMENT COMMENT 'ID rol-acceso'
        PRIMARY KEY,
    ra_rol_fk           int(10)                            NOT NULL COMMENT 'ID rol',
    ra_access_fk        int(10)                            NOT NULL COMMENT 'ID access',
    ra_user_created_fk  int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ra_date_created     datetime DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ra_user_modified_fk int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ra_date_modified    datetime DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT rol_access_ibfk_1 FOREIGN KEY (ra_rol_fk) REFERENCES rol (ro_id),
    CONSTRAINT rol_access_ibfk_2 FOREIGN KEY (ra_access_fk) REFERENCES access (ac_id),
    CONSTRAINT rol_access_ibfk_3 FOREIGN KEY (ra_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT rol_access_ibfk_4 FOREIGN KEY (ra_user_modified_fk) REFERENCES user (us_id)
);