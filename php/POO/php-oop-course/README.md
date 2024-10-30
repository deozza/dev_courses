# Object Oriented Programing in PHP exercices <!-- omit in toc -->

## Table of contents <!-- omit in toc -->

- [Requirements](#requirements)
- [How to install](#how-to-install)
- [How to do the exercices](#how-to-do-the-exercices)
  - [Check your results](#check-your-results)
    - [Manual checks](#manual-checks)
    - [Automated checks](#automated-checks)
- [Exercices](#exercices)
  - [Exercice 1](#exercice-1)
  - [Exercice 2](#exercice-2)
  - [Exercice 3](#exercice-3)
  - [Exercice 4](#exercice-4)
  - [Exercice 5](#exercice-5)
  - [Exercice 6](#exercice-6)
  - [Exercice 7](#exercice-7)
  - [Exercice 8](#exercice-8)
  - [Exercice 9](#exercice-9)
  - [Exercice 10](#exercice-10)
  - [Exercice 11](#exercice-11)
  - [Exercice 12](#exercice-12)
  - [Exercice 1x](#exercice-1x)
  - [Exercice 1xx](#exercice-1xx)
  - [Exercice 1xxx](#exercice-1xxx)
  - [Exercice 1xxxx](#exercice-1xxxx)
  - [Exercice 1xxxxx](#exercice-1xxxxx)
  - [Exercice 1xxxxxx](#exercice-1xxxxxx)
  - [Exercice 1xxxxxxx](#exercice-1xxxxxxx)

## Requirements

- `docker` and `docker compose` must be installed to use this template
- you must have basic knowledge of PHP

## How to install

1. `git clone https://github.com/deozza/php-oop-course`
2. `cd php-oop-course`
3. `docker compose up -d --build`
4. `docker compose exec php-oop-course composer install`

Check that your installation was successful by executing :

```bash
docker compose exec php-oop-course ./vendor/bin/phpunit ./tests/DummyTest.php
```

You should have the following result :

```bash
PHPUnit 11.3.1 by Sebastian Bergmann and contributors.

Runtime:       PHP 8.2.22

.                                                                   1 / 1 (100%)

Time: 00:00.009, Memory: 6.00 MB

OK (1 test, 1 assertion)
```

## How to do the exercices

This repository is based on TDD. Tests asserting you have answered correctly are already written. You can assume you have answered as you should have by executing the tests and none of them are failing.

In order to use this system, you will need to follow closely the instructions of each exercice. This is also true for naming your folders, your files, your classes, etc.

All your code must be located in the `app/src` folder.

### Check your results

#### Manual checks

If you want to check your code manually, you could use the `app/src/index.php` file and use your code inside.

You can then use the following command to execute the code in this file :

```bash
docker compose exec php-oop-course php -f src/index.php
```

You can also open your browser and navigate to the `127.0.0.1:8080/src/index.php` to check your code.

#### Automated checks

If you want to check you have completed that exercice, use the following command :

```bash
docker compose exec php-oop-course ./vendor/bin/phpunit tests/Exercice3
```

If you want to check you have completed all the exercices, use the following command :

```bash
docker compose exec php-oop-course ./vendor/bin/phpunit tests
```

## Exercices

### Exercice 1

> Create a new class named `Product`. You should be able to instanciate a new object of this class.

### Exercice 2

> In your precedent class `Product`, add the following properties
>
> - name
> - price
> - dateOfRelease

### Exercice 3

> Modify your precedent class `Product` so its properties has default values : 
>
> - name : "New product"
> - price : 9.99
> - dateOfRelease : the date of today

### Exercice 4

> In your precedent class `Product`, change your properties so that `name` could only be assigned characters, `price` numbers and decimals, `dateOfRelease` a date

### Exercice 5

> In your precedent class `Product`, add typed `getter` and `setter` for each of the properties

### Exercice 6

> In your precedent class `Product`, find a way to return the name of the product with the first letter capitalized

### Exercice 7

> Create a new class named `User`. This class would have the properties :
>
> - firstname
> - lastname
> - birthday
>
> This class would have getter and setters for all its properties.
>
> Then create another class named `DateCalculator`. This class would have a method called `getDaysBetweenTwoDates`. It takes two dates and calculate number of days between them. For example, if the given dates are `2024 October 31th` and `2024 October 26th`, the method would return `360` .
>
> Then create another class named `BirthdayPlanner`. This class would have a method called `getNextBirthdayMessage`. It takes a user as argument and would display the following message : `Hello <firstname> <lastname> ! There are <numberOfDays> days until your next birthday.`.

### Exercice 8

> Create a new class named `Square`. This class would have a property named `length`, typed as a float. It would also have a setter and a getter. It would also have a method `getArea` to calculate and return the area.

### Exercice 9

> Write a PHP CLI script. It would take as input the dimesion of a square. It would then echo the area of the square.

### Exercice 10

> Create a new class named `Rectangle`. This class would have a property named `length` and `width`, typed as a float. It would also have a setter and a getter. It would also have a method `getArea` to calculate and return the area.

### Exercice 11

> Adapt the CLI script to let the user chose between a square and a circle

### Exercice 12

> Use polymorphism to simplify the CLI script. You will write an abstract class named `Shape` with an abstract methods called `getArea`, `getDimensionsNames` and `setDimensions`.
> Create a new class named `Circle` and add it as a choice of the CLI script

### Exercice 1x

> Something to do with extends on user (for employee, client, secretary, ...)

### Exercice 1xx

> Something to do with a login page

### Exercice 1xxx

> Implement form validator for the login page

### Exercice 1xxxx

> Create a logger when login is unsuccessful. Make it a singleton

### Exercice 1xxxxx

> Create a db connexion 

### Exercice 1xxxxxx

> Make db requests for select, insert, update, delete

### Exercice 1xxxxxxx

> Make it into a ORM