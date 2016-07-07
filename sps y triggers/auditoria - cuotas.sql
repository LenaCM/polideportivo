--auditoria de la tabla cuotas

--creo tabla auditoria
create table auditoria_cuotas(id_auditoria_cuotas SERIAL not null, fecha_aud date not null, usuario character varying(32) not null,
				operacion character varying(32) not null, numero_socio integer not null,   id_cuota integer not null,
				fecha date, precio numeric(6,2) not null, pagada boolean, descuento numeric(8,2), id_persona integer not null,
				CONSTRAINT "PK_auditoria_cuotas" PRIMARY KEY (id_auditoria_cuotas));
--creo indices
create index on auditoria_cuotas(fecha);
create index on auditoria_cuotas(precio);
create index on auditoria_cuotas(numero_socio);
create index on auditoria_cuotas(id_persona);
create index on auditoria_cuotas(fecha_aud);



create or replace function sp_auditoria_cuotas() returns trigger as $auditoria_cuotas$
begin
	if (TG_OP = 'INSERT') then
		INSERT INTO auditoria_cuotas VALUES (default, now(), user, TG_OP, NEW.*);
		return NEW;
	elsif (TG_OP = 'DELETE') THEN
		INSERT INTO auditoria_cuotas VALUES (default, now(), user, TG_OP, OLD.*);
		return OLD;
	elsif (TG_OP = 'UPDATE') THEN
		INSERT INTO auditoria_cuotas VALUES (default, now(), user, 'ANTES', OLD.*);
		INSERT INTO auditoria_cuotas VALUES (default, now(), user, 'DESPUES', NEW.*);
		return NEW;
	end if;
end;
$auditoria_cuotas$
language plpgsql;


create trigger auditoria_cuotas after INSERT or DELETE or UPDATE of pagada, precio, fecha on cuotas
for each row execute procedure sp_auditoria_cuotas();


--Pruebas 

--select sp_alta_cuotas(1, null, 6, 200, true, 20)
--select sp_alta_cuotas(250, 20);


--select * from auditoria_cuotas;


