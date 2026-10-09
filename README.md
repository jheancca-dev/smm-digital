# SMM Digital - Cooperativa Santa María Magdalena

Plataforma Web de Preevaluación Crediticia y Gestión de Solicitudes.

**Autor:** Jhean Carlos Carlin Ayala  
**Curso:** Ingeniería Web - NRC 36769  
**Universidad:** Universidad Continental  

---

## 📋 Requisitos previos

- PHP 8.2 o superior
- Composer
- Node.js 18+
- MySQL / MariaDB (XAMPP)
- Visual Studio Code (recomendado)

---

## 🚀 Instalación paso a paso

### 1. Copiar el proyecto
Coloca la carpeta `smm-digital` en `C:\xampp\htdocs\`

### 2. Iniciar XAMPP
Abre XAMPP Control Panel y activa **Apache** y **MySQL**.

### 3. Crear la base de datos
Abre `http://localhost/phpmyadmin` y crea una BD llamada `smm_digital` con cotejamiento `utf8mb4_unicode_ci`.

### 4. Importar la base de datos
En phpMyAdmin, selecciona `smm_digital` → pestaña **Importar** → sube el archivo `smm_digital.sql` incluido en la raíz del proyecto.

### 5. Instalar dependencias
Abre una terminal en la carpeta del proyecto:

```bash
cd C:\xampp\htdocs\smm-digital
composer install
npm install
```

### 6. Configurar el .env
Verifica que el archivo `.env` tenga:

```
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smm_digital
DB_USERNAME=root
DB_PASSWORD=
```

Si el archivo `.env` no existe, copia `.env.example` y renómbralo:

```bash
copy .env.example .env
php artisan key:generate
```

### 7. Generar el enlace simbólico de storage

```bash
php artisan storage:link
```

### 8. Ejecutar migraciones (si no importaste el .sql)

```bash
php artisan migrate
```

### 9. Arrancar el proyecto
Abre **dos terminales**:

```bash
# Terminal 1
php artisan serve

# Terminal 2
npm run dev
```

Abrir en el navegador: **http://127.0.0.1:8000**

---

## 👤 Usuarios de prueba

| Rol | Email | Contraseña |
|-----|-------|------------|
| Analista | zasmi@test.com | 12345678 |

---

## 📦 Módulos implementados

1. Autenticación (registro / login / logout)
2. Index (menú principal)
3. Simulador de Créditos
4. Preevaluación Crediticia y Scoring
5. Panel de Analistas
6. Notificaciones

---

## 🛠️ Tecnologías utilizadas

- Laravel 12 (PHP)
- MySQL / MariaDB
- Laravel Breeze (autenticación)
- Tailwind CSS
- Vite
- XAMPP

---

## 📁 Estructura de carpetas

```
smm-digital/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php
│   │   │   ├── SimuladorController.php
│   │   │   ├── PreevaluacionController.php
│   │   │   ├── NotificacionController.php
│   │   │   └── AnalistaController.php
│   │   └── Middleware/
│   │       └── EsAnalista.php
│   └── Models/
│       ├── User.php
│       └── Solicitud.php
├── database/
│   └── migrations/
├── resources/
│   └── views/
│       ├── home.blade.php
│       ├── auth/
│       ├── simulador/
│       ├── preevaluacion/
│       ├── notificaciones/
│       └── panel-analistas/
├── routes/
│   └── web.php
├── .env
├── composer.json
├── package.json
└── README.md
```

---

## 📄 Licencia

Proyecto académico desarrollado para el curso de Ingeniería Web - Universidad Continental.