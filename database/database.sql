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