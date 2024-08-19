# Programmation Orientée Objet en PHP <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Définition](#définition)
- [Pourquoi écrire en POO](#pourquoi-écrire-en-poo)
  - [Encapsulation](#encapsulation)
  - [Abstraction](#abstraction)
  - [Héritage](#héritage)
  - [Polymorphisme](#polymorphisme)
- [Objet et classe](#objet-et-classe)
- [Propriété et constructeur](#propriété-et-constructeur)
- [Les méthodes](#les-méthodes)
- [Le mot clef this](#le-mot-clef-this)
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

Classe = concept regroupant des informations cohérentes pour se définir (des propriétés) et pouvant réaliser des actions pour agir ou non avec ou sur ces informations (des méthodes)
Objet = représentation souvent unique (instance), tangible et manipulable de ce concept

Exemples :

| Classe     | Objet                         |
| ---------- | ----------------------------- |
| footballer | Lionel Messi                  |
| computer   | Le macbook sur lequel j'écris |
| fish       | Nemo                          |

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

## Propriété et constructeur

## Les méthodes

## Le mot clef this

## L'héritage

## Accessibilité des méthodes et des propriétés

| modificateurs d'accès | dans la classe     | dans les sous-classes | en dehors de la classe |
| --------------------- | ------------------ | --------------------- | ---------------------- |
| public                | :white_check_mark: | :white_check_mark:    | :white_check_mark:     |
| private               | :white_check_mark: | :x:                   | :x:                    |
| protected             | :white_check_mark: | :white_check_mark:    | :x:                    |

## Les interfaces

## Les classes abstraites

## Ecrire un routeur

## Ecrire un ORM
