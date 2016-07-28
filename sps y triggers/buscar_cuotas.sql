create type lista_cuotas as (
	numero_socio integer,
	apellido character varying (32),
	nombre character varying (32),
	dni integer,
	tipo_doc character(3),
	fecha date,
	precio numeric(6,2),
	descuento numeric(6,2),
	precio_final numeric(6,2),
	pagada boolean
);

create or replace function sp_buscar_cuotas(apellido_soc text)
	returns setof lista_cuotas as 
$$
declare
	rec lista_cuotas%rowtype;
begin
	for rec in select numero_socio,
			  apellido,
			  nombre,
			  dni,
			  tipo_doc,
			  fecha,
			  precio,
			  descuento,
			  precio_final,
			  pagada
		from tipos_doc 
		inner join personas using(id_tipo_doc) 
		inner join socios_activos using(id_persona) 
		inner join cuotas using(numero_socio)
		where apellido like '%'||apellido_soc||'%'
		order by fecha desc, numero_socio asc
	loop
		return next rec;
	end loop;
end;
$$
	language plpgsql;

select * from sp_buscar_cuotas('')