--ABM Insumos:

--Alta
create or replace function sp_alta_insumos(nombre_ text, stock_ integer)
	returns void as $$
declare
	id_ins integer;
begin
	--controles
	if nombre_='' then
		raise exception 'El campo nombre no puede estar vacio';
	end if;
	if stock_ < 0 then
		raise exception 'El stock no puede ser negativo';
	end if;
	--determinar el id
	if (select max(id_insumo) from insumos) is null then
		id_ins:=1;
	else
		id_ins:= (select max(id_insumo) from insumos) + 1;
	end if;
	--control de existencia del proveedor
	if (select id_insumo from insumos where nombre like '%' || nombre_ || '%') is null then
		INSERT INTO insumos(id_insumo, nombre, stock)
			VALUES (id_ins, nombre_, stock_);
	else
		raise exception 'El Insumo ya existe';
	end if;
end;
$$language plpgsql;


--prueba para dar de alta:
select sp_alta_insumos('Escobas', 3);

-----------------------------------------------------------------------------------------------------------------

--modificar 

create or replace function sp_modificacion_insumos(idins integer, que integer, dato text)
	returns void as
$$
begin
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if exists(select * from insumos where id_insumo=idins) then
		if que=1 then
			update insumos
				set nombre=dato
			where id_insumo=idins;
		elsif que=2 then
			update insumos
				set stock=cast(dato as int4)
			where id_insumo=idins;
		end if;
	else 
		raise exception 'El insumo no existe';
	end if;
end;
$$language plpgsql;

--prueba
select sp_modificacion_insumos(2, 2, '32');

-----------------------------------------------------------------------------------------------------------------
--Baja
create or replace function sp_baja_insumos(idins integer)
	returns void as
$$
declare
begin
	if (select id_insumo from insumos where id_insumo=idins) is null then
		raise exception 'El insumo no existe';
	else
		delete from insumos
		where id_insumo=idins;
	end if;
end;
$$
language plpgsql;

select sp_baja_insumos(2)