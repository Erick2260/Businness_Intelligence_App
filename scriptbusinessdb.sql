CREATE TABLE clientes
(
  id               int AUTO_INCREMENT
    PRIMARY KEY,
  codigo_usuario   varchar(50) NOT NULL,
  primer_nombre    varchar(50) NOT NULL,
  segundo_nombre   varchar(50) NOT NULL,
  primer_apellido  varchar(50) NOT NULL,
  segundo_apellido varchar(50) NOT NULL,
  CONSTRAINT codigo_usuario
  UNIQUE (codigo_usuario)
);

CREATE TABLE cuentas_bancarias
(
  id             int AUTO_INCREMENT
    PRIMARY KEY,
  numero_cuenta  int         NOT NULL,
  codigo_usuario varchar(50) NOT NULL,
  tipo_cuenta    varchar(10) NOT NULL,
  monto_cuenta   float       NOT NULL,
  fecha_creacion date        NULL,
  CONSTRAINT numero_cuenta
  UNIQUE (numero_cuenta),
  CONSTRAINT cuentas_bancarias_ibfk_1
  FOREIGN KEY (codigo_usuario) REFERENCES clientes (codigo_usuario)
);

CREATE TABLE cheques
(
  id                 int AUTO_INCREMENT
    PRIMARY KEY,
  cheque_cuenta      int         NOT NULL,
  codigo_usuario     varchar(50) NOT NULL,
  cheque_transaccion int         NOT NULL,
  cheque_fecha       date        NOT NULL,
  cheque_monto       float       NOT NULL,
  CONSTRAINT cheques_ibfk_1
  FOREIGN KEY (cheque_cuenta) REFERENCES cuentas_bancarias (numero_cuenta),
  CONSTRAINT cheques_ibfk_2
  FOREIGN KEY (codigo_usuario) REFERENCES clientes (codigo_usuario)
);

CREATE INDEX cheque_cuenta
  ON cheques (cheque_cuenta);

CREATE INDEX codigo_usuario
  ON cheques (codigo_usuario);

CREATE INDEX codigo_usuario
  ON cuentas_bancarias (codigo_usuario);

CREATE TABLE documentos
(
  id                    int AUTO_INCREMENT
    PRIMARY KEY,
  documento_cuenta      int         NOT NULL,
  documento_transaccion int         NOT NULL,
  documento_tipo        varchar(50) NULL,
  documento_fecha       date        NOT NULL,
  CONSTRAINT documentos_ibfk_1
  FOREIGN KEY (documento_cuenta) REFERENCES cuentas_bancarias (numero_cuenta)
);

CREATE INDEX documento_cuenta
  ON documentos (documento_cuenta);

CREATE TABLE transacciones
(
  id                      int AUTO_INCREMENT
    PRIMARY KEY,
  numero_cuenta           int          NOT NULL,
  codigo_usuario          varchar(50)  NOT NULL,
  codigo_transaccion      int          NOT NULL,
  nombre_transaccion      varchar(50)  NOT NULL,
  monto_transaccion       float        NOT NULL,
  fecha_transaccion       date         NOT NULL,
  comentarios_transaccion varchar(500) NULL,
  sucursal_transaccion    varchar(100) NOT NULL,
  colaborador_transaccion varchar(100) NOT NULL,
  CONSTRAINT transacciones_ibfk_1
  FOREIGN KEY (numero_cuenta) REFERENCES cuentas_bancarias (numero_cuenta),
  CONSTRAINT transacciones_ibfk_2
  FOREIGN KEY (codigo_usuario) REFERENCES clientes (codigo_usuario)
);

CREATE INDEX codigo_usuario
  ON transacciones (codigo_usuario);

CREATE INDEX numero_cuenta
  ON transacciones (numero_cuenta);

CREATE TABLE usuarios
(
  id             int AUTO_INCREMENT
    PRIMARY KEY,
  nombre_usuario varchar(100) NOT NULL,
  password       varchar(300) NOT NULL
);


