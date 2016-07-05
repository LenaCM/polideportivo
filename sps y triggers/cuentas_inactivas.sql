--Cuentas Inactivas

CREATE OR REPLACE FUNCTION sp_cuentas_inactivas() RETURNS TRIGGER AS $cuentas_inactivas$
DECLARE
tipo VARCHAR(16);
BEGIN
	CREATE TABLE IF NOT EXISTS cuentas_inactivas (
		numero_socio integer,
		id_persona integer,
		fechaingreso date ,
		estadocuenta character varying(10),
		CONSTRAINT "PK_cuentas_inactivas" PRIMARY KEY (numero_socio, id_persona)
	);

	IF (TG_OP='DELETE') THEN
		INSERT INTO cuentas_inactivas VALUES (OLD.numero_socio,
			OLD.id_persona,
			OLD.fechaingreso,
			OLD.estadocuenta
			);
			RETURN OLD;
	END IF;
END;
$cuentas_inactivas$ LANGUAGE plpgsql;

--creo trigger
CREATE TRIGGER sp_cuentas_inactivas AFTER DELETE 
ON socios FOR EACH ROW EXECUTE PROCEDURE public.sp_cuentas_inactivas();

--Prueba:
--select sp_alta_socio('Carolina', 'Zelaya', 22123456, 'DNI')
select sp_baja_socio(2, 'DNI', 22123456)