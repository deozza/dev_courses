<script lang="ts">
  import { goto } from "$app/navigation";
    import { page } from "$app/stores";
  import PlayingCard from "$lib/PlayingCard.svelte";

    let game: object | null  = null;
    let currentTurn: object | null = null;
    let displayWageError: boolean = false;
    let waging: boolean = false;
    let gains: number = 0;

    async function getGame() {

        return fetch('http://127.0.0.1:8888/game/'+$page.params.id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || ''
            }}).then(response => {
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }

                if(response.status === 404) {
                    throw new Error('Not found');
                }

                if(response.status === 200){
                    return response.json()
                }
            })
            .then(data => {
                game = data;
                currentTurn = game.turns[game.turns.length - 1];
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }

                return null;
            });
    }

    async function createTurn() {
        return fetch('http://127.0.0.1:8888/game/'+$page.params.id+'/turn', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || ''
            }}).then(response => {
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }
                return response.json()
            })
            .then(data => {
                console.log(data);
                currentTurn = data;
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }

    async function wageTurn(e: Event) {
        waging = true;
        displayWageError = false;

        return fetch('http://127.0.0.1:8888/turn/'+currentTurn.id+'/wage', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Bearer': 'Authorization ' + localStorage.getItem('token') || '',
            },
            body: JSON.stringify({
				wager: (document.getElementById('wager') as HTMLInputElement).value
			})
        }).then(response => {
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }

                if(response.status === 400) {
                    displayWageError = true;
                    waging = false;
                    throw new Error('Bad request');
                }

                if(response.status === 200) {
                    return response.json()
                }

            })
            .then(data => {
                console.log(data);
                currentTurn = data;
                waging = false;

            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }

    async function hitTurn(){
        return fetch('http://127.0.0.1:8888/turn/'+currentTurn.id+'/hit', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || '',
            }
        }).then(response => {
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }
                return response.json()
            })
            .then(data => {
                currentTurn = data;
                if(currentTurn.status !== 'playing'){
                    gains = currentTurn.wager;
                }
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }

    async function standTurn(){
        return fetch('http://127.0.0.1:8888/turn/'+currentTurn.id+'/stand', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || '',
            }
        }).then(response => {
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }
                return response.json()
            })
            .then(data => {
                currentTurn = data;
                gains = currentTurn.wager;
                if(currentTurn.status === 'won' && currentTurn.playerHand.isBlackjack){
                    gains = currentTurn.wager * 2;
                }
                
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }

</script>


{#await getGame()}

    <p>Loading...</p>

{:then}

{#if game === null}
    <p>Game not found</p>
{:else}

{#if currentTurn.status === 'waging'}
<form class="flex flex-col w-2/3 p-6 " on:submit|preventDefault={(e) => wageTurn(e)}>
	
    <div class="flex justify-around items-center my-6">
        <label class="text-primary-foreground justify-items-start w-1/2" for="wager">Wager:</label>
        <input class="border justify-items-end w-1/2 py-1 rounded text-black" type="number" id="wager" name="wager" required/>
    </div>

    {#if displayWageError}
        <p class="text-red-500 text-center">You need to wage at least 10 coins</p>
    {/if}

    <div class="flex justify-around items-center my-6">
        <button type="submit" class="btn btn-lg variant-filled-primary rounded" disabled={waging}>Wage</button>
    </div>
</form>
{:else}
    <div class="flex flex-row flex-wrap w-full justify-between">
        <div class="flex flex-col w-1/3 items-center space-y-6">
            <h1 class="h1">Your hand</h1>
            <div class="flex flex-row justify-left items-center overflow-x-auto w-full">
                {#each currentTurn.playerHand.cards as card}
                    <PlayingCard suit={card.suit} value={card.value} />
                {/each}
            </div>
            {#if currentTurn.status !== 'playing'}
                <p class="text-center">Your score: {currentTurn.playerHand.score}</p>
                {#if currentTurn.playerHand.isBusted}
                    <p class="text-center text-error-500">Busted !</p>
                {/if}
                {#if currentTurn.playerHand.isBlackjack}
                    <p class="text-center text-danger-500">Blackjack !</p>
                {/if}
                
            {/if}
        </div>
        <div class="flex flex-col justify-center">
            <p class="h3 mb-3">Playing for {currentTurn.wager} coins</p>
            
            <div class="flex flex-row flex-wrap justify-center items-center w-full space-x-6">
                <button class="btn btn-xl variant-filled-success" on:click={() => hitTurn()} disabled={currentTurn.status !== 'playing'}>Hit</button>
                <button class="btn btn-xl variant-filled-primary" on:click={() => standTurn()} disabled={currentTurn.status !== 'playing'}>Stand</button>
            </div>
        </div>
        <div class="flex flex-col w-1/3 items-center space-y-6">
            <h1 class="h1">Dealer hand</h1>
            <div class="flex flex-row justify-left items-center overflow-x-auto w-full">
                {#each currentTurn.dealerHand.cards as card}
                <PlayingCard suit={card.suit} value={card.value} />
                {/each}
            </div>
            {#if currentTurn.status !== 'playing'}
                <p class="text-center">Dealer score: {currentTurn.dealerHand.score}</p>
            {/if}
            {#if currentTurn.dealerHand.isBusted}
                    <p class="text-center text-error-500">Busted !</p>
                {/if}
                {#if currentTurn.dealerHand.isBlackjack}
                    <p class="text-center text-danger-500">Blackjack !</p>
                {/if}

        </div>
    </div>
    {#if currentTurn.status !== 'playing'}
        <p class="text-center">
            You {currentTurn.status} {gains} coins
        </p>
        <button class="btn btn-lg variant-filled-primary" on:click={() => createTurn()}>New turn</button>
    {/if}

{/if}

{/if}

{/await}
