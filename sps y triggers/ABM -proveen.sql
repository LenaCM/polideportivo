--ABM proveen
-----------------------------------------------------------------------------------------------------
--ALTA proveen
-----------------------------------------------------------------------------------------------------
create or replace function sp_alta_proveen(nombre_prov varchar, nombre_insumo varchar)
	returns void as
$$
declare 
	idprov smallint; id_ins smallint;
begin
	idprov := (select id_proveedor from proveedores where nombre like '%'||nombre_prov||'%' limit 1);
	id_ins := (select id_insumo from insumos where nombre like '%'||nombre_insumo||'%' limit 1);
	if id_ins is null then
		raise exception 'El insumo no existe';
	elsif (select id_insumos_ad from insumos_administrativos where id_insumos_ad=id_ins) is null then
		raise exception 'No es insumo administrativo';
	end if;
	if idprov is null then
		raise exception 'El proveedor no existe';
	end if;
	insert into proveen values(idprov, id_ins);
	exception
		when unique_violation then
			raise exception 'Ya se establecio el proveedor para el producto';
			
end;
$$
	language plpgsql;

	select id_proveedor from proveedores where nombre like '%AMD%' limit 1
	
--select sp_alta_proveen('PAPELERA DEL SUR', 'Resma de papel A4');
-----------------------------------------------------------------------------------------------------
--MODIFICACION proveen
-----------------------------------------------------------------------------------------------------
--si quiero otro proveedor para el mismo insumo simplemente damos un alta nueva y ya, y si no lo queremos pues lo borramos. O despues lo hacemos al modificado
-----------------------------------------------------------------------------------------------------
--BAJA proveen
-----------------------------------------------------------------------------------------------------
create or replace function sp_baja_proveen(nombre_prov varchar, nombre_insumo varchar)
	returns void as 
$$
declare
	idprov smallint; id_ins smallint;
begin
	idprov := (select id_proveedor from proveedores where nombre like '%'||nombre_prov||'%');
	id_ins := (select id_insumo from insumos where nombre like '%'||nombre_insumo||'%');
	if id_ins is null then
		raise exception 'El insumo no existe';
	elsif (select id_insumos_ad from insumos_administrativos where id_insumos_ad=id_ins) is null then
		raise exception 'No es insumo administrativo';
	end if;
	if idprov is null then
		raise exception 'El proveedor no existe';
	end if;
	delete from proveen where id_insumo_ad=id_ins and id_proveedor=idprov;
end;
$$
	language plpgsql;

--select sp_baja_proveen('PAPELERA DEL SUR', 'Resma de papel A4');