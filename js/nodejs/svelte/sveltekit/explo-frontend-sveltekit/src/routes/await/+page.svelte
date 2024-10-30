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