<script lang="ts">
  import { goto } from "$app/navigation";

    let games: Array<object>  = [];
    let actionOnGame: string | null = null;

    async function getGames() {
        return fetch('http://127.0.0.1:8888/game', {
            method: 'GET',
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
                games = data;
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }

    async function deleteGame(id: string) {
        actionOnGame = id;
        return fetch('http://127.0.0.1:8888/game/'+id, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || ''
            }}).then(response => {
                if(response.status === 204) {
                    games = games.filter(game => game.id !== id);
                }
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }
            
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }

    async function createGame() {
        return fetch('http://127.0.0.1:8888/game', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || ''
            }}).then(response => {
                if(response.status === 201) {
                    return response.json();
                }
                if(response.status === 401) {
                    throw new Error('Unauthorized');
                }
            }).then(data => {
                goto('/user/games/'+data.id);
            })
            .catch(error => {
                if(error.message === 'Unauthorized') {
                    localStorage.removeItem('token');
                    goto('/');
                }
            });
    }


</script>


{#await getGames()}

    <p>Loading...</p>

{:then}
    <div class="flex flex-row justify-between items-center w-1/3">
        <h1 class="h1">My games</h1>
        <button class="btn btn-sm variant-filled-success" on:click={() => createGame()}>New game</button>
    </div>
    {#if games.length === 0}
        <p>No games found</p>
    {:else}
        <table class="table">
            <thead>
                <tr>
                    <th>Game ID</th>
                    <th>Game status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                {#each games as game, i}
                    <tr>
                        <td>{i+1}</td>
                        <td>{game.status}</td>
                        <td>
                            {#if game.status === 'playing'}
                                <a href="/user/games/{i+1}" class="btn btn-sm variant-filled-primary">Resume</a>
                            {/if}
                            <button class="btn btn-sm variant-filled-error" on:click={() => deleteGame(game.id)} disabled={actionOnGame === game.id}>Delete</button>
                        </td>
                    </tr>
                {/each}
            </tbody>

        </table>
    {/if}

{/await}
