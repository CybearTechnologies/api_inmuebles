CREATE TABLE agency
(
    ag_id               int(10) AUTO_INCREMENT COMMENT 'ID Inmobiliaria'
        PRIMARY KEY,
    ag_name             varchar(45)                          NOT NULL COMMENT 'Nombre',
    ag_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ag_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    ag_user_created_fk  int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ag_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ag_user_modified_fk int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ag_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT agency_ibfk_1 FOREIGN KEY (ag_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT agency_ibfk_2 FOREIGN KEY (ag_user_modified_fk) REFERENCES user (us_id),
);