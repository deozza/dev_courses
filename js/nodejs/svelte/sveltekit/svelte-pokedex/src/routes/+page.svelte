<script lang="ts">
  	import { page } from '$app/stores';
	import Search from '$lib/Search.svelte';

    const pokemons = $page.data.pokemons;
</script>

<Search />
<div class="flex flex-col">
  {#each pokemons as pokemon, i}
    <a href="./{pokemon.name}" class="text-white transition ease-in-out delay-150 hover:text-primary">
      <div class="flex flex-row flex-grow justify-between items-center card bordered shadow-lg bg-base-200 my-3 p-3">
        <img src="{pokemon.sprite}" alt="sprite of {pokemon.name}" id="sprite-{i+1}">
        <span id="name-{i+1}">{pokemon.name}</span>
      </div>
    </a>
  {/each}
</div>
    
