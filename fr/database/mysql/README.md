# MySQL <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Définition](#définition)
- [Caractéristiques](#caractéristiques)
- [Installation](#installation)
- [Premiers pas sur le serveur](#premiers-pas-sur-le-serveur)
- [Créer une base de données](#créer-une-base-de-données)
- [Supprimer une base de données](#supprimer-une-base-de-données)
- [Créer une table](#créer-une-table)
  - [Les types de propriétés](#les-types-de-propriétés)
  - [Les options pour les propriétés](#les-options-pour-les-propriétés)
  - [La primary key](#la-primary-key)
- [Relier des tables entre elles](#relier-des-tables-entre-elles)
- [Supprimer une table](#supprimer-une-table)
- [Modifier une table](#modifier-une-table)
- [Insérér des données](#insérér-des-données)
- [Chercher des données](#chercher-des-données)
  - [SELECT ... FROM](#select--from)
  - [WHERE](#where)
  - [ORDER BY](#order-by)
  - [LIMIT](#limit)
  - [Les opérations mathématiques](#les-opérations-mathématiques)
  - [Les opérations sur chaines de caractères](#les-opérations-sur-chaines-de-caractères)
  - [GROUP BY](#group-by)
  - [HAVING](#having)
- [Les jointures de table](#les-jointures-de-table)
- [Mettre à jour des données](#mettre-à-jour-des-données)


## Définition

## Caractéristiques

## Installation

**Sur Windows :**

Utiliser l'installateur officiel :

https://dev.mysql.com/downloads/installer/

Ou installer wamp :

https://wampserver.aviatechno.net/

**Sur Mac :**:

Utiliser brew. Dans un terminal : 

```bash
brew install mysql

brew tap homebrew/services

brew services start mysql

mysqladmin -u root password 'your-password'
```

Ou installer xampp :

https://www.apachefriends.org/fr/index.html

**Sur Linux :**

Dans un terminal : 

```bash
sudo apt-get update -y

sudo apt-get install mysql-server

sudo systemctl start mysql

mysqladmin -u root password 'your-password'
```

Ou installer lamp :

https://doc.ubuntu-fr.org/lamp

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

```sql
CREATE DATABASE first_database;
```

## Supprimer une base de données

```sql
DROP DATABASE table IF EXISTS
;
```

## Créer une table

```sql
CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    dateOfBirth DATE
);
```

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

Une clef primaire est un moyen d'identifier une entrée dans une table. Cette option permet également de rapidement accéder à cette entrée si on utilise la propriété associée, car celle-ci sera indexée dans le système. 

Utiliser primary key implique que la propriété associée devra : 

- avoir des valeurs uniques
- être non null

## Relier des tables entre elles

Pour représenter la relation MCD entre deux tables, il faut dans un premier temps repérer quelle table "possède" la relation. Ensuite, il faut rajouter une propriété dans cette table qui pourra faire le lien avec l'autre table de la relation. Enfin, rajouter dans la table possédant la relation une ligne suivant le modèle : 

```sql
FOREIGN KEY (propriété_locale) REFERENCES table(propriété_étrangère)
```

**Exemple :**

```sql
CREATE TABLE class (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL
)

CREATE TABLE students (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    dateOfBirth DATE,
    class_id INT,
    FOREIGN KEY (class_id) REFERENCES class(id)
);
```

## Supprimer une table

**Supprimer avec les données :**

```sql
DROP TABLE table IF EXISTS
;
```

**Uniquement supprimer les données :**

```sql
TRUNCATE TABLE table IF EXISTS
;
```

## Modifier une table

**Rajouter une colonne dans une table :**

```sql
ALTER TABLE table
ADD nom_colonne type_donnees
;
```

**Supprimer une colonne d'une table :**

```sql
ALTER TABLE table
DROP nom_colonne
;
```

**Modifier une colone d'une table :**

```sql
ALTER TABLE table
MODIFY nom_colonne type_donnees
;
```

## Insérér des données

Syntaxe :

```sql
INSERT INTO table(property1, property2, property3, ...) VALUES ('value1', 'value2', 'value3', ...);
```

## Chercher des données

### SELECT ... FROM

Syntaxe :

```sql
SELECT property1, property2, ... FROM table;
```

```sql
SELECT * FROM table;
```

### WHERE

Syntaxe :

```sql
SELECT property1, property2, ... FROM table WHERE property4 = condition;
```

| comparateur  | description                        |
| ------------ | ---------------------------------- |
| =            | vaut exactement                    |
| >            | est strictement supérieur à        |
| >=           | est supérieur ou égal à            |
| <            | est strictement inférieur à        |
| LIKE '%...'  | chaine de caractère finissant par  |
| LIKE '...%'  | chaine de caractère commençant par |
| LIKE '%...%' | chaine de caractère contenant      |
| BETWEEN      | est entre                          |

### ORDER BY

```sql
SELECT property1, property2, ... FROM table WHERE property4 = condition ORDER BY property3;
```

| comparateur | description                                           |
| ----------- | ----------------------------------------------------- |
| ASC         | ascending => sens croissant (comportement par défaut) |
| DESC        | descending => sens décroissant                        |

### LIMIT

Pour limiter le nombre de résultats obtenus par la requête.

```sql
SELECT property1, property2, ... FROM table WHERE property4 = condition LIMIT 1;
```

Associé à l'ORDER BY, permet d'obtenir la dernière entrée d'une table :

```sql
SELECT property1, property2, ... FROM table WHERE property4 = condition ORDER BY id DESC LIMIT 1;
```

### Les opérations mathématiques

| opérateurs                | description                       |
| ------------------------- | --------------------------------- |
| AVG(property)             | moyenne                           |
| MAX(property)             | valeur maximale                   |
| MIN(property)             | valeur minimale                   |
| FLOOR(property, decimals) | arrondi à l'inférieur             |
| CEIL(property, decimals)  | arrondi au supérieur              |
| COUNT(property)           | nombre d'occurences dans la table |


### Les opérations sur chaines de caractères

| opérateurs                                 | description                                        |
| ------------------------------------------ | -------------------------------------------------- |
| LENGTH(property)                           | taille d'une chaine de caractères                  |
| UPPER(property)                            | met la chaîne en majuscule                         |
| LOWER(property)                            | met la chaîne en minuscule                         |
| CONCAT(string1, string2)                   | concatène plusieurs chaînes de caractères          |
| SUBSTR(value, startAt, numberOfCharacters) | Extrait une sous-chaine de caractères d'une chaine |

### GROUP BY

Utilisé pour grouper les résultats d'une requête entre une ou plusieurs tables, souvent utilisé avec des aggrégateurs mathématiques. Par exemple : 

*Requête pour savoir de quelles villes viennent le plus les clients d'une applicationn*

```sql
SELECT COUNT(City), City
FROM Customers
GROUP BY City
ORDER BY COUNT(City) DESC
;
```

### HAVING

Il est impossible de faire un `SELECT` après un `GROUP BY`. Donc on utilise `HAVING` :

*Requête pour savoir de quelles villes viennent le plus les clients d'une applicationn, en ne prenant en compte que les villes avec plus de 10 caractères dans leur nom*

```sql
SELECT COUNT(City), City
FROM Customers
GROUP BY City
HAVING LENGTH(City) > 10
ORDER BY COUNT(City) DESC
;
```

## Les jointures de table

```sql
SELECT property1, property2, propertyA, propertyB... 
FROM table_a 
INNER JOIN table_b ON table_a.id = table_b.table_a_id;
```

| options    | description                                                    |
| ---------- | -------------------------------------------------------------- |
| LEFT JOIN  | au moins la partie gauche de la jointure répond à la condition |
| RIGHT JOIN | au moins la partie droite de la jointure répond à la condition |
| INNER JOIN | les deux parties de la jointure répondent à la condition       |

## Mettre à jour des données

```sql
UPDATE TABLE
SET property1 = value
WHERE property2 > condition 
;
```