SELECT pr.*,pe.pe_extra_fk,pe.pe_property_fk
FROM property as pr,
     property_extra as pe
WHERE pr.pr_id = pe.pe_property_fk
  AND (Select count(*) FROM property_extra pe2,extra ex2 WHERE
       pr.pr_id = pe2.pe_property_fk AND pe2.pe_extra_fk=ex2.ex_id
       AND (ex2.ex_name='Piscina'))=1
  AND pr.pr_id =(Select pp4.pp_property_fk From property_price pp4 WHERE
                 pp4.pp_id=(SELECT pp2.pp_id price FROM property_price pp2
                 WHERE pr.pr_id = pp2.pp_property_fk
                 ORDER BY pp2.pp_date_created DESC limit 1) AND pp4.pp_price<=10000000
                 AND pp4.pp_price>=10)
GROUP BY pr.pr_id