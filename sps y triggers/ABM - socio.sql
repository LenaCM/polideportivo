--ABM socios
-----------------------------------------------------------------------------------------------------
--ALTA SOCIO
-----------------------------------------------------------------------------------------------------
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
-----------------------------------------------------------------------------------------------------
--TRIGGER QUE INSERTA AUTOMATICAMENTE EN SOCIOS ACTIVOS
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_insertar_sactivo()
	returns trigger as
$tg_insertar_sactivo$
begin
	insert into socios_activos values(NEW.numero_socio, NEW.id_persona);
	return NEW;
end;
$tg_insertar_sactivo$
	language plpgsql;

create trigger tg_insertar_sactivos after insert on socios for each row execute procedure sp_insertar_sactivo();
*/


--select sp_alta_socio('Joan', 'Robinson', 7041358, 'LC')

-----------------------------------------------------------------------------------------------------
--BAJA SOCIO
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_baja_socio(tipo_busq integer, tipo_d text, numero integer)
	returns void as
$$
declare docu integer; num_soc integer; id_dc smallint;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			delete from socios_activos where numero_socio=numero;
		end if;
				
	elsif tipo_busq=2 then
	
		id_dc := (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
		num_soc := (select numero_socio from socios inner join personas using (id_persona) where dni=numero and id_tipo_doc=id_dc);
		if num_soc is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=num_soc) is null then
			raise exception 'El socio no esta activo';
		else
			delete from socios_activos where numero_socio=num_soc;
		end if;
	end if;	
end;
$$
	language plpgsql;
	
*/
-----------------------------------------------------------------------------------------------------
--TRIGGER QUE INSERTA AUTOMATICAMENTE EN SOCIOS INACTIVOS
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_insertar_sinactivo()
	returns trigger as
$tg_insertar_sinactivo$
begin
	insert into socios_inactivos values(OLD.numero_socio, OLD.id_persona);
	return OLD;
end;
$tg_insertar_sinactivo$
	language plpgsql;

create trigger tg_insertar_sinactivo after delete on socios_activos for each row execute procedure sp_insertar_sinactivo();

*/
--select sp_baja_socio(1, null, 4)

-----------------------------------------------------------------------------------------------------
--MODIFICACION SOCIO segunda version
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_modificacion_socio(tipo_busq integer, tipo_d text, numero integer, dni_mod integer, tipo_d_mod text, nombre_mod varchar , apellido_mod varchar)
	returns void as
$$
declare docu integer; tipo_dc text;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		else
			docu:=(select dni from personas p inner join socios s using(id_persona) where s.numero_socio=numero);
			tipo_dc:=(select tipo_doc from tipos_doc t inner join personas p using(id_tipo_doc) where p.dni=docu);
			perform sp_modificacion_persona(docu, tipo_dc, dni_mod, tipo_d_mod, nombre_mod , apellido_mod); 
		end if;
	elsif tipo_busq=2 then
		perform sp_modificacion_persona(numero, tipo_d, dni_mod, tipo_d_mod, nombre_mod , apellido_mod);
	end if;	
end;
$$
	language plpgsql;
*/
--select sp_modificacion_socio(2,'LC', 39574733, null, null, 'Clarisa', null)