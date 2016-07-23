create or replace function sp_deshacer_eliminacion_socio(tipo_busq integer, tipo_d text, numero integer)
	returns void as
$$
declare
	docu integer; 
	num_soc integer; 
	id_dc smallint;
	id_pers integer;
begin
	if tipo_busq=1 then
		if (select numero_socio from socios where numero_socio=numero) is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_inactivos where numero_socio=numero) is null then
			raise exception 'El socio no esta inactivo';
		else
			delete from socios_inactivos where numero_socio=numero;
		end if;
		id_pers:=(select id_persona from socios where numero_socio=numero);
		insert into socios_activos values(numero, id_pers);		
	elsif tipo_busq=2 then
	
		id_dc := (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
		num_soc := (select numero_socio from socios inner join personas using (id_persona) where dni=numero and id_tipo_doc=id_dc);
		
		if num_soc is null then
			raise exception 'El socio no existe';
		elsif (select numero_socio from socios_inactivos where numero_socio=num_soc) is null then
			raise exception 'El socio no esta inactivo';
		else
			delete from socios_inactivos where numero_socio=num_soc;
		end if;
		id_pers:= (select id_persona from socios where numero_socio=num_soc);
		insert into socios_activos values(num_soc, id_pers);
	end if;	
end;
$$
	language plpgsql;

select sp_deshacer_eliminacion_socio(2, 'PAS', 13346938)