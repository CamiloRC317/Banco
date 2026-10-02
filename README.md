# Banco ADSO

Aplicación bancaria simulada, desarrollada como proyecto integrador del programa ADSO - SENA. Permite iniciar sesión con número de cuenta, consultar el saldo en tiempo real, retirar dinero, transferir entre cuentas y consultar el historial de movimientos.

## Funcionalidades

- Inicio de sesión con número de cuenta y contraseña (sin registro público).
- Consulta de saldo en vivo.
- Retiro de dinero, con validación de saldo disponible.
- Transferencia de dinero entre cuentas, con transacción atómica.
- Historial de retiros.
- Historial de transferencias (enviadas y recibidas).

## Tecnologías

- PHP 8.1+
- MySQL
- Composer (autoload PSR-4)
- PDO con consultas preparadas
- Sin frameworks: MVC construido manualmente

## Arquitectura

El proyecto sigue una arquitectura en capas, separando responsabilidades:

- **Modelos** (`src/Modelos`): representan los datos de cada tabla, sin lógica de base de datos.
- **Repositorios** (`src/Repositorios`): únicos responsables de hablar con la base de datos (PDO).
- **Servicios** (`src/Servicios`): contienen las reglas de negocio (validar saldo, transacciones atómicas, autenticación).
- **Controladores** (`src/Controladores`): reciben la petición, llaman al Servicio correspondiente y renderizan una vista.
- **Vistas** (`vistas/`): HTML de cada pantalla, sin lógica de negocio ni acceso a datos.
- **Núcleo** (`src/Nucleo`): piezas de infraestructura compartidas (conexión a la base de datos y enrutador).

Todas las peticiones pasan por un único punto de entrada (`public/index.php`), que delega en un Router propio según la URL y el método HTTP.

## Estructura del proyecto

```
BancoADSO/
├── config/
│   └── config.php          # Configuración de la base de datos (host, usuario, contraseña)
├── public/
│   ├── index.php           # Front Controller
│   └── css/                # Hojas de estilo
├── sql/
│   ├── script.sql
│   └── inserts.sql
├── src/
│   ├── Nucleo/              # Conexion (Singleton) y Router
│   ├── Modelos/
│   ├── Repositorios/
│   ├── Servicios/
│   │   └── Excepciones/
│   └── Controladores/
├── vistas/
│   ├── autenticacion/
│   ├── cuenta/
│   ├── retiro/
│   └── transferencia/
├── vendor/                  # Generado por Composer
└── composer.json
```

## Requisitos

- PHP 8.1 o superior, con la extensión `pdo_mysql` habilitada
- MySQL (o MariaDB)
- Composer

## Instalación

1. Clona el repositorio:
   ```
   git clone <url-del-repositorio>
   cd BancoADSO
   ```

2. Instala las dependencias y genera el autoload de Composer:
   ```
   composer dump-autoload
   ```

3. Crea la base de datos ejecutando los scripts de la carpeta `sql/`, **en orden**, desde tu gestor de MySQL (phpMyAdmin, MySQL Workbench, o la terminal):
   - `script.sql`: crea la base de datos y las tablas.
   - `inserts.sql`: inserta los datos de prueba (clientes, cuentas y usuarios).

4. Configura el acceso a la base de datos en `config/config.php`, ajustando el usuario y la contraseña según tu instalación de MySQL:
   ```php
   <?php
   return [
       'host' => 'localhost',
       'db' => 'db_banco_adso',
       'usuario' => 'root',
       'contrasena' => '',
       'charset'=>'utf8mb4'
   ];
   ```

5. Levanta el servidor de desarrollo de PHP desde la raíz del proyecto:
   ```
   php -S localhost:8000 -t public
   ```

6. Abre `http://localhost:8000/login` en tu navegador.

## Credenciales de prueba

| Número de cuenta | Contraseña | Saldo inicial |
|---|---|---|
| 100001 | juan123 | $1,000.00 |
| 100002 | carlos123 | $1,000.00 |
| 100003 | maria123 | $1,000.00 |
| 100004 | daniel123 | $1,000.00 |
| 100005 | andres123 | $1,000.00 |

## Seguridad

- Las contraseñas se almacenan como hash (`password_hash` / `password_verify`), nunca en texto plano.
- Todo el acceso a la base de datos usa consultas preparadas con PDO, evitando inyección SQL.
- La cuenta activa en sesión se obtiene siempre de `$_SESSION`, nunca de un formulario o de la URL.
- Las transferencias se ejecutan dentro de una transacción (`beginTransaction` / `commit` / `rollBack`), garantizando que el dinero nunca se pierda si algo falla a mitad de la operación.