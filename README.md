## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Status](#status)
* [Installation](#installation)

## General info
This repository is a solution for the Mid-level Laravel Developer test at Vue School. 
## Technologies
* Laravel 11
* sqlite db

## Status
The project is: completed

## Installation
* clone the project
* cd inside the project
* run cp .env.example .env
* run php artisan key:generate
* run composer install
* touch database/database.sqlite
* run php artisan migrate
* run php artisan db:seed (to seed fake users data)
* run php artisan user:update (to update user attributes)
* run php artisan schedule: run (to run the command that is responsible for sending the updated user data to providers)
* run php artisan serve
