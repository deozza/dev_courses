<script lang="ts">
    import { page } from '$app/stores';
	import StatBar from '$lib/StatBar.svelte';
  
    const pokemon = $page.data.pokemon;
    const promise = getMoves();

    async function getMoves(){
        let movesDromRequest: Array<object> = [];

        for(let i = 0; i < pokemon.moves.length; i++) {
            const res = await fetch(pokemon.moves[i].move.url);
            const move = await res.json();
            movesDromRequest = [...movesDromRequest, move];
        }

        return movesDromRequest;
    }
</script>

<div class="flex flex-row justify-between w-full">
    <div class="flex flex-col justify-center items-center w-3/12">
        <div class="flex flex-row items-center">
            <h1 class="text-4xl">{pokemon.name.charAt(0).toUpperCase() + pokemon.name.slice(1)}</h1>
            <div class="flex flex-row items-center">
                {#each pokemon.types as type, i}
                    <span class="badge badge-primary ml-2" id="type-{i+1}">{type.type.name}</span>
                {/each}
            </div>
        </div>
        <img src="{pokemon.sprites.other.home.front_default}" alt="image for {pokemon.name}">
        <div>
            <p class="text-2xl">Abilities :</p>
            <ul>
                {#each pokemon.abilities as ability, i}
                    <li id="ability-{i+1}">{ability.ability.name}</li>
                {/each}
            </ul>
        </div>
    </div>
    <div class="flex justify-end w-full">
        <div class="flex flex-col justify-center w-9/12">
            {#each pokemon.stats as stat}
                <StatBar statName="{stat.stat.name}" statValue="{stat.base_stat}" />
            {/each}
        </div>
    </div>
</div>

{#await promise}
          chargement des moves      
{:then moves} 
<div>
    <p class="text-2xl">Moves :</p>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Power</th>
                <th>Accuracy</th>
                <th>PP</th>
                <th>Effect</th>
            </tr>
        </thead>
        <tbody>
            {#each moves as move}
                <tr class="hover">
                    <td>{move.name}</td>
                    <td>{move.type.name}</td>
                    <td>{move.power}</td>
                    <td>{move.accuracy}</td>
                    <td>{move.pp}</td>
                    <td>{move.effect_entries[0].short_effect}</td>
                </tr>
            {/each}
        </tbody>
    </table>
</div>

{:catch error}
    <p>{error.message}</p>
{/await}
