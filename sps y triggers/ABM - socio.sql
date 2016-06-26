--ABM socios
--ALTA SOCIO
/*
create or replace function sp_alta_socio(nombre_ text, apellido_ text, doc integer, tip_doc text)
	returns void as 
$$
declare
	num_soc integer; id_pers integer; id_doc smallint;
begin
	--determinar el numero de socio
	if (select max(numero_socio) from socios) is null then
		num_soc:=1;
	else
		num_soc:= (select max(numero_socio) from socios) + 1;
	end if;
	perform sp_alta_persona(nombre_, apellido_, doc, tip_doc);
	id_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%' || tip_doc || '%');
	id_pers:=(select id_persona from personas where dni=doc and id_tipo_doc=id_doc);
	--insertar socio
	insert into socios(numero_socio, id_persona, fechaingreso, estadocuenta)
		values (num_soc, id_pers, default, default);
	exception			
		when unique_violation then
			raise exception 'El documento ya existe';
end;
$$
	language plpgsql;

*/
--select sp_alta_socio('Babi', 'Lu', 12345678, 'DNI')
--MODIFICACION SOCIO
/*
create or replace function sp_modificacion_socio(tipo_busq integer, tipo_d text, numero integer, campo integer, dato text)
	returns void as
$$
declare docu integer; tipo_dc text;
begin
	if tipo_busq=1 then
		docu:=(select dni from personas p inner join socios s using(id_persona) where s.numero_socio=numero);
		tipo_dc:=(select tipo_doc from tipos_doc t inner join personas p using(id_tipo_doc) where p.dni=docu);
		perform sp_modificacion_persona(docu,tipo_dc, campo, dato); 
	elsif tipo_busq=2 then
		perform sp_modificacion_persona(numero, tipo_d, campo, dato);
	end if;	
end;
$$
	language plpgsql;
*/
--select sp_modificacion_socio(1,'LC',1,1,'Malena')
--select sp_modificacion_persona(12345678, 'LC', 1, 'Noe')

--BAJA SOCIO

create or replace function sp_baja_socio(tipo_busq integer, tipo_d text, numero integer)
	returns void as
$$
declare docu integer; tipo_dc text; id_pers integer; id_dc smallint;
begin
	if tipo_busq=1 then
		docu:=(select dni from personas p inner join socios s using(id_persona) where s.numero_socio=numero);
		tipo_dc:=(select tipo_doc from tipos_doc t inner join personas p using(id_tipo_doc) where p.dni=docu);
		if docu is not null then
			delete from socios where numero_socio=numero;
		else 
			raise exception 'El socio no existe';
		end if;
		perform sp_baja_persona(docu,tipo_dc);
	elsif tipo_busq=2 then
	
		id_dc := (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
		id_pers :=(select id_persona from personas where dni=numero and id_tipo_doc=id_dc);
		if id_pers is not null then
			delete from socios where id_persona=id_pers;
		else
			raise exception 'El socio no existe';
		end if;
		perform sp_baja_persona(numero, tipo_d);
	end if;	
end;
$$
	language plpgsql;
	
--select sp_baja_socio(2, 'DNI', 12345678)