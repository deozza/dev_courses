# Symfony blackjack AIP

## Table des matières

- [Symfony blackjack AIP](#symfony-blackjack-aip)
  - [Table des matières](#table-des-matières)
  - [Installation du projet](#installation-du-projet)
  - [Règles du blackjack](#règles-du-blackjack)
  - [Fonctionnalités](#fonctionnalités)
    - [Security](#security)
      - [login](#login)
    - [UserController](#usercontroller)
      - [getUserList](#getuserlist)
      - [postUser](#postuser)
      - [getCurrentUserInfos](#getcurrentuserinfos)
      - [getUserInfos](#getuserinfos)
      - [patchCurrentUserInfos](#patchcurrentuserinfos)
      - [patchUserInfos](#patchuserinfos)
      - [deleteCurrentUserInfos](#deletecurrentuserinfos)
      - [deleteUserInfos](#deleteuserinfos)
    - [GameController](#gamecontroller)
      - [createGame](#creategame)
      - [getListOfGames](#getlistofgames)
      - [getGame](#getgame)
      - [deleteGame](#deletegame)
    - [TurnController](#turncontroller)
      - [createTurn](#createturn)
      - [getTurn](#getturn)
      - [wageTurn](#wageturn)
      - [hitRound](#hitround)
      - [standRound](#standround)


## Installation du projet

Après avoir lancé `docker compose up -d --build` pour créer les containers, lancer les commandes suivantes : 

```bash
# Pour installer les dépendances du projet
docker compose exec -u 1000 symfony-blackjack composer install

# Pour réinitaliser la base de données
docker compose exec -u 1000 symfony-blackjack composer reset-db

# Pour lancer le server web
docker compose exec -u 1000 symfony-blackjack symfony serve -d
```

L'application sera disponible sur `http://localhost:8888`.

## Règles du blackjack

Le blackjack est un jeu de cartes dans lesquels 1 ou plusieurs joueurs affrontent un croupier. Le jeu se joue avec un jeu de carte classique, avec des valeurs de 1 (as) à 10, avec valet, dame et roi, et avec 4 couleurs (carreau, coeur, pique, trèfle). Le but du jeu est d'additionner les valeurs de ses cartes pour battre le score du croupier, sans dépasser le score de 21.  Un round d'une partie se déroule de la manière suivante : 

 * chaque joueur mise une somme
 * le croupier distribue 2 cartes à chaques joueurs et se distribue 1 carte
 * chacun son tour, les joueurs choisissent de tirer une nouvelle carte ou de se coucher
 * lorsque tous les joueurs ont perdus ou se sont couchés, le croupier tirent des cartes jusqu'à obtenir un score d'au moins 16
 * lorsque le croupier arrête de piocher, les gains sont distribués aux joueurs qui ont battu son score
   * si un joueur a 2 cartes, dont un as et une tête (valet, dame ou roi), il a ce qu'on appelle un blackjack. Un blackjack bat tous les autres scores et rapportent 2 fois les gains misés

## Fonctionnalités

### Security

#### login

 * url : `/login_check`
 * method : `POST`

**Description :**

Route permettant à un utilisateur de se connecter. Le payload à envoyer doit correspondre à : 

```json
{
    "username": "",
    "password": ""
}
```

### UserController

#### getUserList

 * url : `/user`
 * method : `GET`
 * paramètres optionnels : 
   * `limit` : nombre d'utilisateurs à afficher
   * `page` : placement dans la pagination

**Description :**

Route permettant d'obtenir une liste paginée de tous les utilisateurs enregistrés en BDD. Il faut que l'utilisateur qui utilise cette route soit authentifié et ait le rôle `ROLE_ADMIN`.

#### postUser

 * url : `/user`
 * method : `POST`

**Description :**

Route permettant de créer un nouveau compte utilisateur. Le payload à envoyer doit correspondre à : 

```json
{
    "username": "",
    "email": "",
    "password"
}
```

 * username :
   * chaine de caractères
   * required
   * entre 3 et 255 caractères
   * unique
 * email :
   * chaine de caractère
   * required
   * entre 3 et 255 caractères
   * doit être un format email valide
   * unique
 * password :
   * chaine de caractères
   * required
   * entre 3 et 255 caractères

La réponse doit être le détail de l'utilisateur créé.

#### getCurrentUserInfos

 * url : `/user/profile`
 * method : `GET`

**Description :**

Route permettant d'obtenir les informations de l'utilisateur. Il faut que l'utilisateur qui utilise cette route soit authentifié.

#### getUserInfos

 * url : `/user/{uuid}`
 * method : `GET`

**Description :**

Route permettant d'obtenir les informations d'un utilisateur selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié avec le role `ROLE_ADMIN`.

#### patchCurrentUserInfos

 * url : `/user/profile`
 * method : `PATCH`

**Description :**

Route permettant de modifier les informations de l'utilisateur. Il faut que l'utilisateur qui utilise cette route soit authentifié. Voir [postUser](#postuser) pour connaître les contraintes du payload

#### patchUserInfos

 * url : `/user/{uuid}`
 * method : `PATCH`

**Description :**


Route permettant de modifier les informations d'un utilisateur selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié avec le role `ROLE_ADMIN`. Voir [postUser](#postuser) pour connaître les contraintes du payload

#### deleteCurrentUserInfos

 * url : `/user/profile`
 * method : `DELETE`

**Description :**

Route permettant de supprimer l'utilisateur. Il faut que l'utilisateur qui utilise cette route soit authentifié.

#### deleteUserInfos

 * url : `/user/{uuid}`
 * method : `DELETE`

**Description :**

Route permettant de supprimer un utilisateur selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié avec le role `ROLE_ADMIN`.

### GameController

#### createGame

 * url : `/game`
 * method : `POST`

**Description :**

Route permettant de créer une nouvelle partie de blackjack. Il faut que l'utilisateur qui utilise cette route soit authentifié

#### getListOfGames

 * url : `/game`
 * method : `GET`
 * paramètres optionnels : 
   * `limit` : nombre d'utilisateurs à afficher
   * `page` : placement dans la pagination

**Description :**

Route permettant d'obtenir une liste paginée de toutes les parties enregistrées en BDD. Il faut que l'utilisateur qui utilise cette route soit authentifié et ait le rôle `ROLE_ADMIN`.

#### getGame

 * url : `/game/{gameId}`
 * method : `GET`

**Description :**

Route permettant d'obtenir les informations d'une partie selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à la partie.

#### deleteGame

 * url : `/game/{gameId`
 * method : `DELETE`

**Description :**

Route permettant de supprimer une partie selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à la partie.

### TurnController

#### createTurn

 * url : `/game/{gameId}/turn`
 * method : `POST`

**Description :**

Route permettant de lancer un nouveau round d'une partie en cours selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à la partie.

#### getTurn

 * url : `/turn/{uuid}`
 * method : `GET`

**Description :**

Route permettant à un utilisateur d'obtenir les informations sur un round. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à ce round.

#### wageTurn

 * url : `/turn/{uuid}/wage`
 * method : `PATCH`

**Description :**

Route permettant à un utilisateur de miser pendant un round selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à ce round. Il faut également que le round n'ai pas déjà une mise.

Une fois les mises de tous les joueurs enregistrées, chaque joueur pioche 2 cartes du paquet, et le croupier pioche 1 carte du paquet.

#### hitRound

 * url : `/turn/{uuid}/hit`
 * method : `PATCH`

**Description :**

Route permettant à un utilisateur de tirer une carte pendant un round, selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à ce round. Il faut également que tous joueurs aient déjà misés et que les cartes de base aient été piochées.

Une fois la carte piochée, le score est calculé pour savoir si le joueur a un score trop élevé et a perdu.

#### standRound

 * url : `/turn/{uuid}/stand`
 * method : `PATCH`

**Description :**

Route permettant à un utilisateur de se coucher pendant un round, selon son uuid. Il faut que l'utilisateur qui utilise cette route soit authentifié et participe à ce round. Il faut également que tous joueurs aient déjà misés et que les cartes de base aient été piochées.

Lorsque tous les joueurs ont perdu ou se sont couchés, les gains son distribués et le round se termine.