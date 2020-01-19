CREATE TABLE property_price
(
    pp_id               int(10) AUTO_INCREMENT COMMENT 'ID Precio propiedad' PRIMARY KEY,
    pp_price            double(20, 2)                      NOT NULL COMMENT 'Precio',
    pp_final            tinyint(1)                         NOT NULL COMMENT 'Precio final',
    pp_property_fk      int(10)                            NOT NULL COMMENT 'ID Propiedad',
    pp_user_created_fk  int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pp_date_created     datetime DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pp_user_modified_fk int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pp_date_modified    datetime DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT property_price_ibfk_1 FOREIGN KEY (pp_property_fk) REFERENCES property (pr_id),
    CONSTRAINT property_price_ibfk_2 FOREIGN KEY (pp_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT property_price_ibfk_3 FOREIGN KEY (pp_user_modified_fk) REFERENCES user (us_id)
);