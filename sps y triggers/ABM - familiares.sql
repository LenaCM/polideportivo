--AMB familiares
-----------------------------------------------------------------------------------------------------
--ALTA familiares
-----------------------------------------------------------------------------------------------------
create or replace function sp_alta_familiares(dni_empleado integer, tipo_dni_empleado varchar, dni_familiar integer, tipo_dni_familiar varchar, nombre_familiar varchar, apellido_familiar varchar, rel_parentezco varchar) 
	returns void as
$$
declare
	id_persona_empleado integer; id_persona_familiar integer;
begin
	id_persona_empleado := (select id_persona from empleados inner join personas using (id_persona) where dni=dni_empleado and id_tipo_doc=(select busca_id_documento(tipo_dni_empleado)));
	if id_persona_empleado is null then
		raise exception 'El empleado no existe';
	else
		perform sp_alta_persona(nombre_familiar, apellido_familiar, dni_familiar, tipo_dni_familiar);
		id_persona_familiar := (select id_persona from personas where dni=dni_familiar and id_tipo_doc=(select busca_id_documento(tipo_dni_familiar)));
		insert into familiares values(id_persona_familiar, id_persona_empleado, rel_parentezco);
		
	end if;
end;
$$
	language plpgsql;

--select sp_alta_familiares(33333333,'LE',1680884,'LE','Roth', 'Pratt', 'HIJO' );
-----------------------------------------------------------------------------------------------------
--MODIFICACION familiares
-----------------------------------------------------------------------------------------------------

-----------------------------------------------------------------------------------------------------
--BAJA familiares
-----------------------------------------------------------------------------------------------------