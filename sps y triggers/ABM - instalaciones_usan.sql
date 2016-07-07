--ABM instalaciones usan
-----------------------------------------------------------------------------------------------------------------
--ALTA instalaciones usan
-----------------------------------------------------------------------------------------------------------------
/*
create or replace function sp_alta_instalaciones_usan(nombre_instal varchar, nombre_insumo varchar)
	returns void as
$$
declare 
	id_ins smallint; id_instal smallint;
begin
	id_ins := (select id_insumo from insumos where nombre like '%'||nombre_insumo||'%');
	id_instal := (select id_instalacion from instalaciones where nombre_instalacion like '%'||nombre_instal||'%');
	if id_ins is null then
		raise exception 'El insumo no existe';
	end if;
	if id_instal is null then
		raise exception 'La instalacion no existe';
	end if;
	insert into instalaciones_usan values (id_instal, id_ins);
	exception
		when unique_violation then
			raise exception 'Ya se establecio el insumo para la instalacion'; 
end;
$$
	language plpgsql;
*/
--select sp_alta_instalaciones_usan('PISCINA 1', 'Escobas');
-----------------------------------------------------------------------------------------------------------------
--MODIFICACION instalaciones usan
-----------------------------------------------------------------------------------------------------------------
--si no usa algo que lo borre
-----------------------------------------------------------------------------------------------------------------
--BAJA instalaciones usan
-----------------------------------------------------------------------------------------------------------------
/*
create or replace function sp_baja_instalaciones_usan(nombre_instal varchar, nombre_insumo varchar)
	returns void as
$$
declare 
	id_ins smallint; id_instal smallint;
begin
	id_ins := (select id_insumo from insumos where nombre like '%'||nombre_insumo||'%');
	id_instal := (select id_instalacion from instalaciones where nombre_instalacion like '%'||nombre_instal||'%');
	if id_ins is null then
		raise exception 'El insumo no existe';
	end if;
	if id_instal is null then
		raise exception 'La instalacion no existe';
	end if;
	delete from instalaciones_usan where id_instalacion=id_instal and id_insumo=id_ins;
end;
$$
	language plpgsql;
*/
--select sp_baja_instalaciones_usan('PISCINA 1', 'Escobas');