# Pruebas unitarias del módulo Clientes (Guía 03)

- **Proyecto:** Sistema Web de Control de Medicamentos, Lotes y Dispensación para Farmacia
- **Fecha:** 26/11/2026
- **Responsable:** Luz Katherinne Martinez Mamani
- **Repositorio:** https://github.com/lmartinez251ds16-art/control-farmacia

| Caso | Descripción de la prueba | RF / RN | Resultado | Observación |
| :--- | :--- | :---: | :---: | :--- |
| CP01 | Listado inicial paginado (`/clientes`) | RF15 | OK | Muestra 10 por página y total de 25 clientes del seeder. |
| CP02 | Búsqueda exacta por DNI | RF15 | OK | Devuelve el registro exacto. |
| CP03 | Búsqueda parcial por apellidos en minúsculas (`ilike`) | RF15 | OK | Filtra sin distinguir mayúsculas ni minúsculas. |
| CP04 | Paginación conservando parámetros de búsqueda | RF15 | OK | `withQueryString()` mantiene `?buscar=` en la URL. |
| CP05 | Validación de campos obligatorios vacíos | RF15 | OK | Mensajes personalizados en español bajo cada campo. |
| CP06 | Validación de longitud de DNI (7 dígitos) | RF15, RN01 | OK | Rechaza con mensaje en español y conserva `old()`. |
| CP07 | Validación de unicidad de DNI al registrar | RN01 | OK | Rechaza DNI duplicado antes de llegar a PostgreSQL. |
| CP08 | Validación de formato de celular (inicio con 9) | RF15 | OK | Rechaza números que no inician con 9. |
| CP09 | Validación de longitud de celular (9 dígitos) | RF15 | OK | Rechaza números con menos de 9 dígitos. |
| CP10 | Registro exitoso de nuevo cliente | RF15 | OK | Redirige a `clientes.show` con mensaje flash verde. |
| CP11 | Edición de cliente manteniendo su propio DNI | RF15 | OK | `Rule::unique()->ignore()` evita falso duplicado. |
| CP12 | Edición de cliente intentando usar DNI de otro | RF15, RN01 | OK | Bloquea la actualización por DNI duplicado. |
| CP13 | Intento de baja lógica en cliente con dispensaciones | RF15 | OK | Bloqueado con aviso flash rojo. |
| CP14 | Baja lógica (`SoftDeletes`) en cliente sin dispensaciones | RF15, RNF04 | OK | Marca `deleted_at` y redirige al listado con aviso verde. |
| CP15 | Consulta de identificador inexistente (`/clientes/99999`) | RF15 | OK | Route model binding responde con HTTP 404. |