# Cours complet de PHP <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [La syntaxe de base](#la-syntaxe-de-base)
- [Les variables](#les-variables)
- [Les opérations mathématiques](#les-opérations-mathématiques)
- [Le typage](#le-typage)
- [Les opérateurs de comparaison](#les-opérateurs-de-comparaison)
- [Les boucles](#les-boucles)
- [Les conditions](#les-conditions)
- [Les fonctions de base et utiles de PHP](#les-fonctions-de-base-et-utiles-de-php)
- [Les fonctions](#les-fonctions)
- [Les classes et ce qui va avec](#les-classes-et-ce-qui-va-avec)
	- [Un objet](#un-objet)
	- [Une classe](#une-classe)
	- [Utiliser une classe](#utiliser-une-classe)
- [Le PHPDoc](#le-phpdoc)

## La syntaxe de base

```php
<?php
 $name = ‘John’;
 echo $name;
 $age = 21;
 echo $age;
 if($age > 18) {
  echo ‘’Il est majeur’’;
 }
?>
```

Analyse ligne par ligne :

 1. On démarre le script PHP par une balise ouvrante
 2. On crée une variable avec le signe `$`collé au nom de la variable, on lui donne une valeur avec le signe `=`, on termine la ligne avec un `;`
 3. On utilise la fonction `echo` de PHP pour afficher un message, le message étant le contenu de la variable
 4. On crée une deuxième variable avec le signe `$` collé au nom de la variable, on lui donne une valeur avec le signe `=`, on termine la ligne avec un `;`
 5. On utilise la fonction `echo` de PHP pour afficher un message, le message étant le contenu de la variable
 6. Il y a un truc magique avec un `if`, des `(` et des `{`
 7. On utilise à nouveau la fonction `echo`
 8. On ferme le `}`
 9. On termine le script avec une balise PHP fermante

Récap :

- un script est compris entre des balises (un peu à la manière d’HTML)
- chaque ligne, ou instruction, se termine par un `;`
- une variable se crée avec un `$` avec une valeur par défaut
- on peut réutiliser la variable avec son nom

## Les variables

Rappel : une variable est une association d’une clef, ou d’un nom, à une valeur. La valeur peut être modifié à tout moment. On peut appeler  une variable par son nom pour lire ou modifier la valeur qui y est associée. Une variable à une durée de vie…variable…

Pour créer une variable en PHP, on utilise le préfixe `$`.

**Création d’une variable :**

```php
<?php
 $name = ‘John’;
?>
```

**Appel d’une variable :**

```php
<?php
 $name = ‘John’;
 echo $name;
?>
```

**Modification de la valeur d’une variable :**

```php
<?php
 $name = ‘John’;
 echo $name;
 $name = ‘Patrick’;
 echo $name;
?>
```

**Copie d’une variable :**

```php
<?php
 $name = ‘John’;
 echo $name;
 $copiedName = $name;
 echo $copieName;
?>
```

**Durée de vie d’une variable :**

Une variable ne peut pas être appelée partout en fonction de l’endroit où elle a été créée.

**Appel d’une variable OK :**

```php
<?php
 $name = ‘John’;
 echo $name;
?>
```

**Appel d’une variable pas OK :**

```php
<?php
 $name = ‘John’;
 echo $name;
 if($name === ‘John’) {
  $message = ‘Bonjour John’;
 }

 echo $message;
?>
```

La variable ne peut être appelée que dans le bloc dans lequel il a été créé.

**Appel d’une variable OK :**

```php
<?php
 $name = ‘John’;
 echo $name;
 $message = ‘’;
 if($name === ‘John’) {
  $message = ‘Bonjour John’;
 }

 echo $message;
?>
```

## Les opérations mathématiques

**Addition :**

```php
<?php
 $number = 1;
 echo $number;

 $number = 1 + 1;
 echo $number;
 
 $number += 1;
 echo $number;

 $number ++;
 echo $number;
?>
```

**Soustraction :**

```php
<?php
 $number = 10;
 echo $number;

 $number = 10 - 1;
 echo $number;
 
 $number -= 1;
 echo $number;

 $number —;
 echo $number;
?>
```

**Multiplication :**

```php
<?php
 $number = 10;
 echo $number;

 $number = 10 * 2;
 echo $number;
 
 $number *= 2;
 echo $number;
?>
```

**Divisition :**

```php
<?php
 $number = 100;
 echo $number;

 $number = 100 / 2;
 echo $number;
?>
```

**Le modulo :**

```php
<?php
 $number = 100;
 echo $number;

 $number = 100 % 10;
 echo $number;
?>
```

Ca marche pas ça :

```php
<?php
 $number = ‘10’;
 echo $number;

 $number = $number + 2;
 echo $number;
?>
```

## Le typage

Principaux types :

- int
- string
- float
- array
- boolean

## Les opérateurs de comparaison

Les principales comparaisons :

- `>` : strictement supérieur
- `<` : strictement inférieur
- `>=` : supérieur ou égal
- `<=` : inférieur ou égal
- `==` : égal
- `===` : égal avec le même type

**La différence entre `==` et `===` :**

```php
<?php

 echo '1' == 1;
 echo 1 === 1;
 echo 'coucou' === 0;
 echo 'coucou' == 0;
 ?>
```

**Petit point sur la *yoda condition* :**

En général on fait : `$condition == true`. On peut faire une erreur de frappe et écrire à la place `$condition = true`.

Pour éviter d'écraser une variable au lieu de la comparer, on peut écrire `true == $condition`.

## Les boucles

**for :**

```php
<?php
 for($i = 1; $i <= 10; $i++){
  echo $i;
 }
?>
```

Traduction littérale :
*Pour un compteur $i qui démarre avec la valeur 1, qui ne dépassera 10, et qu'on incrémente de 1 exécuter :*

On peut décrementer aussi :

```php
<?php
 for($i = 10; $i >= 0; $i--){
  echo $i;
 }
?>
```

Utilisable pour parcourir un tableau :

```php
<?php

 $listOfFruits = ['orange', 'banana', 'apple'];
 $listSize = count($listOfFruits);
 for($i = 0; $i < lis$listSize; $i++){
  echo $listOfFruits[$i];
 }
?>
```

Truc drole à faire avec un string :

```php
<?php

 $word = 'cacatoes';
 $numberOfLetterInWord = strlen($word);
 
 for($i = $numberOfLetterInWord - 1; $i >= 0; $i--){
  echo $word[$i];
 }
?>
```

**foreach :**

```php
<?php

 $listOfFruits = ['orange', 'banana', 'apple'];
 foreach($listOfFruits as $fruit){
  echo $fruit;
 }
?>
```

Traduction littérale :
*Prendre dans l'ordre, un à un, les élements d'un tableau et exécuter :*

Beaucoup plus pratique et lisible que `for` pour parcourir un tableau.

```php
<?php

 $user = [
  'name' => 'John',
  'email' => 'john@email.com',
  'age' => '21'
 ];

 foreach($user as $property => $value){
  echo $property . ' : ' . $value;
 }
?>
```

Traduction littérale :
*Prendre dans l'ordre, un à un, la clef et sa valeur d'un tableau et exécuter :*

Attention si on a un tableau qui n'a pas tout le temps des duos clefs-valeur, il y aura des erreurs.

**while :**

```php
<?php

 $i = 1;

 while($i <= 10){
  echo $i;
  $i++;
 }
?>
```

Traduction littérale :
*Tant que la condition n'est pas remplie, exécuter :*

```php
<?php

 $condition = true;

 while($condition === true){

  $randomNumber = rand(0, 100);

  echo $randomNumber;

  $divResult = $randomNumber % 3;

  $condition = $divResult !== 0;
 }
?>
```

Il y a aussi le do...while qui exécute avant de vérifier la condition. Pas très utilisé.

## Les conditions

**if, else, elseif, ternaire :**

```php
<?php

 $number = rand(0, 100);

 if($number % 2 === 0){
  echo $number . ' is even';
 }else{
  echo $number . ' is odd';
 }
 ?>
```

Le même sans else :

```php
<?php

 $number = rand(0, 100);
 $message = $number . ' is ';
 $result = 'even';

 if($number % 2 !== 0){
  $result = 'odd';
 }

 echo $message . $result;
 ?>
```

```php
<?php

 $firstNumber = rand(0, 100);
 $secondNumber = rand(0, 100);

 if($firstnumber % 2 === 0){
  echo $firstNumber . ' is even';
 }elseif($firstnumber % 2 !== 0){
  echo 'both are odds';
 }
 ?>
```

On utilise surtout le elseif quand les deux conditions ne sont pas excluantes Lorsque les conditions n'ont rien a voir entre elles.

Par exemple faire

```php
<?php

 $value = 10;

 if($value >= 0){
  echo 'is positive';
 }elseif($value < 0){
  echo 'is negative';
 }
 ?>
```

est contre productif. Si le nombre n'est pas positif il est forcément négatif. On peut faire :

```php
<?php

 $value = 10;

 if($value >= 0){
  echo 'is positive';
 }else{
  echo 'is negative';
 }
 ?>
```

Voir encore plus simple :

```php
<?php

 $value = 10;
 $message = 'is positive';

 if($value < 0){
  $message 'is negative';
 }

 echo $message;
 ?>
```

Dans la plupart des cas, on peut se débrouiller sans else.

```php
<?php

 $value = 10;
 $message = $value >= 0 ? 'is positive' : 'is negative';

 echo $message;
 ?>
```

La ternaire est un moyen plus court d'écrire un if/else. Pas forcément plus lisible.

**switch :**

```php
<?php

 $listOfObjects = [
  [
   'type' => 'car',
   'name' => 'peugeot'
  ],
  [
   'type' => 'fruit',
   'name' => 'apple'
  ],
  [
   'type' => 'brand',
   'name' => 'apple'
  ],
  [
   'type' => 'fruit',
   'name' => 'orange'
  ]
 ];

 foreach($listOfObjects as $object) {
  $message = '';
  switch($object['type']){
   case 'car':
    $message = 'vroom vroom';
   break;
   case 'fruit':
    $message = 'mangez bougez';
   break;
   default : 
    $message = $object['name'];
   break;
  }

  echo $message;
 }
 ?>
```

C'est un super if elseif. Très pratique pour gérer plusieurs cas possibles. Plus lisible qu'un if elseif sur une même variable.

**try catch :**

```php
<?php

 try{
  $number = rand(0, 100);
  if($number > 50){
   throw new \Exception('number is too high');
  }

  echo $number;
 }catch(\Exception $e){
  echo $e->getMessage();
 }
 ?>
```

Traduction littérale :
*Essaye d'exécuter le script principal, et si une exception en particulier survient alors arrête l'exécution, intercepte l'exception et exécute le script de secours à la place*

Utile pour sécuriser l'application si un comportement anormal se produit.

## Les fonctions de base et utiles de PHP

- var_dump, print_r : pour afficher les détails d'une variable
- count : pour connaitre la taille d'un tableau
- min, max : pour connaitre le nombre minimum / maximum dans un enseble
- strlen : pour avoir le nombre de caractères dans un string
- strpos : pour savoir si un string existe dans un autre string
- sprintf : pour compléter un string avec des variables
- explode : pour transformer un string en tableau en fonction d'un marqueur
- strtolower : pour transformer un string en lowercase
- array_key_exists : pour savoir si une clef existe dans un tableau
- array_keys : pour avoir toutes les clefs dans un tableau
- in_array : pour savoir si une valeur existe dans un tableau
- file_exists : pour savoir si un fichier existe
- file_put_content : pour écrire dans un fichier et le créer s'il n'existe pas déjà
- file_get_contents : pour récupérer le contenu d'un fichier en string
- fopen : pour ouvrir un thread pour manipuler un ficher
- fclose : pour fermer un thread qui manipule un fichier
- mkdir : pour créer un dossier
- json_encode : pour serialiser une variable selon l'encodage JSON
- json_decode : pour transformer un string au format JSON vers un tableau ou un objet
- empty : pour vérifier si une variable correspond à `null`, `0`, `false` ou `''`
- is_* : pour confirmer le type d'une variable
- \DateTime : pour manipuler des dates

Dans le doute aller regarder <https://www.php.net/docs.php>

## Les fonctions

Une fonction est un morceau de code pouvant être réutilisé plusieurs fois, à plusieurs endroits, dans une application.

Elle est définie par un nom, une liste d'arguments. Elle peut retourner un résultat ou ne rien retourner.

```php
<?php


 $listOfNumbers = initListOfNumbers(10);
 $result = getFooBarBuzzResult($listOfNumbers);

 public function initListOfNumbers(int $listSize): array {
  if($listSize <= 0){
   throw new \Exception('You must enter a positive number greater than 0');
  }

  $listOfNumbers = [];

  for($i = 0; $i < $listSize; $i++){
   $number = rand(0, 100);
   $listOfNumbers[] = $number;
  }

  return $listOfNumbers;
 }

 public function getFooBarBuzzResult(array $listofNumbers) : string {
  $message = '';

  foreach($listOfNumbers as $number) {
   if(is_int($number) === false) {
    throw new \Exception('One element in your array is not an number');
   }

   $result = getFooBarBuzzForSingleNumber($number);
   $message .= ' ' . $result;
  }

  return $message;
 }

 public function getFooBarBuzzForSingleNumber(int $number): string {
  $isFoo = number % 3 === 0;
  $isBar = number % 5 === 0;
  $isBuzz = $isFoo && $isBar;

  if($isBuzz){
   return 'buzz';
  }

  if($isFoo){
   return 'foo';
  }

  if($isBar){
   return 'bar';
  }


  return "$number";
 }
 ?>
```

## Les classes et ce qui va avec

### Un objet

Un objet est un type de variable. On l'a déjà vu avec `new \DateTime` précédemment pour la manipulation de date.

Il est composé de propriétés, qui vont stocker des valeurs, et des méthodes, qui vont manipuler des données.

Créer simplement un objet :

```php
<?php

 $user = new \stdClass();
 $user->name = 'John Doe';
 $user->age = 21;

 echo $user->age;

 $user->age = 35;

 echo $user->age;

 var_dump($user);

 ?>
```

On va souvent utiliser un objet pour représenter un concept. On va grouper des valeurs et des fonctionnalités qui ont un rapport avec ce concept, pour pouvoir les gérer ensemble, mieux se les représenter, ...

### Une classe

```php
<?php

 class User{
  private $name;
  private $age;

  public function __construct(int $age){
   $this->age = $age;
  }

  public function getAge(): int {
   return $this->age;
  }

  public function setAge(int $age): self {
   $this->age = $age;
   return $this;
  }

  
  public function getName(): string {
   return $this->name;
  }

  public function setName(string $name): self {
   $this->name = $name;
   return $this;
  }

  public function isUnderAge(): bool {
   return $this->age < 21;
  }

  public function happyBirthday(): string {
   $this->age++;

   return "Happy birthday " . $this->name . ", you are now " . $this->age . " years old.";
  } 
 }
 ?>
```

### Utiliser une classe

## Le PHPDoc

Un commentaire écrit dans un format particulier qui peut aider les développeurs et est utilisé par des outils tiers.

Par les IDE, pour donner des informations supplémentaires sur les variables, les fonctions, les classes. Pour aussi faire de l'analyse statique et repérer d'éventuels bugs
Par des outils comme APIDOC, swagger, ... pour générer automatiquement de la documentation

Originellement utilisé également pour *typer* l'application. Aujourd'hui avec le typage de 8.1, phpdoc permet d'étendre les définitions des types

```php
<?php

 /**
 * @access public
 * 
 * @param string $name
 * @return string
 * 
 * @throw \Exception
 */
 public function welcomeUser(string $name) : string {
  if(strlen($name) === 0) {
   throw new \Exception('Name should not be empty');
  }

  return 'Welcome '.$name;
 }
 ?>
```
