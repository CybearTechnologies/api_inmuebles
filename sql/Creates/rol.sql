create table rol
(
    ro_id     int(10) auto_increment comment 'ID rol' primary key,
    ro_name   varchar(45)           NOT NULL comment 'Nombre',
    ro_active tinyint(10) default 1 NOT NULL comment 'Activo'
);