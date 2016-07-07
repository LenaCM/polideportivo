--Trigger para contolar el sueldo
create or replace function sp_control_sueldos()
	returns trigger as
$tg_controla_sueldo$
declare 
	permitido numeric;
begin
	permitido := (OLD.salario * 20)/100;
	if NEW.salario > (OLD.salario + permitido) then
		NEW.salario = OLD.salario + permitido;
	end if;
	return NEW;
end;
$tg_controla_sueldo$
	language plpgsql;

create trigger tg_controla_sueldo before update of salario ON empleados for each row when
(NEW.salario>OLD.salario) execute procedure sp_control_sueldos()