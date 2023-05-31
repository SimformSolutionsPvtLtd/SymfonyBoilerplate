# Symfony Boilerplate

#### Install Symfony bundles
```
php composer.phar install
```
OR (If you have installed the composer globally)
```
composer install
```
#### Install Node packages
Make sure that you have installed node.
```
npm install
```
#### Build JS for production
```
npm run build
```
#### Update Database
```
php bin/console do:sc:up --force
```
#### Database migration
```
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```
#### Add Fixture 
```
php bin/console doctrine:fixtures:load --append
```
---append will not delete existing data from table but it will append new data in table

If you want to add particular fixtures with group name then use below command:
```
php bin/console doctrine:fixtures:load --append --group=group1
```

#### Export route for javascript usage
```
php bin/console fos:js-routing:dump --format=js --target=public/js/fos_js_routes.js --locale=en
```
This command is added in composer json script. so if you want to export manually then you can use this command.

#### Generate the SSH keys:
```
php bin/console lexik:jwt:generate-keypair
```

#### API Lists

* Get Token from login user
```
POST URL: {url}/api/generateToken

request:
{
    "username": "beier.kristy@hudson.org",
    "password": "password"
}

response:
{
    "token": "<<JWT Token>>"
}
```
* Get Cars List
```
GET URL: {url}/api/car/list

request header:
'Authorization' => 'Bearer <<JWT Token>>'

response:
{
    "success": true,
    "message": "Article List found",
    "articleList": [
        {
            "id": 1,
            "slug": "php-class",
            "title": "PHP class",
            "description": "<p>Test <br></p>",
            "shortDescription": "this is test descr",
            "category": "Technology",
            "isPublish": true,
            "author": "admin",
            "createdAt": "2020-09-21 03:52:22"
        }
    ]
}
