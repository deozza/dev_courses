<script lang="ts">

    import { number } from "../store";


    $:double = $number * 2;
    $:quadruple = double * 2;
    $:half = $number / 2;
    $:square = $number ** 2;
</script>

<h1>Reactive</h1>

<input type="number" bind:value={$number}>

<p>{$number} * 2 = {double}</p>
<p>{$number} * 4 = {quadruple}</p>
<p>{$number} / 2 = {half}</p>
<p>{$number}² = {square}</p>
