--Listado alquileres:
/*******************************************************************************
create type listado_alquileres as (apellido character varying(32),
				nombre character varying(32),
				nombre_instalacion character varying(32),
				fecha date,
				hora time,
				costo numeric(6,2),
				numero_socio integer,
				pagado boolean);
**********************************************************************************/
				
CREATE OR REPLACE FUNCTION sp_listado_alquiler()
RETURNS SETOF listado_alquileres AS $$
DECLARE
rec listado_alquileres%rowtype; 

BEGIN
	
for rec in select * from 
			((select apellido, nombre, nombre_instalacion, fecha, hora, costo, numero_socio, pagado 
			from socios_alquilan 
			inner join personas using(id_persona)
			inner join instalaciones using(id_instalacion) order by hora desc)
			union 
			(select apellido, nombre, nombre_instalacion, fecha, hora, costo, 0, pagado 
			from no_socios_alquilan 
			inner join personas using(id_persona)
			inner join instalaciones using(id_instalacion)order by hora desc))as alquileres
		order by alquileres.fecha desc
	loop
		return next rec;
	end loop;
	

END;
$$LANGUAGE plpgsql;

/*pruebas
SELECT * from sp_listado_alquiler(); */

CREATE OR REPLACE FUNCTION sp_listado_alquiler(apellido_ text)
RETURNS SETOF listado_alquileres AS $$
DECLARE
rec listado_alquileres%rowtype; 

BEGIN
	
for rec in select * from 
			((select apellido, nombre, nombre_instalacion, fecha, hora, costo, numero_socio, pagado 
			from socios_alquilan 
			inner join personas using(id_persona)
			inner join instalaciones using(id_instalacion) order by hora desc)
			union 
			(select apellido, nombre, nombre_instalacion, fecha, hora, costo, 0, pagado 
			from no_socios_alquilan 
			inner join personas using(id_persona)
			inner join instalaciones using(id_instalacion)order by hora desc))as alquileres
		where apellido like '%'||apellido_||'%'
		order by alquileres.fecha desc
	loop
		return next rec;
	end loop;
	

END;
$$LANGUAGE plpgsql;

select * from sp_listado_alquiler('MEN')