--auditoria de la tabla socios_alquilan

--creo tabla auditoria
create table auditoria_socios_alquilan(id_aud_socios_alquilan SERIAL not null, fecha_aud date not null, usuario character varying(32) not null,
				operacion character varying(32) not null,nombretabla character varying(32) not null, numero_socio integer not null, id_instalacion smallint not null,
				fecha date not null, hora time not null, costo numeric(6,2), id_persona integer not null, pagado boolean,
				CONSTRAINT "PKaud_socios_alquilan" PRIMARY KEY (id_aud_socios_alquilan));
--creo indices
create index on auditoria_socios_alquilan (id_instalacion);
create index on auditoria_socios_alquilan (fecha);
create index on auditoria_socios_alquilan (id_persona);
create index on auditoria_socios_alquilan (costo);


create or replace function sp_auditoria_socios_alquilan() returns trigger as $auditoria_socios_alquilan$
begin
	if (TG_OP = 'INSERT') then
		INSERT INTO auditoria_socios_alquilan VALUES (default, now(), user, TG_OP, TG_TABLE_NAME, NEW.*);
		return NEW;
	elsif (TG_OP = 'UPDATE') then
		INSERT INTO auditoria_socios_alquilan VALUES (default, now(), user, 'ANTES', TG_TABLE_NAME, OLD.*);
		INSERT INTO auditoria_socios_alquilan VALUES (default, now(), user, 'DESPUES', TG_TABLE_NAME, NEW.*);
		return NEW;
	end if;
end;
$auditoria_socios_alquilan$
language plpgsql;

--drop trigger auditoria_socios_alquilan ON socios_alquilan

create trigger auditoria_socios_alquilan after INSERT or UPDATE of costo on socios_alquilan
for each row execute procedure sp_auditoria_socios_alquilan();


--Pruebas
--select sp_alta_alquiler(1, null, 2, 'CANCHA DE FUTBOL 11', '2016-07-07', '12:00:00', 234.45,false)


--select * from auditoria_socios_alquilan;

--------------------------------------------------------------------------------------------------------------------


--auditoria de la tabla no_socios_alquilan

--creo tabla auditoria
create table auditoria_no_socios_alquilan(id_aud_no_socios_alquilan SERIAL not null, fecha_aud date not null, usuario character varying(32) not null,
				operacion character varying(32) not null,nombretabla character varying(32) not null, id_persona integer not null,
				id_instalacion smallint NOT NULL, fecha date NOT NULL, hora time NOT NULL, costo numeric(6,2), senia numeric(6,2) NOT NULL,
				pagado boolean,
				CONSTRAINT "PKaud_no_socios_alquilan" PRIMARY KEY (id_aud_no_socios_alquilan));
--creo indices
create index on auditoria_no_socios_alquilan (id_instalacion);
create index on auditoria_no_socios_alquilan (fecha);
create index on auditoria_no_socios_alquilan (id_persona);



create or replace function sp_auditoria_no_socios_alquilan() returns trigger as $auditoria_no_socios_alquilan$
begin
	if (TG_OP = 'INSERT') then
		INSERT INTO auditoria_no_socios_alquilan VALUES (default, now(), user, TG_OP, TG_TABLE_NAME, NEW.*);
		return NEW;
	elsif (TG_OP = 'UPDATE') then
		INSERT INTO auditoria_no_socios_alquilan VALUES (default, now(), user, 'ANTES', TG_TABLE_NAME, OLD.*);
		INSERT INTO auditoria_no_socios_alquilan VALUES (default, now(), user, 'DESPUES', TG_TABLE_NAME, NEW.*);
		return NEW;
	end if;
end;
$auditoria_no_socios_alquilan$
language plpgsql;

--drop trigger auditoria_socios_alquilan ON socios_alquilan

create trigger auditoria_no_socios_alquilan after INSERT or UPDATE of costo, senia on no_socios_alquilan
for each row execute procedure sp_auditoria_no_socios_alquilan();



--Pruebas
-- select sp_alta_alquiler('LE', 16509233, 'Demetria' , 'Fisher', 'CANCHA DE FUTBOL 11', '20/07/2016', '12:00:00', 532.99, 100.00, false);

--select sp_modificacion_alquiler('LE', 16509233, 'CANCHA DE FUTBOL 11', '2016-07-25', '12:00:00', null, null, true)

--select * from auditoria_no_socios_alquilan;