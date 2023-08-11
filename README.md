# Collaborative Core API (Laravel)
> The **Collaborative Core API** is supported with **Laravel** and contains the following services:
> * `Company Services`
> * `Campus Services`
> * `Talent Services`
> * `Community Services`

## Table of Contents
* [Requirements](#requirements)
* [Run Program](#run-program)
* [Unit Testing](#unit-testing)
* [Submission to Devcode](#submission-to-devcode)
* [Development Guide](#development-guide)
* [Project Status](#project-status)
* [Author](#author)

## Requirements
* [Git](https://git-scm.com/book/en/v2/Getting-Started-Installing-Git)
* [Composer](https://getcomposer.org/)
* [Laravel](https://laravel.com/)
* Docker
    * [On Windows](https://docs.docker.com/desktop/install/windows-install/)
    * [On Mac](https://docs.docker.com/desktop/install/mac-install/)
    * [On Linux](https://docs.docker.com/desktop/install/linux-install/)

## Run Program
* Using Local Machine (Windows)
  * Create new database (on MYSQL) as `<database_name>`
  * Copy `.env.example` to `.env` in `src` folder
    * Update `MYSQL_DBNAME` configuration as `<database_name>`
    * Update `MYSQL_PASSWORD` configuration as `<your_mysql_password>`
  * Direct your path to `src` directory

    ```
    cd src
    ```
  * Install all the package dependencies
    
    ```
    composer install
    ```
  * Migrate database tables
    
    ```
    php artisan migrate
    ```
  * Start the program
    
    ```
    php artisan serve --host=0.0.0.0 --port=3030
    ```
  * Open the path on your local machine
    
    ```
    http://localhost:3030/api/
    ```

* Using Docker 
  * Copy `.env.example` to `.env` 
  * Build the Backend API Service docker image. If you don't specify the `<tag>`, it will be tagged as `latest` by default

    ```
    docker build -t <image_name>:<tag> .
    ```
  * Configure `docker-compose.yaml`, adjust the script below according to your built docker image

    ```
    ...
    backend-api-service: 
      image: <image_name>:<tag>
      restart: always
      ports:
        - 8080:3030
    ...
    ```
  * Run `docker-compose.yaml` file, it may take a few minutes and re-attempts.

    ```
    docker-compose -f docker-compose.yaml up
    ```
  * Open the path on your local machine
      
    ```
    http://localhost:8080/api/
    ```

## Unit Testing
* _TODO HERE_

## Submission to Devcode
* _TODO HERE_

## Development Guide
* Migrate database tables

    ```
    php artisan migrate
    ```
* Run the program

    ```
    php artisan serve --host=0.0.0.0 --port=3030
    ```

## Project Status
* Project is: _in progress_

## Author
<table>
    <tr>
      <td><b>Name</b></td>
      <td><b>GitHub</b></td>
    </tr>
    <tr>
      <td>Rava Naufal Attar</td>
      <td><a href="https://github.com/sivaren">sivaren</a></td>
    </tr>
    <tr>
      <td>Suryanto Tan</td>
      <td><a href="https://github.com/SurTan02">SurTan02</a></td>
    </tr>
    <tr>
      <td>Steven Alexander Wen</td>
      <td><a href="https://github.com/loopfree">loopfree</a></td>
    </tr>
</table>
