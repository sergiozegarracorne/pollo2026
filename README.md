# Módulo inicial de catálogo (CodeIgniter 4 + PHP 8)

Este entregable crea la **primera parte** del sistema de venta para pollería:

- Registro de **productos** (pollo entero/cuarto, parrillas, bebidas, papas, etc.).
- Registro de **menús** (combinación de productos con variantes).
- Registro de **combos** (combinación de productos con precio promocional).
- Base de datos preparada para **SQLite** (fácil migración futura a MySQL/PostgreSQL).
- Protección por **privilegios** (roles: `admin`, `encargado` con acceso de edición).
- UI simple para pantalla táctil (máx. `1024x760`) con TailwindCSS.

## Estructura por secciones (mantenible)

- `app/Views/catalog/products.php`: formulario de productos.
- `app/Views/catalog/menus.php`: formulario de menús.
- `app/Views/catalog/combos.php`: formulario de combos.
- `app/Views/layouts/touch.php`: layout común táctil.
- `app/Controllers/CatalogController.php`: controlador de cada sección.
- `app/Models/*`: modelos independientes por entidad.
- `app/Filters/AuthRoleFilter.php`: filtro de privilegios.
- `app/Database/Migrations/2026-01-01-000001_CreateCatalogTables.php`: tablas base.

---

## ⚠️ Importante (antes de instalar)

Este repositorio contiene el **módulo** (archivos `app/` y apoyo), pero no el esqueleto completo de CodeIgniter 4 (`public/index.php`, `spark`, `vendor/`, etc.).

Para correrlo en tu VPS debes:

1. Crear/usar un proyecto **CodeIgniter 4 completo** (appstarter).
2. Copiar encima los archivos de este repositorio dentro de ese proyecto.

---

## Instalación en VPS (Ubuntu 22.04/24.04)

### 1) Instalar paquetes base

```bash
sudo apt update
sudo apt install -y nginx php8.2 php8.2-fpm php8.2-cli php8.2-sqlite3 php8.2-mbstring php8.2-intl php8.2-xml php8.2-curl unzip git
```

Instala Composer:

```bash
cd /tmp
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
sudo mv composer.phar /usr/local/bin/composer
```

### 2) Crear proyecto base CodeIgniter 4

```bash
cd /var/www
sudo composer create-project codeigniter4/appstarter polleria
```

### 3) Copiar este módulo dentro del proyecto

Suponiendo que tu repo actual está clonado en `/root/pollo2026`:

```bash
sudo rsync -av /root/pollo2026/app/ /var/www/polleria/app/
sudo rsync -av /root/pollo2026/public/touch-preview.html /var/www/polleria/public/
sudo rsync -av /root/pollo2026/README.md /var/www/polleria/README-modulo.md
```

### 4) Configurar entorno

```bash
cd /var/www/polleria
sudo cp env .env
sudo sed -i 's|# CI_ENVIRONMENT = production|CI_ENVIRONMENT = production|g' .env
sudo sed -i 's|# app.baseURL = .*|app.baseURL = https://TU_DOMINIO/|g' .env
```

### 5) SQLite + permisos

```bash
sudo mkdir -p /var/www/polleria/writable/database
sudo touch /var/www/polleria/writable/database/restaurante.sqlite
sudo chown -R www-data:www-data /var/www/polleria
sudo find /var/www/polleria/writable -type d -exec chmod 775 {} \;
sudo find /var/www/polleria/writable -type f -exec chmod 664 {} \;
```

### 6) Migrar tablas

```bash
cd /var/www/polleria
sudo -u www-data php spark migrate
```

### 7) Nginx (ejemplo)

Crear `/etc/nginx/sites-available/polleria`:

```nginx
server {
    listen 80;
    server_name TU_DOMINIO;

    root /var/www/polleria/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Activar sitio:

```bash
sudo ln -s /etc/nginx/sites-available/polleria /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### 8) SSL con Let's Encrypt

```bash
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d TU_DOMINIO
```

---

## Acceso y rutas del módulo

- Inicio: `/`
- Productos: `/catalogo/productos`
- Menús: `/catalogo/menus`
- Combos: `/catalogo/combos`

> El filtro de roles usa `session('role')`. Si no hay sesión/rol permitido, bloquea edición.

---

## Migrar luego a MySQL o PostgreSQL

Cuando migres, solo cambia configuración de DB (`app/Config/Database.php`) y vuelve a correr migraciones en el nuevo motor.

