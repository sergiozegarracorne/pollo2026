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

## Nota

Este repositorio solo contiene el módulo solicitado. Si deseas, en el siguiente paso te dejo la integración completa con el esqueleto oficial de CodeIgniter 4 para ejecución directa.
