<script lang="ts">
    import "iconify-icon"
    import { slide } from 'svelte/transition';
	import { quintOut } from 'svelte/easing';
    
    export let suit: string;
    export let value: number
</script>

<div class="bg-white flex flex-col items-center justify-between rounded-xl card-hover p-4 min-h-48 min-w-36 m-1 {suit}" transition:slide={{ delay: 250, duration: 300, easing: quintOut, axis: 'x' }}>
    <div class="text-start w-full">
        <iconify-icon icon={"bi:suit-"+suit+"-fill"}/>
    </div>
    <span class="h1 font-semibold">{value}</span>
    <div class="text-end w-full">
        <iconify-icon icon={"bi:suit-"+suit+"-fill"} class="backward"/>
    </div>
</div>

<style>
    .spades, .clubs {
        color: black;
    }

    .hearts, .diamonds {
        color: red;
    }

    .backward {
        transform: rotate(180deg);
    }
</style>