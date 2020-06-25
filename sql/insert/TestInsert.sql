insert into rol_access(ra_rol_fk, ra_access_fk,ra_user_created_fk,ra_user_modified_fk) values
(1,1,1,1),
(1,2,1,1),
(1,3,1,1),
(1,4,1,1),
(1,5,1,1),
(1,6,1,1),
(1,7,1,1),
(1,8,1,1),
(1,9,1,1),
(1,10,1,1),
(1,11,1,1),
(1,12,1,1),
(1,13,1,1),
(1,14,1,1),
(1,15,1,1),
(1,16,1,1);

insert into seat(se_name, se_rif, se_location_fk, se_agency_fk,se_user_created_fk,
                 se_user_modified_fk)
values ('C21 Los palos grandes','J-12306151',20,1,1,1);

insert into user(us_first_name, us_last_name, us_address, us_email,
                 us_password, us_active, us_seat_fk, us_rol_fk, us_plan_fk,us_location_fk,
                 us_user_created_fk,us_user_modified_fk) values
('Ramiro','Vargas','La candelaria','ramiroavch@gmail.com','123456',1,1,1,1,1,1,1);

insert into user(us_first_name, us_last_name, us_address, us_email,
                 us_password, us_active, us_seat_fk, us_rol_fk, us_plan_fk,us_location_fk,
                 us_user_created_fk,us_user_modified_fk) values
('Jose','Cedeno','Cumbres de Curumo','josejecr97@gmail.com','123456',1,1,1,1,1,1,1);

insert into property(pr_name,pr_destiny_fk,pr_area,pr_description,pr_status,
                     pr_floor,pr_type_fk,pr_user_created_fk,pr_location_fk,
                     pr_user_modified_fk) values
('Apartamento en los palos grandes',1,125.23,'bonito apartamento',1,0,1,1,1,1);

insert into request(re_user_created_fk,re_user_modified_fk,re_property_fk) values
(1,1,1);

insert into request(re_user_created_fk,re_user_modified_fk,re_property_fk) values
(2,2,1);

insert into property_price(pp_price,pp_property_fk,pp_final,pp_user_created_fk,
                           pp_user_modified_fk) values
(5000.23,1,0,1,1);

insert into property_extra(pe_value, pe_property_fk,pe_extra_fk,pe_user_created_fk,
                           pe_user_modified_fk) values
(2,1,1,1,1);

insert into property_extra(pe_value, pe_property_fk,pe_extra_fk,pe_user_created_fk,
                           pe_user_modified_fk) values
(3,1,3,1,1);

insert into property_extra(pe_value, pe_property_fk,pe_extra_fk,pe_user_created_fk,
                           pe_user_modified_fk) values
(3,1,2,1,1);

insert into user(us_first_name, us_last_name, us_address, us_email,
                 us_password, us_active, us_seat_fk, us_rol_fk, us_plan_fk,us_location_fk,
                 us_user_created_fk,us_user_modified_fk) values
('Ramiro','Vargas','La candelaria','ramiroavch@gmail.com','123456',1,1,1,1,1,1,1);

insert into user(us_first_name, us_last_name, us_address, us_email,
                 us_password, us_active, us_seat_fk, us_rol_fk, us_plan_fk,us_location_fk,
                 us_user_created_fk,us_user_modified_fk) values
('Jose','Cedeno','Cumbres de Curumo','josejecr97@gmail.com','123456',1,1,1,1,1,1,1);

insert into property(pr_name,pr_destiny_fk,pr_area,pr_description,pr_status,
                     pr_floor,pr_type_fk,pr_user_created_fk,pr_location_fk,
                     pr_user_modified_fk) values
('Apartamento en los palos grandes',2,125.23,'bonito apartamento',1,0,1,1,1,1);

insert into property_price(pp_price,pp_property_fk,pp_final,pp_user_created_fk,
                           pp_user_modified_fk) values
(2222.23,1,0,1,1);

insert into property_extra(pe_value, pe_property_fk,pe_extra_fk,pe_user_created_fk,
                           pe_user_modified_fk) values
(2,1,1,1,1);

insert into property_extra(pe_value, pe_property_fk,pe_extra_fk,pe_user_created_fk,
                           pe_user_modified_fk) values
(3,1,3,1,1);

insert into property_extra(pe_value, pe_property_fk,pe_extra_fk,pe_user_created_fk,
                           pe_user_modified_fk) values
(3,1,2,1,1);

INSERT INTO origin (or_id, or_name, or_private_key, or_public_key, or_active, or_deleted,
                    or_user_created_fk, or_date_created, or_user_modified_fk, or_date_modified)
        VALUES
                    (1, 'Browser', '5efcef0186887afb02f425fc0f787e4eff6b95f068828a312e2b0756485a19ba',
                     '4a4d4a4341acbccae132bc912d91f0d0bbfa2843d27775e14930143bce44aabb', 1, 0, 1,
                     '2020-04-06 22:40:52', 1, '2020-04-06 22:40:52');