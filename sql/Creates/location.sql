CREATE TABLE location
(
    lo_id          int(10) AUTO_INCREMENT COMMENT 'ID lugar'
        PRIMARY KEY,
    lo_name        varchar(45)          NOT NULL COMMENT 'Nombre',
    lo_type        varchar(45)          NOT NULL COMMENT 'Tipo',
    lo_active      tinyint(1) DEFAULT 1 NOT NULL COMMENT 'Activo',
    lo_deleted     tinyint(1) DEFAULT 0 NOT NULL COMMENT 'Eliminado',
    lo_location_fk int(10)              NULL COMMENT 'ID lugar',
    CONSTRAINT location_ibfk_1 FOREIGN KEY (lo_location_fk) REFERENCES location (lo_id)
)
