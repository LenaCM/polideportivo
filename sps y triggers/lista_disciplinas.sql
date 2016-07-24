create or replace function sp_lista_disciplinas()
	returns setof disciplinas as 
$$
declare
	rec disciplinas%rowtype;
begin
	for rec in select * from disciplinas
	loop
		return next rec;
	end loop;
end;
$$
	language plpgsql;

select * from sp_lista_disciplinas()