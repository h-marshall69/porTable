# PorTable - Sistema de Reservas de Restaurantes

## Acerca de PorTable

**PorTable** es una aplicación web de reservas de restaurantes desarrollada con Laravel 9 Framework. Este proyecto fue creado como parte del 5º semestre en las materias de Framework Web, Desarrollo de Software y Desarrollo Móvil.

PorTable permite a los usuarios reservar mesas en restaurantes y está diseñado para 3 roles específicos (cliente, restaurante, administrador) con diversas funcionalidades para cada rol.

### Enlaces del Proyecto
- **Diseño UI/UX**: [Dribbble - Felic Studio](https://dribbble.com/felic-studio)
- **Demo en Vivo**: [http://3.144.10.202:8000/index](http://3.144.10.202:8000/index)

---

## 📋 Tabla de Contenidos
- [Características del Sistema](#características-del-sistema)
- [Requisitos del Sistema](#requisitos-del-sistema)
- [Instalación](#instalación)
- [Configuración](#configuración)
- [Migraciones y Seeders](#migraciones-y-seeders)
- [Uso del Sistema](#uso-del-sistema)
- [Estructura del Proyecto](#estructura-del-proyecto)
- [Contribuir](#contribuir)
- [Licencia](#licencia)

---

## 🚀 Características del Sistema

<details>
<summary>Funcionalidades de PorTable - ¡Haz clic para ver!</summary>
<br>

### Flujo de la Aplicación PorTable:

#### 1. Registro e Inicio de Sesión de Usuarios
**Tipos de Usuario:**
- **a.** Cliente (Customer)
- **b.** Restaurante (Restaurant)
- **c.** Administrador (Admin)

**Nota Importante:**
- Al registrarse desde la página principal, el usuario se registra por defecto como **cliente**
- Para crear una cuenta de **restaurante**, el cliente debe registrarse nuevamente y completar los términos y condiciones
- La cuenta de **administrador** viene por defecto (1 cuenta), para crear más cuentas de admin se debe hacer a través de otra cuenta admin o directamente desde la base de datos

#### 2. Funcionalidades del Cliente 👤

**Propuesta Original:**
- ✅ Explorar restaurantes (catálogo)
- ✅ Explorar recomendaciones
- ✅ Buscar restaurantes (barra de búsqueda)
- ✅ Filtrar restaurantes (reseñas, precio, mesas disponibles)
- ✅ Pagar con e-money o e-banking (API Midtrans/iPayment)
- ✅ Recargar e-money
- ✅ Favoritos de restaurantes
- ✅ Realizar reservas (reservar mesas disponibles)
- ✅ Ver historial de reservas
- ✅ Ver reservas actuales (transacciones activas)
- ✅ Cancelar reservas actuales (el dinero de la reserva no se reembolsa)
- ✅ CRUD de reseñas para restaurantes previamente reservados

**Funcionalidades Adicionales:**
- ✅ Registrar cuenta de restaurante
- ✅ Página de notificaciones

#### 3. Funcionalidades del Restaurante 🏪

**Propuesta Original:**
- ✅ Ver reservas y transacciones
- ✅ Cambiar cantidad o diseño de mesas
- ✅ Agregar o cambiar descripción del restaurante
- ✅ Agregar o cambiar horarios de funcionamiento
- ✅ Cambiar la cantidad a pagar en la aplicación
- ✅ Marcar reseñas como spam para revisión del administrador

**Funcionalidades Adicionales:**
- ✅ Ver dashboard/estadísticas del restaurante
- ✅ Editar estado de reservas actuales (mesa disponible/no disponible)

#### 4. Funcionalidades del Administrador 👨‍💼

**Propuesta Original:**
- ✅ CRUD de cuentas de restaurantes
- ✅ CRUD de cuentas de clientes
- ✅ Banear cuentas de restaurantes
- ✅ Banear cuentas de clientes
- ✅ Ver todas las transacciones
- ✅ Ver todas las reseñas de restaurantes
- ❌ Revisar reseñas spam de restaurantes (CANCELADO)
- ❌ Agregar reseñas en restaurantes (CANCELADO)
- ❌ Eliminar reseñas de restaurantes (CANCELADO)
- ❌ Cancelar reservas de clientes (CANCELADO)

**Funcionalidades Adicionales:**
- ✅ Dashboard/Resumen
- ✅ Publicaciones/Notificaciones del desarrollador

</details>

---

## 📋 Requisitos del Sistema

### Requisitos de Software
- **PHP** >= 8.0
- **Composer** >= 2.0
- **Node.js** >= 14.0
- **NPM** >= 6.0
- **MySQL** >= 8.0 o **MariaDB** >= 10.3
- **Apache** o **Nginx**

### Extensiones PHP Requeridas
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- BCMath PHP Extension
- GD PHP Extension

---

## 🔧 Instalación

### 1. Clonación del Proyecto

```bash
# Clonar el repositorio
git clone https://github.com/TU_USUARIO/PorTable.git

# Navegar al directorio del proyecto
cd PorTable
```

### 2. Instalación de Dependencias

```bash
# Instalar dependencias de PHP con Composer
composer install

# Instalar dependencias de Node.js
npm install

# Compilar assets para desarrollo
npm run dev

# O compilar para producción
npm run production
```

### 3. Configuración de Permisos

```bash
# Dar permisos de escritura a los directorios necesarios
sudo chmod -R 775 storage
sudo chmod -R 775 bootstrap/cache

# Cambiar propietario (opcional, ajustar según tu servidor)
sudo chown -R www-data:www-data storage
sudo chown -R www-data:www-data bootstrap/cache
```

---

## ⚙️ Configuración

### 1. Configuración del Archivo .env

```bash
# Copiar el archivo de configuración de ejemplo
cp .env.example .env

# Generar la clave de aplicación
php artisan key:generate
```

### 2. Configurar Variables de Entorno

Edita el archivo `.env` con tu configuración:

```env
# Configuración de la aplicación
APP_NAME="PorTable"
APP_ENV=local
APP_KEY=base64:TU_CLAVE_GENERADA_AQUÍ
APP_DEBUG=true
APP_URL=http://localhost:8000

# Configuración de la base de datos
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portable_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña

# Configuración de correo (opcional)
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=hello@portable.com
MAIL_FROM_NAME="${APP_NAME}"

# Configuración de Midtrans (para pagos)
MIDTRANS_SERVER_KEY=tu_server_key
MIDTRANS_CLIENT_KEY=tu_client_key
MIDTRANS_IS_PRODUCTION=false
MIDTRANS_IS_SANITIZED=true
MIDTRANS_IS_3DS=true
```

### 3. Crear Base de Datos

```sql
# Conectar a MySQL
mysql -u root -p

# Crear la base de datos
CREATE DATABASE portable_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# Salir de MySQL
exit
```

---

## 🗄️ Migraciones y Seeders

### 1. Ejecutar Migraciones

```bash
# Ejecutar todas las migraciones
php artisan migrate

# O ejecutar migraciones frescas (elimina todas las tablas y las recrea)
php artisan migrate:fresh
```

### 2. Ejecutar Seeders

```bash
# Ejecutar todos los seeders
php artisan db:seed

# Ejecutar un seeder específico
php artisan db:seed --class=UserSeeder
php artisan db:seed --class=RestaurantSeeder
php artisan db:seed --class=CategorySeeder

# Ejecutar migraciones y seeders en un solo comando
php artisan migrate:fresh --seed
```

### 3. Seeders Disponibles

El proyecto incluye los siguientes seeders:

- **UserSeeder**: Crea usuarios de ejemplo (admin, restaurantes, clientes)
- **RestaurantSeeder**: Crea restaurantes de ejemplo
- **CategorySeeder**: Crea categorías de restaurantes
- **TableSeeder**: Crea mesas para los restaurantes
- **ReviewSeeder**: Crea reseñas de ejemplo

---

## 🚀 Uso del Sistema

### 1. Iniciar el Servidor de Desarrollo

```bash
# Iniciar el servidor Laravel
php artisan serve

# El servidor estará disponible en: http://localhost:8000
```

### 2. Acceso al Sistema

**Cuentas por Defecto (después de ejecutar seeders):**

**Administrador:**
- Email: `admin@portable.com`
- Contraseña: `password`

**Restaurante de Ejemplo:**
- Email: `restaurant@portable.com`
- Contraseña: `password`

**Cliente de Ejemplo:**
- Email: `customer@portable.com`
- Contraseña: `password`

### 3. Flujo de Uso Básico

1. **Registro/Inicio de Sesión**: Accede a la página principal y regístrate o inicia sesión
2. **Explorar Restaurantes**: Navega por el catálogo de restaurantes disponibles
3. **Realizar Reserva**: Selecciona un restaurante, elige fecha/hora y confirma la reserva
4. **Gestión de Cuenta**: Accede a tu perfil para ver reservas, historial, etc.

---

## 🏗️ Estructura del Proyecto

```
PorTable/
├── app/
│   ├── Http/
│   │   ├── Controllers/      # Controladores
│   │   ├── Middleware/       # Middleware personalizado
│   │   └── Requests/         # Form Requests
│   ├── Models/               # Modelos Eloquent
│   └── Services/            # Servicios personalizados
├── database/
│   ├── migrations/          # Migraciones de BD
│   ├── seeders/            # Seeders
│   └── factories/          # Model Factories
├── public/                 # Archivos públicos
├── resources/
│   ├── views/              # Vistas Blade
│   ├── js/                 # Archivos JavaScript
│   └── css/               # Archivos CSS
├── routes/
│   ├── web.php            # Rutas web
│   └── api.php            # Rutas API
└── storage/               # Almacenamiento de archivos
```

---

## 🛠️ Comandos Útiles

### Comandos de Desarrollo

```bash
# Limpiar caché de configuración
php artisan config:clear

# Limpiar caché de rutas
php artisan route:clear

# Limpiar caché de vistas
php artisan view:clear

# Limpiar todos los cachés
php artisan optimize:clear

# Ver rutas disponibles
php artisan route:list

# Crear nuevo controlador
php artisan make:controller NombreController

# Crear nuevo modelo con migración
php artisan make:model NombreModelo -m

# Crear nuevo seeder
php artisan make:seeder NombreSeeder
```

### Comandos de Base de Datos

```bash
# Ver estado de migraciones
php artisan migrate:status

# Rollback de la última migración
php artisan migrate:rollback

# Rollback de las últimas X migraciones
php artisan migrate:rollback --step=5

# Refrescar base de datos con seeders
php artisan migrate:refresh --seed
```

---

## 🔍 Solución de Problemas Comunes

### Error: "Please provide a valid cache path"

```bash
# Crear directorio de caché de vistas
mkdir -p storage/framework/views
mkdir -p storage/framework/cache
mkdir -p storage/framework/sessions
```

### Error de Permisos

```bash
# Dar permisos correctos
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: "Key path does not exist"

```bash
# Regenerar clave de aplicación
php artisan key:generate
```

### Error de Conexión a Base de Datos

1. Verificar que MySQL esté ejecutándose
2. Confirmar credenciales en `.env`
3. Verificar que la base de datos exista

```bash
# Verificar conexión
php artisan tinker
DB::connection()->getPdo();
```

---

## 🤝 Contribuir

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

---

## 📱 Capturas de Pantalla

<img width="1280" alt="Screenshot (3)" src="https://github.com/AntonioCR11/PorTable/assets/99940538/4ffe33a7-3d6d-4ede-8668-fbaa4ebfe1b6">
<img width="1280" alt="Screenshot (3)" src="https://github.com/AntonioCR11/PorTable/assets/99940538/94091b48-6076-49b0-8391-a34403fd165d">

---

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.

---

## 👨‍💻 Autor

**Tu Nombre**
- GitHub: [@TuUsuario](https://github.com/TuUsuario)
- Email: tu.email@example.com

---

## 🙏 Agradecimientos

- Laravel Framework
- Bootstrap para el diseño responsivo
- Midtrans para el procesamiento de pagos
- Felic Studio por el diseño UI/UX

---

**¿Necesitas ayuda?** Abre un [issue](https://github.com/TuUsuario/PorTable/issues) en GitHub.
