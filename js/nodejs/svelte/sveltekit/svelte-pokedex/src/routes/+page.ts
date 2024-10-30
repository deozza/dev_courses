import type { PageLoad } from './$types';

export const load: PageLoad = async ({ fetch }) => {

    const res = await fetch(`https://pokeapi.co/api/v2/pokemon`);
    const items = await res.json();

    let pokemons: Array<object> = [];

    for(let i = 0; i < items.results.length; i++) {
        const name: string = items.results[i].name;

        const pokemonDetailsRequest = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}`);
        const pokemonDetails = await pokemonDetailsRequest.json();
        const sprite: string = pokemonDetails.sprites.front_default;

        const pokemonItem = {
            name: name.charAt(0).toUpperCase() + name.slice(1),
            sprite: sprite
        }

        pokemons = [...pokemons, pokemonItem];
    }


    return { pokemons };
};
