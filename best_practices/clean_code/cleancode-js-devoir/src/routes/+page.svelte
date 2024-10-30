<script lang="ts">

    import { fight, init, newRound } from "$lib";

    let state: any = {
        playerMaxHealth: null,
        playerCurrentHealth: null,
        enemyMaxHealth: null,
        enemyCurrentHealth: null,
        playerWeapon: null,
        enemyWeapon: null,
        hasInit: false,
        hasRound: false,
        hasFought: false,
        playerWon: false,
        playerLost: false
    };

    function triggerInit() {
        state = init();
    }

    function triggerNewRound() {
        let response = null;
        try {        
            response = newRound(state.hasInit);
        } catch (error) {
            console.error(error);
        }

        if(response !== null) {
            state.playerWeapon = response.playerWeapon;
            state.enemyWeapon = response.enemyWeapon;
            state.hasRound = response.hasRound;
            state.hasFought = response.hasFought;
        }

    }

    function triggerFight() {
        let response = null;

        try {        
            response = fight(state.playerCurrentHealth, state.enemyCurrentHealth, state.playerWeapon, state.hasInit, state.hasRound, state.hasFought);
        } catch (error) {
            console.error(error);
        }

        if(response !== null) {
            state.playerCurrentHealth = response[0];
            state.enemyCurrentHealth = response[1];
            state.enemyWeapon = response[2];
            state.hasFought = response[3];
            state.playerWon = response[4];
            state.playerLost = response[5];
        }
    }

</script>


<section id="player" class="w-1/3">
    {#if state.hasInit === true}
        <div class="flex flex-row items-center justify-between flex-wrap w-full">
            <div class="flex flex-col items-center justify-center w-full">
                <h1 class="text-2xl font-bold">Player</h1>
                <p class="text-lg">Health: {state.playerCurrentHealth} / {state.playerMaxHealth}</p>
                <p class="text-lg">Weapon name: {state.playerWeapon.name}</p>
                <p class="text-lg">Weapon description: {state.playerWeapon.description}</p>
            </div>
        </div>
    {/if}
</section>

<section id="action">
    {#if state.hasInit === false}
        <button class="btn btn-xl variant-filled-primary" on:click={triggerInit}>Start</button>
    {:else}
        {#if (state.hasRound === true && state.hasFought === true && state.playerWon === false && state.playerLost === false)}
            <button class="btn btn-xl variant-filled-warning" on:click={triggerNewRound}>Next Round</button>
        {/if}

        {#if (state.hasRound === true && state.hasFought === false && state.playerWon === false && state.playerLost === false)}
            <button class="btn btn-xl variant-filled-error" on:click={triggerFight}>Fight</button>
        {/if}

        {#if (state.hasRound === true && state.hasFought === true && state.playerWon === true && state.playerLost === false)}
            <p class="p">You won !</p>
            <button class="btn btn-xl variant-filled-primary" on:click={triggerInit}>Play again</button>
        {/if}

        {#if (state.hasRound === true && state.hasFought === true && state.playerWon === false && state.playerLost === true)}
            <p class="p">You lost ...</p>
            <button class="btn btn-xl variant-filled-primary" on:click={triggerInit}>Play again</button>
        {/if}
    {/if}
</section>

<section id="enemy" class="w-1/3">
    {#if state.hasInit === true}
        <div class="flex flex-row items-center justify-between flex-wrap w-full">
            <div class="flex flex-col items-center justify-center w-full">
                <h1 class="text-2xl font-bold">Enemy</h1>
                <p class="text-lg">Health: {state.enemyCurrentHealth} / {state.enemyMaxHealth}</p>
                {#if state.enemyWeapon !== null}
                    <p class="text-lg">Weapon name: {state.enemyWeapon.name}</p>
                    <p class="text-lg">Weapon description: {state.enemyWeapon.description}</p>
                {/if}
            </div>
        </div>
    {/if}
</section>
