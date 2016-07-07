--ABM comision directiva
------------------------------------------------------------------
--ALTA comision directiva
------------------------------------------------------------------
/*
create or replace function alta_comision_directiva(tipo_busq integer, tipo_d varchar, numero integer, puesto_co varchar)
	returns void as
$$
declare
	id_pers integer; num_soc integer;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elseif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := numero;
			id_pers := (select id_persona from socios where numero_socio=num_soc);
		end if;
	elsif tipo_busq=2 then
		id_pers := (select personas.id_persona from personas inner join socios using (id_persona) inner join socios_activos using(numero_socio) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if id_pers is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := (select numero_socio from socios where id_persona = id_pers);
		end if;
	end if;	
	if puesto_co is null or puesto_co='' then
		raise exception 'Puesto inválido';
	end if;
	insert into comision_directiva values(num_soc, puesto_co, id_pers);
	exception
		when unique_violation then
			raise exception 'El puesto ya esta ocupado';
end;
$$
	language plpgsql;
*/
--select alta_comision_directiva(2, 'LE', 43759710, 'Vice-Director');
------------------------------------------------------------------
--MODIFICACION comision directiva
------------------------------------------------------------------
/*
create or replace function sp_modificacion_comision_directiva(tipo_busq integer, tipo_d varchar, numero integer, puesto_co_mod varchar)
	returns void as
$$
declare
	id_pers integer; num_soc integer;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elseif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := numero;
			id_pers := (select id_persona from socios where numero_socio=num_soc);
		end if;
	elsif tipo_busq=2 then
		id_pers := (select personas.id_persona from personas inner join socios using (id_persona) inner join socios_activos using(numero_socio) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if id_pers is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := (select numero_socio from socios where id_persona = id_pers);
		end if;
	end if;	
	if (select numero_socio from comision_directiva where numero_socio=num_soc)is null then
		raise exception 'El socio no forma parte de la comision directiva';
	end if;
	if puesto_co_mod is null or puesto_co_mod='' then
		raise exception 'Puesto inválido';
	end if;
	update comision_directiva
	set puesto=puesto_co_mod
	where numero_socio=num_soc and id_persona=id_pers;
	exception
		when unique_violation then
			raise exception 'El puesto ya esta ocupado';
end;
$$
	language plpgsql;
*/
--select sp_modificacion_comision_directiva(2, 'LE', 43759710, 'Secretario 1');
------------------------------------------------------------------
--BAJA comision directiva
------------------------------------------------------------------
create or replace function sp_baja_comision_directiva(tipo_busq integer, tipo_d varchar, numero integer)
	returns void as
$$
declare
	id_pers integer; num_soc integer;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elseif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := numero;
			id_pers := (select id_persona from socios where numero_socio=num_soc);
		end if;
	elsif tipo_busq=2 then
		id_pers := (select personas.id_persona from personas inner join socios using (id_persona) inner join socios_activos using(numero_socio) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if id_pers is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := (select numero_socio from socios where id_persona = id_pers);
		end if;
	end if;	
	if (select numero_socio from comision_directiva where numero_socio=num_soc)is null then
		raise exception 'El socio no forma parte de la comision directiva';
	end if;
	delete from comision_directiva where numero_socio=num_soc;
end;
$$
	language plpgsql;

--select sp_baja_comision_directiva(2, 'LE', 43759710)