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
    CONSTRAINT or_ibfk_1 FOREIGN KEY (or_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT or_ibfk_2 FOREIGN KEY (or_user_modified_fk) REFERENCES user (us_id)
);