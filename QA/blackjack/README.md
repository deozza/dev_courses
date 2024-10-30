# Blackjack - Une application en Symfony et en Sveltekit pour s'entrainer à la QA

## Table des matières

- [Blackjack - Une application en Symfony et en Sveltekit pour s'entrainer à la QA](#blackjack---une-application-en-symfony-et-en-sveltekit-pour-sentrainer-à-la-qa)
  - [Table des matières](#table-des-matières)
  - [A propos](#a-propos)
  - [Comment installer](#comment-installer)
      - [Installer la partie symfony](#installer-la-partie-symfony)
      - [Lancer le serveur de développement symfony](#lancer-le-serveur-de-développement-symfony)
      - [Installer la partie Sveltekit](#installer-la-partie-sveltekit)
      - [Lancer le serveur de développement sveltekit](#lancer-le-serveur-de-développement-sveltekit)
  - [Objectif](#objectif)


## A propos

Ceci est un repository pour s'exercer à l'écriture de tests pour une application backend et une application frontend. il permettra de mettre à l'épreuve vos connaissances et votre rigueur en matière de test d'applications.

## Comment installer

**Pré-requis :**

 * docker engine
 * docker-compose

Pour initialiser le projet, veuillez faire un fork du repository sur votre compte. Puis, lancer les commandes suivantes :

```bash
git clone https://github.com/<your-username>/blackjack

cd blackjack

docker-compose up -d --build
```

#### Installer la partie symfony

```bash
docker-compose exec -u 1000 symfony-blackjack composer install
docker-compose exec -u 1000 symfony-blackjack php bin/console lexik:jwt:generate-keypair
docker-compose exec -u 1000 symfony-blackjack composer reset-db
```

#### Lancer le serveur de développement symfony

```bash
docker-compose exec -u 1000 symfony-blackjack symfony serve
```

L'application sera disponible à l'url `http://127.0.0.1:8888` (ou un autre port si vous avez changé la configuration du service dans le `docker-compose.yml`).

Un compte utilisateur est déjà créé : 
 * username : admin
 * email: admin@gmail.com
 * password: admin

#### Installer la partie Sveltekit

```bash
docker-compose exec -u 1000 svelte-blackjack npm install
```

#### Lancer le serveur de développement sveltekit

```bash
docker-compose exec -u 1000 svelte-blackjack npm run dev -- --host
```

L'application sera disponible à l'url `http://127.0.0.1:5173` (ou un autre port si vous avez changé la configuration du service dans le `docker-compose.yml`).

## Objectif

Vous faites partie de la nouvelle équipe de QA d'une start-up de jeu en ligne. Le CTO souhaite vérifier que son application réponde aux spécifications de son cahier des charges. Ce cahier des charges vous est fourni sous la forme d'un [readme](./symfony-blackjack/README.md) pour la partie backend et de [maquettes](./svelte-blackjack/doc/models/) pour la partie frontend.

L'application a été développée avec Symfony 7 pour son backend et Sveltekit (avec un pack UI Skeleton et Tailwind) pour son frontend. Elle permet au visiteur de se créer un compte, de s'y connecter et de lancer des parties de blackjack contre un ordinateur. Pour l'instant, la startup n'est pas très connue et l'application ne compte qu'à peine 100 utilisateurs journaliers.

L'application a été écrite uniquement en étant testée manuellement. Il se peut que des erreurs se produisent.

Votre objectif est de faire une courte analyse de l'application et des besoins métiers. Grâce à celle-ci, vous choisirez quel plan de test adopter pour vérifier que l'application fonctionne comme prévu. Vous pourrez utiliser des tests manuels, unitaires, fonctionnels, d'API, E2E, de charges, des linters, des outils d'analyse de code statiques. Vous rédigerez ensuite autant de tests que vous estimerez nécessaire. 

Si des bugs sont rencontrés, il vous sera demander d'écrire des tickets de bugs afin que d'autres développeurs puissent les corriger. Enfin, si vous disposez de compétences supplémentaires pour mettre en place des fixtures ou de la CI/CD, cela sera un plus non négligeable.

Votre rendu sera constitué d'un rapport contenant votre analyse et la justification de votre plan de test, des tickets de bugs rédigés ainsi que d'une pull request de votre repository vers le projet d'origine. Si vos tests ont été réalisés avec un outil externe ou sont manuels, veuillez également les joindre à votre rendu
