# Test Driven Development <!-- omit in toc -->

## Sommaire  <!-- omit in toc -->

- [Introduction aux tests](#introduction-aux-tests)
  - [Pourquoi écrire des testes](#pourquoi-écrire-des-testes)
  - [Les différents types de test](#les-différents-types-de-test)
    - [Unitaire](#unitaire)
    - [Fonctionnel](#fonctionnel)
    - [De non-régression](#de-non-régression)
- [L'intérêt de faire du TDD](#lintérêt-de-faire-du-tdd)
- [Description du TDD](#description-du-tdd)
  - [Développement classique](#développement-classique)
  - [Développement en TDD](#développement-en-tdd)
  - [Conclusion](#conclusion)
- [Méthode pour faire du TDD](#méthode-pour-faire-du-tdd)
  - [Premier tour](#premier-tour)
  - [Deuxième tour](#deuxième-tour)
  - [Exemple :](#exemple-)
    - [Premier tour](#premier-tour-1)
    - [Deuxième tour](#deuxième-tour-1)
    - [Troisième tour](#troisième-tour)
    - [Quatrième tour](#quatrième-tour)
    - [Cinquième tour](#cinquième-tour)
    - [Sixième tour](#sixième-tour)


## Introduction aux tests

### Pourquoi écrire des testes

 * s'assurer que la fonctionnalité qu'on a écrite correspond à ce qui a été demandé (specs, scope, ...)
 * s'assurer qu'elle ne fait pas régresser le reste de l'application (effets de bord)
 * ne pas perdre du temps de développement (et donc de l'argent) en réduisant le risque d'apparitions de bug
 * avoir un semblant de documentation (lire les tests pour comprendre comment doit réagir une fonction)
 * automatisation = gain de temps, CI/CD, faire confiance à la trace écrite et pas aux humains qui, en testant manuellement, peuvent oublier certains cas de tests ou (in)valider sans raison

### Les différents types de test

#### Unitaire

 * tester une unité du code (= une petite partie)
 * concerne uniquement l'entrée et la sortie d'une fonction, pas ses intéractions avec d'autres fonctions

 Exemple : tests unitaires pour une fonction d'addition

#### Fonctionnel

 * tester une fonctionnalité (et pas une fonction) dans son ensemble, avec toutes les intéractions possibles entre les différentes parties de l'application


Exemple : test fonctionnel qui vérifie que le user est connecté, a suffisamment de crédits, a l'autorisation pour utiliser l'addition

#### De non-régression

 * chaque test écrit, validé et ajouté dans une release devient un test de non-régression
 * permet de vérifier que malgré la modification du code, l'application réagit toujours comme convenu dans sa globalité

## L'intérêt de faire du TDD

 * on est contraint de ne pas écrire de nouvelles fonctions sans tests
 * on colle au plus près les specs
 * on risque moins d'oublier des fonctionnalités
 * on est plus confiant sur le code écrit

## Description du TDD

### Développement classique

 * réception de la fonctionnalité à intégrer
 * commencer à développer
 * se rendre compte à mi parcours qu'on a oublié un cas d'usage de la fonctionnalité
 * refactoriser le code
 * tester à la main
 * valider de soi même, sans avoir de preuves que la fonctionnalité écrite correspond à ce qui a été demandé
 * se dire qu'on écrira des tests plus tard
 * déployer
 * ne jamais écrire de tests

### Développement en TDD

 * réception de la fonctionnalité à intégrer
 * penser en amont à tous les cas d'usage possibles, qu'ils soient un succès ou non
 * obtenir un scope de la fonctionnalité
   * comment elle doit se comporter en fonction de chaque input possible, ses intéractions avec le reste de l'application, ...
 * écrire les objectifs pour valider le fonctionnement
 * ajouter petit à petit du code pour remplir les objectifs

### Conclusion 

 * on a un cadrage avant même de commencer à développer
 * on peut plus facilement discuter avec le demandeur pour s'assurer des cas d'usage
 * on a un code coverage élevé, on est plus confiant sur la qualité du code
 * on sait qu'avant de modifier le code, on a une application qui a été testée, validée, fonctionnant comme prévu
 * DRY (don't repeat yourself) : on risque moins de dupliquer du code
   * les tests unitaires peuvent forcer à écrire des fonctions plus petites, plus spécialisées, avec un scope réduit, donc plus facilement réutilisables ou modifiables
 * YAGNI (you aren't gonna need it) : 
   * on connait le cadrage à l'avance, on n'a pas besoin d'écrire des condtitions de succés supplémentaires

## Méthode pour faire du TDD

 * fonctionnement itératif

### Premier tour

 1. Ecrire un test décrivant le cas nominal de succès pour cette fonctionnalité
 2. Lancer le test et constater qu'il échoue
 3. Ecrire le code minimal pour faire passer le test

### Deuxième tour

 1. Sur cette fonctionnalité, choisir un premier cas où la fonctionnalité  devrait réagir autrement que par le succès
 2. Ecrire le test décrivant ce comportement
 3. Lancer les deux tests
 4. Constater que le premier réussi et que le deuxième échoue
 5. Modifier le code pour faire passer les deux tests

Répéter autant de fois que nécessaire pour cerner tous les comportements possibles de la fonctionnalité à développer.

### Exemple :

*Ajouter une fonctionnalité pour se connecter à une application* 

#### Premier tour

 1. retourner un token si on envoie un login et un mot de passe

#### Deuxième tour

 1. si le login ne correspond pas à un utilisateur en BDD, retourner false

#### Troisième tour

 1. si le mot de passe ne correspond pas à l'utilisateur retrouvé par le login, retourner false

#### Quatrième tour

 1. s'il n'y a pas un login ET un mot de passe envoyés, retourner false

#### Cinquième tour

 1. si le login n'est pas au format email, retourner false

#### Sixième tour

 1. si l'utilisateur retrouvé par login n'est pas actif, retourner false