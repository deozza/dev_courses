# Introduction à sveltekit <!-- omit in toc -->

## Sommaire <!-- omit in toc -->

- [Présentation de svelte](#présentation-de-svelte)
- [Présenation de sveltekit](#présenation-de-sveltekit)
- [Création d'un projet](#création-dun-projet)
- [Description de l'arborescence de fichiers et des types de fichier](#description-de-larborescence-de-fichiers-et-des-types-de-fichier)
- [Créer une page](#créer-une-page)
- [Créer un composant](#créer-un-composant)
- [Les slots](#les-slots)
- [Les variable](#les-variable)
- [Passer une variable à un composant](#passer-une-variable-à-un-composant)
- [Passer un argument réactif à un composant](#passer-un-argument-réactif-à-un-composant)
- [Les events](#les-events)
- [Les conditions et les boucles](#les-conditions-et-les-boucles)
- [Les variables réactives](#les-variables-réactives)
- [Créer un layout](#créer-un-layout)
- [CSS](#css)
- [Les animations](#les-animations)
- [Le store](#le-store)
- [Une application fullstack ?](#une-application-fullstack-)
- [Déployer](#déployer)


## Présentation de svelte

Svelte est un framework mis au point par Rich Harris en 2016. Son objectif était de créer un outil pour développer des applications front-end simples et légères. Pour cela, Svelte fait le gros du travail lors du build de l'application et non pas au moment de l'affichage par le navigateur et l'interprétation du code. C'est pour cette raison qu'on considère davantage Svelte comme un compilateur qu'un framework.

Svelte se base sur HTML, CSS et JS/TS. Il n'est pas nécessaire d'apprendre un nouveau langage pour l'utiliser (contrairement à React) et, du fait qu'il n'embarque pas beaucoup de mots-clefs, on peut commencer à l'utiliser avec des notions basiques de front-end.

## Présenation de sveltekit

Sveltekit est à Svelte ce que NextJS est à React et NuxtJS est à Vue : un framework qui se base sur un autre et qui y incorpore des fonctionnalités avancées pour créer des sites webs. Sveltekit permet entre autre de créer des appliations SPA, SSR et SSG. Il intègre le routeur automatique par arborescence de fichiers.

## Création d'un projet

Pour créer un projet Sveltekit, il faut avoir installé NodeJS v18 au minimum. Lancez ensuite la commande suivante : 

```bash
npm create svelte@latest nom-de-mon-appli
```

Le prompt du terminal va ensuite vous permettre de configurer votre application avec un formulaire. Sélectionnez les options qui semblent correspondre avec les besoins de votre projet.

Une fois le formulaire rempli, lancez les commandes suivantes : 

```bash
cd nom-de-mon-appli
npm install
```

## Description de l'arborescence de fichiers et des types de fichier

`
nom-de-mon-appli/
├ src/
│ ├ lib/
│ │ ├ server/
│ │ │ └ [your server-only lib files]
│ │ └ [your lib files]
│ ├ params/
│ │ └ [your param matchers]
│ ├ routes/
│ │ └ [your routes]
│ ├ app.html
│ ├ error.html
│ ├ hooks.client.js
│ ├ hooks.server.js
│ └ service-worker.js
├ static/
│ └ [your static assets]
├ tests/
│ └ [your tests]
├ package.json
├ svelte.config.js
├ tsconfig.json
└ vite.config.js
`

**vite.config.js**

Fichier de configuration du bundler et serveur vite pour le développement.

**tsconfig.json**

Fichier de configuration pour le linter typescript.

**svelte.config.js**

Fichier de configuration pour le projet svelte. C'est notamment ici que l'on choisira l'`adapter` pour build le projet en fonction de la plateforme et la méthode d'hébergement.

**package.json**

Fichier de configuration des dépendances du projet. Liste également les commandes `npm` relatives au projet. Notez que toutes les dépendances sont listées dans `devDependencies`. C'est parce que Svelte considère que tous les packages ne sont utiles que pendant le développement. Les parties réellement utilisées en production seront extraites lors du build du projet. Parfois, selon leur documentation, certaines dépendances (comme tailwind ou firebase) préfèrent être installées dans la partie `dependencies`.

**/tests**

Dossier pour stocker les tests unitaires et fonctionnels.

**/static**

Dossier pour stocker les fichiers médias (vidéos, images, audio, ...). Attention : tous les fichies stockés ici seront accessibles à tous les visiteurs du site. Il ne faut pas y stocker de fichiers qui sont réservés à des utilisateurs en particulier.

**/src/app.html**

Fichier principal de l'application. Notez la ligne `%sveltekit.head%` et la ligne `%sveltekit.body%`. La première sert à injecter les balises `meta` que l'on pourra customiser dans les pages, la seconde sert à insérer le contenu de la page dans ce template de base.

**/src/routes**

Dossier pour stocker les pages et layouts de l'application.

**/src/lib**

Dossier pour stocker les composants réutilisables de l'application. Si vous utilisez Sveltekit pour créer une librairie npm, c'est dans ce dossier que vous stockerez les fichiers relatifs à cette librairie.

**/node_modules**

Dossier dans lequel sont stockées les dépendances listées dans `package.json`. A ignorer.

**/.svelte-kit**

Dossier de build intermédiaire. A ignorer.

## Créer une page

Pour créer une nouvelle page dans une application Sveltekit, il faut d'abord comprendre deux concepts. Le premier, c'est au niveau du nommage : une page correspond toujours à un fichier nommé `+page.svelte`. Ensuite, l'url d'une page web correspond au chemin du fichier `+page.svelte`  associé. Par exemple, une page avec l'url `/ma/page/web` correponsdra au fichier `/src/routes/ma/page/web/+page.svelte` . 

Nous allons créer une nouvelle page `à propos` pour notre application, qui sera disponible à l'url `/about`. Pour cela, créez un nouveau dossier `/src/routes/about` et créez dedans un nouveau fichier `+page.svelte` : 

```html
<script lang="ts">

</script>

<h1>About</h1>

<p>Hi this is me !</p>

<style>
    
</style>
```

Dans un terminal, lancez la commande `npm run dev -- --open` pour démarrer le serveur et voir notre page : 

![1-create_page](../../../../../assets/js/nodejs/svelte/sveltekit/1-create_page.png)

Chaque page dans une application Sveltekit se décompose en 3 parties : 

 * la partie `<script>`, ce sera là qu'on écrira nos manipulations de données en JS/TS pour la page en cours
 * la partie html
 * la partie `<style>`, ce sera là qu'on écrira notre CSS pour la page en cours

## Créer un composant

L'une des principales fonctionnalités de Sveltekit est sa gestion des composants réutilisables. Dans une application, nous allons souvent avoir besoin des mêmes blocs visuels dans plusieurs pages. Au lieu de dupliquer du code et risquer d'introduire des bugs, nous allons créer un composant.

Pour commencer simplement, nous allons créer un composer `Header`, que nous utiliserons ensuite sur notre page `/about` ainsi que que la page d'accueil. Pour cela, créez un nouveau fichier `/src/lib/Header.svelte` : 

```html
<script lang="ts">

</script>

<h1>Title from component</h1>

<style>
    
</style>
```

Comme vous pouvez le constater, un composant a la même structure qu'une `+page.svelte`. Ce sera le cas également des `+layout.page` qu'on verra plus tard.

Un composant est utilisable dans une `+page.svelte`, dans un `+layout.svelte` et dans un autre composant. On appellera dorénavant `composant parent` un fichier (page, layout ou composant) qui utilise un autre composant. Et `composant enfant` un composant intégré à un autre composant. 

Pour intégrer un composant, il suffit de l'importer dans la partie `<script>` puis de l'insérer dans la partie `html` comme n'importe quelle autre balise. Ajoutons ce composant dans le fichier `/src/routes/+page.svelte` : 

```html
<script lang="ts">

import Header from "$lib/Header.svelte";

</script>

<Header />
<h1>Welcome to SvelteKit</h1>
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>

<style>
    
</style>
```

![2-create_component](../../../../../assets/js/nodejs/svelte/sveltekit/2-create_component.png)

## Les slots

Un autre intérêt des composants est leur capacité à être customisés par le composant parent. Jusqu'à présent, notre composant `Header.svelte` affiche `Title from component` peu importe comment il est intégré. Le but serait qu'il affiche `About` sur la page `/about` et `Welcome to SvelteKit` sur la page d'accueil.

Pour faire cela, on peut utiliser les `slots`. Un slot se présente en 2 parties. Du côté composant parent, il s'agit du contenu que l'on écrira dans la balise appelant le composant. Du côté composant enfant, il prendra la forme `<slot />`. Il indiquera la position que prendra le contenu écrit dans la balise du composant parent.

```html
<!-- /src/lib/Header.svelte -->
<script lang="ts">

</script>

<h1><slot /></h1>

<style>

    h1 {
        color: red;
        font-size: x-large;
        text-decoration: underline;
    }
    
</style>
```

```html
<!-- /src/routes/+page.svelte -->
<script lang="ts">

import Header from "$lib/Header.svelte";

</script>

<Header>Welcome to SvelteKit</Header>
<p>Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</p>

<style>

</style>
```

```html
<!-- /src/routes/about/+page.svelte -->
<script lang="ts">
    import Header from "$lib/Header.svelte";
</script>

<Header>About</Header>

<p>Hi this is me !</p>

<style>

</style>
```

Vous pourrez constater que grâce au composant et au slot, nous avons pu configurer un header qui possède le même style dans l'ensemble de l'application, mais dont le contenu est variable en fonction du composant parent.

Si on souhaite utiliser plusieurs slots dans le même composant, on pourra utiliser la variante nommée pour les différencier : 

```html
<!-- /src/lib/Header.svelte -->
<script lang="ts">

</script>

<h1><slot name="header"/></h1>

<p>
    <slot name="description"/>
</p>
<style>

    h1 {
        color: red;
        font-size: x-large;
        text-decoration: underline;
    }
    
</style>
```

```html
<!-- /src/routes/+page.svelte -->
<script lang="ts">

import Header from "$lib/Header.svelte";

</script>

<Header>
    <span slot="header">Welcome to SvelteKit</span>
    <span slot="description">Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</span>
</Header>

<style>

</style>
```

```html
<!-- /src/routes/about/+page.svelte -->
<script lang="ts">
    import Header from "$lib/Header.svelte";
</script>

<Header>
    <span slot="header">About</span>
    <span slot="description">Hi this is me !</span>
</Header>

<style>

</style>
```

## Les variable

Pour créer une variable JS/TS en SvelteKit, il suffit de se mettre dans la partie `<script>` d'un composant et d'utiliser les mots clefs classiques du langage. Pour faire cela et voir comment manipuler des variables dans SvelteKit, nous allons créer une nouvelle `/src/routes/cat/+page.svelte` : 

```html
<script lang="ts">
	import { onMount } from "svelte";

    let catUrl: string = '';

    onMount(() => {
        fetch('https://api.thecatapi.com/v1/images/search')
        .then(response => response.json())
        .then(data => {
            catUrl = data[0].url;
        });
    });

</script>

<h1>Cat</h1>

<img src="{catUrl}" alt="cat">

<style>

</style>
```

La partie `let catUrl: string = '';` crée une variable `carUrl`, utilisable aussi bien dans le reste du `script` que dans le `html`. Nous avons ensuite une fonction `onMount`, qui se lance lorsque la page est affichée sur le navigateur, fait une requête vers une API pour récupérer l'url d'une image et la stocke dans la variable. La variable est ensuite utilisée dans `<img src="{catUrl}" alt="cat">` grâce aux `{}`.

## Passer une variable à un composant

Les slots sont pratiques lorsque l'ont veut faire passer du contenu statique d'un composant parent à un composant enfant. Mais ils sont inadaptés lorsque l'ont veut transmettre une variable. Pour cela, nous utiliserons des `props`.

Créons un nouveau composant `/src/lib/CatImage.svelte` : 

```html
<script lang="ts">
    export let catUrl: string;
</script>

<img src="{catUrl}" alt="cat">

<style>

</style>
```

Pour différencier une variable classique d'un props, il faut rajouter le mot clef `export` devant l'instanciation de la variable.

Pour utiliser ce composant avec son props, mettons à jour la `/src/routes/cat/+page.svelte` : 

```html
<script lang="ts">
	import { onMount } from "svelte";
    import CatImage from "$lib/CatImage.svelte";

    let catUrl: string = '';

    onMount(() => {
        fetch('https://api.thecatapi.com/v1/images/search')
        .then(response => response.json())
        .then(data => {
            catUrl = data[0].url;
        });
    });

</script>

<h1>Cat</h1>

<CatImage catUrl="{catUrl}"/>

<style>

</style>
```

Nous avons ici la balise `<CatImage />` qui intègre le composant `CatImage`. Pour lui passer le props dont il a besoin pour fonctionner, il suffit de rajouter le nom de ce props dans la balise suivi de sa valeur selon le schéma `nomDuProps=value`. Ici : `catUrl="{catUrl}"`.

En utilisant `export let catUrl: string;` sans donner de valeur, cela signifie que le props n'aura pas de valeur par défaut. Donc, si aucune valeur n'est renseignée dans le composant parent, une erreur aurait été levée. Pour donner une valeur par défaut au props, il suffit de faire :

```html
<script lang="ts">
    export let catUrl: string = '';
</script>

<img src="{catUrl}" alt="cat">

<style>

</style>
```

Autre chose à noter : si le nom du props dans le composant enfant est le même que le nom de la variable passée depuis le composant parent, alors on peut simplement passer la variable. Dans notre exemple, le props s'appelle `catUrl` et la variable dans le composant parent s'appelle également `catUrl`. On peut donc mettre à jour : 

```html
<script lang="ts">
	import { onMount } from "svelte";
    import CatImage from "$lib/CatImage.svelte";

    let catUrl: string = '';

    onMount(() => {
        fetch('https://api.thecatapi.com/v1/images/search')
        .then(response => response.json())
        .then(data => {
            catUrl = data[0].url;
        });
    });

</script>

<h1>Cat</h1>

<CatImage {catUrl}/>

<style>

</style>
```

## Passer un argument réactif à un composant

Il est possible qu'une variable, une fois envoyée à un composant enfant, soit manipulé et modifié. Pour que ce changement soit reflété dans le composant parent, il faut utiliser le mot clef `bind` lors de l'affectation. Nous allons créer une nouvelle `/src/routes/sum/+page.svelte` ainsi qu'un nouveau composant `/src/lib/Sum.svelte`: 

```html
<!-- /src/lib/Sum.svelte -->
<script lang="ts">
    export let a: number;
    export let b: number;
    export let result: number;
    
    function sum(a: number, b: number): number {
        return a + b;
    }
</script>

<div>

    <input type="number" bind:value={a}>
    <input type="number" bind:value={b}>
    <button on:click={() => result = sum(a, b)}>Sum</button>
</div>
```

*Notez que `bind` fonctionne aussi pour mettre à jour une variable manipulée par un input.*

```html
<!-- /src/routes/sum/+page.svelte-->
<script lang="ts">
    import Sum from '$lib/Sum.svelte';

    let a = 0;
    let b = 0;
    let result = 0;


</script>

<h1>Sum</h1>

<Sum {a} {b} bind:result={result} />

<p>Result: {result}</p>
```

Les variables `a` et `b` ont le même nom dans le composant enfant et le composant parent, on peut donc les utiliser directement. La variable `result` également, mais à cause de `bind`, on est obligé de l'écrire de la longue manière.

Nous avons ici une page parent qui initialiser le résultat à 0, et intègre un composant enfant qui calcule le résultat et le renvoi au composant parent une fois actualisé.

## Les events

Dans l'exemple précédent, nous avons utilisé un bouton avec à l'intérieur `on:click`. C'est ce qu'on appelle un event. Avec SvelteKit, il est possible de créer des évènements et de les affecter à des fonctions de notre partie script. 

Les events du DOM sont les évènements classiques que chaque navigateur gère par défaut. Le plus pratique d'entre eux est le `on:click`, vu précédemment, qui s'active lorsqu'on clique avec la souris sur l'élément html associé. Il nous permet de lancer une fonction, avec le schéma `on:click={(event) => methodToCall()}`. 

Pour illustrer cette fonctionnalité, nous allons créer un compteur avec une nouvelle page `/src/routes/count/+page.svelte` : 

```html
<script lang="ts">
    let count: number = 0;

    function increment() {
        count += 1;
    }

    function decrement() {
        count -= 1;
    }

</script>

<h1>Count</h1>

<button on:click={decrement}>-</button>
<p>Count: {count}</p>
<button on:click={increment}>+</button>
```

## Les conditions et les boucles

Avec SvelteKit, il est possible de manipuler l'html en fonction des variables. En effet, on peut afficher un bloc en fonction d'une condition, répéter un bloc par rapport à une liste ou encore afficher différents blocs en fonction de l'état d'avancement d'une requête API.

**Bloc conditionnel**

Pour afficher un bloc d'html en fonction d'une condition, on utilisera le pattern `{#if condition}{:else if}{:else}{/if}`. Modifions la `/src/routes/count/+page.svelte` pour afficher un message pour savoir si le nombre affiché est pair ou impair : 

```html
<script lang="ts">
    let count: number = 0;

    function increment() {
        count += 1;
    }

    function decrement() {
        count -= 1;
    }

</script>

<h1>Count</h1>

<button on:click={decrement}>-</button>
<p>Count: {count}</p>
<button on:click={increment}>+</button>

{#if count % 2 === 0}
    <p>Count is even</p>
{:else}
    <p>Count is odd</p>
{/if}
```

**Boucle**

Si on veut répéter un bloc html pour afficher les différents éléments d'une liste, on utilisera le pattern `{#each list as element, i}{/each}`. `list` étant la variable contenant la variable sur laquelle itérer, `element` étant une nouvelle variable créée pour l'itération en cours, `i` est optionnel et correspond à l'index de l'itération en cours. Créons une nouvelle page `/src/routes/todo/+page.svelte` pour afficher une todolist : 

```html
<script lang="ts">
    let todoList: string[] = ['walk the dog', 'exercise', 'eat a fruit'];
</script>

<h1>Todo</h1>

<ul>
    {#each todoList as todo}
        <li>{todo}</li>
    {/each}
</ul>
```

**Affichage en attente d'une requête**

L'une des fonctionnalités intéressante de JavaScript est la possibilité d'envoyer des requêtes asynchrones à des services web. Du fait de leur nature, il faut que l'interface sache gérer 3 possibilités : 
 * le chargement des données
 * le succès de la requête
 * l'échec de la requête

SvelteKit permet de faire ça simplement avec le pattern `{#await method()}{:then }{:catch }{/await}`. Créons une nouvelle page `/src/routes/await/+page.svelte` pour afficher une image de chat après avoir réussi une requête API : 

```html
<script lang="ts">

    async function fetchPokemon() {
        return await fetch('https://api.thecatapi.com/v1/images/search')
            .catch(err => {
                console.error(err);
                return err;
            })
            .then(async (response) => {                
                return response.json();
            })
            .then(data => {
                return data[0].url;
            });
    }
</script>

{#await fetchPokemon()}
    loading...
{:then url}
<img src="{url}" alt="">
{:catch e}
    An error happened : {e.message}
{/await}
```

Vous pouvez constater que le temps que la requête soit complète, un message apparait. Contrairement à notre précédente page `/src/routes/cat/+page.svelte` qui n'affiche rien pendant le chargement.

## Les variables réactives

Pour créer une variable dont la valeur va évoluer en fonction d'une autre variable, SvelteKit met à disposition le mot clef `$:`. Créons une nouvelle page `/src/routes/reactive/+page.svelte` , dont le rôle sera de calculer le double, le quadruple, la moitié et le carré d'une variable : 

```html
<script lang="ts">
    let number: number = 0;

    $:double = number * 2;
    $:quadruple = double * 2;
    $:half = number / 2;
    $:square = number ** 2;
</script>

<h1>Reactive</h1>

<input type="number" bind:value={number}>

<p>{number} * 2 = {double}</p>
<p>{number} * 4 = {quadruple}</p>
<p>{number} / 2 = {half}</p>
<p>{number}² = {square}</p>
```

***Cette mise en page sera remplacée dans Svelte 5 par le système des runes***.

## Créer un layout

Le layout est un composant qui permet de réutiliser des éléments visuels sur des pages enfants. Quelque chose de pratique pour réutiliser un menu ou un footer sur les pages d'une application. Créons une layout `/src/pages/+layout.svelte` pour s'en rendre compte :

```html
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/await">Await</a></li>
        <li><a href="/cat">Cat</a></li>
        <li><a href="/count">Count</a></li>
        <li><a href="/reactive">Reactive</a></li>
        <li><a href="/sum">Sum</a></li>
        <li><a href="/todo">Todo</a></li>

    </ul>
</nav>

<main>
    <slot></slot>
</main>
```
Notez l'ajout de `slot`. Ce sera à cet endroit que le contenu des pages sera inséré dans le layout.

## CSS

Dans SvelteKit, le style est `scoped` par défaut. Ce qui signifie qu'il ne se propage pas d'un élément à un autre. Il est contenu dans son composant. Dans le cas d'un conflit (si un style venant d'un composant parent s'applique sur le même élément qu'un composant enfant), alors le style du composant le plus enfant est prioritaire. Modifions certains de nos fichiers pour s'en rendre compte : 

```html
<!-- /src/routes/+layout.svelte-->
<script lang="ts">
    import '../app.css'
</script>
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/await">Await</a></li>
        <li><a href="/cat">Cat</a></li>
        <li><a href="/count">Count</a></li>
        <li><a href="/reactive">Reactive</a></li>
        <li><a href="/sum">Sum</a></li>
        <li><a href="/todo">Todo</a></li>

    </ul>
</nav>

<main>
    <slot></slot>
</main>

<p>In layout</p>

<style>
    p {
        color: blue;
    }
</style>
```

```html
<!-- /src/routes/+page.svelte-->
<script lang="ts">

import Header from "$lib/Header.svelte";

</script>

<Header>
    <span slot="header">Welcome to SvelteKit</span>
    <span slot="description">Visit <a href="https://kit.svelte.dev">kit.svelte.dev</a> to read the documentation</span>
</Header>


<p>In page</p>

<style>
    p{
        color: brown;
    }
</style>
```

```html
<!-- /src/lib/Header.svelte-->
<script lang="ts">

</script>

<h1><slot name="header"/></h1>

<p>
    <slot name="description"/>
</p>

<p class="global">Get the global css</p>
<style>

    h1 {
        color: red;
        font-size: x-large;
        text-decoration: underline;
    }

    p{
        color: green;
    }
    
</style>
```

![11-css](../../../../../assets/js/nodejs/svelte/sveltekit/11-css.png)

## Les animations

SvelteKit nous permet d'utiliser des animations et des transitions simplement. Pour qu'une transition ait lieu sur un bloc, il faut qu'il apparaisse sur l'interface après que la page soit affichée. Créons une nouvelle page `/src/routes/animation/+page.svelte` et utilisons une variable `visible` pour afficher et cacher un bloc :

```html
<script>
	import { fade } from 'svelte/transition';
	let visible = true;
</script>

<label>
	<input type="checkbox" bind:checked={visible} />
	visible
</label>

{#if visible}
	<p transition:fade>Fades in and out</p>
{/if}
```

## Le store

```ts
// /src/store.ts
import { writable } from 'svelte/store';

export const number = writable(0);
```

```html
<!-- /src/routes/count/+page.svelte -->
<script lang="ts">
    import { number } from "../store";

    let count: number = 0;
    number.subscribe(value => count = value);

    function increment() {
        number.update((n) => n + 1);
    }

    function decrement() {
        number.update((n) => n - 1);    
    }

</script>

<h1>Count</h1>

<button on:click={decrement}>-</button>
<p>Count: {count}</p>
<button on:click={increment}>+</button>

{#if count % 2 === 0}
    <p>Count is even</p>
{:else}
    <p>Count is odd</p>
{/if}
```

```html
<!-- /src/routes/reactive/+page.svelte -->
<script lang="ts">

    import { number } from "../store";

    $:double = $number * 2;
    $:quadruple = double * 2;
    $:half = $number / 2;
    $:square = $number ** 2;
</script>

<h1>Reactive</h1>

<input type="number" bind:value={$number}>

<p>{$number} * 2 = {double}</p>
<p>{$number} * 4 = {quadruple}</p>
<p>{$number} / 2 = {half}</p>
<p>{$number}² = {square}</p>

```

## Une application fullstack ?

```ts
// /src/routes/api/hello-world/+server.ts

import type { RequestHandler } from './$types';
import { json } from '@sveltejs/kit'


export const GET: RequestHandler = async () => {
    
    
      return json({ 'hello': 'world' })
};
```

## Déployer
