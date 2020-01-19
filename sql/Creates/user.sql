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
    us_seat_fk     int(10)              NULL COMMENT 'ID Sede',
    us_rol_fk      int(10)              NOT NULL COMMENT 'ID Rol',
    us_plan_fk     int(10)              NULL COMMENT 'ID Plan',
    us_location_fk int(10)              NOT NULL COMMENT 'ID Lugar',
    CONSTRAINT user_ibfk_1 FOREIGN KEY (us_seat_fk) REFERENCES seat (se_id),
    CONSTRAINT user_ibfk_2 FOREIGN KEY (us_rol_fk) REFERENCES rol (ro_id),
    CONSTRAINT user_ibfk_3 FOREIGN KEY (us_plan_fk) REFERENCES plan (pl_id),
    CONSTRAINT user_ibfk_4 FOREIGN KEY (us_location_fk) REFERENCES location (lo_id)
);