create or replace busca_id_documento(tipo varchar)
	returns integer as
$$
declare 
	id_doc smallint;
begin
	id_doc := (select id_tipo_doc from tipos_doc where tipo_doc like '%'||tipo||'%');
	return id_doc;
end;
$$
	language plpgsql;