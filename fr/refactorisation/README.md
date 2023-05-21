## Sommaire du cours sur la refactorisation

 1. Qu'est-ce que c'est
 2. Pourquoi en faire
 3. Avant d'en faire
 4. Les méthodes

## Qu'est-ce que c'est

 * exemple de la refacto en maths
 * le fait de transformer une expression complexe en une expression plus simple à lire et comprendre en appliquant de nouveau les bonnes pratiques
 * dans un monde parfait, on n'aurait pas besoin de le faire
 * dans la théorie, il faut le faire tout le temps (quand on debugge, quand on implémente, dans des sessions dédiées)
 * dans la réalité, on nous donne pas le temps de le faire (faut pousser de la feature)
 * seule contrainte : ne pas perdre des features en cours de route

## Les raisons

Très rarement pour gagner en performance. Parfois pour faire évoluer une fonctionnalité

__Gagner en lisibilité__

 * dev = 90% du temps de la lecture de code

### Gagner en compréhension du métier

 * il faut comprendre les raisons métiers derrière les choix techniques
 * montée de compétence

### Faciliter les tests (et le debuggage)

 * plus simple de tester et debugger de petites fonctions et avec un scope réduit
 * on peut couvrir plus de cas limites et repérer plus de cas superflus à supprimer/ignorer

### Faciliter l'implémentation de nouvelles fonctionnalités

 * on évite de dupliquer du code puisque plus facile de réutiliser l'existant
 * on comprend l'existant, donc plus plus difficile de le casser

## Le prérequis

 * impératif d'avoir une grande compréhension du code existant et des fonctionnalités avant de refactoriser
 * sinon on risque de :
   * perdre du temps pour comprendre comment refactoriser
   * perdre du temps à refactoriser du code qui n'en avait pas besoin
   * perdre des fonctionnalités en chemin

### Comprendre comment le code fonctionne

#### Lire la doc

 * la doc devrait expliquer à quoi servent les fonctions principale
 * si elle est à jour

#### Lire les tests

 * selon la granularité des tests, permet de savoir 
   * quel est le scope de la fonction
   * le contrat d'interface (input/output)

#### Exécuter le code en posant du debuggage

 * avec des outils comme xdebug
 * à l'ancienne avec des `var_dump()`
 * permet de savoir
   * à quoi servent les variables
   * dans quel embranchement de if/else la fonction passe
   * comment les valeurs dans les variables évolues

### Schématiser le fonctionnement

Avec des logiciels ou une feuille et un crayon

#### A l'écrit

Envoyer un email = CronController->EmailAction() ==> EmailService->getEmails()
												 ==> 
#### Tableau des valeurs

#### Faire son diagramme de séquence simplifié

## Les méthodes

### Renommage de fonctions et de variables

Quel problème : 
 * 

La solution : 

Les avantages : 
 * gagner en lisibilité
 * lier la technique et le business
 * éviter les erreurs de compréhension

Niveau de difficulté : facile

### Supprimer le code mort (commentaires)

Quel problème : 

La solution :

Les avantages :
 * gagner en lisibilité

Niveau de difficulté : facile

### Extraire les fonctions

Quel problème : 

La solution : 

Les avantages :
 * gagner en lisibilité
 * testable plus facilement
 * debuggable plus facilement
 * rendre les fonctions réutilisables
 * loi de demeter (1 fonction = 1 responsabilite)

Niveau de difficulté : difficile

### Supprimer les duplicatas

Quel problème :

La solution :

Les avantages :
 * gagner en lisibilité

Niveau de difficulté : facile

### Fail fast

Quel problème :

La solution :

Les avantages :
 * gagner en lisibilité
 * couverture des cas limites

Niveau de difficulté : moyen

### Meilleure utilisation du typage

Quel problème : 

La solution :

Les avantages :
 * gagner en lisibilité
 * couverture des cas limites
 * meilleur cadrage des attentes techniques et business

Niveau de difficulté : moyen

### Meilleure utilisation du framework

Quel problème :

La solution :

Les avantages :
 * gagner en lisibilite
 * testable plus facilement
 * debuggable plus facilement
 * rendre les fonctions plus réutilisables
 * loi de demeter
 * respect du framework
 * meilleure architecture de l'application (hexagonal architecture)

Niveau de difficulté : difficile
