--ABM empleados
--alta empleado
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
	
--select sp_alta_empleado('Esteban', 'Quito', 33333333, 'LE',8999.99, 5, '08:00:00', '12:00:00')