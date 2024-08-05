# Introduction aux bases de données <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Définition](#définition)
- [Cas d'usage](#cas-dusage)
- [Tables, propriétés et données](#tables-propriétés-et-données)
  - [Table](#table)
  - [Propriété](#propriété)
  - [Données](#données)
- [Modéliser une base de données : le MCD](#modéliser-une-base-de-données--le-mcd)

## Définition

Selon le Larousse :

> ensemble structuré et organisé de données qui représente un système d'informations sélectionnées de telle sorte qu'elles puissent être consultées par des utilisateurs ou par des programmes

Selon Oracle :

> ensemble d'informations qui est organisé de manière à être facilement accessible, géré et mis à jour. Elle est utilisée par les organisations comme méthode de stockage, de gestion et de récupération de l’informations.

Exemples de base de données dans la vie de tous les jours :

- une bibliothèque
- le cerveau
- un musée
- un frigo
- un tableur (google sheet / microsoft excel)

## Cas d'usage

**Pour une application e-commerce** :

- sauvegarder les produits et leurs descriptions
- sauvegarder les stocks
- sauvegarder les commandes passées

**Pour une messagerie instantannée** :

- sauvegarder les messages passés
- sauvegarder les fichiers envoyés
- sauvegarder les salon de discussion

**Pour un CMS comme Wordpress** :

- sauvegarder les blocs visuels du site
- sauvegarder les images, les vidéos, les fichiers audio
- sauvegarder le contenu des articles de blog

## Tables, propriétés et données

Pour faciliter la compréhension, nous ferons des analogies avec des logiciel de tableur (google sheet / microsoft excel)

### Table

Une table permet de regrouper un ensemble d'informations sur un concept précis. Ces informations sont organisées en lignes et en colonnes. Chaque colonne correspond à une propriété précise et chaque ligne correspond à une nouvelle entrée dans cette table. Il est ainsi facile de stocker, retrouver et analyser ces informations.

**Exemple :**

Pour une application e-commerce :

- table user, pour regrouper les informations sur les utilisateurs
- table product, pour regrouper les informations sur les produits vendus par ue boutique

On peut rapprocher le concept de la table en base de données à celui de la feuille de calcul dans un tableur.

Dans une base de données dite relationnelle, il est possible qu'une table soit liée à une autre. Cela permet de pouvoir regrouper des informations communes à plusieurs concepts et d'éviter de répéter des informations dans plusieurs tables.

**Exemmples :**

Pour une bibliothèque :

- table user, pour regrouper les informations sur les membres de la bibliothèque
- table book, pour regrouper les informations sur les livres proposés par la bibliothèque
- table borrow, pour regrouper les informations sur les emprunts de livre par les membres, liée à la table user (pour savoir quel membre a emprunté) et à la table book (pour savoir quel livre a été emprunté)

### Propriété

Une propriété est un type d'information qui sera stockée dans une table. Une propriété sera configurée par :

- son nom, unique dans la table
- un type, pour savoir quel genre de donnée pourra être enregistrée (nombre entier, date, chaine de caractères, ...)
- d'autres options (UNIQUE, NOT NULL, PRIMARY KEY, ...)

On peut rapprocher le concept de la propriété en base de données à celui de la colonne dans un tableur.

**Exemples :**

Pour une table `user`, on pourra avoir les propriétés suivantes :

- firstname
- lastname
- dateOfBirth
- active

| firstname | lastname | dateOfBirth | active |
| --------- | -------- | ----------- | ------ |
|           |          |             |        |

Pour une table `book`, on pourra avoir les propriétés suivantes :

- title
- author
- edition
- isbn

| title | author | edition | isbn |
| ----- | ------ | ------- | ---- |
|       |        |         |      |

### Données

Une donnée est l'enregistrement d'une information dans une propriété d'une table.

On peut rapprocher le concept de la donnée en base de données à celui de la cellule dans un tableur.

**Exemples :**

Pour une table `user`, on pourra avoir les propriétés suivantes :

| firstname | lastname | dateOfBirth | active |
| --------- | -------- | ----------- | ------ |
| John      | Doe      | 1992/08/01  | 1      |
| Jane      | Smith    | 1985/05/15  | 1      |
| Alice     | Johnson  | 1978/11/23  | 0      |
| Bob       | Brown    | 2000/02/29  | 1      |

**Les types de propriété :s**

| type      | description                             |
| --------- | --------------------------------------- |
| VARCHAR   | chaine de caractères                    |
| INT       | nombre entier                           |
| FLOAT     | nombre à virgule flottante              |
| BOOLEAN   | true ou false                           |
| DATETIME  | date et heure                           |
| TIMESTAMP | temps écoule en ms depuis le 01/01/1970 |

**Les options pour les propriétés :**

| options        | description                                                                   |
| -------------- | ----------------------------------------------------------------------------- |
| NOT NULL       | La propriété ne peut être vide                                                |
| UNIQUE         | La valeur ne peut pas être répétée dans la table                              |
| AUTO_INCREMENT | La valeur est un INT qui augmente de 1 à chaque nouvel enregistrement         |
| DEFAULT        | Spécifier quelle est la valeur par défaut si aucune n'est fournie             |
| PRIMARY KEY    | Cette propriété servira d'identifiant pour les enregistrements                |
| FOREIGN KEY    | Cette propriété servira d'identifiant pour les relations avec d'autres tables |

## Modéliser une base de données : le MCD
`