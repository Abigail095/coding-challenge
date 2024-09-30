# Proyecto de gestión de Contactos

Este proyecto consiste en un script PHP que procesa un archivo CSV con datos de potenciales clientes y los ordena en función del tamaño de la empresa y el rol del contacto.

## Estructura

- `SortContacts.php`: El script PHP que realiza la lectura, procesamiento y ordenamiento de los contactos.
- `data.csv`: El archivo de entrada que contiene los datos desordenados.
- `contact_plan.csv`: El archivo de salida que contiene los contactos ordenados.

## Como ejecutar

1. Asegurarse tener PHP instalado en tu máquina.
2. Colocar `data.csv` en el mismo directorio que `SortContacts.php`.
3. Ejecutar el script con el siguiente comando:
   ```bash
   php SortContacts.php
