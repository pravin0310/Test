First => composer install

Second =>Create DataBase in your Local server wampp or xampp.

Third =>.env File change DB_DATABASE:Your DataBase
                 DB_USERNAME: Your DB User Name
                 DB_USERNAME:Your DB Password

Fourth => php artisan key:generate

Fifth => php artisan migrate

Sixth => php artisan db:seed

Seventh => php artisan serve

Eight => copy The url In command line To paste the browser(like http://127.0.0.1:8000)

Nineth =>Then Login userName:admin@gmail.com
           password:password