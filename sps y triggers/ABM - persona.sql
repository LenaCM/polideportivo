--ABM personas
--ALTA PERSONA
/*
create or replace function sp_alta_persona(nombre_ text, apellido_ text, doc integer, tip_doc text)
	returns void as 
$$
declare
	id_pers integer; id_doc smallint;
begin
	--controles
	if nombre_='' or nombre_ is null then
		raise exception 'El nombre no puede ser nulo';
	end if;
	if apellido_='' or apellido_ is null then
		raise exception 'El apellido no puede ser nulo';
	end if;
	if doc<0 or doc is null then
		raise exception 'Documento invalido';
	end if;
	--determinar id tipo de documento
	id_doc:= (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tip_doc||'%');
	--control de existencia de persona
	--puedo insertar una persona con el mismo numero pero distinto tipo de documento
	--determinar el id de persona
	if (select max(id_persona) from personas) is null then
		id_pers:=1;
	else
		id_pers:= (select max(id_persona) from personas) + 1;
	end if;
	--insertar persona
	if(select id_persona from personas where dni=doc and id_tipo_doc=id_doc) is null then
		insert into personas(id_persona, dni, id_tipo_doc, nombre, apellido)
			values (id_pers, doc, id_doc, nombre_, apellido_);
	else
		raise notice 'La persona ya existe';
	end if;
end;
$$
	language plpgsql;
*/
--select sp_alta_persona('Lola', 'Mento', 39560791, 'DNI')
--MODIFICICACION PERSONA
/*
create or replace function sp_modificacion_persona(doc integer, tipo_d text, que integer, dato text)
	returns void as
$$
begin
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if que=1 then
		update personas
			set nombre=dato
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	elsif que=2 then
		update personas
			set apellido=dato
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	elsif que=3 then
		update personas
			set dni=cast(dato as int4)
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	elsif que=4 then
		update personas
			set id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||dato||'%')
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	end if;
	exception
		when unique_violation then
			raise exception 'El documento ya existe';
end;
$$ 
	language plpgsql;
*/

--BAJA PERSONA
/*
create or replace function sp_baja_persona(doc integer,tip_doc text)
	returns void as
$$
declare
	id_doc smallint;
begin
	id_doc := (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tip_doc||'%');
	if (select id_persona from personas where dni=doc and id_tipo_doc=id_doc) is null then
		raise exception 'La persona no existe';
	else
		delete from personas
		where dni=doc and id_tipo_doc=id_doc;
	end if;
end;
$$
	language plpgsql;
*/
--select sp_baja_persona(39560791, 'DNI')