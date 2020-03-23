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

insert into property(pr_name,pr_area,pr_description,pr_status,
                     pr_floor,pr_type_fk,pr_user_created_fk,pr_location_fk,
                     pr_user_modified_fk) values
('Apartamento en los palos grandes',125.23,'bonito apartamento',1,0,1,1,1,1);

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

insert into property(pr_name,pr_area,pr_description,pr_status,
                     pr_floor,pr_type_fk,pr_user_created_fk,pr_location_fk,
                     pr_user_modified_fk) values
('Apartamento en los palos grandes',125.23,'bonito apartamento',1,0,1,1,1,1);

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

insert into favourite(fa_property_fk, fa_user_created_fk, fa_user_modified_fk)  VALUES
(1,2,2);

insert into favourite(fa_property_fk, fa_user_created_fk, fa_user_modified_fk)  VALUES
(1,1,1);

insert into subscription(su_ci,su_first_name,su_last_name,su_address,
                         su_passport, su_email, su_password,
                         su_user_modified_fk,su_plan_fk, su_seat_fk,
                         su_location_fk) VALUES
(24933360,'ramiro','vargas','La campiña','N45OP456','ramiroavch@gmail.com','89531705',1,1,1,1);

insert into subscription(su_ci, su_first_name,su_last_name,su_address,
                         su_passport, su_email, su_password,
                         su_user_modified_fk,su_plan_fk, su_seat_fk,
                         su_location_fk) VALUES
(23897542,'benito','llovia','can','N45OP1324','ramiroavch@gmail.com','89531705',1,1,1,1);

insert into subscription_detail(sd_subscription_fk,sd_document,sd_user_modified_fk) values
(2,'C:/',1);

insert into subscription_detail(sd_subscription_fk,sd_document,sd_user_modified_fk) values
(3,'D:/',1);