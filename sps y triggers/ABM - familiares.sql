-- Function: sp_alta_familiares(integer, character varying, integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION sp_alta_familiares(integer, character varying, integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION sp_alta_familiares(dni_empleado integer, tipo_dni_empleado character varying, dni_familiar integer, tipo_dni_familiar character varying, nombre_familiar character varying, apellido_familiar character varying, rel_parentezco character varying)
  RETURNS void AS
$BODY$
declare
	id_persona_empleado integer; id_persona_familiar integer;
begin
	id_persona_empleado := (select id_persona from empleados inner join personas using (id_persona) where dni=dni_empleado and id_tipo_doc=(select busca_id_documento(tipo_dni_empleado)));
	if id_persona_empleado is null then
		raise exception 'El empleado no existe';
	else
		perform sp_alta_persona(nombre_familiar, apellido_familiar, dni_familiar, tipo_dni_familiar);
		id_persona_familiar := (select id_persona from personas where dni=dni_familiar and id_tipo_doc=(select busca_id_documento(tipo_dni_familiar)));
		insert into familiares values(id_persona_familiar, id_persona_empleado, rel_parentezco, current_timestamp);
		
	end if;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_alta_familiares(integer, character varying, integer, character varying, character varying, character varying, character varying)
  OWNER TO postgres;

---------------------------------------------------
--baja familiares
-------------------------------------------------
CREATE OR REPLACE FUNCTION sp_baja_familiares(dni_familiar integer, tipo_dni_familiar character varying)
  RETURNS void AS
$BODY$
declare
	id_persona_familiar integer;
begin
	id_persona_familiar := (select id_persona from familiares inner join personas using (id_persona) where dni=dni_familiar and id_tipo_doc=(select busca_id_documento(tipo_dni_familiar)));
	if id_persona_familiar is null then
		raise exception 'El familiar no existe';
	else
		delete from familiares where id_persona=id_persona_familiar;
		perform sp_baja_persona(dni_familiar, tipo_dni_familiar);
	end if;
end;
$BODY$
  LANGUAGE plpgsql;
 --modificar familiar
  CREATE OR REPLACE FUNCTION sp_modificar_familiares(dni_familiar integer, tipo_dni_familiar character varying, dni_mod integer, tipo_d_mod text, nombre_mod character varying, apellido_mod character varying, parentezco_mod character varying)
  RETURNS void AS
$BODY$
declare
	id_persona_familiar integer;
begin
	id_persona_familiar := (select id_persona from familiares inner join personas using (id_persona) where dni=dni_familiar and id_tipo_doc=(select busca_id_documento(tipo_dni_familiar)));
	if id_persona_familiar is null then
		raise exception 'El familiar no existe';
	else
		
	end if;
end;
$BODY$
  LANGUAGE plpgsql;