--ABM Insumos:

--Alta
create or replace function sp_alta_insumos(nombre_ varchar, stock_ integer, tipo integer)
	returns void as 
$$
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
	--control de existencia del insumo
	if (select id_insumo from insumos where nombre like '%' || nombre_ || '%') is null then
		INSERT INTO insumos(id_insumo, nombre, stock)
			VALUES (id_ins, nombre_, stock_);
	else
		raise exception 'El Insumo ya existe';
	end if;
	if tipo=1 then
		insert into insumos_administrativos values (id_ins);
	else 
		insert into insumos_no_administrativos values (id_ins);
	end if;
end;
$$language plpgsql;


--prueba para dar de alta:
select sp_alta_insumos('Detergente', 10, 2);

-----------------------------------------------------------------------------------------------------------------

--modificar 

create or replace function sp_modificacion_insumos(nombre_ins varchar, nombre_mod varchar, stock_mod integer)
	returns void as
$$
declare 
	id_ins integer;
begin
	id_ins := (select id_insumo from insumos where nombre like '%'||nombre_ins||'%');
	if id_ins is null then
		raise exception 'El insumo no existe';
	else
		if nombre_mod is not null then
			if nombre_mod='' then
				raise exception 'Nombre invalido';
			else
				update insumos 
				set nombre=nombre_mod
				where id_insumo=id_ins;
			end if;
		end if;
		if stock_mod is not null then
			if stock_mod<0 then
				raise exception 'El stock no puede ser negativo';
			else
				update insumos 
				set stock=stock_mod
				where id_insumo=id_ins;
			end if;
		end if;
	end if;
end;
$$language plpgsql;

--prueba
select sp_modificacion_insumos('Escobas', null, 32);

-----------------------------------------------------------------------------------------------------------------
--Baja
create or replace function sp_baja_insumos(nombre_ins varchar)
	returns void as
$$
declare
	id_ins integer;
begin
	id_ins := (select id_insumo from insumos where nombre like '%'||nombre_ins||'%');
	if id_ins is null then
		raise exception 'El insumo no existe';
	else
		delete from insumos
		where id_insumo=id_ins;
	end if;
end;
$$
language plpgsql;

select sp_baja_insumos('Detergente');

CREATE type insumos_ as
(
  id_insumo smallint ,
  nombre character varying(30) ,
  stock smallint
)

create or replace function buscar_insumos(nombre_ text) returns setof insumos_ as $$
declare
rec record;
begin
	for rec in select * from insumos where nombre like '%' || nombre_ || '%' loop
		return next rec;
	end loop;
end;
$$ language plpgsql;

select * from buscar_insumos('co')




