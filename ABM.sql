--ABM socios
create or replace function sp_alta_socio(nombre_ text, apellido_ text, doc integer, tip_doc text)
	returns void as 
$$
declare
	id_pers integer; num_soc integer; id_doc smallint;
begin
	--controles
	if nombre_='' then
		raise exception 'El nombre no puede ser nulo';
	end if;
	if apellido_='' then
		raise exception 'El apellido no puede ser nulo';
	end if;
	if doc<0 then
		raise exception 'El documento no puede ser negativo';
	end if;
	--determinar el numero de socio
	if (select max(numero_socio) from socios) is null then
		num_soc:=1;
	else
		num_soc:= (select max(numero_socio) from socios) + 1;
	end if;
	--determinar id tipo de documento
	id_doc:= (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tip_doc||'%');
	--control de existencia de persona
	if (select id_persona from personas where dni=doc and id_tipo_doc=id_doc) is null then
		--determinar el id de persona
		if (select max(id_persona) from personas) is null then
			id_pers:=1;
		else
			id_pers:= (select max(id_persona) from personas) + 1;
		end if;
		--insertar persona
		insert into personas(id_persona, dni, id_tipo_doc, nombre, apellido)
			values (id_pers, doc, id_doc, nombre_, apellido_);
	else
		id_pers:=(select id_persona from personas where dni=doc and id_tipo_doc=id_doc);
	end if;
	--insertar socio
	insert into socios(numero_socio, id_persona, fechaingreso, estadocuenta)
		values (num_soc, id_pers, default, default);
end;
$$
	language plpgsql;

select sp_alta_socio('Noelia Analia', 'Lastra', 12345678, 'LC')

insert into personas(id_persona)values((select max(id_persona)from personas)+1)

