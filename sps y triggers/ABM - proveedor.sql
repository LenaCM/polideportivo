--ABM Proveedores:

--Alta

CREATE OR REPLACE FUNCTION sp_alta_proveedor(nombre_ text, dire text, tel text)
RETURNS void AS
$BODY$
declare
	id_prov integer;
begin
	--controles
	if nombre_='' then
		raise exception 'El campo nombre no puede estar vacio';
	end if;
	if dire='' then
		raise exception 'El campo direccion no puede estar vacio';
	end if;
	if tel='' then
		raise exception 'El campo telefono no puede estar vacio';
	end if;
	--determinar el id
	if (select max(id_proveedor) from proveedores) is null then
		id_prov:=1;
	else
		id_prov:= (select max(id_proveedor) from proveedores) + 1;
	end if;
	--control de existencia del proveedor
	if (select id_proveedor from proveedores where nombre like '%' || nombre_ || '%') is null then
		INSERT INTO proveedores(id_proveedor, nombre, direccion, telefono)
			VALUES (id_prov, nombre_, dire, tel);
	else
		raise exception 'El Proveedor ya existe';
	end if;
end;
$BODY$
 LANGUAGE plpgsql VOLATILE
 COST 100;

--prueba
select sp_alta_proveedor('EL CHANGUITO', 'calle 2345', '3676757');



-----------------------------------------------------------------------------------------------------------------

--modificar

CREATE OR REPLACE FUNCTION sp_modificacion_proveedor(nombre_prov varchar, nombre_mod varchar, telefono_mod varchar, direccion_mod varchar)
  RETURNS void AS
$BODY$
declare
	idprov smallint;
begin
	idprov := (select id_proveedor from proveedores where nombre like '%'||nombre_prov||'%');
	if idprov is not null then 
		if nombre_mod is not null then
			if nombre_mod='' then
				raise exception 'Nombre invalido';
			else
				update proveedores
				set nombre=nombre_mod
				where id_proveedor=idprov;
			end if;
		end if;
		if telefono_mod is not null then
			if telefono_mod='' then
				raise exception 'Numero de telefono invalid0';
			else
				update proveedores
				set telefono=telefono_mod
				where id_proveedor=idprov;
			end if;
		end if;
		if direccion_mod is not null then
			if direccion_mod='' then
				raise exception 'Direccion invalida';
			else
				update proveedores
				set direccion=direccion_mod
				where id_proveedor=idprov;
			end if;
		end if;
	else
		raise exception 'El proveedor no existe';
	end if;	
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;


--select sp_modificacion_proveedor('CAPO','CAPOS', null, 'direccion cambiada 1234')

-----------------------------------------------------------------------------------------------------------------
--Baja
CREATE OR REPLACE FUNCTION sp_baja_proveedor(nombre_prov varchar)
  RETURNS void AS
$BODY$
declare
	idprov smallint;
begin
	idprov := (select id_proveedor from proveedores where nombre like '%'||nombre_prov||'%');
	
	if idprov is null then
		raise exception 'El proveedor no existe';
	else
		delete from proveedores
		where id_proveedor=idprov;
	end if;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

  
--prueba:
select sp_baja_proveedor('CAPOS');
