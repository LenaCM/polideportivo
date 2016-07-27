-- Function: sp_busqueda_empleado(integer, text)

-- DROP FUNCTION sp_busqueda_empleado(integer, text);

CREATE OR REPLACE FUNCTION sp_busqueda_empleado(tipo_busq integer, dato text)
  RETURNS SETOF personas_empleados AS
$BODY$
DECLARE
rec personas_empleados%rowtype; 

BEGIN
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if tipo_busq= 1 then
		FOR rec IN SELECT id_persona, dni , tipo_doc , nombre , apellido , salario , antiguedad , hora_entrada, hora_salida 
			FROM empleados
			inner join personas  using(id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where apellido like '%'|| dato ||'%'
			ORDER BY apellido
		LOOP
		RETURN NEXT rec;
		END LOOP;
	
	elsif tipo_busq=2 then
		FOR rec IN SELECT id_persona, dni , tipo_doc , nombre , apellido , salario , antiguedad , hora_entrada, hora_salida 
			FROM empleados
			inner join personas  using(id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where nombre like '%'|| dato ||'%'
			ORDER BY nombre
		LOOP
		RETURN NEXT rec;
		END LOOP;
	elsif tipo_busq=3 then
		FOR rec IN SELECT id_persona, dni , tipo_doc , nombre , apellido , salario , antiguedad , hora_entrada, hora_salida 
			FROM empleados
			inner join personas  using(id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where dni=cast(dato as integer)
		LOOP
		RETURN NEXT rec;
		END LOOP;
	elsif tipo_busq=4 then
		FOR rec IN SELECT id_persona, dni , tipo_doc , nombre , apellido , salario , antiguedad , hora_entrada, hora_salida 
			FROM empleados
			inner join personas  using(id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where id_persona=cast(dato as integer)
		LOOP
		RETURN NEXT rec;
		END LOOP;
	else
		raise exception 'Verificar datos o El empleado que busca no existe';
	end if;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION sp_busqueda_empleado(integer, text)
  OWNER TO postgres;
