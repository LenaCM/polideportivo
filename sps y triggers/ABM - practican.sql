--ABM practican:

--Alta

CREATE OR REPLACE FUNCTION sp_alta_practican(numerosocio integer, disciplina  integer)
RETURNS void AS
$$
declare
	idpersona integer; 
begin
	idpersona:= (select id_persona from socios where numero_socio=numerosocio);
	if (select numero_socio from socios where numero_socio=numerosocio) is null then
		raise exception 'El socio no existe';
	elsif (select id_disciplina from practican where numero_socio=numerosocio and id_disciplina=disciplina)is null then
		INSERT INTO practican(numero_socio, id_disciplina, id_persona)
			VALUES (numerosocio, disciplina, idpersona);
	else
		raise exception 'El socio ya practica esta disciplina';
	end if;
end;
$$ LANGUAGE plpgsql VOLATILE
 COST 100;

--prueba
--select sp_alta_practican(3, 2);



-----------------------------------------------------------------------------------------------------------------

--modificar

CREATE OR REPLACE FUNCTION sp_modificacion_practican(doc integer, tipodoc text, que integer, dato integer)
  RETURNS void AS $$
declare
	idpersona integer; id_doc smallint; 
begin
	--controles
	if dato < 0 then
		raise exception 'Dato inválido';
	end if;
	if tipodoc='' then
		raise exception 'El campo tipo no puede estar vacio';
	end if;
	if doc<1000000 then
		raise exception 'El documento ingresado es invalido';
	end if;

	id_doc := (select id_tipo_doc from tipos_doc where tipo_doc like '%'|| tipodoc ||'%');
	idpersona:=(select id_persona from personas where dni=doc and id_tipo_doc=id_doc);
	
	if exists(select * from practican where id_persona=idpersona) then
		if que=1 then
			update practican
				set numero_socio=dato
			where id_persona=idpersona;
		elsif que=2 then
			if(select id_disciplina from practican where id_persona=idpersona and  id_disciplina=cast(dato as smallint)) is null then
				update practican
				set id_disciplina=cast(dato as smallint)
				where id_persona=idpersona;
			else
				raise exception 'El socio ya practica esta disciplina';
			end if;
		end if;
	else 
		raise exception 'El socio que solicita no practica ninguna disciplina';
	end if;
end;
$$ LANGUAGE plpgsql VOLATILE
  COST 100;


--select sp_modificacion_practican(39574733, 'LC ', 2, 1);

-----------------------------------------------------------------------------------------------------------------
--Baja
CREATE OR REPLACE FUNCTION sp_baja_practican(numerosocio integer, disciplina  integer)
  RETURNS void AS $$
declare
	idpersona integer;
begin
	--controles
	if disciplina< 0 then
		raise exception 'Dato inválido';
	end if;
	if numerosocio<0 then
		raise exception 'El documento ingresado es invalido';
	end if;

	idpersona:= (select id_persona from socios where numero_socio=numerosocio);
	if (select numero_socio from practican where numero_socio=numerosocio and id_disciplina=disciplina) is null then
		raise exception 'El socio no practica la disciplina seleccionada o no existe';
	else
		DELETE FROM practican
			WHERE numero_socio=numerosocio and id_disciplina=disciplina;
	end if;
end;
$$ LANGUAGE plpgsql VOLATILE
  COST 100;

  
--prueba:
--select sp_baja_practican(3, 1);
