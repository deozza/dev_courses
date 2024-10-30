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