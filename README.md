# Ten Degrees Workshop
### How to install

```sh
docker-composer build
docker-compose up -d
docker exec -it ten-degrees_app bash
php artisan storage:link
cp .env.example .env  //set your database configuration
php artisan jwt:secret
php artisan migrate
```

### Used Packages for JWT and Pdf creation
- tymon/jwt-auth
- barryvdh/laravel-dompdf

### Postman Collocation

Included ./Ten-degrees.postman_collection.json

Share Collection Link : https://www.getpostman.com/collections/2655f37278857510347b

### Postman Online Docs

https://documenter.getpostman.com/view/9347560/TzJsfJSt

### End-Points

| End-point | Do |
| ------ | ------ |
| auth/register | Registering new user on system |
| auth/login | Login user  |
| /tweet | Posting new tweet |
| /follow | Follow another user |
| /report | Generate PDF report |

### Tests
```sh
vendor/bin/phpunit
```

