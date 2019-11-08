# Prueba Mumablue

**Version 1.0.0**

This project was created for practicing with PHP MVC pattern and OOP.

This project consists in creating a simple virtual store.

The user can register, login, edit his profile and billing info,
add products to cart, manage his orders.

There is an admin role that in addition of regular users actions, it 
also can manage all orders, add new products, edit existing ones, 
manage the categories.

## Tasks done

- `MVC Structure` Created and separated the Model Views and Controllers in propper folders 
- `DB configuration` Setting up the configuration file to connect with database 
- `Shopping Cart - Controllers:` Created next controllers: Cart, User, Order, Product, Category, Error  
- `Shopping Cart - Models:` Created next controllers: User, Product, Category, Order  
- `Shopping Cart - Views:` For each Controller there is a necesary view to show the content   
- `Helpers:` It's a class that contains the necesary methods that are shared between controllers 
- `Lib:` Contains the external libraries that are used 

## Tasks to do

- `Flash messages` To create and fix all slash messages(success, warning and error messages). 
- `Base Url` Fix the application base url that is used. The application starts at the root of domain.
In case that the application is set in a subfolder the files(controllers, models, views) must be
pointing for that subfolder. It is resolved by using the constant `BASE_URL` in 
all the project(all assets, scripts, views).
- `Email notifications` There must be a email notification for the user. It is a must for 
registration action, confirmation when the order is completed, when the password is replaced...

## How to run Application

1. First of all you need to import the database.
2. Config the /config/db.php file.
3. Config the parameters.php file with your needs.

!!! For a well working project, it is necesary to move/upload the project in the root of the domain !!!
In other case the `Base Url` task must to be solved. 

## Contributors

- Roma Bilibov <romabilibov@gmail.com>

--- 
Created By Roma Bilibov
