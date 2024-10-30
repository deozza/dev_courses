<script lang="ts">
	import CalculatorService from "$lib/services/calculator/CalculatorService";

    let a:number = 0;
    let b:number = 0;
    let operator:string = '';
    let result: number|null = null;
    let errors: string[] = [];

    function calculate() {
        errors = [];
        const calculatorService = new CalculatorService();
        const requestParams: object = {
            operation: operator,
            leftOperand: a,
            rightOperand: b
        };

        errors = calculatorService.getErrorsFromRequestParams(requestParams);
        if(errors.length > 0)
        {
            return;
        }

        if(!calculatorService.checkOperationExists(operator))
        {
            errors = [...errors, 'The operation is invalid'];
            return;
        }

        if(!calculatorService.checkOperatorsAreNumeric(a, b))
        {
            errors = [...errors, 'The operands must be numeric'];
            return;
        }

        result = calculatorService.calculate(operator, a, b);
    }

</script>

<h1>Simple calculator</h1>

<input type="number" bind:value={a} />
<input type="text" bind:value={operator}>
<input type="number" bind:value={b} />
<input type="number" bind:value={result} disabled>

<button on:click={calculate}>Calculate</button>

{#if errors.length > 0}
    <ul>
        {#each errors as error}
            <li>{error}</li>
        {/each}
    </ul>
{/if}