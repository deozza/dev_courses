# MySQL <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Définition](#définition)
- [Caractéristiques](#caractéristiques)
- [Installation](#installation)
- [Premiers pas sur le serveur](#premiers-pas-sur-le-serveur)
- [Créer une base de données](#créer-une-base-de-données)
- [Créer une table](#créer-une-table)
  - [Les types de propriétés](#les-types-de-propriétés)
  - [Les options pour les propriétés](#les-options-pour-les-propriétés)
  - [La primary key](#la-primary-key)
- [Relier des tables entre elles](#relier-des-tables-entre-elles)
- [Insérér des données](#insérér-des-données)
- [Chercher des données](#chercher-des-données)
  - [SELECT ... FROM](#select--from)
  - [WHERE](#where)
  - [ORDER BY](#order-by)
- [Les jointures de table](#les-jointures-de-table)


## Définition

## Caractéristiques

## Installation

**Sur Windows :**

Utiliser l'installateur officiel :

https://dev.mysql.com/downloads/installer/

**Sur Mac :**:

Utiliser brew. Dans un terminal : 

```bash
brew install mysql

brew tap homebrew/services

brew services start mysql

mysqladmin -u root password 'your-password'
```

**Sur Linux :**

Dans un terminal : 

```bash
sudo apt-get update -y

sudo apt-get install mysql-server

sudo systemctl start mysql

mysqladmin -u root password 'your-password'
```

**Avec Docker :**

Utiliser le docker-compose suivant :

```yml
services:
  db:
    image: mysql:latest
    container_name: db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: 'db'
      MYSQL_USER: 'user'
      MYSQL_PASSWORD: 'password'
      MYSQL_ROOT_PASSWORD: 'password'
    ports:
      - '3306:3306'
    volumes:
      - ./data:/var/lib/mysql
```

Et lancer dans un terminal :

```bash
docker compose up -d --build
```

## Premiers pas sur le serveur

Ouvrir un terminal et utiliser la commande :

```bash
mysql -u <username> -p
```

Un prompt va vous demander votre mot de passe.

**Lister les bases de données du serveur :**

```sql
show databases; 
```

**Se connecter à une base de données :**

```sql
use <database_name>; 
```

**Lister les tables d'une base :**

```sql
show tables; 
```

**Avoir les détails sur une table :**

```sql
desc <table_name>; 
```

## Créer une base de données

## Créer une table

### Les types de propriétés

| type      | description                             |
| --------- | --------------------------------------- |
| VARCHAR   | chaine de caractères                    |
| INT       | nombre entier                           |
| FLOAT     | nombre à virgule flottante              |
| BOOLEAN   | true ou false                           |
| DATETIME  | date et heure                           |
| TIMESTAMP | temps écoule en ms depuis le 01/01/1970 |

### Les options pour les propriétés

| options        | description                                                                   |
| -------------- | ----------------------------------------------------------------------------- |
| NOT NULL       | La propriété ne peut être vide                                                |
| UNIQUE         | La valeur ne peut pas être répétée dans la table                              |
| AUTO_INCREMENT | La valeur est un INT qui augmente de 1 à chaque nouvel enregistrement         |
| DEFAULT        | Spécifier quelle est la valeur par défaut si aucune n'est fournie             |
| PRIMARY KEY    | Cette propriété servira d'identifiant pour les enregistrements                |
| FOREIGN KEY    | Cette propriété servira d'identifiant pour les relations avec d'autres tables |

### La primary key

## Relier des tables entre elles

## Insérér des données

## Chercher des données

### SELECT ... FROM

### WHERE

### ORDER BY

## Les jointures de table


| options    | description |
| ---------- | ----------- |
| LEFT JOIN  |             |
| RIGHT JOIN |             |
| INNER JOIN |             |

