# Cours complet sur sveltekit

## Table des matières

 1. Présentation de svelte
 2. Présentation de sveltekit
 3. Installation
 4. Description de l'arboresence de fichiers et des types de fichier
 5. Créer une page
 6. Les attributs dynamiques
 7. CSS
 8. Créer un composant
 9. Les slots
 10. Passer un argument à un composant
 11. Passer un argument réactif à un composant
 12. Créer un layout
 13. Les conditions et les boucles
 14. Les events
 15. Les animations
 16. Le store
 17. Une application fullstack ?
 18. Ajouter de la doc avec `Histoire`
 19. Déployer

## Présentation de svelte

 *  une librairie pour écrire des interfaces utilisateurs
   * que ca soit un composant ou une page entiere voir un site
 * pas vraiment un framework, comme react ou angular ou vuejs, mais plus un compilateur
   * on écrit du html, css et javascript/typescript classique, avec un peu de fonctionnalités et de sucre syntaxique, que svelte va compiler en modules JS
   * comme c'est du vanillaJS, c'est aussi léger que du vanillaJS.
     * 3.6kb pour une appli demo en svelte contre 45kb pour la meme appli en react
   * plus leger donc plus rapide a
     * deployer
     * lancer pour un serveur
     * executer pour un browser / client
   * https://krausest.github.io/js-framework-benchmark/2022/table_chrome_104_windows.html
     * plus rapide que vuejs, que react, que angular, que ember, que preact
       * presque aussi rapide que vanillaJS. Solid est le rare framwork plus rapide

## Présenation de sveltekit

 * comme nuxtjs, nextjs
 * se base sur svelte et ajoute des packages de base comme le routing, le SSR, le packaing, ...

## Installation

### Prérequis

Il faut avoir installé nodejs et npm sur sa machine.

```bash
npm create svelte@latest myapp
cd myapp
npm install
```

## Description de l'arborescence de fichiers et des types de fichier

## Créer une page

 * les fichiers en +page.svelte

## Les attributs dynamiques

 * comme en js avec let et const
 * reactif avec $:

## CSS

### scoped

Les styles écrits avec `<style></style>` dans un composant/page ne s'appliquent qu'au composant/page. Pas ailleurs

### pas scope

Rajouter :global a la classe css pour qu'elle s'applique partout ou elle est chargée (d'une page vers un composant, d'un composant parent vers un composant enfant)

Utiliser des fichiers .css 

## Créer un composant

## Les slots

### Les slots nommés

## Passer un argument à un composant

## Passer un argument réactif à un composant

bind:

## Créer un layout

## Les conditions et les boucles

for

if

## Les events

### Les events du DOM

on:click
on:pointermove
...


### Les events de composants

on:foo
dispatch


## Les animations

## Le store

## Une application fullstack ?

les fichiers en +server.ts

## Ajouter de la doc avec `Histoire`

## Déployer
