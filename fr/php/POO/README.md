# Programmation Orientée Objet en PHP <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Définition](#définition)
- [Pourquoi écrire en POO](#pourquoi-écrire-en-poo)
  - [Encapsulation](#encapsulation)
  - [Abstraction](#abstraction)
  - [Héritage](#héritage)
  - [Polymorphisme](#polymorphisme)
- [Objet et classe](#objet-et-classe)
- [Propriétés](#propriétés)
- [Les constantes](#les-constantes)
- [Les méthodes](#les-méthodes)
- [Le mot clef this](#le-mot-clef-this)
- [Récapitulatif](#récapitulatif)
- [L'héritage](#lhéritage)
- [Accessibilité des méthodes et des propriétés](#accessibilité-des-méthodes-et-des-propriétés)
- [Les interfaces](#les-interfaces)
- [Les classes abstraites](#les-classes-abstraites)
- [Ecrire un routeur](#ecrire-un-routeur)
- [Ecrire un ORM](#ecrire-un-orm)

## Définition

## Pourquoi écrire en POO

### Encapsulation

> Compartimenter les données et les méthodes qui manipulent ces données, ainsi que les restrictions d'accès à ces données / méthodes

Avantages :

- permet de séparer en modules l'application
- sécurise les données de ces modules en choisissant ce qui est accessible ou pas
- limite les effets de bord
- facilite les mises à jour et la maintenance

Outils à utiliser :

- les modificateurs d'accès

### Abstraction

> Réduire les détails et les implémentations d'un concept pour se concentrer sur ses fondamentaux. Permet de définir les composants minimaux qu'un module doit avoir.

Avantages :

- permet de se servir d'un modèle réutilisable
- customisable en fonction des différents besoins

Outils à utiliser :

- classes abstraites
- les interfaces

### Héritage

> Faire hériter à une classe enfant des propriétés et des méthodes de sa classe parent. Permet de définir les composants minimums qu'un module a de base.

Avantages :

- code réutilisable
- customisable en fonction des différents besoins
- faire un lien entre les modules

Outils à utiliser :

- *extends*

### Polymorphisme

> Pouvoir utiliser un sous module précis comme s'il faisait partie d'un module parapluie, global

Avantages :

- ne pas se soucier de la structure interne des modules puisque leur structure externe est compatible
- ne pas se soucier des implémentations particulières car le comportement est le même

Outils à utiliser :

- les intefaces

## Objet et classe

- classe = concept regroupant des informations cohérentes pour se définir (des propriétés) et pouvant réaliser des actions pour agir ou non avec ou sur ces informations (des méthodes)
- objet = représentation souvent unique (instance), tangible et manipulable de ce concept

Exemples :

| Classe     | Objet                         |
| ---------- | ----------------------------- |
| footballer | Lionel Messi                  |
| computer   | Le macbook sur lequel j'écris |
| fish       | Nemo                          |

```php
<?php
 class User{

 }

 $user = new User();
?>
```

## Propriétés

- définissent quelles données sont stockées et gérées par une classe
- peuvent être typées

```php
<?php
 class User{
    string $name;
    int $age;
 }

 $user = new User();
?>
```

- une propriété peut avoir plusieurs types
  - utiliser `|` pour séparer les différents types possibles

```php
<?php
 class User{
    string $name;
    int | float $age;
 }

 $user = new User();
?>
```

- utiliser `->` pour accéder à une propriété

```php
<?php
 class User{
    string $name;
    int $age;
 }

 $user = new User();
 $user->name = 'Vincent';

 echo $user->name;
?>
```

## Les constantes

- une catégorie de donnée dont la valeur est fixe et ne pourra pas être modifiée pendant l'exécution du logiciel
- depuis PHP 8.3, les constantes peuvent être typées

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;
 }

 $user = new User();
?>
```

- utiliser `::` pour accéder à une constante de classe
- il n'est pas nécessaire d'instancier un objet de classe pour accéder à une constante

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;
 }

 echo User::AGE_OF_MAJORITY;
?>
```

## Les méthodes

- permettent de rajouter des fonctionnalités dans une classe

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function helloWorld() {
      echo "hello world"
    }
 }

 $user = new User();
 $user->helloWorld();
?>
```

- une méthode peut recevoir des arguments

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function helloWorld($mail) {
      echo "hello $mail !"
    }
 }

 $user = new User();
 $user->helloWorld("test@gmail.com");
?>
```

- si on souhaite récupérer le résultat d'une méthode, il faut utiliser le mot clef `return` :

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function helloWorld($mail) {
      return "hello $mail !";
    }
 }

 $user = new User();
 $message = $user->helloWorld("test@gmail.com");
 echo $message;
?>
```

- il est possible de typer aussi bien les arguments que le retour d'une méthode
- on appelle ça la `signature` de la méthode
- comme les propriétés, il est possible que les arguments et/ou le retour d'une méthode puissent avoir plusieurs types
  - on utilisera aussi `|` pour les séparer
- si la méthode ne retourne rien, alors le type de retour sera `void`

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function helloWorld(string $mail): string {
      echo "hello $mail !"
    }
 }

 $user = new User();
 $user->helloWorld("test@gmail.com");
?>
```

## Le mot clef this

- permet d'accéder à n'importe quel élément (propriétés comme méthodes) de sa classe

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function getName(): string {
      return $this->name;
    }

    function setName(string $name): void {
      $this->name = $name;
    }
 }

 $user = new User();
 echo $user->getName();
 $user->setName("Vincent");
 echo $user->getName();
?>
```

- remarquez que dans `setName`, `$this->name` et `$name` ne correspondent pas à la même variable, au même enregistrement mémoire

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function setName(string $name): void {
      echo "before assignation" . PHP_EOL
      echo $name . PHP_EOL;
      echo $this->name . PHP_EOL;
      
      $this->name = $name;
      
      echo "after assignation" . PHP_EOL
      echo $name . PHP_EOL;
      echo $this->name . PHP_EOL;
    }
 }

 $user = new User();
 $user->setName("Vincent");
 $user->setName("Pablo");
?>
```

- il est possible de chainer des méthodes ensemble si elles retournent le même objet venant de la même classe

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function setName(string $name): self {
      $this->name = $name;
      return $this;
    }

    function setAge(int $age): self {
      $this->age = $age;
      return $this;
    }
 }

 $user1 = new User()->setName('Vincent')->setAge(10);
 $user2 = new User();
 $user2->setName("Pablo");
 $user2->setAge(15);
?>
```

- il est possible d'appeler une méthode depuis une autre méthode de la même classe

```php
<?php
 class User{
    const int AGE_OF_MAJORITY = 18;

    string $name;
    int $age;

    function setName(string $name): self {
      $this->name = $name;
      return $this;
    }

    function setAge(int $age): self {
      $this->age = $age;
      return $this;
    }

      public function isUnderAge(): bool {
         return $this->getAge() < self::AGE_OF_MAJORITY;
      }
 }

 $user1 = new User()->setName('Vincent')->setAge(10);
 $user2 = new User();
 $user2->setName("Pablo");
 $user2->setAge(20);
 echo $user1->isUnderAge() . PHP_EOL;
 echo $user2->isUnderAge() . PHP_EOL;
?>
```

- remarquez dans l'exemple le mot clef `self` qui permet d'utiliser des constantes de classe à l'intérieure de celles-ci

## Récapitulatif

```php
<?php
 class User{
  public $name;
  public $age;

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


 $user1 = new User();
 $user1->name = "Vincent";
 $user1->age = 31;

 $user2 = new User();
 $user2->name = "Charlotte";
 $user2->age = 12;

 echo $user1->name; //"Vincent"
 echo $user2->name; //"Charlotte"

 $user1->setName("Paul");
 echo $user1->name; //"Paul"
?>
```

## L'héritage

- lorsque des concepts similaires sont représentés par des classes et qu'ils peuvent partager des propriétés et des méthodes en commun, pour éviter de dupliquer du code, on utilise le concept d'héritage
  - on crée une classe parente qui va englober les méthodes et propriétés communes
  - on crée des classes enfants qui vont étendre (= reprendre la configuration et le type de) la classe parente

```php
<?php
 class LivingBeing{
   string $order;
   string $family;
   string $genre;
   string $species;
 }

 class Animal extends LivingBeing {
   string $behaviour;
   string $feedingRegime;
 }

 class Mammal extends LivingBeing {
   int $numberOfLegs;
 }

 class Fish extends LivingBeing {
   int $numberOfFins;
 }

 class Plant extends LivingBeing {
   int $sunExposition;
   string $soil;
   int $temperature;
 }

 class TerrestrialPlant extends Plant {
   int $wateringAmount;
 }

 class AquaticPlant extends Plant {
   string $waterFlow;
 }

?>
```

```php
<?php
 class User{
   string $firstName;
   string $familyName;
   string $email;
 }

 class Employee extends User {

 }

 class Client extends User {

 }

$user = new Employee();

if($user instanceof Client) {
   echo "you can't fire a client";
}

?>
```

## Accessibilité des méthodes et des propriétés

| modificateurs d'accès | dans la classe     | dans les sous-classes | en dehors de la classe |
| --------------------- | ------------------ | --------------------- | ---------------------- |
| public                | :white_check_mark: | :white_check_mark:    | :white_check_mark:     |
| private               | :white_check_mark: | :x:                   | :x:                    |
| protected             | :white_check_mark: | :white_check_mark:    | :x:                    |

## Les interfaces

- permettent d'obliger des classes à respecter des signatures particulières
  - définissent les méthodes, ainsi que leurs types, qu'une classe doit comporter au minimum
  - ne définissent pas en revanche le contenu des méthodes

```php
<?php

 interface CommandInterface {
   execute(): string;
 }

 class HelloCommand implements CommandInterace{
   function execute(): string {
      return 'Hello world';
   }
 }

 class WhatTimeCommand implements CommandInterace{
   function execute(): string {
      $date = new /DateTime();
      return $date->format('Y-m-d H-i-s');
   }
 }

 class RollDiceCommand implements CommandInterace{

   int $diceFaces

   function setOptions(array $arguments) {
      if(array_key_exists('diceFaces', $arguments) 
         && !empty($arguments['diceFaces'])
         && is_int($arguments['diceFaces'])
         && $arguments['diceFaces'] > 0
      ) {
         $this->diceFaces = $arguments['diceFaces']
      }
   }

   function execute(): string {
      if(empty($diceFaces)) {
         return "No dice were selected";
      }

      $diceValue = random_int(1, $this->diceFaces);

      return "You got a $diceValue";
   }
 }

$command = new HelloCommand();
$command->execute();

$command = new WhatTimeCommand();
$command->execute();

$command = new RollDiceCommand();
$command->execute();
$command->setOptions(['diceFaces' => 6]);
$command->execute();


?>
```

- permet d'utiliser des fonctionnalités de classe en étant sans devoir vérifier que les méthodes n'existent pas
- permet de passer des classes plus abstraites qui correspondent aux attentes du logiciel
- il est possible d'implémenter plusieurs interfaces pour une même classe

## Les classes abstraites

- permettent d'obliger des classes à respecter des signatures particulières
  - définissent les méthodes et les propriétés, ainsi que leurs types, qu'une classe doit comporter au minimum
  - ne définissent pas en revanche le contenu des méthodes
- permettent d'embarquer des méthodes communes

```php
<?php

 abstract class AnimalInterface {
   protected $name;
   protected $species;

   abstract public function eating(): string;

   public function getInfos(): string {
      return "Hello, my name is $this->name and i'm a $this->species";
   }
 }

 class Cat extends AnimalInterface {
   public function eating(): string {
      return "I eat meat and fish";
   }
 }

 class Cow extends AnimalInterface{
   public function eating(): string {
      return "I eat grass";
   }
 }

 class Socialist extends AnimalInterface{
   public function eating(): string {
      return "I eat the richs";
   }
 }

$animal = new Cat();
$animal->name = "Minou"
$animal->species "Chat européen"
echo $animal->getInfos();
echo $animal->eating();

$animal = new Cow();
$animal->eating();

$animal = new Socialist();
$animal->eating();
?>
```

- il n'est pas possible d'étendre plusieurs classes abstraites pour une même classe

## Ecrire un routeur

## Ecrire un ORM
