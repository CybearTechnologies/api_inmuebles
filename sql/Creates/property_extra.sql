CREATE TABLE property_extra
(
    pe_id               int(10) AUTO_INCREMENT COMMENT 'ID Propiedad extra'
        PRIMARY KEY,
    pe_value            int(10)                            NOT NULL COMMENT 'Valor',
    pe_property_fk      int                                NOT NULL COMMENT 'ID Propiedad',
    pe_extra_fk         int                                NOT NULL COMMENT 'ID Extra',
    pe_user_created_fk  int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario creador',
    pe_date_created     datetime DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT 'Fecha de creación',
    pe_user_modified_fk int(10)  DEFAULT 1                 NOT NULL COMMENT 'Usuario modificador',
    pe_date_modified    datetime DEFAULT CURRENT_TIMESTAMP NOT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'Fecha de modificación',
    CONSTRAINT property_extra_ibfk_1 FOREIGN KEY (pe_property_fk) REFERENCES property (pr_id),
    CONSTRAINT property_extra_ibfk_2 FOREIGN KEY (pe_extra_fk) REFERENCES extra (ex_id),
    CONSTRAINT property_extra_ibfk_3 FOREIGN KEY (pe_user_created_fk) REFERENCES user (us_id),
    CONSTRAINT property_extra_ibfk_4 FOREIGN KEY (pe_user_modified_fk) REFERENCES user (us_id)
);