# La QA - ou comment s'assurer qu'une app fonctionne

## Sommaire 

 1. [Définition](#définition)
 2. [Quand intégrer la QA ?](#quand-intégrer-la-qa)
 3. [Qui intervient ?](#qui-intervient)
 4. [Les protocoles de test](#les-protocoles-de-test)
 5. [Analyse et audit](#analyse-et-audit)
 6. [Automatiser avec la CI/CD](#automatiser-avec-la-cicd)

## 1. Définition

La QA, pour Quality Assurance, est un processus mis en place pour déterminer qu'un produit ou un service remplit des standards de qualités déterminés par une équipe, une entreprise ou l'industrie de manière générale. 

On lui donne en général 3 objectifs à remplir : 

 - garantir qu'une fonctionnalité à été développée en accord avec un cahier des charges
 - limiter l'introduction de bugs
 - améliorer continuellement la qualité du produit livré

## 2. Quand intégrer la QA ?

La QA intervient tout au long de la vie d'un produit. C'est un processus proactif. C'est d'ailleurs la principale différence entre la QA et la QC (quality control). La première va tout autant avoir lieu lors du développement qu'après la livraison du code, pour prévenir des défauts, alors que la seconde aura lieu une fois le programme en production pour tester et corriger le code.

## 3. Qui intervient ?

### a. Les développeur.ses

Les développeurs et développeuses vont 

### b. Les utilisateur.rices

D'une certaine manière, toutes les personnes qui utilisent un programme font partie de la QA. En l'utilisant, elles vont attendre à ce qu'il remplisse ses fonctions et qu'aucun bug ne vienne perturber leur expérience. Si ce n'est pas le cas, elles peuvent faire appel au support technique pour relever la malfonction.

### c. Les QA

On peut assigner le rôle d'ingénieur QA à certaines personnes d'une équipe technique. Ce seront les référent.es 

## 4. Les protocoles de test

### a. Les tests manuels

### b. Les tests unitaires

Définition : tester une petite partie du code, indépendante du reste de l'application.

Exemple : test d'une fonction d'addition.

**En PHP avec PHPUnit**

Soit la méthode : 

```php
/**
 * @param int $num1
 * @param int $num2
 * 
 * @return int
 */
public function addition(int $num1, int $num2): int
{
    return $num1 + $num2;
}
```

Cette méthode ne fait pas appel à une autre, elle ne dépend pas d'un `$this`, elle peut donc être facilement testable unitairement : 

```php
<?php
use PHPUnit\Framework\TestCase; // on importe les outils de test de PHPUnit

class AdditionTest extends TestCase // on crée une classe et on la surchage avec PHPUnit
{
    public function testAddition() //une methode avec `test` au début = 1 test
    {
        $result = addition(2, 3); // on exécute la méthode à tester
        $this->assertEquals(5, $result); // on vérifie avec `assertEquals` que le résultat de la méthode testée corresponde au résultat attentu 
    }
}
?>
```

**En JS avec Vitest**

Soit la méthode : 

```ts
function addition(num1: number, num2: number): number {
    return num1 + num2;
}
```

```ts
import { test } from 'vitest' // on importe les outils de test de Vitest

test('addition', () => { //on utilise la méthode `test` de vitest pour créer un nouveau test
  const result = addition(2, 3) // on exécute la méthode à tester
  expect(result).toBe(5) // on vérifie avec `expect().toBe()` que le résultat de la méthode testée corresponde au résultat attentu 
})
```

### c. Les tests fonctionnels

Définition : tester une fonctionnalité d'une application

Exemple : test la récupération de la liste des users d'une API

**En PHP avec PHPUnit**

Soit l'endpoint suivant, avec le framework Symfony :

```php
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserController extends AbstractController
{
    #[Route('/users', name: 'get_users', methods:['GET'])]
    public function getUsers(EntityManagerInterface $entityManager): JsonResponse
    {
        $data = $entityManager->getRepository(User::class)->findAll();
        return $this->json(
            $data,
            headers: ['Content-Type' => 'application/json;charset=UTF-8']
        );
    }
}
```

Nous pouvons tester cet endpoint pour nous assurer que seul le verbe http `GET` puisse être utilisé : 

```php
<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    /**
     * @dataProvider dataprovider_getUsers_checkAuthorizedMethods
     */
    public function test_getUsers_checkAuthorizedMethods(string $method)
    {
        $client = static::createClient();
        $client->request($method, '/users');
        $this->assertEquals(405, $client->getResponse()->getStatusCode());
    }

    private static function dataprovider_getUsers_checkAuthorizedMethods(): array
    {
        return [
            ['PUT'],
            ['DELETE'],
            ['PATCH'],
            ['POST'],
            ['OPTIONS']
        ];
    }
}
```

Pour éviter d'écrire un nouveau test par verbe, on utilise ici un `dataProvider`. Le test `test_getUsers_checkAuthorizedMethods` est lié à la méthode `dataprovider_getUsers_checkAuthorizedMethods` par l'anotation `* @dataProvider dataprovider_getUsers_checkAuthorizedMethods`. Elle va boucler pour chaque ligne dans le tableau retourné par le dataProvider, et chaque ligne sera utilisée comme paramètre du test. 

Dans cet exemple, nous aurons donc le test `test_getUsers_checkAuthorizedMethods` qui sera lancé une fois avec `$method = 'PUT`, une fois avec $method = 'DELETE`, etc

### d. Les tests E2E

Définition : tester le comportement d'un scénario, d'un use case, de l'application

Exemple : tester la redirection après la connexion à l'application web

### e. Les tests de performance

Définition : tester quelles sont les limites d'une application en terme de flux

Exemple : vérifier qu'une page web tienne 1000 utilisateurs

## 5. Analyse et audit

### a. Analyse statique de code

Les outils d'analyse statique, également appelés `linter` ont pour objectif de lire la code base d'une application et de signaler lorsqu'une anomalie est détectée. Suivant la configuration qui a été faite, cela peut permettre de mettre en avant de possibles bugs, comme l'utilisation d'une variable alors qu'elle n'a pas encore été instanciée ou l'utilisation d'une méthode qui n'a pas encore été créée. Cela peut aussi forcer un style d'écriture de code sur l'ensemble de l'application, comme par exemple forcer le camel case sur les variables et les méthodes, forcer le retour à la ligne après un `{` au début d'une méthode, ...

En PHP, un des outils de ce style s'appelle `PHPStan`. Pour l'installer dans votre application, vous devez avoir le package manager `composer` d'installé et un fichier `composer.json` dans votre application. Vous pourrez alors lancer la commande :

```bash
composer require --dev phpstan/phpstan
``` 

*Notez le `--dev`, cette dépendance ne sera pas installée sur la prod*

La configuration de l'outil se situe dans le fichier `phpstan.dist.neon` . 

Voici un exemple de fichier pour un projet Symfony : 

```yaml
parameters:
    level: 6
    paths:
        - bin/
        - config/
        - public/
        - src/
        - tests/
```

Pour en savoir plus sur les configurations possibles, [regarder ici](https://phpstan.org/config-reference)

Pour lancer l'analyse, utiliser la commande : 

```bash
vendor/bin/phpstan analyse
```

L'outil lira les dossiers qui seront listés dans le fichier de configuration.

Toutes les erreurs et recommandations seront listées dans le terminal. Vous devriez les corriger vous-même.

Lorsque vous aurez atteint une correction satisfaisante, vous pouvez lancer la commande : 

```bash
vendor/bin/phpstan analyse --generate-baseline
```

Cette commande va créer un fichier `phpstan-baseline.neon` et listera les recommandations actuelles. Et lors prochaines analyses, l'outil ne remontera pas les recommandations qui sont déjà listées dans la baseline. Cela est utile notamment dans une intégration de CI/CD lorsque les erreurs remontées ne sont pas décisives pour une livraison.

En JavaScript, on utilisera le duo `esLint` et `Prettier`. Le premier sera notre linter, l'outil analysant notre code et remontant les changements recommandés. Le second nous permet d'automatiquement réaliser les changements.

Pour les installer dans votre application, vous devez avoir le package manager `npm` d'installé et un fichier `package.json` dans votre application. Vous pourrez alors lancer la commande :

```bash
npm init @eslint/config
npm install --save-dev --save-exact prettier
```

`eslint` se configure dans les fichiers `.eslintrc.cjs` et `.eslintignore`, tandis que `prettier` se configure dans `.prettierrc` et `.prettierignore`.

Pour lancer l'analyse de votre application nodejs, vous pouvez lancer la commande : 

```bash
npm run prettier --check . && eslint .
```

Pour lancer le correcteur automatique, utilisez : 

```bash
npm run prettier --write .
```

En savoir plus sur [eslint](https://eslint.org/docs/latest/use/core-concepts) et [prettier][https://prettier.io/docs/en/]

### b. Audit externe de site web

Si vous souhaitez connaître rapidement les performances de votre site web, vous pouvez utiliser les sites [google pagespeed insights][https://pagespeed.web.dev/] et [gtmetrix](https://gtmetrix.com/), ainsi que l'extension [lightouse](https://chromewebstore.google.com/detail/lighthouse/blipmdconlkpinefehnmjammfjpmpbjk). 

Les 3 vont analyser l'url renseignée et tester le site sur 5 critères : 
 - la performance (temps de chargement, temps avant que l'utilisateur puisse naviguer, optimisation des médias et des fichiers css, ...)
 - l'accessibilité (utilisation des alt, nuances entre les couleurs utilisées)
 - bonnes pratiques de code (ordre des balises header, les input ont un label, ...)
 - SEO (utilisation des balises meta)
 - compatibilité avec les PWA (le site peut être utilisé comme une appli mobile)

## 6. Automatiser avec la CI/CD

