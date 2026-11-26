# Sistema Web de Control de Medicamentos, Lotes y Dispensación para Farmacia

Proyecto integrador de DSI406 Tecnología Backend (Laravel + PostgreSQL).

## Requisitos
- PHP 8.3 o superior con extensiones `pdo_pgsql` y `pgsql`
- Composer 2 y PostgreSQL

## Instalación
1. `git clone https://github.com/lmartinez251ds16-art/control-farmacia.git`
2. `cd control-farmacia`
3. `composer install`
4. `copy .env.example .env` (y completar `DB_PASSWORD`)
5. `php artisan key:generate`
6. Crear la base de datos `control_farmacia` en PostgreSQL
7. `php artisan migrate --seed`
8. `php artisan serve`

## Datos de prueba
Comando: `php artisan migrate:fresh --seed`

| Usuario | Rol | Permiso Regente | Contraseña |
| :--- | :--- | :---: | :--- |
| `regente@farmacia.test` | `administrador` | Sí | `password` |
| `admin@farmacia.test` | `administrador` | No | `password` |
| `almacen@farmacia.test` | `almacenero` | No | `password` |
| `tecnico@farmacia.test` | `tecnico_farmacia` | No | `password` |

Autor: Luz Katherinne Martinez Mamani