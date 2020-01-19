CREATE TABLE property
(
    pr_id               int(10) AUTO_INCREMENT COMMENT 'ID Propiedad'
        PRIMARY KEY,
    pr_name             varchar(100)                         NOT NULL COMMENT 'Nombre',
    pr_area             double(20, 2)                        NOT NULL COMMENT 'Area',
    pr_description      varchar(500)                         NULL COMMENT 'Descripcion',
    pr_floor            tinyint(1)                           NULL COMMENT 'Piso',
    pr_status           tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Estatus',
    pr_type_fk          int(10)                              NOT NULL COMMENT 'ID Tipo de propiedad',
    pr_location_fk      int(10)                              NOT NULL COMMENT 'ID lugar',
    pr_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pr_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pr_user_created_fk  int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pr_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pr_user_modified_fk int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pr_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT property_ibfk_1 FOREIGN KEY (pr_type_fk) REFERENCES property_type (pt_id),
    CONSTRAINT property_ibfk_2 FOREIGN KEY (pr_location_fk) REFERENCES location (lo_id),
    CONSTRAINT property_ibfk_3 FOREIGN KEY (pr_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT property_ibfk_4 FOREIGN KEY (pr_user_modified_fk) REFERENCES user (us_id)
);