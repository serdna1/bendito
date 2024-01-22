# Ben Dito

[Deployed here](https://ben-dito.000webhostapp.com/)

## Intructions to reproduce the app in your local machine
### Requirements
- PHP
- MySQL
### Install dependencies
```
composer install
```
### Create database
Create an .env file inside the includes dir and fill it with your database parameters. For example:
```
DB_HOST = localhost
DB_USER = root
DB_PASS = 
DB_NAME = bendito_db
```
The database only has the users table:
```
create database bendito_db;

use bendito_db;

create table users (
	user_id int not null auto_increment,
    username varchar(50),
    email varchar(50),
    password varchar(60),
    primary key(user_id)
);
```
### Run server
Navigate to de public directory and execute the next line:
```
php -S localhost:3000
```
Then you just have to navigate to 'localhost:3000'.