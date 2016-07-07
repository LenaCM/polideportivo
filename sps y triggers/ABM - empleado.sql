--ABM empleados--
-----------------------------------------------------------------------------------------------------
--alta empleado
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_alta_empleado(nombre_ text, apellido_ text, doc integer, tip_doc text, sueldo numeric, ant integer, ho_ent time without time zone, ho_sal time without time zone)
	returns void as
$$
declare
	id_pers integer;
begin
	perform sp_alta_persona(nombre_, apellido_, doc, tip_doc);
	id_pers := (select id_persona from personas where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tip_doc||'%'));
	if not exists (select * from empleados where id_persona=id_pers) then
		if sueldo<=0 then
			raise exception 'Monto inválido para salario';
		end if;
		if ant<0 then
			raise exception 'Valor inválido para la antiguedad';
		end if;
		if ho_ent>=ho_sal then
			raise exception 'El horario de entrada no puede ser despues que el de salida';
		end if;
		insert into empleados(id_persona, salario, antiguedad, hora_entrada, hora_salida)
			values(id_pers, sueldo, ant, ho_ent, ho_sal);
	else
		raise exception 'El empleado ya existe';
	end if;
end;
$$
	language plpgsql;
*/
--select sp_alta_empleado('Lola', 'Mento', 39560791, 'DNI',5678.32, 4, '08:00:00', '12:00:00')

-----------------------------------------------------------------------------------------------------
--BAJA empleado
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_baja_empleado(tipo_d character varying, numero integer)
	returns void as
$$ 
declare
	id_dc smallint; id_pers integer;
begin 
	id_dc := (select busca_id_documento(tipo_d));
	id_pers :=(select id_persona from empleados inner join personas using(id_persona) where dni=numero and id_tipo_doc=id_dc);
	
	if id_pers is not null then
		delete from empleados where id_persona=id_pers;
	else
		raise exception 'El empleado no existe';
	end if;
	perform sp_baja_persona(numero, tipo_d);
end;
$$
	language  plpgsql;
*/
--select sp_baja_empleado('DNI', 7804213);

-----------------------------------------------------------------------------------------------------
--MODIFICAR EMPLEADO segunda version
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_modificar_empleado(doc integer, tipo_d text, dni_mod integer, tipo_d_mod text, nombre_mod varchar , apellido_mod varchar, salario_mod numeric, antiguedad_mod integer, hora_entrada_mod time without time zone,  hora_salida_mod time without time zone)
	returns void as
$$
declare
	id_pers integer;
begin
	id_pers := (select id_persona from empleados e inner join personas p using(id_persona)  where p.dni=doc and p.id_tipo_doc=(select 	id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%'));
	if id_pers is not null then
		perform sp_modificacion_persona(doc, tipo_d, dni_mod, tipo_d_mod, nombre_mod , apellido_mod);
		if salario_mod is not null then
			if salario_mod<=0 then
				raise exception 'Monto inválido para salario';
			end if;
			update empleados 
			set salario=salario_mod
			where id_persona=id_pers;
		end if;
		if antiguedad_mod is not null then
			if antiguedad_mod<0 then
				raise exception 'Valor inválido para la antiguedad';
			end if;
			update empleados 
			set antiguedad=antiguedad_mod
			where id_persona=id_pers;
		end if;
		if hora_entrada_mod is not null then
			if hora_entrada_mod>=(select hora_salida from empleados inner join personas using(id_persona) where id_persona=id_pers) then
				raise exception 'El horario de entrada no puede ser despues que el de salida';
			end if;
			update empleados 
			set hora_entrada=hora_entrada_mod
			where id_persona=id_pers;
		end if;
		if hora_salida_mod is not null then
			if hora_salida_mod<=(select hora_entrada from empleados inner join personas using(id_persona) where id_persona=id_pers) then
				raise exception 'El horario de salida no puede ser antes que el de entrada';
			end if;
			update empleados 
			set hora_salida=hora_salida_mod
			where id_persona=id_pers;
		end if;
	else
		raise exception 'El emplead@ no existe';
	end if;
	
end;
$$
	language plpgsql;
*/
-- select sp_modificar_empleado(33333333, 'LE', null, null, null, null, 9567.99, 11, '09:00:00', '14:00:00')