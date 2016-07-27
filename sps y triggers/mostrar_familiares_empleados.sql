create type familiares_empleados as(
	apellido_empleado character varying (32),
	nombre_empleado character varying (32),
	dni_empleado integer,
	tipo_doc_empleado character(3),
	apellido_familiar character varying (32),
	nombre_familiar character varying (32),
	dni_familiar integer,
	tipo_doc_familiar character(3),
	parentezco character varying (15),
	fecha_adicion timestamp without time zone);
	
create or replace function sp_mostrar_familiares_empleados()
	returns setof familiares_empleados as
$$
declare
	rec familiares_empleados%rowtype;
begin
	for rec in select e.apellido, 
		          e.nombre, e.dni, 
		          te.tipo_doc, 
		          fa.apellido, 
		          fa.nombre, 
		          fa.dni, 
		          tf.tipo_doc, 
		          f.parentezco
		from tipos_doc te  
		inner join personas e on te.id_tipo_doc=e.id_tipo_doc 
		inner join familiares f on f.id_persona_empl=e.id_persona
		inner join personas fa on f.id_persona=fa.id_persona
		inner join tipos_doc tf on fa.id_tipo_doc=tf.id_tipo_doc
		order by f.fecha_adicion desc
	loop
		return next rec;
	end loop;
end;
$$
	language plpgsql;

select sp_mostrar_familiares_empleados(4578567, 'dni')

create or replace function sp_mostrar_familiares_empleados(numero integer, dato text)
	returns setof familiares_empleados as
$$
declare
	rec familiares_empleados%rowtype;
begin
	if (select sp_busqueda_empleado(3,cast(numero as text),dato)) is null then
		raise exception 'El empleado no existe';
	end if;
	for rec in select e.apellido, 
		          e.nombre,
		          e.dni, 
		          te.tipo_doc, 
		          fa.apellido, 
		          fa.nombre, 
		          fa.dni, 
		          tf.tipo_doc, 
		          f.parentezco
		from tipos_doc te  
		inner join personas e on te.id_tipo_doc=e.id_tipo_doc 
		inner join familiares f on f.id_persona_empl=e.id_persona
		inner join personas fa on f.id_persona=fa.id_persona
		inner join tipos_doc tf on fa.id_tipo_doc=tf.id_tipo_doc
		where e.dni=numero and te.tipo_doc like '%'||dato||'%'
		order by f.fecha_adicion desc
	loop
		return next rec;
	end loop;
	if rec is null then
		raise exception 'El empleado no tiene familiares';
	end if;
end;
$$
	language plpgsql;
--por apellido
create or replace function sp_mostrar_familiares_empleados(apellido_ text)
	returns setof familiares_empleados as
$$
declare
	rec familiares_empleados%rowtype;
begin
	if (select sp_busqueda_empleado(1,apellido_)) is null then
		raise exception 'El empleado no existe';
	end if;
	for rec in select e.apellido, 
		          e.nombre,
		          e.dni, 
		          te.tipo_doc, 
		          fa.apellido, 
		          fa.nombre, 
		          fa.dni, 
		          tf.tipo_doc, 
		          f.parentezco
		from tipos_doc te  
		inner join personas e on te.id_tipo_doc=e.id_tipo_doc 
		inner join familiares f on f.id_persona_empl=e.id_persona
		inner join personas fa on f.id_persona=fa.id_persona
		inner join tipos_doc tf on fa.id_tipo_doc=tf.id_tipo_doc
		where e.apellido like '%'||apellido_||'%'
		order by f.fecha_adicion desc
	loop
		return next rec;
	end loop;
	if rec is null then
		raise exception 'El empleado no tiene familiares';
	end if;
end;
$$
	language plpgsql;
