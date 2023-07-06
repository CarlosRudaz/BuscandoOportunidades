# BuscandoOportunidades
Diseño 2023

Pasos para descarga con 'git'
* ir a la carpeta donde queremos descargar el proyecto.
* abrir una terminal y escribir el siguiente comando:
  - git clone https://github.com/CarlosRudaz/BuscandoOportunidades.git
* creamos una nueva rama para realizar nuestros cambios:
  - git branch nombre_rama
* siempre que querramos verificar los cambios en el proyecto remoto debemos ejecutar:
  -  git fetch
* para cambiarnos de una rama a la otra ejecutamos:
  - git checkout nombre_rama
* una vez que tenemos cambios para compartir, primero los tenemos que agregar a una lista. El punto al final
* está indicando que tomamos todos los archivos que creamos o modificamos, si solamente queremos subir cambios
* de algunos archivos, los tendremos que listar separando por un espacio.
  - git add .
  - git add archivo1 archivo2 etc
* luego de generar una lista de archivos modificados/creados debemos hacer un commit:
  - git commit -m "Mensaje de commit, que resume los cambios realizados en esta rama"
* luego de hacer commit, DEBEMOS VERIFICAR QUE LA RAMA EN LA QUE REALIZAMOS LOS CAMBIOS NO SEA LA origin/main.
* en esta rama solo se suben los cambios verificados y funcionando en su totalidad.
  - git push origin/nombre_rama

