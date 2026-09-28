CREATE DATABASE db_banco_adso;
USE db_banco_adso;


CREATE TABLE clientes(

id INT AUTO_INCREMENT PRIMARY KEY,

nombre VARCHAR(30)
);


CREATE TABLE cuentas(

id INT AUTO_INCREMENT PRIMARY KEY,

numero_cuenta VARCHAR(40) UNIQUE,

saldo DECIMAL(12,2) CHECK(saldo >= 0) DEFAULT 0,

cliente_id INT,

FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);


CREATE TABLE usuarios(

id INT AUTO_INCREMENT PRIMARY KEY,

cuenta_id INT UNIQUE,

FOREIGN KEY (cuenta_id) REFERENCES cuentas(id),
clave_hash VARCHAR(255)
);

CREATE TABLE retiros(

id INT AUTO_INCREMENT PRIMARY KEY,
cuenta_id INT,

FOREIGN KEY (cuenta_id) REFERENCES cuentas(id),
valor DECIMAL(12,2),

fecha DATETIME DEFAULT CURRENT_TIMESTAMP

);

CREATE TABLE transferencias(

id INT AUTO_INCREMENT PRIMARY KEY,
cuenta_origen_id INT,

FOREIGN KEY (cuenta_origen_id) REFERENCES cuentas(id),

cuenta_destino_id INT,

FOREIGN KEY (cuenta_destino_id) REFERENCES cuentas(id),
valor DECIMAL(12,2),

fecha DATETIME DEFAULT CURRENT_TIMESTAMP

);
