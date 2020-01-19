CREATE TABLE access
(
    ac_id               int(10) AUTO_INCREMENT COMMENT 'ID acceso'
        PRIMARY KEY,
    ac_name             varchar(45)                          NOT NULL COMMENT 'Nombre',
    ac_abbreviation     varchar(5)                           NOT NULL COMMENT 'Abreviacion',
    ac_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ac_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    ac_user_created_fk  int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ac_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ac_user_modified_fk int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ac_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT access_ibfk_1 FOREIGN KEY (ac_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT access_ibfk_2 FOREIGN KEY (ac_user_modified_fk) REFERENCES user (us_id)
);