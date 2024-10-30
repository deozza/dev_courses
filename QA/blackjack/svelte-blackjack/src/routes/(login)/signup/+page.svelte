<script lang="ts">
  import { goto } from "$app/navigation";

    let errors: object | null = null;
	let loading: boolean = false;

	async function submitCreateAccount(e: Event) {
		loading = true;
		errors = null;

		await fetch('http://127.0.0.1:8888/user', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json'
			},
			body: JSON.stringify({
				username: (document.getElementById('username') as HTMLInputElement).value,
				email: (document.getElementById('email') as HTMLInputElement).value,
				password: (document.getElementById('password') as HTMLInputElement).value
			})
		})
		.then(response => {
			if(response.status === 400) {
	
			}

			return response.json();
		})
		.then(data => {
			if(data.id !== undefined) {
				goto('/login');
			}else{
				errors = data;
				loading = false;
			}
		})
		.catch(err => {
			console.error(err);
		})

	}
    
</script>
<div class="flex flex-col justify-center items-center w-full rounded variant-glass-surface">

	<h1 class="h1 py-3">Create your account</h1>

	<div>
		<p>You already have an account ? <a href="/login" class="anchor">Log in !</a></p>
	</div>

	<form class="flex flex-col  w-2/3 p-6 " on:submit|preventDefault={(e) => submitCreateAccount(e)}>

		<div class="flex justify-around items-center my-6">
			<label class="text-primary-foreground justify-items-start w-1/2" for="username">Username:</label>
			<input class="border justify-items-end w-1/2 py-1 rounded text-black" type="text" id="username" name="username" required/>    
		</div>

		{#if errors !== null && errors.username !== undefined}
			<p class="text-red-500 text-center">{errors.username}</p>
		{/if}

		<div class="flex justify-around items-center my-6">
			<label class="text-primary-foreground justify-items-start w-1/2" for="email">Email:</label>
			<input class="border justify-items-end w-1/2 py-1 rounded text-black" type="email" id="email" name="email" required/>    
		</div>

		{#if errors !== null && errors.email !== undefined}
			<p class="text-red-500 text-center">{errors.email}</p>
		{/if}

		<div class="flex justify-around items-center my-6">
			<label class="text-primary-foreground justify-items-start w-1/2" for="password">Password:</label>
			<input class="border justify-items-end w-1/2 py-1 rounded text-black" type="password" id="password" name="password" required/>
		</div>

		{#if errors !== null && errors.password !== undefined}
			<p class="text-red-500 text-center">{errors.password}</p>
		{/if}

		<div class="flex justify-around items-center my-6">
			<button type="submit" class="btn btn-lg variant-filled-primary rounded" disabled={loading}>Register</button>
		</div>
	</form>
</div>