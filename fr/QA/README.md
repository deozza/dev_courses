# Quality assurance

Quels sont les moyens de prouver que votre code est de qualité ?

Comment être sur que l'application fonctionne comme décrite par les specs ?

## Test manuels

## Audits

google lightouse, gtmetrix

## Tester le comportement d'une application

Objectifs : 
 - vérifier que l'application remplisse les specs de la fonctionnalité en cours
 - vérififer qu'il n'y a pas de bugs sur la fonctionnalité en cours
 - vérifier qu'il n'y a pas de régression sur les autres fonctionnalités

### Tests unitaires

Définition : tester une petite partie du code, indépendante du reste de l'application.

Exemple : test d'une fonction statique.

Outils :
 - en php : PHPUnit
 - en js : Junit; JEST, Vitest

### Tests fonctionnels

Définition : tester une fonctionnalité d'une application

Exemple : test le login d'une API

Outils :
 - en php : PHPUnit
 - en js : Junit; JEST; Vitest 

### Tests E2E

Définition : tester le comportement d'un scénario, d'un use case, de l'application

Exemple : tester la redirection après la connexion à l'application web

Outils : 
 - selenium, cypress, playwright

### Tests d'API

Définition : tester le comportement fonctionnel des endpoints d'une API

Exemple : tester la route de création de token

Outils :
 - Postman, Insomnia

## Analyse de code

Définition : sans lancer de tests, vérifier les erreurs basiques de programmation et l'application de bonnes pratiques

Outils : 
 - en php : PHPStan, Psalm
 - en js : eslint + prettier

## Test de performance

Définition : tester quelles sont les limites d'une application

Exemple : vérifier qu'une page web tienne 1000 utilisateurs

Outils :
 - Apache JMeter

## CI/CD

Définition : chaque fois que du code est livré, lancer les outils de QA avant d'accepter les modifications

Exemple : lancer eslint pour vérifier les bonnes pratiques, puis vitest pour les tests unitaires, puis playwright pour les tests E2E, sur une application nodejs avant de merge le code

Outils :
 - Github actions

## Méthodologie TDD

Définition : 
 1. écrire des tests simples
 2. lancer les tests
 3. constater les tests qui échouent
 4. écrire du code pour faire passer les tests
 5. lancer les tests
 6. constater que les tests passent
 7. recommencer jusqu'à ce que la fonctionnalité corresponde aux specs
