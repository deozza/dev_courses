<script lang="ts">
  import { goto } from "$app/navigation";

    let displayAuthError: boolean = false;
	let loading: boolean = false;

	async function submitLogin(e: Event) {
		loading = true;

		await fetch('http://127.0.0.1:8888/login_check', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({
				username: (document.getElementById('username') as HTMLInputElement).value,
				password: (document.getElementById('password') as HTMLInputElement).value
			})
		})
		.then(response => response.json())
		.then(data => {
			if(data.code === 401) {
				displayAuthError = true;
				loading = false;
				return;
			}

			localStorage.setItem('token', data.token);
			goto('/user/profile');
		})

	}
    
</script>

<div class="flex flex-col justify-center items-center w-full rounded variant-glass-surface">

	<h1 class="h1 py-3">Login</h1>

	<div>
		<p>Not already registered ? <a href="/signup" class="anchor">Create an account !</a></p>
	</div>
	
	<form class="flex flex-col w-2/3 p-6 " on:submit|preventDefault={(e) => submitLogin(e)}>
	
		<div class="flex justify-around items-center my-6">
			<label class="text-primary-foreground justify-items-start w-1/2" for="username">Username:</label>
			<input class="border justify-items-end w-1/2 py-1 rounded text-black" type="text" id="username" name="username" required/>    
		</div>
		<div class="flex justify-around items-center my-6">
			<label class="text-primary-foreground justify-items-start w-1/2" for="password">Password:</label>
			<input class="border justify-items-end w-1/2 py-1 rounded text-black" type="password" id="password" name="password" required/>
		</div>
	
		{#if displayAuthError}
			<p class="text-red-500 text-center">Invalid username or password</p>
		{/if}
	
		<div class="flex justify-around items-center my-6">
			<button type="submit" class="btn btn-lg variant-filled-primary rounded" disabled={loading}>Login</button>
		</div>
	</form>
</div>
