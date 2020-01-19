CREATE TABLE rol
(
    ro_id      int AUTO_INCREMENT COMMENT 'ID rol' PRIMARY KEY,
    ro_name    varchar(45)           NOT NULL COMMENT 'Nombre',
    ro_active  tinyint(10) DEFAULT 1 NOT NULL COMMENT 'Activo',
    ro_deleted tinyint(1)  DEFAULT 0 NOT NULL COMMENT 'Eliminado'
);

CREATE TABLE location
(
    lo_id          int AUTO_INCREMENT COMMENT 'ID lugar'
        PRIMARY KEY,
    lo_name        varchar(45)          NOT NULL COMMENT 'Nombre',
    lo_type        varchar(45)          NOT NULL COMMENT 'Tipo',
    lo_active      tinyint(1) DEFAULT 1 NOT NULL COMMENT 'Activo',
    lo_deleted     tinyint(1) DEFAULT 0 NOT NULL COMMENT 'Eliminado',
    lo_location_fk int                  NOT NULL COMMENT 'ID lugar',
    CONSTRAINT FOREIGN KEY (lo_location_fk) REFERENCES location (lo_id)
);

CREATE TABLE plan
(
    pl_id               int AUTO_INCREMENT COMMENT 'ID plan' PRIMARY KEY,
    pl_name             varchar(45)                          NOT NULL COMMENT 'Nombre',
    pl_price            double(10, 2)                        NOT NULL COMMENT 'Precio',
    pl_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pl_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pl_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pl_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pl_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pl_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación'
);

CREATE TABLE agency
(
    ag_id               int AUTO_INCREMENT COMMENT 'ID Inmobiliaria'
        PRIMARY KEY,
    ag_name             varchar(45)                          NOT NULL COMMENT 'Nombre',
    ag_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ag_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    ag_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ag_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ag_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ag_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación'
);


CREATE TABLE seat
(
    se_id               int AUTO_INCREMENT COMMENT 'ID sede'
        PRIMARY KEY,
    se_name             varchar(100)                         NOT NULL COMMENT 'Nombre',
    se_rif              varchar(20)                          NOT NULL COMMENT 'Rif',
    se_location_fk      int(10)                              NOT NULL COMMENT 'ID Lugar',
    se_agency_fk        int(10)                              NOT NULL COMMENT 'ID Inmobiliaria',
    se_active           tinyint(1)                           NOT NULL COMMENT 'Activo',
    se_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    se_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    se_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    se_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    se_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (se_location_fk) REFERENCES location (lo_id),
    CONSTRAINT FOREIGN KEY (se_agency_fk) REFERENCES agency (ag_id)
);

CREATE TABLE user
(
    us_id          int AUTO_INCREMENT COMMENT 'ID usuario'
        PRIMARY KEY,
    us_first_name  varchar(45)          NOT NULL COMMENT 'Nombre',
    us_last_name   varchar(45)          NOT NULL COMMENT 'Apellido',
    us_address     varchar(200)         NOT NULL COMMENT 'Dirección',
    us_email       varchar(50)          NOT NULL COMMENT 'Email',
    us_password    varchar(255)         NOT NULL COMMENT 'Contraseña',
    us_status      tinyint(1) DEFAULT 0 NOT NULL COMMENT 'Estatus',
    us_blocked     tinyint(1) DEFAULT 0 NOT NULL COMMENT 'Bloqueado',
    us_deleted     tinyint(1) DEFAULT 0 NOT NULL COMMENT 'Eliminado',
    us_seat_fk     int                  NOT NULL COMMENT 'ID Sede',
    us_rol_fk      int                  NOT NULL COMMENT 'ID Rol',
    us_plan_fk     int                  NOT NULL COMMENT 'ID Plan',
    us_location_fk int                  NOT NULL COMMENT 'ID Lugar',
    CONSTRAINT FOREIGN KEY (us_seat_fk) REFERENCES seat (se_id),
    CONSTRAINT FOREIGN KEY (us_rol_fk) REFERENCES rol (ro_id),
    CONSTRAINT FOREIGN KEY (us_plan_fk) REFERENCES plan (pl_id),
    CONSTRAINT FOREIGN KEY (us_location_fk) REFERENCES location (lo_id)
);

ALTER TABLE plan
    ADD CONSTRAINT
        FOREIGN KEY (pl_user_created_fk)
            REFERENCES user (us_id);

ALTER TABLE plan
    ADD CONSTRAINT
        FOREIGN KEY (pl_user_modified_fk)
            REFERENCES user (us_id);

ALTER TABLE seat
    ADD CONSTRAINT
        FOREIGN KEY (se_user_created_fk)
            REFERENCES user (us_id);

ALTER TABLE seat
    ADD CONSTRAINT
        FOREIGN KEY (se_user_modified_fk)
            REFERENCES user (us_id);

ALTER TABLE agency
    ADD CONSTRAINT
        FOREIGN KEY (ag_user_created_fk)
            REFERENCES user (us_id);

ALTER TABLE agency
    ADD CONSTRAINT
        FOREIGN KEY (ag_user_modified_fk)
            REFERENCES user (us_id);

CREATE TABLE access
(
    ac_id               int AUTO_INCREMENT COMMENT 'ID acceso'
        PRIMARY KEY,
    ac_name             varchar(45)                          NOT NULL COMMENT 'Nombre',
    ac_abbreviation     varchar(5)                           NOT NULL COMMENT 'Abreviacion',
    ac_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ac_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    ac_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ac_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ac_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ac_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (ac_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (ac_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE extra
(
    ex_id               int AUTO_INCREMENT COMMENT 'ID Extra' PRIMARY KEY,
    ex_name             varchar(450)                         NOT NULL COMMENT 'Nombre',
    ex_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ex_deleted          tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Eliminado',
    ex_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ex_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ex_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ex_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (ex_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (ex_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE property_type
(
    pt_id               int AUTO_INCREMENT COMMENT 'ID Tipo de propiedad'
        PRIMARY KEY,
    pt_name             varchar(30)                          NOT NULL COMMENT 'Nombre',
    pt_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pt_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pt_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pt_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pt_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pt_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (pt_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (pt_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE property
(
    pr_id               int AUTO_INCREMENT COMMENT 'ID Propiedad'
        PRIMARY KEY,
    pr_name             varchar(100)                         NOT NULL COMMENT 'Nombre',
    pr_area             double(20, 2)                        NOT NULL COMMENT 'Area',
    pr_description      varchar(500)                         NULL COMMENT 'Descripcion',
    pr_floor            tinyint(1)                           NULL COMMENT 'Piso',
    pr_status           tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Estatus',
    pr_type_fk          int                                  NOT NULL COMMENT 'ID Tipo de propiedad',
    pr_location_fk      int                                  NOT NULL COMMENT 'ID lugar',
    pr_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pr_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pr_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pr_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pr_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pr_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (pr_type_fk) REFERENCES property_type (pt_id),
    CONSTRAINT FOREIGN KEY (pr_location_fk) REFERENCES location (lo_id),
    CONSTRAINT FOREIGN KEY (pr_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (pr_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE property_extra
(
    pe_id               int AUTO_INCREMENT COMMENT 'ID Propiedad extra'
        PRIMARY KEY,
    pe_value            int(10)                              NOT NULL COMMENT 'Valor',
    pe_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pe_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pe_property_fk      int                                  NOT NULL COMMENT 'ID Propiedad',
    pe_extra_fk         int                                  NOT NULL COMMENT 'ID Extra',
    pe_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pe_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pe_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pe_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (pe_property_fk) REFERENCES property (pr_id),
    CONSTRAINT FOREIGN KEY (pe_extra_fk) REFERENCES extra (ex_id),
    CONSTRAINT FOREIGN KEY (pe_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (pe_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE property_price
(
    pp_id               int AUTO_INCREMENT COMMENT 'ID Precio propiedad' PRIMARY KEY,
    pp_price            double(20, 2)                        NOT NULL COMMENT 'Precio',
    pp_final            tinyint(1)                           NOT NULL COMMENT 'Precio final',
    pp_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pp_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pp_property_fk      int                                  NOT NULL COMMENT 'ID Propiedad',
    pp_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pp_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pp_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pp_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (pp_property_fk) REFERENCES property (pr_id),
    CONSTRAINT FOREIGN KEY (pp_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (pp_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE rating
(
    ra_id               int AUTO_INCREMENT COMMENT 'ID rating'
        PRIMARY KEY,
    ra_score            float                                NOT NULL COMMENT 'Calificacion',
    ra_message          varchar(200)                         NULL COMMENT 'Mensaje',
    ra_user_fk          int                                  NOT NULL COMMENT 'ID usuario',
    ra_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ra_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    ra_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ra_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ra_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ra_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (ra_user_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (ra_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (ra_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE request
(
    re_id               int AUTO_INCREMENT COMMENT 'ID Solicitud'
        PRIMARY KEY,
    re_property_fk      int                                  NOT NULL COMMENT 'ID Propiedad',
    re_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    re_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    re_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    re_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    re_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    re_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (re_property_fk) REFERENCES property (pr_id),
    CONSTRAINT FOREIGN KEY (re_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (re_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE rol_access
(
    ra_id               int AUTO_INCREMENT COMMENT 'ID rol-acceso'
        PRIMARY KEY,
    ra_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ra_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    ra_rol_fk           int                                  NOT NULL COMMENT 'ID rol',
    ra_access_fk        int                                  NOT NULL COMMENT 'ID access',
    ra_user_created_fk  int        DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ra_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ra_user_modified_fk int        DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ra_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT FOREIGN KEY (ra_rol_fk) REFERENCES rol (ro_id),
    CONSTRAINT FOREIGN KEY (ra_access_fk) REFERENCES access (ac_id),
    CONSTRAINT FOREIGN KEY (ra_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT FOREIGN KEY (ra_user_modified_fk) REFERENCES user (us_id)
);