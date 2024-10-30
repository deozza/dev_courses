<script lang="ts">
    import Sum from '$lib/Sum.svelte';

    let a = 0;
    let b = 0;
    let result = 0;


</script>

<h1>Sum</h1>

<Sum {a} {b} bind:result={result} />

<p>Result: {result}</p>