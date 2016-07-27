-- Function: sp_control_sueldos()

-- DROP FUNCTION sp_control_sueldos();

CREATE OR REPLACE FUNCTION sp_control_sueldos()
  RETURNS trigger AS
$BODY$
declare 
	permitido numeric;
begin
	permitido := (OLD.salario * 20)/100;
	if NEW.salario > (OLD.salario + permitido) then
		NEW.salario = OLD.salario + permitido;
		raise notice 'El aumento al salario no debe superar el 20 por ciento. Se aumento hasta el limite permitido.';
	end if;
	return NEW;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_control_sueldos()
  OWNER TO postgres;
