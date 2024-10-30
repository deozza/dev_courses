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