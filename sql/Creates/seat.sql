CREATE TABLE seat
(
    se_id               int(10) AUTO_INCREMENT COMMENT 'ID sede'
        PRIMARY KEY,
    se_name             varchar(100)                       NOT NULL COMMENT 'Nombre',
    se_rif              varchar(20)                        NOT NULL COMMENT 'Rif',
    se_location_fk      int(10)                            NOT NULL COMMENT 'ID Lugar',
    se_agency_fk        int(10)                            NOT NULL COMMENT 'ID Inmobiliaria',
    se_active           tinyint(1)                         NOT NULL COMMENT 'Activo',
    se_user_created_fk  int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    se_date_created     datetime DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    se_user_modified_fk int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    se_date_modified    datetime DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT seat_ibfk_1 FOREIGN KEY (se_location_fk) REFERENCES location (lo_id),
    CONSTRAINT seat_ibfk_2 FOREIGN KEY (se_agency_fk) REFERENCES agency (ag_id),
    CONSTRAINT seat_ibfk_3 FOREIGN KEY (se_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT seat_ibfk_4 FOREIGN KEY (se_user_modified_fk) REFERENCES user (us_id)
);