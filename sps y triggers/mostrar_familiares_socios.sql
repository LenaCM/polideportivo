select psocios.id_persona as id_persona_socio, socio.numero_socio, psocios.nombre as nombre_socio, psocios.apellido as apellido_socio, fsocios.id_persona as id_persona_familiar, socio.numero_socio_fam as numero_socio_familiar ,  fsocios.nombre as nombre_socio_familiar ,fsocios.apellido as apellido_socio_familiar
from 
personas psocios inner join familiar_socio socio on psocios.id_persona=socio.id_persona
inner join personas fsocios on fsocios.id_persona=socio.id_persona_fam
where socio.numero_socio=20

--con busqueda de un socio en especifico
create or replace function sp_mostrar_familiares(tipo_busq integer, dato text)
	returns setof lista_familiares_socios as
$$
declare
	rec lista_familiares_socios%rowtype;
begin
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if(tipo_busq=1) then
		if (select numero_socio from socios_activos where numero_socio=numero) is null then
			raise exception 'El socio no existe o no está activo';
		else
			if (select numero_socio from familiar_socio where numero_socio=numero)is null then
				raise exception 'El socio no tiene familiares que sean socios';
			else
				for rec in select 
					psocios.id_persona, 
					socio.numero_socio, 
					psocios.nombre, 
					psocios.apellido, 
					fsocios.id_persona, 
					socio.numero_socio_fam,  
					fsocios.nombre,
					fsocios.apellido
					from 
						personas psocios inner join familiar_socio socio on psocios.id_persona=socio.id_persona
								inner join personas fsocios on fsocios.id_persona=socio.id_persona_fam
					where socio.numero_socio=cast(dato as integer)
					order by socio.fecha_adicion desc
				loop
					return next rec;
				end loop;
			end if;
		end if;
	elsif (tipo_busq=2) then
		for rec in select 
			psocios.id_persona, 
			socio.numero_socio, 
			psocios.nombre, 
			psocios.apellido, 
			fsocios.id_persona, 
			socio.numero_socio_fam,  
			fsocios.nombre,
			fsocios.apellido
			from 
				personas psocios inner join familiar_socio socio on psocios.id_persona=socio.id_persona
						inner join personas fsocios on fsocios.id_persona=socio.id_persona_fam
			where psocios.apellido like '%'||dato||'%'
			order by socio.fecha_adicion desc
		loop
			return next rec;
		end loop;
	end if;
end;
$$
	language plpgsql;
--todos los familiares
create or replace function sp_mostrar_familiares()
	returns setof lista_familiares_socios as
$$
declare
	rec lista_familiares_socios%rowtype;
begin
	for rec in select 
		psocios.id_persona, 
		socio.numero_socio, 
		psocios.nombre, 
		psocios.apellido, 
		fsocios.id_persona, 
		socio.numero_socio_fam,  
		fsocios.nombre,
		fsocios.apellido
		from 
			personas psocios inner join familiar_socio socio on psocios.id_persona=socio.id_persona
					inner join personas fsocios on fsocios.id_persona=socio.id_persona_fam
		order by socio.fecha_adicion desc
	loop
		return next rec;
	end loop;
end;
$$
	language plpgsql;

select * from sp_mostrar_familiares(2,'')