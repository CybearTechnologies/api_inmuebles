CREATE TABLE rating
(
    ra_id               int(10) AUTO_INCREMENT COMMENT 'ID rating'
        PRIMARY KEY,
    ra_score            float                                NOT NULL COMMENT 'Calificacion',
    ra_message          varchar(200)                         NULL COMMENT 'Mensaje',
    ra_user_fk          int(10)                              NOT NULL COMMENT 'ID usuario',
    ra_active           tinyint(1) DEFAULT 1                 NOT NULL COMMENT 'Activo',
    ra_user_created_fk  int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    ra_date_created     datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    ra_user_modified_fk int(10)    DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    ra_date_modified    datetime   DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT rating_ibfk_1 FOREIGN KEY (ra_user_fk) REFERENCES user (us_id),
    CONSTRAINT rating_ibfk_2 FOREIGN KEY (ra_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT rating_ibfk_3 FOREIGN KEY (ra_user_modified_fk) REFERENCES user (us_id)
);