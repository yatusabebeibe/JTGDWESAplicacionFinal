USE DBJTGDWESProyectoLoginLogoff;

INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario, T01_Perfil)
VALUES
    ('admin', SHA2('adminpaso', 256), 'Administrador', 'administrador')
;
INSERT INTO T01_Usuario (T01_CodUsuario, T01_Password, T01_DescUsuario)
VALUES
    ('gonzalo',SHA2('gonzalopaso',256),'Gonzalo Junquera Lorenzo'),
    ('enrique',SHA2('enriquepaso',256),'Enrique Nieto Lorenzo'),
    ('alvaroG',SHA2('alvarogpaso',256),'Alvaro Gonzalez'),
    ('jimmy',SHA2('jimmypaso',256),'Jimmy Nuñez Cuzcano'),
    ('oscar',SHA2('oscarpaso',256),'Oscar Pozuelo'),
    ('alejandro',SHA2('alejandropaso',256),'Alejandro De La Huerga'),
    ('alvaroA',SHA2('alvaroapaso',256),'Alvaro Allén Perlines'),
    ('vero',SHA2('veropaso',256),'Veronique Grue'),
    ('alberto',SHA2('albertopaso',256),'Alberto Mendez Nuñez'),
    ('jesus',SHA2('jesuspaso',256),'Jesus Temprano Gallego'),
    ('cristian',SHA2('cristianpaso',256),'Cristian Mateos Vega'),
    ('heraclio',SHA2('heracliopaso',256),'Heraclio Borbujo Moran'),
    ('amor',SHA2('amorpaso',256),'Amor Rodriguez Navarro'),
    ('albertoB',SHA2('albertobpaso',256),'Alberto Bahillo Fernandez'),
    ('antonio',SHA2('antoniopaso',256),'Antonio')
;

insert into T02_Departamento (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio,T02_FechaBajaDepartamento)
values
    ('TES','Desc test', NOW() - INTERVAL 3 MONTH, 1235.5, NOW() - INTERVAL 43 DAY),
    ('INF','Dept Informatica', NOW() - INTERVAL 2 WEEK, 1235.5 ,NULL),
    ('MUS','Dept Musica', NOW(), 1235.5, NULL)
;