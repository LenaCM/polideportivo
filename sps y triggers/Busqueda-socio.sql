--LISTADOS:

create type personas_socio as (dni integer, tipo_doc character varying(3),
				nombre character varying(32), apellido character varying(32), numero_socio integer, fechaingreso date, estadocuenta character varying(10));


CREATE OR REPLACE FUNCTION sp_busqueda_socio(tipo_busq integer, dato text)
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
			inner join personas  using(id_persona)
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
			where dni=cast(dato as integer)
		LOOP
		RETURN NEXT rec;
		END LOOP;
	else
		raise exception 'Verificar datos o El socio que busca no existe';
	end if;
END;
$BODY$
LANGUAGE plpgsql VOLATILE
COST 100;

/*pruebas
SELECT sp_busqueda_socio(1, 'Saenz'); 
SELECT sp_busqueda_socio(2, 'Juan'); 
SELECT sp_busqueda_socio(3, 'tenis'); 
SELECT sp_busqueda_socio(4, '12345678'); 
SELECT sp_busqueda_socio(2, 'Ana'); 

