--ABM Proveedores:

--Alta
create or replace function sp_alta_proveedores(nombre_ text, dir text, tel text)
	returns void as $$
declare
	id_prov integer;
begin
	--controles
	if nombre_='' then
		raise exception 'El campo nombre no puede estar vacio';
	end if;
	if dir='' then
		raise exception 'El campo direccion no puede estar vacio';
	end if;
	if tel='' then
		raise exception 'El campo telefono no puede estar vacio';
	end if;
	--determinar el id
	if (select max(id_proveedor) from proveedores) is null then
		id_prov:=1;
	else
		id_prov:= (select max(id_proveedor) from proveedores) + 1;
	end if;
	--control de existencia del proveedor
	if (select id_persona from personas where dni=doc and id_tipo_doc=id_doc) is null then
		--determinar el id de persona
		if (select max(id_persona) from personas) is null then
			id_pers:=1;
		else
			id_pers:= (select max(id_persona) from personas) + 1;
		end if;
		--insertar persona
		perform sp_alta_persona(nombre_, apellido_, doc, tip_doc);
	else
		id_pers:=(select id_persona from personas where dni=doc and id_tipo_doc=id_doc);
	end if;
	--insertar No_socio
	insert into no_socios(id_persona)
   		values (id_pers);
   	exception			
		when unique_violation then
			raise exception 'El documento ya existe';
end;
$$language plpgsql;


--prueba para dar de alta no_socio:
select sp_alta_no_socio('Ana', 'Jimenez', 11234567, 'DNI')

-----------------------------------------------------------------------------------------------------------------

--modificar no socio

create or replace function sp_modificacion_no_socio(tipo_busq integer, tipo_d text, numero integer, campo integer, dato text)
	returns void as
$$
declare docu integer; tipo_dc text;
begin
	if tipo_busq=1 then
		docu:=(select dni from personas p inner join no_socios s using(id_persona) where s.id_persona=numero);
		tipo_dc:=(select tipo_doc from tipos_doc t inner join personas p using(id_tipo_doc) where p.dni=docu);
		perform sp_modificacion_persona(docu,tipo_dc, campo, dato); 
	elsif tipo_busq=2 then
		perform sp_modificacion_persona(numero, tipo_d, campo, dato);
	end if;	
end;
$$
language plpgsql;

--select sp_modificacion_socio(1,'DNI',3,2,'Saenz')
--select sp_modificacion_persona(13234567, 'LC', 2, 'Saenz')

-----------------------------------------------------------------------------------------------------------------
--Baja
create or replace function sp_borrar_no_socio(doc integer, tip_doc text)
	returns void as $$
declare
	id_pers integer; id_doc smallint;
begin
	--controles
	if doc<0 then
		raise exception 'El campo documento no puede ser negativo o estar vacio';
	end if;
	
	--determinar id
	id_doc:= (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tip_doc||'%');
	id_pers:=(select id_persona from personas where dni=doc and id_tipo_doc=id_doc);
	--control de existencia de persona
	if (select id_persona from personas where dni=doc and id_tipo_doc=id_doc) is null then
		raise exception 'La persona que busca no se encuentra en BD';
	else
		perform sp_baja_persona(doc,tip_doc);
	end if;
end;
$$language plpgsql;

--prueba para eliminar socio:
select sp_borrar_no_socio(11234567, 'DNI');
