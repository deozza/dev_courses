<script lang="ts">
  import { goto } from "$app/navigation";

    const user = null;

    async function getUser() {
        return fetch('http://127.0.0.1:8888/user/profile', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token') || ''
            }}).then(response => {
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
</script>


{#await getUser()}

    <p>Loading...</p>

{:then}
<h1 class="h1">Welcome {user.username} !</h1>
<div class="flex flex-col w-2/3 p-6 ">
	
    <div class="flex justify-around items-center my-6">
        <label class="text-primary-foreground justify-items-start w-1/2" for="username">Username:</label>
        <input class="border justify-items-end w-1/2 py-1 rounded text-black" type="text" id="username" name="username" bind:value={user.username} disabled/>    
    </div>
    <div class="flex justify-around items-center my-6">
        <label class="text-primary-foreground justify-items-start w-1/2" for="email">Email:</label>
        <input class="border justify-items-end w-1/2 py-1 rounded text-black" type="email" id="email" name="email" bind:value={user.email} disabled/>
    </div>
    
    <div class="flex justify-around items-center my-6">
        <label class="text-primary-foreground justify-items-start w-1/2" for="wallet">Wallet:</label>
        <input class="border justify-items-end w-1/2 py-1 rounded text-black" type="number" id="wallet" name="wallet" bind:value={user.wallet} disabled/>
    </div>

</div>
{/await}
