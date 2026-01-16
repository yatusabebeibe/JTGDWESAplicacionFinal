-- Borrado
DROP TABLE IF EXISTS T01_Usuario;
DROP TABLE IF EXISTS T02_Departamento;

-- Creacion
CREATE TABLE IF NOT EXISTS T01_Usuario(
    T01_CodUsuario VARCHAR(10) NOT NULL PRIMARY KEY,
    T01_Password VARCHAR(64) NOT NULL, /* 64 caracteres porque guardamos el hash */
    T01_DescUsuario VARCHAR(255) NOT NULL,
    T01_NumConexiones INT NOT NULL DEFAULT(0),
    T01_FechaHoraUltimaConexion DATETIME DEFAULT(NULL),
    T01_Perfil VARCHAR(25) DEFAULT('usuario'), /* Seria mas bien el rol del usuario */
    T01_ImagenUsuario MEDIUMBLOB DEFAULT(NULL)
);

CREATE Table IF NOT EXISTS T02_Departamento(
    T02_CodDepartamento VARCHAR(3) NOT NULL PRIMARY KEY,
    T02_DescDepartamento VARCHAR(255) NOT NULL,
    T02_FechaCreacionDepartamento DATETIME NOT NULL,
    T02_VolumenDeNegocio FLOAT NOT NULL,
    T02_FechaBajaDepartamento DATETIME
);

-- Carga inicial
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

INSERT INTO T02_Departamento (T02_CodDepartamento,T02_DescDepartamento,T02_FechaCreacionDepartamento,T02_VolumenDeNegocio,T02_FechaBajaDepartamento)
VALUES
    ('TES','Desc test', NOW() - INTERVAL 3 MONTH, 1235.5, NOW() - INTERVAL 43 DAY),
    ('INF','Dept Informatica', NOW() - INTERVAL 2 WEEK, 1235.5 ,NULL),
    ('MUS','Dept Musica', NOW(), 1235.5, NULL)
;