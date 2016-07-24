-- Function: sp_busqueda_socio_inactivo(integer, text, text)

-- DROP FUNCTION sp_busqueda_socio_inactivo(integer, text, text);

CREATE OR REPLACE FUNCTION sp_busqueda_socio_inactivo(tipo_busq integer, dato text, dato2 text)
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
			inner join socios_inactivos using(numero_socio)
			inner join personas  on (personas.id_persona=socios_inactivos.id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where apellido like '%'|| dato ||'%'
			ORDER BY apellido
		LOOP
		RETURN NEXT rec;
		END LOOP;
		if rec is null then
			raise exception 'Verificar datos o El socio que busca no existe o esta activo';
		end if;
	
	elsif tipo_busq=2 then
		FOR rec IN SELECT dni , tipo_doc , nombre , apellido , numero_socio , fechaingreso , estadocuenta 
			FROM socios 
			inner join socios_inactivos using(numero_socio)
			inner join personas  on (personas.id_persona=socios_inactivos.id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where nombre like '%'|| dato ||'%'
			ORDER BY nombre
		LOOP
		RETURN NEXT rec;
		END LOOP;
		if rec is null then
			raise exception 'Verificar datos o El socio que busca no existe o esta activo';
		end if;
	
	elsif tipo_busq=3 then
		FOR rec IN SELECT p.dni, td.tipo_doc, p.nombre, p.apellido, s.numero_socio, s.fechaingreso, s.estadocuenta, d.nombre
			FROM socios s
			inner join socios_inactivos using(numero_socio)
			inner join personas p  on (p.id_persona=socios_inactivos.id_persona)
			inner join tipos_doc td using(id_tipo_doc)
			inner join practican pr using (numero_socio)
			inner join disciplinas d using (id_disciplina)
			where d.nombre like '%'|| dato ||'%'
			
		LOOP
		RETURN NEXT rec;
		END LOOP;
		if rec is null then
			raise exception 'Verificar datos o El socio que busca no existe o esta activo';
		end if;
	elsif tipo_busq=4 then
		FOR rec IN SELECT dni , tipo_doc , nombre , apellido , numero_socio , fechaingreso , estadocuenta 
			FROM socios 
			inner join socios_inactivos using(numero_socio)
			inner join personas  on (personas.id_persona=socios_inactivos.id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where dni=cast(dato as integer) and tipo_doc like '%'||dato2||'%'
		LOOP
		RETURN NEXT rec;
		END LOOP;
		if rec is null then
			raise exception 'Verificar datos o El socio que busca no existe o esta activo';
		end if;
	elsif tipo_busq=5 then
		FOR rec IN SELECT dni , tipo_doc , nombre , apellido , numero_socio , fechaingreso , estadocuenta 
			FROM socios 
			inner join socios_inactivos using(numero_socio)
			inner join personas  on (personas.id_persona=socios_inactivos.id_persona)
			inner join tipos_doc using(id_tipo_doc)
			where numero_socio=cast(dato as integer)
		LOOP
		RETURN NEXT rec;
		END LOOP;
		if rec is null then
			raise exception 'Verificar datos o El socio que busca no existe o esta activo';
		end if;
	else
		raise exception 'No existe el tipo de busqueda ingresado';
	end if;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100
  ROWS 1000;
ALTER FUNCTION sp_busqueda_socio_inactivo(integer, text, text)
  OWNER TO postgres;
