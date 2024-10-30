# Clean code exercice in TS <!-- omit in toc -->

## Table of content <!-- omit in toc -->

- [About this exercice](#about-this-exercice)
- [Pre requisite](#pre-requisite)
- [Installation](#installation)
- [Objectives](#objectives)
  - [What this application is about](#what-this-application-is-about)
  - [How to submit your solutions](#how-to-submit-your-solutions)
  - [Exercices](#exercices)
    - [1) Method analysis /2.5](#1-method-analysis-25)
    - [2) Refactoring /12.5](#2-refactoring-125)
    - [3) Deliver working feature /5](#3-deliver-working-feature-5)
    - [Bonus points (+2 points)](#bonus-points-2-points)

## About this exercice

This repository purpose is to help you apply clean code principles in an app written in TypeScript and SvelteKit. You will use principles such as code readability, modularity, maintanbility, testability, ... There are 3 exercices that will test your abilities to analyze whether or not a codebase is written with clean code in mind, what could be fixed about it and how to add new features in the clean code way. These exercices are meant to be done in 3 hours.

## Pre requisite

You need to have these installed on your machine :

- docker engine
- docker compose

You would also need to know how TypeScript works. You may need to know OOP (mostly abstraction and polymorphism) to get the most out of the exercices. Sveltekit knowledge is very optionnal.

## Installation

In order to install the project, fork it then follow these instructions :

```bash
git clone https://github.com/<your-username>/cleancode-js-devoir

cd cleancode-js-devoir

docker compose up -d --build

docker compose exec cleancode-js-devoir npm i
```

The application is accessible on the browser. Use this command to run it locally :

```bash
docker compose exec cleancode-js-devoir npm run dev -- --host
```

It should be accessible at the address `http://127.0.0.1:5173`.

## Objectives

### What this application is about

This is a simple game between a player and a CPU. Both have 10 life points. At the beginning of the round, the player finds a weapon and attacks the enemy. Then, the enemy picks a random weapon. If the player's weapon is more powerful than the enemy's, damages are inflicted. You win when the enemy has lost all its life points.

### How to submit your solutions

Once you finished your exercice, you will determine what is your final branch. From there, you will create a Pull Request to this repository main branch.

### Exercices

#### 1) Method analysis /2.5

Take a look at the `fight()` method in the `/src/lib/index.ts` file. Is this a method written with clean code in mind ?

Create a new file next to the `README.MD` called `fight_method_analysis.md` and write your analysis of this method. List all the issues you can find, and explain how you would fix it.

#### 2) Refactoring /12.5

Following your analysis, rewrite the `fight` method to make it clean. Remember that a clean code is a code that explain itself to improve readability, maintanability and modularity, and that it's done through naming and functions lengths.

**Bonus points :**

- find a way to make the `switch` clean code (+4 points)
- in the `/src/routes/+page.svelte`, get rid of all the booleans and find an elegant way to handle the status of the game (+4 points)

#### 3) Deliver working feature /5

As of now, the user can't chose a weapon and it is chosen randomly at the beginning of the turn. Add new methods to let the user reroll its weapon (max 2 times per round). A weapon that has been picked in a round cannot be picked again. You may need to refactor existing code to stay in the clean code mindset.

Add unit and functionnal tests to prove this feature is working.

#### Bonus points (+2 points)

Anything proving that you took extra care in the previous exercices would grant you bonus points. This could apply to github repository handling (commits, branches, PRs, ...), packages you installed to go beyond what has been asked, ...
