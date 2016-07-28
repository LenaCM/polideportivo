--ABM cuotas
-----------------------------------------------------------------------------------------------------
--ALTA cuotas
-----------------------------------------------------------------------------------------------------
-----Una sola cuota para un socio en especifico
/*
create or replace function sp_alta_cuotas(tipo_busq integer, tipo_d text, numero integer, fecha_cuo date, monto numeric, pago boolean, descu numeric)
	returns void as 
$$
declare
	id_cuo integer; familiares smallint; fecha_ultima date; num_soc integer; id_pers integer; prec_final numeric;
begin	
	if monto<=0 then
		raise exception 'Monto de la cuota invalido';
	end if;
	if descu<=0 then
		raise exception 'Monto del descuento de cuota invalido';
	end if;
	if tipo_busq=1 then
		if (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no existe o no esta activo';
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
					raise notice 'El socio no tiene los familiares necesarios para aplicar descuento';
				end if;
				prec_final:= monto - ((monto*descu)/100);
				insert into cuotas values(numero, id_cuo, fecha_cuo, monto, pago, descu, id_pers, prec_final);
			end if;
		end if;
	else
		num_soc := (select id_persona from socios_activos inner join personas using(id_persona) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if num_soc is null then
			raise exception 'El socio no existe o no esta activo';
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
					raise notice 'El socio no tiene los familiares necesarios para aplicar descuento';
				end if;
				prec_final:= monto - ((monto*descu)/100);
				insert into cuotas values(num_soc , id_cuo, fecha_cuo, monto, pago, descu, id_pers, prec_final);
			end if;
		end if;
	end if;
end;
$$
	language plpgsql;
*/

--select sp_alta_cuotas(1, null, 5, 125, false, 20)
-----cuotas para todos los socios que desde hace un mes no tienen un registro de cuota
/*
create or replace function sp_alta_cuotas(monto numeric, descu numeric)
	returns void as
$$
declare
	rec_cuotas cuotas%rowtype; id_cuo integer; familiares smallint; ultima date;prec_final numeric;
begin
	if monto<=0 then
		raise exception 'Monto de la cuota invalido';
	end if;
	if descu<=0 then
		raise exception 'Monto del descuento de cuota invalido';
	end if;
	
	for rec_cuotas in select * from cuotas
	loop
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
					raise notice 'El socio no tiene los familiares suficientes necesarios para aplicar descuento';
				end if;
				prec_final:= monto - ((monto*descu)/100);
				
			insert into cuotas values (rec_cuotas.numero_socio, id_cuo, DEFAULT, monto, default, descu, rec_cuotas.id_persona, prec_final);
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
/*
create or replace function sp_modificacion_cuotas(tipo_busq integer, tipo_d text, numero integer, fecha_c date,monto numeric, pago boolean, descu numeric)
	returns void as 
$$
declare 
	docu integer; tipo_dc text; num_soc integer; familiares smallint; prec_final numeric;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no esta activo';
		else
			num_soc := numero;
		end if;
	elsif tipo_busq=2 then
		num_soc := (select numero_socio from socios inner join personas using(id_persona) where dni=numero and id_tipo_doc=(select busca_id_documento(tipo_d)));
		if  num_soc is null then
			raise exception 'El socio no existe';
		
		elsif (select numero_socio from socios_activos where numero_socio=num_soc)is null then
			raise exception 'El socio no esta activo';		
		end if;
	end if;	
	
	if fecha_c is not null then
		
		if (select pagada from cuotas where numero_socio=num_soc and fecha=fecha_c) is true then
			raise exception 'La cuota ya ha sido pagada no puede ser modificada';
		else
			if monto is not null then
				if monto<=0 then
					raise exception 'Monto de la cuota invalido';
				end if;
			end if;
			if descu is not null then
				if descu<0 then
					raise exception 'Monto de la cuota invalido';
				end if;
				familiares := (select count(numero_socio_fam) from familiar_socio where numero_socio=num_soc);
				if familiares<3 then
					descu := 0;
					raise notice 'El socio no tiene los familiares suficientes necesarios para aplicar descuento';
				end if;
			end if;
			prec_final:= monto - ((monto*descu)/100);
			
			update cuotas
			set descuento=descu,pagada=pago, precio=monto, precio_final=prec_final
			where numero_socio=num_soc and fecha=fecha_c;
		end if;
	end if;
end;
$$
	language plpgsql;
	*/
--select sp_modificacion_cuotas(2,'LE',39574733,null, 300.00, true, null)
-----------------------------------------------------------------------------------------------------
--TRIGGER PARA BAJA AUTOMATICA DE SOCIOS DEUDORES 
-----------------------------------------------------------------------------------------------------

create or replace function sp_baja_deudores()
	returns trigger as
$tg_baja_deudores$
declare 
	debe smallint;
begin
	debe := (select count(pagada) from cuotas where numero_socio=NEW.numero_socio and pagada=false);
	
	if debe=12 and (NEW.numero_socio in (select numero_socio from socios_activos))  then
		perform sp_baja_socio(1, null, NEW.numero_socio);
		update socios 
		set estadocuenta='INACTIVO'
		where numero_socio=NEW.numero_socio;
	else
		update socios
		set estadocuenta='Adeuda '||debe||' cuotas'
		where numero_socio=NEW.numero_socio;
	end if; 
	return NEW;
end;
$tg_baja_deudores$
	language plpgsql;

--create trigger tg_baja_deudores before insert on cuotas for each row execute procedure sp_baja_deudores();

-----------------------------------------------------------------------------------------------------
--BAJA cuotas
-----------------------------------------------------------------------------------------------------
