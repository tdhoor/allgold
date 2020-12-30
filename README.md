# Documentation

- [Documentation](#documentation)
- [Allgold](#allgold)
    - [Verkaufsstellen](#verkaufsstellen)
    - [Lieferanten](#lieferanten)
    - [Verkauf](#verkauf)
    - [Reporting](#reporting)
    - [Formulare](#formulare)
- [Init Project](#init-project)
- [Used Frameworks](#used-frameworks)
- [Routes](#routes)
  - [API for all Models](#api-for-all-models)
  - [Spezial API for Invnetories](#spezial-api-for-invnetories)
  - [Pages](#pages)

# Allgold

Allgold is a fictional company, which produces natural products like milk, cheese,... and sells them at various locations. The application simulates five different apps: 
### Verkaufsstellen
This app lists Allgold sales outlets. In addition, sales outlets can be added, edited, deleted and searched by ID or location.
### Lieferanten
This app can create new product deliveries and display their status. Product deliveries can only be created if the current amount of a product is lower than the target amount.
### Verkauf
This is a sales application. It lists all products that are currently available in a shop. These products can be added to the shopping cart and then sold.
### Reporting
**This is an external app which was developed with JAVA and XML technologies and is not available on this repository.**
This app is used for warehouse management and to create product sales and sales point statements.
### Formulare
**This is an external app which was developed with JAVA and XML technologies and is not available on this repository.**
Various forms, documents and catalogs can be printed with this app.

Testdomain: **www.thomasdorfer.com/projects/allgold**
# Init Project

- php composer.phar install
- npm install
- php artisan migrate:fresh
- php artisan db:seed

# Used Frameworks
Here is an overview of the main frameworks that were used. See all in the package.json and composer.json files.

        "bootstrap": "^4.0.0",

        "vue": "^2.6.12",
        "vue-router": "^3.4.9"

        "laravel/framework": "^8.12",
        "fakerphp/faker": "^1.9.1",

# Routes

All models use the same API routes and functions (see table [API for all Models](#api-for-all-models)). Only the inventory has two additional routes (see table [Spezial API for Invnetories](#spezial-api-for-invnetories))
The Domain for this project is: **https://www.thomasdorfer.com**


## API for all Models

| Domain | Method       | URI                                        | Controller                                        | Action        |
| ------ | ------------ | ------------------------------------------ | ------------------------------------------------- | ------------- |
|        | GET \| HEAD  | projects/allgold/api/**model**             | App\Http\Controllers\\**ModelController**@index   | get all items |
|        | POST         | projects/allgold/api/**model**             | App\Http\Controllers\\**ModelController**@store   | store item    |
|        | DELETE       | projects/allgold/api/**model**/{**model**} | App\Http\Controllers\\**ModelController**@destroy | delete item   |
|        | GET          | projects/allgold/api/**model**/{**model**} | App\Http\Controllers\\**ModelController**@show    | get item      |
|        | PUT \| PATCH | projects/allgold/api/**model**/{**model**} | App\Http\Controllers\\**ModelController**@update  | update item   |

## Spezial API for Invnetories
| Domain | Method | URI                                             | Controller                                                       | Action                                                |
| ------ | ------ | ----------------------------------------------- | ---------------------------------------------------------------- | ----------------------------------------------------- |
|        | GET    | projects/allgold/api/inventories/refillProducts | App\Http\Controllers\InventoryController@getRefill               | get all products where current amount < target amount |
|        | GET    | projects/allgold/api/inventories/allProducts    | App\Http\Controllers\InventoryController@getInventoryByStationId | get all products from one shop                        |


## Pages
| Domain | Method      | URI   | Controller                                | Action                      |
| ------ | ----------- | ----- | ----------------------------------------- | --------------------------- |
|        | GET \| HEAD | {any} | App\Http\Controllers\PageController@index | link url to frontend router |