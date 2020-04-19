SELECT pr.pr_id id, pr.pr_name 'name', pr.pr_area area,
       pr.pr_description description, pr.pr_floor floor,
       pr.pr_status 'status', pr.pr_active active, pr.pr_type_fk 'type',
       pr.pr_deleted 'delete', pr.pr_location_fk location,
       pr.pr_user_created_fk userCreated, pr.pr_date_created dateCreated,
       pr.pr_user_modified_fk userModified, pr.pr_date_modified dateModified
FROM property pr WHERE pr.pr_id =(Select pp4.pp_property_fk From property_price pp4 WHERE
        pp4.pp_id=(SELECT pp2.pp_id price FROM property_price pp2
                   WHERE pr.pr_id = pp2.pp_property_fk
                   ORDER BY pp2.pp_date_created DESC limit 1) AND pp4.pp_price>=200 AND pp4.pp_price<=10000000800
) AND (Select count(*)
       FROM property_extra pe2,extra ex2
       WHERE pr.pr_id = pe2.pe_property_fk AND pe2.pe_extra_fk=ex2.ex_id
         AND (  ex2.ex_name ='Piscina' OR  ex2.ex_name ='Estacionamiento'  ))=2
                   AND ((INSTR(pr.pr_name, 'apartamento') > 0) OR (INSTR(pr.pr_description, 'feo') > 0)) GROUP BY pr.pr_id;