CREATE DATABASE tienda;
USE tienda;

CREATE TABLE usuarios(
    id int auto_increment not null,
    nombre varchar(255) not null,
    apellidos varchar(255),
    email varchar(255) not null,
    password varchar(255) not null,
    rol varchar(255),
    imagen varchar(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id),
    CONSTRAINT uq_email UNIQUE(email)
)ENGINE=InnoDB;

INSERT INTO usuarios(nombre, apellidos, email, password, rol, imagen) VALUES
('Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', null);  

CREATE TABLE categorias(
    id int auto_increment not null,
    nombre varchar(255) not null,
    CONSTRAINT pk_categorias PRIMARY KEY(id)
)ENGINE=InnoDB;

INSERT INTO categorias(nombre) VALUES
('Tinto'),
('Blanco'),
('Moda');

CREATE TABLE productos(
    id int auto_increment not null,
    categoria_id int not null,
    nombre varchar(255) not null,
    descripcion text not null,
    precio float(2) not null,
    stock int not null,
    oferta varchar(2),
    fecha date not null,
    imagen varchar(255),
    CONSTRAINT pk_productos PRIMARY KEY(id),
    CONSTRAINT fk_categoria FOREIGN KEY(categoria_id) REFERENCES categorias(id)
    ) ENGINE=InnoDB;

INSERT INTO productos(categoria_id, nombre, descripcion, precio, stock, oferta, fecha, imagen) VALUES
(1, 'Albariño Pazo de Señoráns', 'Vino blanco gallego de la D.O. Rías Baixas. Fresco y aromático con notas de frutas blancas y cítricos.', 15.90, 50, null, CURDATE(), null),
(1, 'Ribeira Sacra Mencía', 'Tinto joven de la D.O. Ribeira Sacra. Vino fresco con carácter frutal y mineralidad característica de la zona.', 12.50, 45, null, CURDATE(), null),
(1, 'Godello Valdeorras', 'Vino blanco de la D.O. Valdeorras. Elegante y estructurado con notas de frutas de hueso y flores blancas.', 14.20, 40, null, CURDATE(), null),
(2, 'Ribeiro Tinto', 'Vino tinto de la D.O. Ribeiro. Sabor afrutado y suave, perfecto para el día a día.', 8.90, 60, 'si', CURDATE(), null),
(2, 'Monterrei Blanco', 'Vino blanco de la D.O. Monterrei. Fresco y ligero con notas herbáceas características de la variedad.', 9.50, 55, null, CURDATE(), null),
(1, 'Albariño Martín Códax', 'Albariño clásico de las Rías Baixas. Perfecto para mariscos y pescados con su frescura atlántica.', 13.80, 70, null, CURDATE(), null),
(1, 'Mencía Peza do Rei', 'Tinto de gran carácter de la Ribeira Sacra. Crianza en barrica con aromas a frutas rojas maduras.', 18.50, 30, null, CURDATE(), null),
(2, 'Treixadura Ribeiro', 'Vino blanco autóctono gallego. Fresco y aromático ideal para aperitivos y tapas.', 10.50, 50, 'si', CURDATE(), null),
(1, 'Godello D. Ventura', 'Godello premium de Valdeorras. Complejo y elegante con crianza sobre lías.', 22.00, 25, null, CURDATE(), null),
(2, 'Rosado de Garnacha', 'Vino rosado fresco y afrutado. Perfecto para el verano con notas de fresas y frambuesas.', 7.50, 65, null, CURDATE(), null),
(1, 'Salnés Albariño', 'Albariño del Valle del Salnés. Máxima expresión de la variedad con acidez vibrante.', 16.50, 40, null, CURDATE(), null),
(1, 'Ribeira Sacra Tinto Crianza', 'Mencía con crianza en barrica. Vino estructurado con notas de frutos negros y especias.', 19.90, 35, null, CURDATE(), null);

CREATE TABLE pedidos(
    id int auto_increment not null,
    usuario_id int not null,
    provincia varchar(255) not null,
    localidad varchar(255) not null,
    direccion varchar(255) not null,
    coste float(2) not null,
    estado varchar(255) not null,
    fecha date,
    hora time,
    CONSTRAINT pk_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_usuario FOREIGN KEY(usuario_id) REFERENCES usuarios(id)
) ENGINE=InnoDB;

CREATE TABLE lineas_pedidos(
    id int auto_increment not null,
    pedido_id int not null,
    producto_id int not null,
    unidades int not null,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id),
    CONSTRAINT fk_linea_pedido FOREIGN KEY(pedido_id) REFERENCES pedidos(id),
    CONSTRAINT fk_linea_producto FOREIGN KEY(producto_id) REFERENCES productos(id)
) ENGINE=InnoDB;