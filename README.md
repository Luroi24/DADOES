<<<<<<< HEAD
# DADOES
## Do Androids Dream of Electric Sheep?
Softserve's Crash Course Project
=======
# Do Androids Dream Of Electric Sheep?
Bienvenidos, este es el repositorio creado para llevar a cabo el proyecto asignado en el Crash Course en DevOps.


## Instalación del proyecto

Para instalar este proyecto se recomienda contar con Laragon ya que de este modo la instalación será más cómoda.
Los pasos a seguir para la instalación son los siguientes:
- Clonar repositorio utilizando el CLI.
	> git clone https://github.com/Luroi24/DADOES.git
- Una vez clonado, dirigirse a la ruta creada.
	> cd DADOES
- Instalar las dependencias necesarias mediante Composer.
	> composer install
- Copiar el archivo .env.example y renombrarlo .env
	> cp .env.example .env
- Abrir el archivo .env en su editor de texto y configurar las credenciales necesarias
- Crear la app key utilizando Artisan.
	> php artisan key:generate
- Ejecutar las migraciones.
	> php artisan migrate
- Instalar dependencias y paquetes node.
	> npm install && npm run build
- Ejecutar el servidor virtual para acceder al proyecto.
	> En caso de utilizar Laragon inicie los servicios de este.
	> En caso de no utilizar Laragon podrá encender el servidor virtual utilizando php artisan serve
>>>>>>> main
