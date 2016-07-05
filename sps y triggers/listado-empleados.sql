--LISTADO EMPLEADOS
--tipo de dato para guardar el listado
create type lista_empleados as (dni integer, 
				tipo_doc char(3), 
				apellido character varying(32),
				nombre character varying(32),
				salario numeric(8,2),
				apellido_conyugue character varying(32),
				nombre_conyugue character varying (32),
				numero_hijos smallint);
			
--funcion para armar el listado
create or replace function sp_listado_empleados()
	returns SETOF lista_empleados as
$$
declare
	rec lista_empleados%rowtype;
begin
	for rec in select p.dni, t.tipo_doc, p.apellido, p.nombre, e.salario, 
			(select apellido from personas where id_persona=f.id_persona_empl),
			(select nombre from personas where id_persona=f.id_persona_empl),
			(select count(parentezco) from familiares where id_persona=e.id_persona and (parentezco like '%HIJO%' or parentezco like '%HIJA%'))
		from empleados e 
		inner join familiares f using(id_persona)
		inner join personas p using(id_persona)
		inner join tipos_doc t using(id_tipo_doc)
		where parentezco like '%CONYUGUE%' order by p.apellido
	loop
		return next rec;
	end loop;

end;
$$
	language plpgsql;

select * from sp_listado_empleados();