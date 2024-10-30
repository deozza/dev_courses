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