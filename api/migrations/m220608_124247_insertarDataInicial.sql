DO $$
BEGIN

INSERT INTO tipo_documento VALUES (1, 'DNI','DNI');
INSERT INTO tipo_documento VALUES (2, 'CUIL', 'CUIL');
INSERT INTO tipo_documento VALUES (3, 'CUIT', 'CUIT');


INSERT INTO tipo_sexo VALUES (1, 'MASCULINO','M');
INSERT INTO tipo_sexo VALUES (2, 'FEMENINO','F');

INSERT INTO tipo_responsable VALUES (1, 'Padre');
INSERT INTO tipo_responsable VALUES (2, 'Madre');
INSERT INTO tipo_responsable VALUES (3, 'Tio/a');
INSERT INTO tipo_responsable VALUES (4, 'Abuelo/a');


END
$$;