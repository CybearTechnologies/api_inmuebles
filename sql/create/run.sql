CREATE TABLE plan
(
    pl_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID plan',
    pl_name             varchar(45)   NOT NULL COMMENT 'Nombre',
    pl_price            double(10, 2) NOT NULL COMMENT 'Precio',
    pl_active           tinyint(1)    NOT NULL DEFAULT 1 COMMENT 'Activo',
    pl_deleted          tinyint(1)    NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    pl_user_created_fk  int(10)                DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    pl_date_created     datetime      NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    pl_user_modified_fk int(10)                DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    pl_date_modified    datetime      NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (pl_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (pl_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE access
(
    ac_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID acceso',
    ac_name             varchar(45) NOT NULL COMMENT 'Nombre',
    ac_abbreviation     varchar(5)  NOT NULL COMMENT 'Abreviacion',
    ac_active           tinyint(1)  NOT NULL DEFAULT 1 COMMENT 'Activo',
    ac_deleted          tinyint(1)  NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    ac_user_created_fk  int(10)              DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    ac_date_created     datetime    NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    ac_user_modified_fk int(10)              DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    ac_date_modified    datetime    NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (ac_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (ac_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE rol
(
    ro_id      int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID rol',
    ro_name    varchar(45) NOT NULL COMMENT 'Nombre',
    ro_active  tinyint(10) NOT NULL DEFAULT 1 COMMENT 'Activo',
    ro_deleted tinyint(1)  NOT NULL DEFAULT 0 COMMENT 'Eliminado'
);

CREATE TABLE rol_access
(
    ra_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID rol-acceso',
    ra_rol_fk           int(10)    NOT NULL COMMENT 'ID rol',
    ra_access_fk        int(10)    NOT NULL COMMENT 'ID access',
    ra_active           tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
    ra_deleted          tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    ra_user_created_fk  int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    ra_date_created     datetime   NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    ra_user_modified_fk int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    ra_date_modified    datetime   NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (ra_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (ra_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (ra_rol_fk) REFERENCES rol (ro_id),
    FOREIGN KEY (ra_access_fk) REFERENCES access (ac_id)
);

CREATE TABLE location
(
    lo_id          int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID lugar',
    lo_name        varchar(45) NOT NULL COMMENT 'Nombre',
    lo_type        varchar(45) NOT NULL COMMENT 'Tipo',
    lo_active      tinyint(1)  NOT NULL DEFAULT 1 COMMENT 'Activo',
    lo_deleted     tinyint(1)  NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    lo_location_fk int(10) COMMENT 'ID lugar',
    FOREIGN KEY (lo_location_fk) REFERENCES location (lo_id)
);

CREATE TABLE agency
(
    ag_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Inmobiliaria',
    ag_name             varchar(45) NOT NULL COMMENT 'Nombre',
    ag_active           tinyint(1)  NOT NULL DEFAULT 1 COMMENT 'Activo',
    ag_deleted          tinyint(1)  NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    ag_user_created_fk  int(10)              DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    ag_date_created     datetime    NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    ag_user_modified_fk int(10)              DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    ag_date_modified    datetime    NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (ag_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (ag_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE seat
(
    se_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID sede',
    se_name             varchar(100) NOT NULL COMMENT 'Nombre',
    se_rif              varchar(20)  NOT NULL COMMENT 'Rif',
    se_location_fk      int(10)      NOT NULL COMMENT 'ID Lugar',
    se_agency_fk        int(10)      NOT NULL COMMENT 'ID Inmobiliaria',
    se_active           tinyint(1)   NOT NULL DEFAULT 1 COMMENT 'Activo',
    se_deleted          tinyint(1)   NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    se_user_created_fk  int(10)               DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    se_date_created     datetime     NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    se_user_modified_fk int(10)               DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    se_date_modified    datetime     NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (se_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (se_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (se_location_fk) REFERENCES location (lo_id),
    FOREIGN KEY (se_agency_fk) REFERENCES agency (ag_id)
);

CREATE TABLE user
(
    us_id          int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID usuario',
    us_first_name  varchar(45)  NOT NULL COMMENT 'Nombre',
    us_last_name   varchar(45)  NOT NULL COMMENT 'Apellido',
    us_address     varchar(200) NOT NULL COMMENT 'Dirección',
    us_email       varchar(50)  NOT NULL COMMENT 'Email',
    us_password    varchar(255) NOT NULL COMMENT 'Contraseña',
    us_active      tinyint(1)   NOT NULL DEFAULT 1 COMMENT 'Activo',
    us_blocked     tinyint(1)   NOT NULL DEFAULT 0 COMMENT 'Bloqueado',
    us_deleted     tinyint(1)   NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    us_seat_fk     int(10) COMMENT 'ID Sede',
    us_rol_fk      int(10)      NOT NULL COMMENT 'ID Rol',
    us_plan_fk     int(10) COMMENT 'ID Plan',
    us_location_fk int(10)      NOT NULL COMMENT 'ID Lugar',
    FOREIGN KEY (us_seat_fk) REFERENCES seat (se_id),
    FOREIGN KEY (us_rol_fk) REFERENCES rol (ro_id),
    FOREIGN KEY (us_plan_fk) REFERENCES plan (pl_id),
    FOREIGN KEY (us_location_fk) REFERENCES location (lo_id)
);

CREATE TABLE rating
(
    ra_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID rating',
    ra_score            float      NOT NULL COMMENT 'Calificacion',
    ra_message          varchar(200) COMMENT 'Mensaje',
    ra_user_fk          int(10)    NOT NULL COMMENT 'ID usuario',
    ra_active           tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
    ra_deleted          tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    ra_user_created_fk  int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    ra_date_created     datetime   NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    ra_user_modified_fk int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    ra_date_modified    datetime   NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (ra_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (ra_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (ra_user_fk) REFERENCES user (us_id)
);

CREATE TABLE property_type
(
    pt_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Tipo de propiedad',
    pt_name             varchar(30) NOT NULL COMMENT 'Nombre',
    pt_active           tinyint(1)  NOT NULL DEFAULT 1 COMMENT 'Activo',
    pt_deleted          tinyint(1)  NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    pt_user_created_fk  int(10)              DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    pt_date_created     datetime    NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    pt_user_modified_fk int(10)              DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    pt_date_modified    datetime    NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (pt_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (pt_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE property
(
    pr_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Propiedad',
    pr_name             varchar(100)  NOT NULL COMMENT 'Nombre',
    pr_area             double(20, 2) NOT NULL COMMENT 'Area',
    pr_description      varchar(500) COMMENT 'Descripcion',
    pr_floor            tinyint(1) COMMENT 'Piso',
    pr_status           tinyint(1)    NOT NULL DEFAULT 0 COMMENT 'Estatus',
    pr_type_fk          int(10)       NOT NULL COMMENT 'ID Tipo de propiedad',
    pr_active           tinyint(1)    NOT NULL DEFAULT 1 COMMENT 'Activo',
    pr_deleted          tinyint(1)    NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    pr_location_fk      int(10)       NOT NULL COMMENT 'ID lugar',
    pr_user_created_fk  int(10)                DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    pr_date_created     datetime      NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    pr_user_modified_fk int(10)                DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    pr_date_modified    datetime      NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (pr_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (pr_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (pr_type_fk) REFERENCES property_type (pt_id),
    FOREIGN KEY (pr_location_fk) REFERENCES location (lo_id)

);

CREATE TABLE request
(
    re_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Solicitud',
    re_property_fk      int(10)    NOT NULL COMMENT 'ID Propiedad',
    re_active           tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
    re_deleted          tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    re_user_created_fk  int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    re_date_created     datetime   NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    re_user_modified_fk int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    re_date_modified    datetime   NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (re_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (re_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (re_property_fk) REFERENCES property (pr_id)
);

CREATE TABLE property_price
(
    pp_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Precio propiedad',
    pp_price            double(20, 2) NOT NULL COMMENT 'Precio',
    pp_final            tinyint(1)    NOT NULL COMMENT 'Precio final',
    pp_active           tinyint(1)    NOT NULL DEFAULT 1 COMMENT 'Activo',
    pp_deleted          tinyint(1)    NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    pp_property_fk      int(10)       NOT NULL COMMENT 'ID Propiedad',
    pp_user_created_fk  int(10)                DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    pp_date_created     datetime      NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    pp_user_modified_fk int(10)                DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    pp_date_modified    datetime      NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (pp_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (pp_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (pp_property_fk) REFERENCES property (pr_id)
);

CREATE TABLE extra
(
    ex_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Extra',
    ex_name             varchar(450) NOT NULL COMMENT 'Nombre',
    ex_active           tinyint(1)   NOT NULL DEFAULT 1 COMMENT 'Activo',
    ex_deleted          tinyint(1)   NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    ex_user_created_fk  int(10)               DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    ex_date_created     datetime     NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    ex_user_modified_fk int(10)               DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    ex_date_modified    datetime     NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (ex_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (ex_user_modified_fk) REFERENCES user (us_id)
);

CREATE TABLE property_extra
(
    pe_id               int AUTO_INCREMENT PRIMARY KEY COMMENT 'ID Propiedad extra',
    pe_value            int(10)    NOT NULL COMMENT 'Valor',
    pe_active           tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Activo',
    pe_deleted          tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    pe_property_fk      int        NOT NULL COMMENT 'ID Propiedad',
    pe_extra_fk         int        NOT NULL COMMENT 'ID Extra',
    pe_user_created_fk  int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    pe_date_created     datetime   NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    pe_user_modified_fk int(10)             DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    pe_date_modified    datetime   NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (pe_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (pe_user_modified_fk) REFERENCES user (us_id),
    FOREIGN KEY (pe_property_fk) REFERENCES property (pr_id),
    FOREIGN KEY (pe_extra_fk) REFERENCES extra (ex_id)
);

CREATE TABLE origin
(
    or_id               int PRIMARY KEY NOT NULL AUTO_INCREMENT COMMENT 'ID origen',
    or_name             varchar(50)     NOT NULL COMMENT 'Nombre de origen',
    or_private_key      varchar(512)    NOT NULL COMMENT 'Llave privada',
    or_public_key       varchar(256)    NOT NULL COMMENT 'Llave publica',
    or_active           tinyint(1)      NOT NULL DEFAULT 1 COMMENT 'Activo',
    or_deleted          tinyint(1)      NOT NULL DEFAULT 0 COMMENT 'Eliminado',
    or_user_created_fk  int(10)                  DEFAULT 1 NOT NULL COMMENT 'Usuario creador',
    or_date_created     datetime        NOT NULL DEFAULT current_timestamp COMMENT 'Fecha de creación',
    or_user_modified_fk int(10)                  DEFAULT 1 NOT NULL COMMENT 'Usuario modificador',
    or_date_modified    datetime        NOT NULL DEFAULT current_timestamp ON UPDATE current_timestamp COMMENT 'Fecha de modificación',
    FOREIGN KEY (or_user_created_fk) REFERENCES user (us_id),
    FOREIGN KEY (or_user_modified_fk) REFERENCES user (us_id)
);
