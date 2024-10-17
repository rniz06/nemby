PASOS A SEGUIR PARA LA INSTALACION


1 - git clone https://github.com/rniz06/nemby.git

2 - cd nemby

3 - composer install

4 - copiar el archivo .env.example a .env y configurar las credenciales 

5 - php artisan key:generate

6 - php artisan migrate --seed

7 - php artisan shield:install