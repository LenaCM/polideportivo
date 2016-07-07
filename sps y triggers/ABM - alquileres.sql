--ABM alquileres
-----------------------------------------------------------------------------------------------------
--ALTA alquiler socio
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_alta_alquiler(tipo_busq integer, tipo_d varchar, numero integer, instal varchar, fecha_al date, hora_al time without time zone,costo_al numeric, pagado_al boolean)
	returns void as
$$
	declare num_soc integer; id_pers integer; id_inst smallint;
begin
	if instal='' or instal is null then
		raise exception 'Instalación no válida';
	end if;
	if fecha_al<current_date then
		raise exception 'La fecha no puede ser anterior a la fecha actual';
	end if;
	if costo_al<=0 then
		raise exception 'El monto ingresado no es valido';
	end if;
	if hora_al<'07:00:00' or hora_al>'22:00:00' then
		raise exception 'Alquiler fuera de horario';
	end if;
	id_inst := (select id_instalacion from instalaciones where nombre_instalacion like '%'||instal||'%');
	if (select id_instalacion from socios_alquilan where id_instalacion=id_inst and fecha=fecha_al and hora=hora_al) is not null then
		raise exception 'La instalacion ya se encuentra alquilada en este turno';
	end if;
	
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			num_soc:=numero;
			id_pers = (select id_persona from socios where numero_socio=num_soc);
		end if;
	else
		num_soc := (select id_persona from socios inner join personas using(id_persona) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if num_soc is null then
			raise exception 'El socio no existe';
		elsif (select num_soc from socios_activos where numero_socio=num_soc) is null then
			raise exception 'El socio no esta activo';
		else
			id_pers = (select id_persona from socios where numero_socio=num_soc);
		end if;
	end if;
	insert into socios_alquilan values (num_soc, id_inst, fecha_al, hora_al, costo_al,id_pers, pagado_al);
	exception 
		when unique_violation then
			raise exception 'Ya se registro el alquiler';
			
	
end;
$$
language plpgsql;
*/
--select sp_alta_alquiler(2, 'LC', 39567455, 'PISCINA 1', '09/07/2016', '07:00:00', 234.45,false)
-----------------------------------------------------------------------------------------------------
--ALTA alquiler no socio
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_alta_alquiler(tipo_d varchar, numero integer, nombre_al varchar, apellido_al varchar, instal varchar, fecha_al date, hora_al time without time zone,costo_al numeric, senia_al numeric, pagado_al boolean)
	returns void as
$$
declare
	id_inst smallint; id_pers integer;
begin
	if instal='' or instal is null then
		raise exception 'Instalación no válida';
	end if;
	if fecha_al<current_date then
		raise exception 'La fecha no puede ser anterior a la fecha actual';
	end if;
	if costo_al<=0 then
		raise exception 'El monto de costo alquiler ingresado no es valido';
	end if;
	if senia_al<=0 then
		raise exception 'El monto ingresado como senia no es valido';
	end if;
	if hora_al<'07:00:00' or hora_al>'22:00:00' then
		raise exception 'Alquiler fuera de horario';
	end if;
	id_inst := (select id_instalacion from instalaciones where nombre_instalacion like '%'||instal||'%');
	if (select id_instalacion from no_socios_alquilan where id_instalacion=id_inst and fecha=fecha_al and hora=hora_al) is not null then
		raise exception 'La instalacion ya se encuentra alquilada en este turno';
	end if;
	if (select id_persona from personas where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d))) is null then
		perform sp_alta_persona(nombre_al, apellido_al, numero, tipo_d);
		insert into no_socios values (id_pers);
		id_pers := (select id_persona from personas where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
	else
		id_pers := (select id_persona from personas where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
	end if;
	
	insert into no_socios_alquilan values(id_pers, id_inst, fecha_al, hora_al, costo_al, senia_al, pagado_al);
end;
$$
language plpgsql;
*/
-- select sp_alta_alquiler('LE', 16509233, 'Demetria' , 'Fisher', 'CANCHA DE FUTBOL 5 1', '20/07/2016', '12:00:00', 532.99, 100.00, false);
	
-----------------------------------------------------------------------------------------------------
--MODIFICACION alquiler socio
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_modificacion_alquiler(tipo_busq integer, tipo_d varchar, numero integer, instal varchar, fecha_al date, hora_al time without time zone, fecha_mod date, hora_mod time without time zone, pagado_mod boolean)
	returns void as
$$
declare
	num_soc integer; id_pers integer; id_inst smallint;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			num_soc:=numero;
			id_pers = (select id_persona from socios where numero_socio=num_soc);
		end if;
	else
		num_soc := (select id_persona from socios inner join personas using(id_persona) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if num_soc is null then
			raise exception 'El socio no existe';
		elsif (select num_soc from socios_activos where numero_socio=num_soc) is null then
			raise exception 'El socio no esta activo';
		else
			id_pers = (select id_persona from socios where numero_socio=num_soc);
		end if;
	end if;

	id_inst := (select id_instalacion from instalaciones where nombre_instalacion like '%'||instal||'%');
	
	if(select id_instalacion from socios_alquilan where numero_socio=num_soc and fecha=fecha_al and hora=hora_al and id_instalacion=id_inst) is null then
		raise exception 'No hay registros del alquiler';
	else
		if fecha_mod<current_date then
			raise exception 'La fecha no puede ser anterior a la fecha actual';
		end if;
		if hora_mod<'07:00:00' or hora_al>'22:00:00' then
			raise exception 'Alquiler fuera de horario';
		end if;
		
		if fecha_mod is not null then
			if(select id_instalacion from socios_alquilan where fecha=fecha_mod and hora=hora_al and id_instalacion=id_inst) is null then
				update socios_alquilan 
				set fecha=fecha_mod
				where fecha=fecha_al and hora=hora_al and id_instalacion=id_inst;
			else
				raise exception'El turno se encuentra ocupado';
			end if;
		end if;
		if hora_mod is not null then
			if(select id_instalacion from socios_alquilan where fecha=fecha_al and hora=hora_mod and id_instalacion=id_inst) is null then
				update socios_alquilan 
				set hora=hora_mod
				where fecha=fecha_al and hora=hora_al and id_instalacion=id_inst;
			else
				raise exception 'El turno se encuentra ocupado';
			end if;
		end if;
		if pagado_mod is not null then
			update socios_alquilan
			set pagado=pagado_mod
			where fecha=fecha_al and hora=hora_al and id_instalacion=id_inst;
		end if;
	end if;
end;
$$
	language plpgsql;
*/
--select sp_modificacion_alquiler(2, 'LC', 39567455,'PISCINA 1', '2016-07-08', '07:00:00', null, '08:00:00', false);


-----------------------------------------------------------------------------------------------------
--MODIFICACION alquiler no socio
-----------------------------------------------------------------------------------------------------
/*
create or replace function sp_modificacion_alquiler(tipo_d varchar, numero integer, instal varchar, fecha_al date, hora_al time without time zone, fecha_mod date, hora_mod time without time zone, pagado_mod boolean)
	returns void as
$$
declare
	id_pers integer; id_inst integer;
begin
	id_pers := (select id_persona from personas where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
	
	id_inst := (select id_instalacion from instalaciones where nombre_instalacion like '%'||instal||'%');
	
	if(select id_instalacion from no_socios_alquilan where id_persona=id_pers and fecha=fecha_al and hora=hora_al and id_instalacion=id_inst) is null then
		raise exception 'No hay registros del alquiler';
	else
		if fecha_mod<current_date then
			raise exception 'La fecha no puede ser anterior a la fecha actual';
		end if;
		if hora_mod<'07:00:00' or hora_al>'22:00:00' then
			raise exception 'Alquiler fuera de horario';
		end if;
		
		if fecha_mod is not null then
			if(select id_instalacion from no_socios_alquilan where fecha=fecha_mod and hora=hora_al and id_instalacion=id_inst) is null then
				update no_socios_alquilan 
				set fecha=fecha_mod
				where fecha=fecha_al and hora=hora_al and id_instalacion=id_inst;
			else
				raise exception'El turno se encuentra ocupado';
			end if;
		end if;
		if hora_mod is not null then
			if(select id_instalacion from no_socios_alquilan where fecha=fecha_al and hora=hora_mod and id_instalacion=id_inst) is null then
				update no_socios_alquilan 
				set hora=hora_mod
				where fecha=fecha_al and hora=hora_al and id_instalacion=id_inst;
			else
				raise exception 'El turno se encuentra ocupado';
			end if;
		end if;
		if pagado_mod is not null then
			update no_socios_alquilan
			set pagado=pagado_mod
			where fecha=fecha_al and hora=hora_al and id_instalacion=id_inst;
		end if;
	end if;
end;
$$
	language plpgsql;
*/
--select sp_modificacion_alquiler('LE', 16509233, 'PISCINA 2', '2016-07-20', '13:00:00', null, null, true)