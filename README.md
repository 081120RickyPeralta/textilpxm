# TextilPXM

Sitio Web Dinámico desarrollado con PHP, Bootstrap y Arquitectura MVC

## Características

- Framework MVC (Modelo-Vista-Controlador) personalizado
- Diseño responsivo con Bootstrap 5
- Conexión PDO a base de datos MySQL/MariaDB
- Sistema de enrutamiento dinámico
- Autenticación de usuarios
- Gestión de usuarios
- Vistas con layouts reutilizables
- URLs amigables
- Sin dependencias externas (solo CDN para Bootstrap)

## Estructura del Proyecto

```
textilpxm/
├── app/
│   ├── controllers/      # Controladores de la aplicación
│   │   ├── Controller.php         # Controlador base
│   │   └── HomeController.php     # Controlador principal
│   ├── models/           # Modelos de datos
│   │   ├── Model.php              # Modelo base
│   │   └── User.php               # Modelo de usuario
│   ├── views/            # Vistas de la aplicación
│   │   ├── View.php               # Clase de vista
│   │   ├── layouts/
│   │   │   └── main.php           # Layout principal
│   │   ├── home/
│   │   │   └── index.php          # Vista home
│   │   ├── about.php              # Vista sobre nosotros
│   │   ├── contact.php            # Vista contacto
│   │   ├── login.php              # Vista login
│   │   └── register.php           # Vista registro
│   └── router.php                 # Sistema de enrutamiento
├── config/
│   ├── Config.php       # Configuración principal
│   └── Database.php     # Clase de conexión a base de datos
├── public/
│   ├── css/
│   │   └── style.css    # Estilos personalizados
│   ├── js/
│   │   └── main.js      # JavaScript
│   ├── img/             # Imágenes del proyecto
│   ├── index.php        # Punto de entrada
│   └── .htaccess        # Configuración de URLs amigables
└── README.md
```

## Requisitos Previos

- PHP 7.4 o superior
- MySQL/MariaDB
- Servidor web Apache con mod_rewrite habilitado
- XAMPP (opcional, pero recomendado)

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/081120RickyPeralta/textilpxm.git
cd textilpxm
```

2. Importante: Los archivos están en la subcarpeta `textilpxm/`, puedes moverlos al directorio raíz del proyecto.

3. Crear la base de datos:
```sql
CREATE DATABASE textilpxm_db;

USE textilpxm_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol VARCHAR(50) DEFAULT 'usuario',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

4. Configurar el servidor web:
   - Asegúrate de que el mod_rewrite esté habilitado en Apache
   - Configura el DocumentRoot de Apache apuntando a la carpeta `public/`

5. Ajustar las configuraciones:
   - Abre `config/Config.php`
   - Modifica `BASE_URL` según tu configuración

6. Permisos:
   - Asegúrate de que PHP tenga permisos de escritura en las carpetas necesarias

## Uso

### Configuración del Servidor

Asegúrate de que el DocumentRoot de tu servidor web apunte al directorio `public/` por razones de seguridad.

### Configuración de XAMPP

Si estás usando XAMPP:

1. Copia el contenido de `textilpxm/` al directorio `htdocs/`
2. Asegúrate de que tu URL sea: `http://localhost/textilpxm/public`
3. Habilita `rewrite_module` en Apache
4. Reinicia Apache

### Accediendo al sitio

- Inicio: `http://localhost/textilpxm/public/`
- Login: `http://localhost/textilpxm/public/login`
- Registro: `http://localhost/textilpxm/public/register`
- Contacto: `http://localhost/textilpxm/public/contact`
- Nosotros: `http://localhost/textilpxm/public/about`

### URLs Amigables

Las URLs están configuradas para ser amigables gracias al archivo `.htaccess`. Esto convierte URLs como:
- `index.php?path=about` → `/about`

Si las URLs no funcionan, verifica que:
1. Apache tenga mod_rewrite habilitado
2. El archivo `.htaccess` esté en la carpeta `public/`
3. `AllowOverride` esté configurado en `All` en tu configuración de Apache

### Datos de Acceso Iniciales

El sistema simula la autenticación. Puedes registrar usuarios a través del formulario de registro.

## Descripción de Componentes

### MVC

**Modelo (Model):**
- `Model.php`: Clase base con funcionalidades comunes de acceso a datos
- `User.php`: Ejemplo de modelo para gestión de usuarios

**Vista (View):**
- `View.php`: Clase que renderiza las vistas con layouts
- `layouts/main.php`: Layout principal con Bootstrap
- Todas las vistas usan este layout automáticamente

**Controlador (Controller):**
- `Controller.php`: Clase base con funcionalidades comunes
- `HomeController.php`: Controlador principal que gestiona las páginas principales

### Enrutamiento

El sistema de enrutamiento automáticamente:
- Parsea la URL del navegador
- Determina qué controlador y método invocar
- Pasa parámetros si existen

### Bootstrap 5

El diseño usa Bootstrap 5 a través de CDN para:
- Diseño responsivo
- Componentes predefinidos
- Iconos de Bootstrap Icons
- Sin necesidad de descargas locales

## Personalización

### Cambiar colores y estilos
- Edita `public/css/style.css`
- El CSS usa variables para fácil personalización

### Agregar nuevas páginas
1. Crea una vista en `app/views/`
2. Agrega un método en el controlador correspondiente en `app/controllers/`
3. Accede a través de la URL: `/nombre-controlador/nombre-metodo`

### Agregar nuevos modelos
1. Crea un nuevo archivo en `app/models/`
2. Extiende de la clase `Model`
3. Usa los métodos protegidos para consultas a la base de datos

### Modificar base de datos
- Cambia las credenciales en `config/Config.php`

## Seguridad

- Contraseñas hasheadas con `password_hash`
- Prepared statements para todas las consultas (prevenir SQL injection)
- Protección contra acceso a archivos sensibles vía .htaccess
- Cabeceras de seguridad configuradas

## Desarrollo

### Agregar dependencias (si fuera necesario)

Si deseas agregar gestión de dependencias con Composer:

```bash
composer init
composer install
```

### Depuración

La configuración muestra errores PHP por defecto. En producción, desactivar esto en `config/Config.php`.

## Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/NuevaFeature`)
3. Commit tus cambios (`git commit -m 'Agrega la nueva feature'`)
4. Push a la rama (`git push origin feature/NuevaFeature`)
5. Abre un Pull Request

## Soporte

Para reportar problemas o sugerencias, por favor abre un issue en el repositorio.

## Licencia

Este proyecto está bajo la Licencia MIT.

## Créditos

Desarrollado por Ricky Peralta
Framework MVC: PHP puro, sin dependencias externas
Frontend: Bootstrap 5