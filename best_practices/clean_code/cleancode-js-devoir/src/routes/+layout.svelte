<script>
	import '../app.css';
</script>

<main class="w-full h-screen bg-surface-500">
	<div class="w-full h-full flex flex-col items-center justify-center">
		<div class="w-11/12 h-full flex flex-row items-center justify-between">
			<slot></slot>
		</div>
	</div>
</main>
