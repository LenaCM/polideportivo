--ABM personas
-----------------------------------------------------------------------------------------------------
--ALTA PERSONA
-----------------------------------------------------------------------------------------------------
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
	
	
	--determinar el id de persona
	if (select max(id_persona) from personas) is null then
		id_pers:=1;
	else
		id_pers:= (select max(id_persona) from personas) + 1;
	end if;
	--control de existencia de persona
	--puedo insertar una persona con el mismo numero pero distinto tipo de documento
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

-----------------------------------------------------------------------------------------------------
--BAJA PERSONA
-----------------------------------------------------------------------------------------------------
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
-----------------------------------------------------------------------------------------------------
--modificar persona segunda version
-----------------------------------------------------------------------------------------------------

create or replace function sp_modificacion_persona(doc integer, tipo_d text, dni_mod integer, tipo_d_mod text, nombre_mod varchar , apellido_mod varchar)
	returns void as
$$
begin
	if exists(select * from personas where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%')) then
		
		if nombre_mod is not null then
			update personas
				set nombre=nombre_mod
			where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
		end if;
		
		if apellido_mod is not null then
			update personas
				set apellido=apellido_mod
			where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
		end if;
		
		if dni_mod is not null then
			update personas
				set dni=dni_mod
			where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
			--cambio el documento para buscar
			doc=(select dni from personas where dni=dni_mod and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%'));
		end if;
		
		if tipo_d_mod is not null then
			update personas
				set id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d_mod||'%')
			where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
		end if;
		
	else 
		raise exception 'La persona no existe';
	end if;
	exception
		when unique_violation then
			raise exception 'El documento ya existe';
end;
$$
	language plpgsql;

--select sp_modificacion_persona(45676777, 'LE',39574733,'LE', 'Luna', null)