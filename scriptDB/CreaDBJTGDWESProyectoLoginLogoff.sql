CREATE DATABASE IF NOT EXISTS DBJTGDWESProyectoLoginLogoff;

USE DBJTGDWESProyectoLoginLogoff;

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

CREATE USER IF NOT EXISTS 'userJTGDWESProyectoLoginLogoff'@'%' IDENTIFIED BY 'paso';
GRANT ALL PRIVILEGES ON DBJTGDWESProyectoLoginLogoff.* TO 'userJTGDWESProyectoLoginLogoff'@'%';
FLUSH PRIVILEGES;