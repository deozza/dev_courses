<script lang="ts">
	import '../../app.postcss';
	import { AppShell, AppBar } from '@skeletonlabs/skeleton';
</script>

<AppShell>
	<svelte:fragment slot="header">
		<!-- App Bar -->
		<AppBar>
			<svelte:fragment slot="lead">
				<strong class="text-xl uppercase">Blackjack</strong>
			</svelte:fragment>
			<svelte:fragment slot="trail">
			</svelte:fragment>
		</AppBar>
	</svelte:fragment>
	<main class="container h-full mx-auto flex justify-center items-center">
		<div class="space-y-10 text-center flex flex-col items-center w-full">
			<slot />
		</div>
	</main>	
</AppShell>
