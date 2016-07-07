--ABM familiares socios
-----------------------------------------------------------------------------------------------------
--ALTA familiar socio
-----------------------------------------------------------------------------------------------------
create or replace function sp_alta_familiar_socio(tipo_busq1 integer, tipo_d1 text, numero1 integer, tipo_busq2 integer, tipo_d2 text, numero2 integer)
	returns void as
$$
declare
	num_soc1 integer; id_pers1 integer;
	num_soc2 integer; id_pers2 integer;
begin
	if tipo_busq1=1 then
		if (select numero_socio from socios where numero_socio=numero1) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=numero1) is null then
			raise exception 'El socio no esta activo';
		else
			id_pers1 := (select id_persona from socios where numero_socio=numero1);
			
			if tipo_busq2=1 then
				if (select numero_socio from socios where numero_socio=numero2) is null then
					raise exception 'El socio no existe';
				elsif (select numero_socio from socios_activos where numero_socio=numero2) is null then
					raise exception 'El socio no esta activo';
				else
					id_pers2 := (select id_persona from socios where numero_socio=numero2);
				
					insert into familiar_socio values(numero1, numero2, id_pers1, id_pers2);
					insert into familiar_socio values(numero2, numero1, id_pers2, id_pers1);

				end if;
			else
				num_soc2 := (select numero_socio from socios inner join personas using(id_persona)where dni=numero2 and id_tipo_doc=(select busca_id_documento(tipo_d2)));
				if (select numero_socio from socios where numero_socio=num_soc2) is null then
					raise exception 'El socio no existe';
				elsif (select numero_socio from socios_activos where numero_socio=num_soc2) is null then
					raise exception 'El socio no esta activo';
				else	
					id_pers2 := (select id_persona from socios where numero_socio=num_soc2);
					insert into familiar_socio values(numero1, num_soc2, id_pers1, id_pers2);
					insert into familiar_socio values(num_soc2, numero1, id_pers2, id_pers1);
				end if;
			end if;
		end if;
	else
		num_soc1 := (select numero_socio from socios inner join personas using(id_persona)where dni=numero1 and id_tipo_doc=(select busca_id_documento(tipo_d1)));
		if (select numero_socio from socios where numero_socio=num_soc1) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_activos where numero_socio=num_soc1) is null then
			raise exception 'El socio no esta activo';
		else
			id_pers1 := (select id_persona from socios where numero_socio=num_soc1);
			
			if tipo_busq2=1 then
				if (select numero_socio from socios where numero_socio=numero2) is null then
					raise exception 'El socio no existe';
				elsif (select numero_socio from socios_activos where numero_socio=numero2) is null then
					raise exception 'El socio no esta activo';
				else
					id_pers2 := (select id_persona from socios where numero_socio=numero2);
				
					insert into familiar_socio values(num_soc1, numero2, id_pers1, id_pers2);
					insert into familiar_socio values(numero2, num_soc1, id_pers2, id_pers1);

				end if;
			else
				num_soc2 := (select numero_socio from socios inner join personas using(id_persona)where dni=numero2 and id_tipo_doc=(select busca_id_documento(tipo_d2)));
				if (select numero_socio from socios where numero_socio=num_soc2) is null then
					raise exception 'El socio no existe';
				elsif (select numero_socio from socios_activos where numero_socio=num_soc2) is null then
					raise exception 'El socio no esta activo';
				else	
					id_pers2 := (select id_persona from socios where numero_socio=num_soc2);
					insert into familiar_socio values(num_soc1, num_soc2, id_pers1, id_pers2);
					insert into familiar_socio values(num_soc2, num_soc1, id_pers2, id_pers1);
				end if;
			end if;
		end if;
		
	end if;
	exception
		when unique_violation then
			raise exception 'La relacion de familiaridad ya se establecio';
		
end;
$$
	language plpgsql;

--select sp_alta_familiar_socio(2,'LC',39567455,1,null,3)