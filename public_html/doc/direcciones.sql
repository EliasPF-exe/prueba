CREATE TABLE IF NOT EXISTS direccion(
    uuuid INT AUTO_INCREMENT,
    pais TINYINT,
    provincia fk,
    localidad fk, 
    calle fk,
    numero fk,
    municipio fk,
    cp fk,
    barrio,
    mazasec,
    dto,
    piso,
    link_gm,
    tipo TINYINT 
)

--Agregado
 CREATE TABLE IF NOT EXISTS paises(
    id INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(50) NOT NULL,
    codigo INT NOT NULL
);

--Agregado
CREATE TABLE IF NOT EXISTS municipios (
  categoria VARCHAR(20),
  centroide_lat DOUBLE,
  centroide_lon DOUBLE,
  fuente VARCHAR(5),
  id INT primary key,
  nombre VARCHAR(150),
  nombre_completo VARCHAR(150),
  provincia_id INT,
  provincia_interseccion DOUBLE,
  provincia_nombre VARCHAR(150)
);

--Agregado
CREATE TABLE IF NOT EXISTS departamentos (
  categoria VARCHAR(20),
  centroide_lat DOUBLE,
  centroide_lon DOUBLE,
  fuente VARCHAR(5),
  id INT PRIMARY KEY,
  nombre VARCHAR(150),
  nombre_completo VARCHAR(150),
  provincia_id INT,
  provincia_interseccion DOUBLE,
  provincia_nombre VARCHAR(150)
);

LOAD DATA INFILE '/tmp/departamentos_.csv' 
INTO TABLE departamentos
FIELDS TERMINATED BY ';' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(categoria, centroide_lat, centroide_lon, fuente, id, nombre, nombre_completo, provincia_id, provincia_interseccion, provincia_nombre);

--Agregado
CREATE TABLE calles (
  altura_fin_derecha INT,
  altura_fin_izquierda INT,
  altura_inicio_derecha INT,
  altura_inicio_izquierda INT,
  categoria VARCHAR(50),
  departamento_id INT,
  departamento_nombre VARCHAR(50),
  fuente VARCHAR(50),
  id INT PRIMARY KEY,
  localidad_censal_id VARCHAR(20),
  localidad_censal_nombre VARCHAR(50),
  nombre VARCHAR(50),
  provincia_id INT,
  provincia_nombre VARCHAR(50)
);

LOAD DATA INFILE '/tmp/calles_.csv' 
INTO TABLE calles
FIELDS TERMINATED BY ';' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(altura_fin_derecha, altura_fin_izquierda, altura_inicio_derecha, altura_inicio_izquierda, categoria, departamento_id, departamento_nombre, fuente, id, localidad_censal_id, localidad_censal_nombre, nombre, provincia_id, provincia_nombre);

CREATE TABLE cp (
    CP INT,
    Provincia VARCHAR(50),
    Localidad VARCHAR(50)
);

LOAD DATA INFILE '/tmp/Codigos-Postales-Argentina_.csv'
INTO TABLE cp
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(CP, Provincia, Localidad);

CREATE TABLE localidades (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre TEXT
);

CREATE TABLE IF NOT EXISTS provincias (
    categoria VARCHAR(50),
    centroide_lat FLOAT,
    centroide_lon FLOAT,
    fuente VARCHAR(50),
    id INT PRIMARY KEY,
    iso_id VARCHAR(5),
    iso_nombre VARCHAR(50),
    nombre VARCHAR(200),
    nombre_completo VARCHAR(200)
);

LOAD DATA INFILE '/tmp/provincias_.csv'
INTO TABLE provincias
FIELDS TERMINATED BY ';'
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(categoria, centroide_lat, centroide_lon, fuente, id, iso_id, iso_nombre, nombre, nombre_completo);