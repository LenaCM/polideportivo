-- Function: sp_busqueda_socio(integer, text)

-- DROP FUNCTION sp_busqueda_socio(integer, text);

CREATE OR REPLACE FUNCTION sp_busqueda_socio(tipo_busq integer, dato text, dato2 text)
  RETURNS SETOF personas_socio AS
$BODY$
DECLARE
rec personas_socio%rowtype; 

BEGIN
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if tipo_busq= 1 then
		FOR rec IN SELECT dni , tipo_doc , nombre , apellido , numero_socio , fechaingreso , estadocuenta 
			FROM socios 
			inner join socios_activos using(numero_socio)
			inner join personas  on (personas.id_persona=socios_activos.id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where apellido like '%'|| dato ||'%'
			ORDER BY apellido
		LOOP
		RETURN NEXT rec;
		END LOOP;
	
	elsif tipo_busq=2 then
		FOR rec IN SELECT dni , tipo_doc , nombre , apellido , numero_socio , fechaingreso , estadocuenta 
			FROM socios 
			inner join personas  using(id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where nombre like '%'|| dato ||'%'
			ORDER BY nombre
		LOOP
		RETURN NEXT rec;
		END LOOP;
	
	elsif tipo_busq=3 then
		FOR rec IN SELECT p.dni, td.tipo_doc, p.nombre, p.apellido, s.numero_socio, s.fechaingreso, s.estadocuenta
			FROM socios s
			inner join personas  p using(id_persona)
			inner join tipos_doc td using(id_tipo_doc)
			inner join practican pr using (numero_socio)
			inner join disciplinas d using (id_disciplina)
			where d.nombre like '%'|| dato ||'%'
			
		LOOP
		RETURN NEXT rec;
		END LOOP;
	elsif tipo_busq=4 then
		FOR rec IN SELECT dni , tipo_doc , nombre , apellido , numero_socio , fechaingreso , estadocuenta 
			FROM socios 
			inner join personas  using(id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where dni=cast(dato as integer) and tipo_doc like '%'||dato2||'%'
		LOOP
		RETURN NEXT rec;
		END LOOP;
	else
		raise exception 'Verificar datos o El socio que busca no existe';
	end if;
END;
$BODY$
  LANGUAGE plpgsql;
