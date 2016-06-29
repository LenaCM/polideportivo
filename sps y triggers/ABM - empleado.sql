--ABM empleados
--alta empleado
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
		insert into empleados(id_persona, salario, antiguedad, hora_entrada, hora_salida)
			values(id_pers, sueldo, ant, ho_ent, ho_sal);
	else
		raise exception 'El empleado ya existe';
	end if;
end;
$$
	language plpgsql;
*/
--select sp_alta_empleado('Esteban', 'Quito', 33333333, 'LE',8999.99, 5, '08:00:00', '12:00:00')

--modificacion empleado
/*
create or replace function sp_modificacion_empleado(doc integer, tipo_d text, que integer, dato text)
	returns void as
$$
declare 
	id_pers integer;
begin
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	id_pers := (select id_persona from empleados e inner join personas p using(id_persona)  where p.dni=doc and p.id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%'));
	if id_pers is not null then
		if que=1 or que=2 or que=3 or que=4 then
		
			perform sp_modificacion_persona(doc, tipo_d, que, dato);
			
		elsif que=5 then
		
			update empleados
			set salario=cast(dato as numeric)
			where id_persona=id_pers;
			
		elsif que=6 then
		
			update empleados
			set antiguedad=cast(dato as int4)
			where id_persona=id_pers;
			
		elsif que=7 then
			update empleados
			set hora_entrada=cast(dato as time)
			where id_persona=id_pers;
		elsif que=8 then
			update empleados
			set hora_salida=cast(dato as time)
			where id_persona=id_pers;
		end if;
	else
		raise exception 'El emplead@ no existe';
	end if;
end;
$$
	language plpgsql;
*/
--select sp_modificacion_empleado(33333334, 'LE', 8, '13:00:00')