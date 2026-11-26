# Pruebas del módulo Medicamentos (Guía 04)

- **Proyecto:** Sistema Web de Control de Medicamentos, Lotes y Dispensación para Farmacia
- **Fecha:** 26/11/2026
- **Responsable:** Luz Katherinne Martinez Mamani
- **Repositorio:** https://github.com/lmartinez251ds16-art/control-farmacia

| Caso | Acción | Resultado esperado | RF / RN | Resultado |
| :--- | :--- | :--- | :---: | :---: |
| CP01 | Abrir `/medicamentos` | Lista los 21 medicamentos activos del seeder con su stock vigente (`100` c/u) y etiqueta verde. | RF08 | OK |
| CP02 | Filtrar por estado `Inactivos` / `Todos` | Muestra `0` inactivos y `21` en total. | RF09 | OK |
| CP03 | Combinar filtro de categoría + búsqueda por principio activo | Filtra únicamente medicamentos de esa categoría que coinciden con el texto (agrupación `where`). | RF08 | OK |
| CP04 | Guardar formulario `/medicamentos/create` vacío | Muestra errores en español bajo los campos obligatorios. | RF07 | OK |
| CP05 | Ingresar precio de venta o stock mínimo negativo (`-5`) | Muestra «no puede ser negativo.» | RN12, RN14 | OK |
| CP06 | Ingresar un `codigo_interno` ya existente | Muestra «Ya existe un medicamento con este código interno.» | RN02 | OK |
| CP07 | Con F12 cambiar `condicion_venta` a un valor inválido y guardar | Muestra «Seleccione una condición de venta válida.» (`Rule::in`). | RF07 | OK |
| CP08 | Seleccionar condición `Controlado` sin elegir `lista_control_id` | Muestra «Debe seleccionar una lista de control cuando el medicamento es controlado.» | RF07 | OK |
| CP09 | Registrar medicamento controlado válido con lista `IV-B` | Redirige a la ficha con aviso verde y muestra la lista asociada. | RF07 | OK |
| CP10 | Editar medicamento manteniendo su propio `codigo_interno` | Guarda cambios sin falso error de código duplicado. | RF07 | OK |
| CP11 | Editar colocando el `codigo_interno` de otro medicamento | Rechaza con mensaje de código duplicado. | RN02 | OK |
| CP12 | Desactivar un medicamento con stock vigente en la ficha | Muestra aviso con las unidades en lotes vigentes y cambia etiqueta a `Inactivo`. | RF09 | OK |
| CP13 | Activar nuevamente el medicamento | Cambia etiqueta a `Activo` con aviso verde. | RF09 | OK |
| CP14 | Ejecutar `php artisan route:list --path=medicamentos` | Confirma que no existe ruta `DELETE` (`destroy`). | RF09 | OK |