CREATE TABLE property_type
(
    pt_id               int(10) AUTO_INCREMENT COMMENT 'ID Tipo de propiedad'
        PRIMARY KEY,
    pt_name             varchar(30)                          NOT NULL COMMENT 'Nombre',
    pt_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pt_user_created_fk  int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pt_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pt_user_modified_fk int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pt_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT property_type_ibfk_1 FOREIGN KEY (pt_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT property_type_ibfk_2 FOREIGN KEY (pt_user_modified_fk) REFERENCES user (us_id)
);