<script lang="ts">
    let name: string = '';

    function redirectAccordingToNameSearch() {
        if (name) {
            window.location.href = `/${name}`;
        }
    }

</script>

<div class="flex flex-row justify-between">
    <input type="text" placeholder="Type here" class="input input-bordered w-6/12" id="input-search" bind:value={name} />
    <button class="btn w-5/12 btn-primary" id="button-search" on:click={redirectAccordingToNameSearch}>Search</button>
</div>