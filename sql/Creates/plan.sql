CREATE TABLE plan
(
    pl_id               int(10) AUTO_INCREMENT COMMENT 'ID plan' PRIMARY KEY,
    pl_name             varchar(45)                          NOT NULL COMMENT 'Nombre',
    pl_price            double(10, 2)                        NOT NULL COMMENT 'Precio',
    pl_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    pl_deleted          tinyint(1) DEFAULT 0                 NOT NULL COMMENT 'Eliminado',
    pl_user_created_fk  int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pl_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pl_user_modified_fk int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pl_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT plan_ibfk_1 FOREIGN KEY (pl_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT plan_ibfk_2 FOREIGN KEY (pl_user_modified_fk) REFERENCES user (us_id)
);