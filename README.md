# TextilPXM

Sitio Web Dinámico desarrollado con PHP, Bootstrap y Arquitectura MVC

## Características

- Framework MVC (Modelo-Vista-Controlador) personalizado
- Diseño responsivo con Bootstrap 5
- Conexión PDO a base de datos MySQL/MariaDB
- Sistema de enrutamiento dinámico
- Autenticación de usuarios
- **CRUD completo de productos** (Crear, Leer, Actualizar, Eliminar)
- **Catálogo público de productos** con diseño adaptado
- **Panel de administración** para gestionar productos
- Control de stock y disponibilidad
- Gestión de categorías de productos
- Vistas con layouts reutilizables
- URLs amigables
- Sin dependencias externas (solo CDN para Bootstrap)

## Estructura del Proyecto

```
textilpxm/
├── app/
│   ├── controllers/      # Controladores de la aplicación
│   │   ├── Controller.php         # Controlador base
│   │   ├── HomeController.php     # Controlador principal
│   │   ├── CatalogController.php  # Controlador del catálogo público
│   │   └── ProductController.php  # Controlador CRUD de productos
│   ├── models/           # Modelos de datos
│   │   ├── Model.php              # Modelo base
│   │   ├── User.php               # Modelo de usuario
│   │   └── Product.php            # Modelo de productos
│   ├── views/            # Vistas de la aplicación
│   │   ├── View.php               # Clase de vista
│   │   ├── layouts/
│   │   │   └── main.php           # Layout principal
│   │   ├── catalog/               # Vistas del catálogo público
│   │   │   ├── index.php          # Lista de productos
│   │   │   └── show.php          # Detalle de producto
│   │   ├── products/              # Vistas del panel de administración
│   │   │   ├── index.php          # Lista de productos (CRUD)
│   │   │   └── form.php           # Formulario crear/editar
│   │   ├── home/
│   │   │   └── index.php          # Vista home
│   │   ├── about.php              # Vista sobre nosotros
│   │   ├── contact.php            # Vista contacto
│   │   ├── login.php              # Vista login
│   │   └── register.php          # Vista registro
│   └── router.php                 # Sistema de enrutamiento
├── config/
│   ├── Config.php       # Configuración principal
│   └── Database.php     # Clase de conexión a base de datos
├── database/
│   └── schema.sql       # Script SQL con estructura de BD
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
   - Ejecuta el script SQL: `database/schema.sql`
   - O importa la base de datos desde phpMyAdmin
   - El script incluye:
     - Tabla de usuarios
     - Tabla de productos
     - Usuario administrador por defecto (email: admin@textilpxm.com, contraseña: admin123)
     - Productos de ejemplo

4. Configurar el servidor web (solo necesario si mod_rewrite no está habilitado):

   **Nota:** El proyecto detecta automáticamente las rutas, por lo que funciona en cualquier subdirectorio sin configuración adicional.
   
   **Habilitar mod_rewrite en Apache (XAMPP) - Solo si no está habilitado:**
   
   En la mayoría de instalaciones de XAMPP, mod_rewrite ya viene habilitado. Si las URLs amigables no funcionan:
   
   a. Abre el archivo `httpd.conf` ubicado en `C:\xampp\apache\conf\httpd.conf`
   
   b. Busca la línea: `#LoadModule rewrite_module modules/mod_rewrite.so`
   
   c. Elimina el símbolo `#` al inicio: `LoadModule rewrite_module modules/mod_rewrite.so`
   
   d. Busca `<Directory "C:/xampp/htdocs">` y cambia `AllowOverride None` a `AllowOverride All`
   
   e. Guarda y reinicia Apache desde el Panel de Control de XAMPP
   
   **Acceso al sitio:**
   
   Simplemente accede a: `http://localhost/textilpxm/public/`
   
   El proyecto detecta automáticamente la ruta base, por lo que funcionará en cualquier ubicación sin configuración adicional.

5. Ajustar las configuraciones (opcional):
   - Abre `config/Config.php` si necesitas cambiar la configuración de la base de datos
   - Las URLs se detectan automáticamente, no es necesario modificar `BASE_URL`

6. Permisos:
   - Asegúrate de que PHP tenga permisos de escritura en las carpetas necesarias

## Uso

### Configuración del Servidor

Asegúrate de que el DocumentRoot de tu servidor web apunte al directorio `public/` por razones de seguridad.

### Configuración de XAMPP

**¡Configuración simplificada!** El proyecto detecta automáticamente las rutas, por lo que solo necesitas:

1. **Asegúrate de que Apache esté corriendo** en XAMPP
2. **Accede directamente a:** `http://localhost/textilpxm/public/`

**Si las URLs amigables no funcionan:**
- Verifica que mod_rewrite esté habilitado (ver paso 4 de Instalación)
- En la mayoría de instalaciones de XAMPP ya viene habilitado por defecto

**Nota:** El proyecto funciona automáticamente en cualquier subdirectorio sin necesidad de configurar Virtual Hosts o modificar rutas.

### Accediendo al sitio

Una vez que Apache esté corriendo, accede a:

**Páginas Públicas:**
- Catálogo: `http://localhost/textilpxm/public/catalog` (página principal)
- Detalle de producto: `http://localhost/textilpxm/public/catalog/show/{id}`
- Nosotros: `http://localhost/textilpxm/public/about`
- Contacto: `http://localhost/textilpxm/public/contact`

**Panel de Administración (requiere login):**
- Login: `http://localhost/textilpxm/public/login`
- Gestión de Productos: `http://localhost/textilpxm/public/products`
- Crear Producto: `http://localhost/textilpxm/public/products/create`
- Editar Producto: `http://localhost/textilpxm/public/products/edit/{id}`

**Credenciales por defecto:**
- Email: `admin@textilpxm.com`
- Contraseña: `admin123`

**Nota:** Si colocas el proyecto en otra ubicación, simplemente ajusta la ruta en la URL. El proyecto detectará automáticamente su ubicación.

### URLs Amigables

Las URLs están configuradas para ser amigables gracias al archivo `.htaccess`. Esto convierte URLs como:
- `index.php?path=about` → `/about`

Si las URLs no funcionan, verifica que:
1. Apache tenga mod_rewrite habilitado
2. El archivo `.htaccess` esté en la carpeta `public/`
3. `AllowOverride` esté configurado en `All` en tu configuración de Apache

### Gestión de Productos

Una vez que hayas iniciado sesión, podrás:

1. **Ver todos los productos:** Accede a `/products` para ver la lista completa
2. **Crear nuevo producto:** Haz clic en "Nuevo Producto" y completa el formulario
3. **Editar producto:** Haz clic en el ícono de editar en la lista de productos
4. **Eliminar producto:** Haz clic en el ícono de eliminar (soft delete - el producto se desactiva)
5. **Controlar stock:** Actualiza el stock disponible para cada producto
6. **Activar/Desactivar:** Los productos inactivos no aparecen en el catálogo público

### Catálogo Público

El catálogo público (`/catalog`) muestra todos los productos activos con:
- Imágenes de productos
- Precios en MXN
- Estado de stock (disponible, pocas unidades, agotado)
- Categorías
- Descripciones detalladas
- Diseño adaptado del HTML original

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