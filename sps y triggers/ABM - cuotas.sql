--ABM cuotas
-----------------------------------------------------------------------------------------------------
--ALTA cuotas
-----------------------------------------------------------------------------------------------------
-----Una sola cuota para un socio en especifico
/*
create or replace function sp_alta_cuotas(tipo_busq integer, tipo_d text, numero integer, monto numeric, pago boolean, descu numeric)
	returns void as 
$$
declare
	id_cuo integer; familiares smallint; fecha_ultima date; num_soc integer; id_pers integer;
begin	
	if monto<=0 then
		raise exception 'Monto de la cuota invalido';
	end if;
	if descu<=0 then
		raise exception 'Monto del descuento de cuota invalido';
	end if;
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elseif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			fecha_ultima := (select fecha from cuotas where numero_socio=numero order by fecha desc limit 1);
			if (extract(month from age(current_date ,fecha_ultima)))=0 then
				raise exception 'Ya existe el registro de cuota para este mes';
			else
				--determinar id_cuota
				if (select max(id_cuota) from cuotas) is null then
					id_cuo:=1;
				else
					id_cuo:= (select max(id_cuota) from cuotas) + 1;
				end if;
				--------------------------------------------------------
				id_pers := (select id_persona from socios where numero_socio=numero);
				---------------------------------------------------------
				familiares := (select count(numero_socio_fam) from familiar_socio where numero_socio=numero);
				if familiares<3 then
					descu := 0;
				end if;
				
				insert into cuotas values(numero, id_cuo, default, monto, pago, descu, id_pers);
			end if;
		end if;
	else
		num_soc := (select id_persona from socios inner join personas using(id_persona) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if num_soc is null then
			raise exception 'El socio no existe';
		elseif (select num_soc from socios_activos where numero_socio=num_soc) is null then
			raise exception 'El socio no esta activo';
		else
			fecha_ultima := (select fecha from cuotas where numero_socio=numero order by fecha desc limit 1);
			if (extract(month from age(current_date ,fecha_ultima)))=0 then
				raise exception 'Ya existe el registro de cuota para este mes';
			else
				
				--determinar id_cuota
				if (select max(id_cuota) from cuotas) is null then
					id_cuo:=1;
				else
					id_cuo:= (select max(id_cuota) from cuotas) + 1;
				end if;
				--------------------------------------------------------
				id_pers := (select id_persona from socios where numero_socio=num_soc);
				---------------------------------------------------------
				familiares := (select count(numero_socio_fam) from familiar_socio where numero_socio=numero);
				if familiares<3 then
					descu := 0;
				end if;
				
				insert into cuotas values(num_soc , id_cuo, default, monto, pago, descu, id_pers);
			end if;
		end if;
	end if;
end;
$$
	language plpgsql;
*/

--select sp_alta_cuotas(1, null, 5, 125, true, 20)
-----cuotas para todos los socios que desde hace un mes no tienen un registro de cuota
/*
create or replace function sp_alta_cuotas(monto numeric, descu numeric)
	returns void as
$$
declare
	rec_cuotas cuotas%rowtype; id_cuo integer; familiares smallint; ultima date;
begin
	if monto<=0 then
		raise exception 'Monto de la cuota invalido';
	end if;
	if descu<=0 then
		raise exception 'Monto del descuento de cuota invalido';
	end if;
	
	for rec_cuotas in select * from cuotas
	loop
	        raise notice '%,%', rec_cuotas.numero_socio, rec_cuotas.id_persona;
	        ultima := (select fecha from cuotas where numero_socio=rec_cuotas.numero_socio order by fecha desc limit 1);
		if (extract(month from age(current_date ,ultima)))>0 then
			--determinar id_cuota
			if (select max(id_cuota) from cuotas) is null then
				id_cuo:=1;
			else
				id_cuo:= (select max(id_cuota) from cuotas) + 1;
			end if;
			
			familiares := (select count(numero_socio_fam) from familiar_socio where numero_socio=rec_cuotas.numero_socio);
				if familiares<3 then
					descu := 0;
				end if;
				
			insert into cuotas values (rec_cuotas.numero_socio, id_cuo, DEFAULT, monto, default, descu, rec_cuotas.id_persona);
		end if;
	end loop;
end;
$$
	language plpgsql;
*/
--select sp_alta_cuotas(200, 20)
-----------------------------------------------------------------------------------------------------
--MODIFICACION cuotas
-----------------------------------------------------------------------------------------------------
-----------------------------------------------------------------------------------------------------
--BAJA cuotas
-----------------------------------------------------------------------------------------------------