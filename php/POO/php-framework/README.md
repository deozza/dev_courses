# PHP Framework

## Table of content

- [PHP Framework](#php-framework)
  - [Table of content](#table-of-content)
  - [Step 1](#step-1)
  - [Step 2](#step-2)
  - [Step 3](#step-3)
  - [Step 4](#step-4)
  - [Step 5](#step-5)
  - [Step 6](#step-6)
  - [Step 7](#step-7)
  - [Step 8](#step-8)

## Step 1

**Obejctive :** initialize the docker containers

Execute the following command to initialize the project :

```bash
docker compose up -d --build
```

Composer is the package manager for PHP. It is used to download bundles and libraries other developer made and to set up our own php project. We will use it for the PSR-4 autoloader it brings.

```bash
docker compose exec php-framework composer init
```

## Step 2

**Objective :** set up the redirections.

The purpose of a router is to manage all the incoming requests from clients and redirect them to according functions, in dedicated files. Therefore, we need a single entrypoint for all the requests. We are using a `.htaccess` file for that.

## Step 3

**Objective :** get the requests informations

**Objective :** move the request informations in a dedicated class

## Step 4

**Objective :** setup the config to list all the routes the application will handle, and what controller will process them

## Step 5

**Objective :** We want to check if the URI matches something in our route config, and if so we can have a controller name

**Objective :** move the router loop inside a dedicated class, and extract sub-functionnalities into dedicated functions

## Step 6

**Objective :** use the router to call a controller class according to the route config

## Step 7

**Objective :** use polymorphism and abstract class to provide a safe and reusable template for the controllers. Move the logic from index.php into the router

## Step 8

**Objective :** create a universal response object all controllers must return