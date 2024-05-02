# Introduction à nuxtjs <!-- omit in toc -->

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
- [Mettre à jour une variable par l'interface](#mettre-à-jour-une-variable-par-linterface)
- [Les events](#les-events)
- [Les conditions et les boucles](#les-conditions-et-les-boucles)
- [Les variables réactives](#les-variables-réactives)
- [Créer un layout](#créer-un-layout)
- [CSS](#css)
- [Le store](#le-store)


## Présentation de Vuejs

//TODO

## Présenation de Nuxtjs

//TODO

## Création d'un projet

Pour créer un projet Nuxtjs, il faut avoir installé NodeJS v18 au minimum. Lancez ensuite la commande suivante : 

```bash
npx nuxi@latest init nom-de-mon-appli
```

Le prompt du terminal va ensuite vous permettre de configurer votre application avec un formulaire. Sélectionnez les options qui semblent correspondre avec les besoins de votre projet.

## Description de l'arborescence de fichiers et des types de fichier

nom-de-mon-appli/
├ public/
│ └ [your static assets]
├ server/
│ └ [your tests]
├ app.vue
├ package.json
├ nuxt.config.ts
└ tsconfig.json

**tsconfig.json**

Fichier de configuration pour le linter typescript.

**nuxt.config.ts**

Fichier de configuration pour le projet nuxtjs

**package.json**

Fichier de configuration des dépendances du projet. Liste également les commandes `npm` relatives au projet. .

**/server**

Dossier pour stocker les endpoints API de l'application.

**/public**

Dossier pour stocker les fichiers médias (vidéos, images, audio, ...). Attention : tous les fichies stockés ici seront accessibles à tous les visiteurs du site. Il ne faut pas y stocker de fichiers qui sont réservés à des utilisateurs en particulier.

**/node_modules**

Dossier dans lequel sont stockées les dépendances listées dans `package.json`. A ignorer.

**/.nuxt**

Dossier de build intermédiaire. A ignorer.

## Créer une page

Pour créer une nouvelle page dans une application NuxtJS, nous devons tout d'abord créer un nouveau dossier `/pages` dans lequel nous stockerons nos fichiers en fonction des URL voulues. Puis, il faut modifier le fichier `/app.vue` pour que l'application puisse gérer automatiquement les pages : 

```vue
<template>
  <div>
    <NuxtPage />
  </div>
</template>
```

Enfin, nous pouvons créer notre première `/pages/index.vue` : 

```vue
<template>
  <h1>Index page</h1>
</template>
```

Dans un terminal, lancez la commande `npm run dev -- -o` pour démarrer le serveur et voir notre page : 

![1-create_page](../../../../../assets/js/nodejs/vuejs/nuxtjs/1-create_page.png)

Chaque page dans une application NuxtJS se décompose en 3 parties : 

 * la partie `<script>`, ce sera là qu'on écrira nos manipulations de données en JS/TS pour la page en cours
 * la partie html
 * la partie `<style>`, ce sera là qu'on écrira notre CSS pour la page en cours

La partie html doit impérativement commencer par la balise `<template>`, et celle-ci ne peut contenir qu'une seule autre balise. Par exemple, ce code est invalide : 

```vue
<template>
  <h1>Index page</h1>
  <p>paragraphe</p>
</template>
```

Pour le rendre valide, il faut entourer le `<h1>` et le `<p>` d'une autre balise, unique enfant de la balise `<template>` :

```vue
<template>
    <div>
        <h1>Index page</h1>
        <p>paragraphe</p>
    </div>
</template>
```

Historiquement, jusqu'à Nuxt 2, pour écrire une page, il fallait utiliser le concept de `options API`. La partie `<script>` ne pouvait contenir qu'un objet, formatté et retourné : 

```vue
<script>
export default {
  data() {
    return {
      count: 0
    }
  },
  methods: {
    increment(){
      this.count++
    }
  }
}
</script>
```

Depuis Nuxt 3, une nouvelle manière plus simple a été implémentée : la `composition API` : 

```vue
<script setup lang="ts">
    const count = ref(0);
    function increment() {
        count.value++;
    }
</script>
```

Il est toujours possibile d'utiliser l'options API.

Concernant le routeur automatique, 2 options s'offrent à nous. On peut soit créer un dossier pour chaque url et y stocker un unique fichier `index.vue` dedans. Par exemple `/pages/about/index.vue` aura comme url `/about`. On peut aussi nommer directement notre fichier avec l'url voulue. Par exemple `/pages/about.vue` aura aussi comme url `/about`. Créons un ce fichier : 

```vue
<template>
    <h1>About</h1>
</template>
```

## Créer un composant

L'une des principales fonctionnalités de NuxtJS est sa gestion des composants réutilisables. Dans une application, nous allons souvent avoir besoin des mêmes blocs visuels dans plusieurs pages. Au lieu de dupliquer du code et risquer d'introduire des bugs, nous allons créer un composant.

Pour commencer simplement, nous allons créer un dossier `/components` et y stocker un composant `Header`, que nous utiliserons ensuite sur notre page `/about` ainsi que que la page d'accueil. Pour cela, créez un nouveau fichier `/components/Header.vue` : 

```vue
<template>
    <h1>Title from component</h1>
</template>
```

Comme vous pouvez le constater, un composant a la même structure qu'une page. Ce sera le cas également des layout qu'on verra plus tard.

Un composant est utilisable dans une page, dans un layout et dans un autre composant. On appellera dorénavant `composant parent` un fichier (page, layout ou composant) qui utilise un autre composant. Et `composant enfant` un composant intégré à un autre composant. 

Pour intégrer un composant, NuxtJS propose un système d'auto-import. Il suffit de l'insérer dans la partie `html` comme n'importe quelle autre balise. Ajoutons ce composant dans le fichier `/pages/about.vue` : 

```vue
<template>
    <div>
        <h1>About</h1>
        <Header />
    </div>

</template>
```

![2-create_component](../../../../../assets/js/nodejs/vuejs/nuxtjs/2-create_component.png)

## Les slots

Un autre intérêt des composants est leur capacité à être customisés par le composant parent. Jusqu'à présent, notre composant `Header.vue` affiche `Title from component` peu importe comment il est intégré. Le but serait qu'il affiche `About` sur la page `/about` et `Index page` sur la page d'accueil.

Pour faire cela, on peut utiliser les `slots`. Un slot se présente en 2 parties. Du côté composant parent, il s'agit du contenu que l'on écrira dans la balise appelant le composant. Du côté composant enfant, il prendra la forme `<slot />`. Il indiquera la position que prendra le contenu écrit dans la balise du composant parent.

```vue
<!-- /components/Header.vue -->
<template>
    <h1><slot></slot></h1>
</template>
```

```vue
<!-- /pages/index.vue -->
<template>
    <div>
        <Header>Index page</Header>
    </div>
</template>
```

```vue
<!-- /pages/ -->
<template>
    <div>
        <Header>About</Header>
    </div>

</template>
```

Vous pourrez constater que grâce au composant et au slot, nous avons pu configurer un header qui possède le même style dans l'ensemble de l'application, mais dont le contenu est variable en fonction du composant parent.

Si on souhaite utiliser plusieurs slots dans le même composant, on pourra utiliser la variante nommée pour les différencier : 

```vue
<!-- /components/Header.vue -->
<template>
    <h1><slot name="header" /></h1>
    <p><slot name="description" /></p>
</template>

<style>

    h1 {
        color: red;
        font-size: x-large;
        text-decoration: underline;
    }
    
</style>
```

```vue
<!-- /pages/index.vue -->
<template>
    <div>
        <Header>
            <template v-slot:header>
                Index page
            </template>
            <template v-slot:description>
                Hello World !
            </template>
        </Header>
    </div>
</template>
```

```vue
<!-- /pages/about.vue -->
<template>
    <div>
        <Header>
            <template v-slot:header>
                About
            </template>
            <template v-slot:description>
                This is me !
            </template>
        </Header>
    </div>

</template>
```

## Les variable

Pour créer une variable JS/TS en NuxtJS, il suffit de se mettre dans la partie `<script>` d'un composant et d'utiliser les mots clefs classiques du langage. Pour faire cela et voir comment manipuler des variables dans Nuxtjs, nous allons créer une nouvelle `/pages/greetings.vue` : 

```vue
<script setup lang="ts">

    let name: string = "James";

</script>

<template>
<h1>Hello {{name}}</h1>

</template>

```

La partie `let name: string = 'James';` crée une variable `name`, utilisable aussi bien dans le reste du `script` que dans le `html`. `<h1>Hell {{name}}</h1>` grâce aux `{{}}`.

## Passer une variable à un composant

Les slots sont pratiques lorsque l'ont veut faire passer du contenu statique d'un composant parent à un composant enfant. Mais ils sont inadaptés lorsque l'ont veut transmettre une variable. Pour cela, nous utiliserons des `props`.

Créons un nouveau composant `/components/Greetings.vue` : 

```vue
<script setup lang="ts" >
defineProps({
  name: String,
})
</script>

<template>
  <h1>Hello {{name}}</h1>
</template>
```

Pour définir les props utilisés par un composant, il faut utiliser la fonction `defineProps` dans une balise `<script setup>`.

Pour utiliser ce composant avec son props, mettons à jour la `/pages/greetings.vue` : 

```vue
<template>
    <Greetings name="Charles" />
</template>

```

Nous avons ici la balise `<Greetings />` qui intègre le composant `Greetings`. Pour lui passer le props dont il a besoin pour fonctionner, il suffit de rajouter le nom de ce props dans la balise suivi de sa valeur selon le schéma `nomDuProps=value`. Ici : `name="Charles"`.

Si on veut affecter une variable au props, il faut utiliser la syntaxe : `:nomDuProps="variable"` : 
```vue
<script setup lang="ts">

    let user: string = "James";

</script>

<template>
<Greetings name="Charles" />
<Greetings :name="user" />
</template>
```

Si le nom du props est le même que le nom de la variable à passer, on peut simplement écrire `:nomDuProps` : 

```vue
<script setup lang="ts">

    let user: string = "James";
    let name: string = "Michael";

</script>

<template>
<Greetings name="Charles" />
<Greetings :name="user" />
<Greetings :name />
</template>

```

En utilisant `defineProps({name: String = "John"})` sans donner de valeur, cela signifie que le props n'aura pas de valeur par défaut. Donc, si aucune valeur n'est renseignée dans le composant parent, une erreur aurait été levée. Pour donner une valeur par défaut au props, il faut utiliser une autre notation :

```vue
<script setup lang="ts" >
defineProps({
  name: {
    type: String,
    default: 'John'
  },
})
</script>

<template>
  <h1>Hello {{name}}</h1>
</template>
```

## Mettre à jour une variable par l'interface

Il est possible qu'une variable, une fois utilisée sur l'interface, soit manipulé et modifié. Pour que ce changement soit reflété dans JS, il faut utiliser le mot clef `v-model` à la place de `value` dans la balise input. Nous allons créer une nouvelle `/pages/sum.vue` : 


```vue
<!-- /pages/sum.vue-->
<script setup lang="ts">
import { ref } from 'vue';

    let num1: number = 0;
    let num2: number = 0;
    let result = ref(0);

    function sum() {
        result.value = num1 + num2;
    }
    
</script>

<template>
  <div>
    <input type="number" v-model="num1">
    <input type="number" v-model="num2">
    
    <button v-on:click="sum" >Sum</button>

    <p>The sum is: {{ result }}</p>
  </div>
</template>

```

Nous avons ici une page qui initialise deux variables à 0, et lie les changements réalisés par l'utilisateur sur l'interface à ces variables.

## Les events

Dans l'exemple précédent, nous avons utilisé un bouton avec à l'intérieur `v-on:click`. C'est ce qu'on appelle un event. Avec NuxtJS, il est possible de créer des évènements et de les affecter à des fonctions de notre partie script. 

Les events du DOM sont les évènements classiques que chaque navigateur gère par défaut. Le plus pratique d'entre eux est le `v-on:click`, vu précédemment, qui s'active lorsqu'on clique avec la souris sur l'élément html associé. Il nous permet de lancer une fonction, avec le schéma `v-on:click={methodToCall}`. 

Pour illustrer cette fonctionnalité, nous allons créer un compteur avec une nouvelle page `/pages/count.vue` : 

```vue
<script setup lang="ts">
import { ref } from 'vue';

    let num = ref(0);

    function increment() {
        num.value++;
    }

    function decrement() {
        num.value--;
    }
    
</script>


<template>
  <div>

    <button v-on:click="decrement" >-</button>
    <p>{{ num }}</p>
    <button v-on:click="increment" >+</button>

  </div>
</template>

```

## Les conditions et les boucles

Avec NuxtJS, il est possible de manipuler l'html en fonction des variables. En effet, on peut afficher un bloc en fonction d'une condition, répéter un bloc par rapport à une liste ou encore afficher différents blocs en fonction de l'état d'avancement d'une requête API.

**Bloc conditionnel**

Pour afficher un bloc d'html en fonction d'une condition, on utilisera le pattern `v-if`. Modifions la `/pages/count.vue` pour afficher un message pour savoir si le nombre affiché est pair ou impair : 

```vue
<script setup lang="ts">
import { ref } from 'vue';

    let num = ref(0);

    function increment() {
        num.value++;
    }

    function decrement() {
        num.value--;
    }
    
</script>


<template>
  <div>

    <button v-on:click="decrement" >-</button>
    <p>{{ num }}</p>
    <button v-on:click="increment" >+</button>

    <p v-if="num%2===0">The count is even</p>
    <p v-else>The count is odd</p>

  </div>
</template>
```

**Boucle**

Si on veut répéter un bloc html pour afficher les différents éléments d'une liste, on utilisera le pattern `v-for`. Créons une nouvelle page `/pages/todo.vue` pour afficher une todolist : 

```vue
<script setup lang="ts">

    let todoList: string[] = ['walk the dog', 'exercise', 'eat a fruit'];
    
</script>


<template>
  <div>

        <ul>
            <li v-for="todo in todoList">{{todo}}</li>
        </ul>

  </div>
</template>

```

## Les variables réactives

```vue
<script setup lang="ts">
import { computed, reactive, ref } from 'vue';

    let state = reactive({
        number: 0
    });

    const double = computed(() => state.number * 2);
    const quadruple = computed(() => double.value * 2);
    const half = computed(() => state.number / 2);
    const square = computed(() => state.number ** 2);
    
</script>

<template>
    <div>
        <input type="number" v-model="state.number">
        <p>The number is: {{ state.number }}</p>
        <p>The double is: {{ double }}</p>
        <p>The quadruple is: {{ quadruple }}</p>
        <p>The half is: {{ half }}</p>
        <p>The square is: {{ square }}</p>
    </div>
</template>
```

## Créer un layout

```vue
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

## CSS

```vue
<!-- /pages/+layout.vue-->
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

```vue
<!-- /pages/+page.vue-->
<script lang="ts">

import Header from "$lib/Header.vue";

</script>

<Header>
    <span slot="header">Welcome to SvelteKit</span>
    <span slot="description">Visit <a href="https://kit.vue.dev">kit.vue.dev</a> to read the documentation</span>
</Header>


<p>In page</p>

<style>
    p{
        color: brown;
    }
</style>
```

```vue
<!-- /components/Header.vue-->
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


## Le store

```ts
// /src/store.ts
import { writable } from 'svelte/store';

export const number = writable(0);
```

```vue
<!-- /pages/count/+page.vue -->
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

```vue
<!-- /pages/reactive/+page.vue -->
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
