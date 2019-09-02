Configuration Note for php-assignment-zumry assignment
Foobar is a Python library for dealing with word pluralization.

Installation
pull the new branch "fixico"

run : composer update on assignment folder under fixico -> assignment

run : php artisan migrate - [ user/vehicle table *Required ]

run : php artisan db:seed for create demo user *Required

run : npm run api in json-serve folder to activate json api

run : php artisan vehicle:create - to create dummy vehicle each time this will create 1 vehicle

add JWT_SECRET=fixico@ZDEEN845445hSDSsEEW add this key in .env file (rename the .env.example)

run : php artisan serve - start server

Custom Composer Command
According to the Bonus task the app will check and fix all PSR-2 coding issues

to fix PSR-2 check and fix PSR-2 coding issues

run composer psrfix

to test PHP UNIT test

run ./vendor/bin/phpunit or composer testme

Demo Login
email : test@fixico.com
password : test
API Documentation
getallVehicles
getvehicles
updateVehicle
https://documenter.getpostman.com/view/8059329/SVfJVBYT?version=latest https://documenter.getpostman.com/view/8059329/SVfJVBhF https://documenter.getpostman.com/view/8059329/SVfKwA1d

Author
Zumry Deen - zumrydeen.prs@gmail.com
MIT
