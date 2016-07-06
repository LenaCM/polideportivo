--Listado alquileres:

create type listado_alquileres as (apellido character varying(32),
				nombre character varying(32),
				nombre_instalacion character varying(32),
				fecha date,
				hora time,
				costo numeric(6,2),
				numero_socio integer);

				
CREATE OR REPLACE FUNCTION sp_listado_alquiler()
RETURNS SETOF listado_alquileres AS $$
DECLARE
rec listado_alquileres%rowtype; 

BEGIN
	
for rec in select apellido, nombre, nombre_instalacion, fecha, hora, costo, numero_socio
		from socios_alquilan  
		inner join personas using(id_persona)
		inner join instalaciones i using(id_instalacion)
		order by apellido
	loop
		return next rec;
	end loop;
	
for rec in select apellido, nombre, nombre_instalacion, fecha, hora, costo
		from no_socios_alquilan  
		inner join personas using(id_persona)
		inner join instalaciones i using(id_instalacion)
		order by apellido
	loop
		return next rec;
	end loop;

END;
$$LANGUAGE plpgsql VOLATILE
COST 100;

/*pruebas
SELECT * from sp_listado_alquiler(); 
