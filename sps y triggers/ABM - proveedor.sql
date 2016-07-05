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
select sp_alta_proveedor('CAPO', 'calle 1111', '1234567');



-----------------------------------------------------------------------------------------------------------------

--modificar

CREATE OR REPLACE FUNCTION sp_modificacion_proveedor(idprov integer, que integer, dato text)
  RETURNS void AS
$BODY$
begin
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if exists(select * from proveedores where id_proveedor=idprov) then
		if que=1 then
			update proveedores
				set nombre=dato
			where id_proveedor=idprov;
		elsif que=2 then
			update proveedores
				set direccion=dato
			where id_proveedor=idprov;
		elsif que=3 then
			update proveedores
				set telefono=dato
			where id_proveedor=idprov;
		end if;
	else 
		raise exception 'La proveedor no existe';
	end if;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;


--select sp_modificacion_proveedor(1, 2, 'direccion cambiada 1234')

-----------------------------------------------------------------------------------------------------------------
--Baja
CREATE OR REPLACE FUNCTION sp_baja_proveedor(idprov integer)
  RETURNS void AS
$BODY$
declare
begin
	if (select id_proveedor from proveedores where id_proveedor=idprov) is null then
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
select sp_baja_proveedor(2);
