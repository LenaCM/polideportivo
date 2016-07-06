--AMB familiares
-----------------------------------------------------------------------------------------------------
--ALTA familiares
-----------------------------------------------------------------------------------------------------
/*
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
*/
--select sp_alta_familiares(33333333,'LE',1680884,'LE','Roth', 'Pratt', 'HIJO' );
-----------------------------------------------------------------------------------------------------
--MODIFICACION familiares
-----------------------------------------------------------------------------------------------------
create or replace function sp_modificacion_familiar(doc integer, tipo_d text, dni_mod integer, tipo_d_mod text, nombre_mod varchar , apellido_mod varchar, dni_empleado_mod integer, tipo_doc_empleado_mod varchar, parentezco_mod varchar)
	returns void as
$$
declare 
	id_persona_familiar integer; id_persona_empleado integer;
begin
	id_persona_familiar := (select id_persona from familiares inner join personas using(id_persona) where dni=doc and id_tipo_doc=(select busca_id_documento(tipo_d)));
	
	if id_persona_familiar is null then
		raise exception 'La persona no es familiar de un empleado';
	else
		perform sp_modificacion_persona(doc, tipo_d, dni_mod, tipo_d_mod, nombre_mod , apellido_mod);
		
		if dni_empleado_mod is not null and tipo_doc_empleado_mod is not null then
			if dni_empleado_mod <1000000 then
				raise exception 'El valor para la modificacion del documento del empleado no es valida';
			else
				id_persona_empleado := (select id_persona from empleados inner join personas using(id_persona) where dni=dni_empleado_mod and id_tipo_doc=(select busca_id_documento(tipo_doc_empleado_mod)));
				if id_persona_empleado is null then
					raise exception 'No existe el empleado';
				end if;
				update familiares
				set id_persona_empl = id_persona_empleado
				where id_persona=id_persona_familiar;
			end if;
		end if;
		if parentezco_mod is not null then
			update familiares
			set parentezco=parentezco_mod
			where id_persona=id_persona_familiar;
		end if;
		
	end if;
end;
$$
	language plpgsql;
--select sp_modificacion_familiar(1680884, 'LE', null, null, null ,null, 39567456, 'LE', 'HIJO')
-----------------------------------------------------------------------------------------------------
--BAJA familiares
-----------------------------------------------------------------------------------------------------