import type { PageLoad } from './$types';

export const load: PageLoad = async ({ fetch, params }) => {

    const name = params.id.toLocaleLowerCase();
    const res = await fetch(`https://pokeapi.co/api/v2/pokemon/${name}`);
    const pokemon = await res.json();


    return { pokemon };
    
};
