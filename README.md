<h1 align="center" id="title">InstagramClone</h1>

<div align="center">
    <img src="https://portfolio-migue-rasgado.netlify.app/build/img/selfie.webp" alt="project-image">
</div>

<p id="description">

   In this project, an Instagram clone was created with basic functionalities as login, registration, user search, posts, likes, followers and comments.

</p>


## Table of Contents

- [Demo](#demo)
- [Features](#features)
- [Getting Started](#getting-started)
  - [Database configuration](#database-configuration)
    - [Laravel internal tables](#laravel-internal-tables)
  - [Project packages](#project-packages)
  - [Local environment variables](#local-environment-variables)
  - [Use project](#use-project)
  - [Docker with Laravel Sail](#docker-with-laravel-sail)
  - [Folders](#folders)
  - [Built with](#built-with)
- [Learn more](#learn-more)
- [License](#license)


## Demo

To see the demo of the project you can access the following link [Instagram-clone](https://yisjice.sao.dom.my.id/)


## Features

Some of the project's features:

*   Data application is saved in a MySQL database.
*   Project was made using Laravel framework with The Model-View-Controller (MVC) pattern.
*   Tailwind CSS framework is used for the design and styles of the page.


## Getting Started

Clone and save the repository or download ZIP folder.

```bash
git clone git@github.com:MGLA13/instagram-clone.git
```

### Database configuration

Create a database in MySQL with the name: **instagramclone**.

Import `sql/data.sql` into your MySQL management or access to mysql in your terminal and run every query.

The tables of the database are:

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tableUsers.png)

**users** table for save the information of the users.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tablePost.png)

**posts** table for save the publications that users make.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tableCommentaries.png)

**commentaries** table for save the commentaries of a publication.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tableLikes.png)

**likes** table for save the likes number of a publication.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tableFollowers.png)

**followers** table for save the users followers of other users.


### Laravel internal tables

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tableFailedJobs.png)

**failed_jobs** table for save information about jobs that failed to be processed by the Laravel job queue.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tableMigrations.png)

**migrations** table to track which database migrations have already been run.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tablePasswordReset.png)

**password_reset_tokens** table to save tokens when the user request a reset password.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/tablePersonalAccess.png)

**personal_access_tokens** table for save personal access tokens generated for API authentication.


### Project packages

Open the project in a some code editor as VS Code.

Open a new terminal in the editor. 

Install NPM packages:

```bash
npm install
```

Install PHP packages:

```bash
composer install
```


### Local environment variables

Copy `.env.example` to create a new file named **.env** to set local environment variables:

```bash
cp .env.example .env
```

You need modify the values ​​of some environment variables to configure your development environment.

Database connection.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/databaseVariables.png)

SMTP service to send users password reset emails.

![](https://raw.githubusercontent.com/MGLA13/instagram-clone/main/imgs/smtpVariables.png)


### Use project

Generate a new application key:

```bash
php artisan key:generate 
```

Run the database migrations including the seeders and factories that are found in folder `database`:

```bash
php artisan migrate --seed
```

Start the local development server:

```bash
php artisan serve
```

Open your browser and access to [localhost](http://localhost/) and check the web application.


### Docker with Laravel Sail

After clone repository or download ZIP folder.

Open a new terminal and access to the folder project, remember the route when you saved the project.

```bash
cd instagram-clone
```

Copy `.env.example` to create a new file called **.env**, remember to set the local environment variables seen.

```bash
cp .env.example .env
```

Install NPM packages:

```bash
docker-compose exec laravel.test npm install
```

Install PHP packages:

```bash
docker-compose exec laravel.test composer install
```

Generate a new application key:

```bash
docker-compose exec laravel.test php artisan key:generate
```

Run the database migrations with the seeders and factories:

```bash
docker-compose exec laravel.test php artisan migrate --seed
```

Start Docker containers with Sail:

```bash
./vendor/bin/sail up
```

Compile CSS and JS files

```bash
./vendor/bin/sail npm run dev
```

Open your browser and access to [localhost](http://localhost/) to view the page.

You can stop running the application:

```bash
./vendor/bin/sail down
```


### Folders

*   `app/Http/Controllers` Contains all the controllers
*   `app/Livewire` Contains all the livewire components
*   `app/Mail` Contains all the controllers
*   `app/Models` Contains all the models
*   `app/Policies` Contains all the policies
*   `app/View/Components` Contains all the components
*   `config` Contains all the application configuration files
*   `database/factories` Contains all the database factories
*   `database/migrations` Contains all the database migrations
*   `imgs` Contains used images in README.md
*   `public` To run the project, includes index.php, images, also CSS and JS files
*   `resources` Contains CSS and JS files to compile
*   `resources/views` Contains all the views
*   `routes/web.php` Contains all valid url´s
*   `tests` Contains all the application tests
*   `docker-compose.yml` Docker compose configuration file
*   `tailwind.config.js` Tailwind CSS configuration file
*   `vite.config.js` Vite configuration file


### Built with

Technologies used in the project:

*   Html5
*   JavaScript
*   Tailwind CSS 3.4
*   Docker 26.0.0
*   Laravel Sail 8.2
*   MySql 8.0.32


## Learn More

* [MySQL](https://www.mysql.com/) - DBMS to create database
* [Laravel](https://laravel.com/) - About more Laravel 
* [Laravel Sail](https://laravel.com/) - For interacting with Docker
* [Tailwind](https://tailwindcss.com/) - Framework for design and styles 
* [Docker](https://www.docker.com/) - Docker for container application development 
* [MVC pattern](https://developer.mozilla.org/en-US/docs/Glossary/MVC) - MVC documentation
* [SMTP](https://aws.amazon.com/es/what-is/smtp/) - SMTP service explication


## License:

> This project is licensed under the MIT License.
