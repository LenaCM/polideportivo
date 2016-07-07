--auditoria de la tabla empleados

--creo tabla auditoria
create table auditoria_empleados(id_aud_empleado SERIAL not null, fecha_aud date not null, usuario character varying(32) not null,
				operacion character varying(32) not null, id_persona integer not null,salario numeric(8,2) not null,
				antiguedad integer not null, hora_entrada time not null,hora_salida time not null,
				CONSTRAINT "PKaud_empleado" PRIMARY KEY (id_aud_empleado));
--creo indices
create index on auditoria_empleados (antiguedad);
create index on auditoria_empleados (salario);
create index on auditoria_empleados (fecha_aud);



create or replace function sp_auditoria_empleados() returns trigger as $auditoria_empleados$
begin
	if (TG_OP = 'INSERT') then
		INSERT INTO auditoria_empleados VALUES (default, now(), user, TG_OP, NEW.*);
		return NEW;
	elsif (TG_OP = 'DELETE') THEN
		INSERT INTO auditoria_empleados VALUES (default, now(), user, TG_OP, OLD.*);
		return OLD;
	else
		INSERT INTO auditoria_empleados VALUES (default, now(), user, 'ANTES', OLD.*);
		INSERT INTO auditoria_empleados VALUES (default, now(), user, 'DESPUES', NEW.*);
		return NEW;
	end if;
end;
$auditoria_empleados$
language plpgsql;


create trigger auditoria_empleados after INSERT or DELETE or UPDATE of salario, hora_entrada, hora_salida on empleados
for each row execute procedure sp_auditoria_empleados();

--drop trigger auditoria_empleados ON empleados

--Pruebas

--select sp_alta_empleado('Debora', 'Mendoza', 44123456, 'DNI',5000.99, 3, '08:00:00', '12:00:00');

-- select sp_modificar_empleado(44123456, 'DNI', null, null, null, null, 7000, 11, '09:00:00', '12:00:00');


--select sp_baja_empleado('DNI', 44123456);


--select * from auditoria_empleados;


