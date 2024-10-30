<script lang="ts">
    export let statName: string;
    export let statValue: number;

    function getStatColor(statValue: number) {
        if (statValue > 200) {
            return "info";
        } else if (statValue > 100) {
            return "warning";
        } else {
            return "error";
        }
    }


</script>

<div class="flex flex-row justify-between items-center my-1" id="{statName}">
    <p>{statName}</p>
    <div class="flex justify-end w-8/12 items-center">
        <span>{statValue}</span>
        <progress class="flex flex-grow progress progress-{getStatColor(statValue)}" value="{statValue}" max="255"></progress>
    </div>
</div>