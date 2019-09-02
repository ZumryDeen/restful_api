# Configuration Note for  php-assignment-zumry assignment 

Foobar is a Python library for dealing with word pluralization.

## Installation

1. pull  the new branch  
2. run : ```composer update ``` on assignment folder under ```fixico -> assignment ```  
3. run : ``` php artisan migrate ``` - [ user/vehicle table *Required  ]
4. run : ``` php artisan db:seed ```  for create  demo user *Required 
5. run : ``` npm run api```   in json-serve folder to activate json api
6. run : ``` php artisan vehicle:create```  - to create dummy vehicle each time this will create 1 
   vehicle  
7. add ```JWT_SECRET=fixico@ZDEEN845445hSDSsEEW ``` add this key in .env file ```(rename the .env.example)```
   
8. run : ``` php artisan serve```  - start server 

## Custom Composer Command  
According to the Bonus task the app will check and fix all PSR-2 coding issues

to fix PSR-2 check and fix PSR-2 coding issues

run ``` composer psrfix ```   

to test PHP UNIT test 

run ``` ./vendor/bin/phpunit ``` or  ``` composer testme ```

## Demo Login

1. email    : test@fixico.com
2. password : test



## API Documentation 
1. [getallVehicles ](https://documenter.getpostman.com/view/8059329/SVfJVBYT?version=latest)
2. [getvehicles](https://documenter.getpostman.com/view/8059329/SVfJVBhF)
3. [updateVehicle](https://documenter.getpostman.com/view/8059329/SVfKwA1d)

https://documenter.getpostman.com/view/8059329/SVfJVBYT?version=latest
https://documenter.getpostman.com/view/8059329/SVfJVBhF
https://documenter.getpostman.com/view/8059329/SVfKwA1d

## Author
Zumry Deen - zumrydeen.prs@gmail.com  
[MIT](https://choosealicense.com/licenses/mit/)
