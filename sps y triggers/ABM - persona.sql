
--MODIFICICACION PERSONA
/*
create or replace function sp_modificacion_persona(doc integer, tipo_d text, que integer, dato text)
	returns void as
$$
begin
	if dato is null then
		raise exception 'Dato inválido';
	end if;
	if que=1 then
		update personas
			set nombre=dato
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	elsif que=2 then
		update personas
			set apellido=dato
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	elsif que=3 then
		update personas
			set dni=cast(dato as int4)
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	elsif que=4 then
		update personas
			set id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||dato||'%')
		where dni=doc and id_tipo_doc=(select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo_d||'%');
	end if;
	exception
		when unique_violation then
			raise exception 'El documento ya existe';
end;
$$ 
	language plpgsql;
*/

