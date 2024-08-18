CREATE DATABASE IF NOT EXISTS dbase_elprogreso CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE dbase_elprogreso;

--Agregado
CREATE TABLE IF NOT EXISTS usuario (
    uuid INT AUTO_INCREMENT PRIMARY KEY, 
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    estado TINYINT NOT NULL DEFAULT 0,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS pedido (
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT, 
    estado TINYINT,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    modificado TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT id_cliente
        FOREIGN KEY (id_cliente) REFERENCES usuario(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS historica (
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_cliente INT, 
    estado TINYINT,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fK_pedido_historica
        FOREIGN KEY(id_pedido) REFERENCES pedido(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    CONSTRAINT fk_cliente_historica
        FOREIGN KEY(id_cliente) REFERENCES usuario(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS carrito (
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    id_pedido INT,
    id_producto INT,
    id_cliente INT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_cliente_carrito
        FOREIGN KEY (id_cliente) REFERENCES usuario(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    CONSTRAINT fk_pedido_carrito
        FOREIGN KEY (id_pedido) REFERENCES pedido(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    CONSTRAINT fk_producto_carrito
        FOREIGN KEY (id_producto) REFERENCES producto(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS venta (
    id_cliente INT,
    id_historica INT,
    direccion_entrega INT,
    datos_facturacion INT,
    precio_total DECIMAL(10, 2),
    fecha_venta TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_datos_facturacion
        FOREIGN KEY (datos_facturacion) REFERENCES datos_facturacion(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    CONSTRAINT fk_cliente_venta
        FOREIGN KEY (id_cliente) REFERENCES usuario(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT,
    CONSTRAINT fk_historica_venta
        FOREIGN KEY (id_historica) REFERENCES historica(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

CREATE TABLE IF NOT EXISTS datos_facturacion (
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT,
    direccion_fiscal VARCHAR(200),
    razon_social VARCHAR(50),
    cuil VARCHAR(14),
    iva VARCHAR(20),
    CONSTRAINT fk_id_cliente_datos_facturacion
        FOREIGN KEY (id_cliente) REFERENCES usuario(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);

--Agregado
CREATE TABLE proveedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    contacto VARCHAR(100),
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--Agregado
CREATE TABLE marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    pais_origen VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
--Agregado
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

--Agregado
CREATE TABLE IF NOT EXISTS producto (
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    id_categoria INT,
    id_marca INT,
    id_proveedor INT,
    codigo_barras VARCHAR(20) UNIQUE NOT NULL,
    descripcion TEXT,
    precio_venta DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    modelo VARCHAR(50),
    talle VARCHAR(10) NOT NULL,
    color VARCHAR(20) NOT NULL,
    peso DECIMAL(5,2),
    alto DECIMAL(10, 2),
    largo DECIMAL(10, 2),
    ancho DECIMAL(10, 2),
    volumen DECIMAL(10, 2) AS (alto * largo * ancho) VIRTUAL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_categoria
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
    CONSTRAINT fk_marca
    FOREIGN KEY (id_marca) REFERENCES marcas(id)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT,
    CONSTRAINT fk_proveedor
    FOREIGN KEY (id_proveedor) REFERENCES proveedores(id)
    ON UPDATE RESTRICT
    ON DELETE RESTRICT
);

--agregado
CREATE TABLE imagenes_producto (
    id_producto INT,
    url_imagen VARCHAR(255) DEFAULT NULL,
    es_principal BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_producto
        FOREIGN KEY (id_producto) REFERENCES producto(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
);


CREATE TABLE registro_conexiones(
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    ip VARCHAR(11)
)

CREATE TABLE blacklist(
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    id_ip INT,
    CONSTRAINT fk_ip
        FOREIGN KEY (ip) REFERENCES registro_conexiones(uuid)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
)

CREATE TABLE lote(
    uuid INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT,
    id_proveedor INT,
    cantidad INT,
    fecha_ingreso TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificado TIMESTAMP UPDATE CURRENT_TIMESTAMP
    CONSTRAINT fk_producto_lote
        FOREIGN KEY (id_producto)
        ON UPDATE RESTRICT
        ON DELETE RESTRICT
)

CREATE TABLE ajuste(
    id_producto INT,
    id_cliente INT,
    razon INT,
    cantidad INT,
    id_admin INT

    CONSTRAINT 
        FOREIGN KEY ()
)