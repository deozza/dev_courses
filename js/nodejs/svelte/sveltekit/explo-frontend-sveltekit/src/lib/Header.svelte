<script lang="ts">

</script>

<h1><slot name="header"/></h1>

<p>
    <slot name="description"/>
</p>

<p class="global">Get the global css</p>
<style>

    h1 {
        color: red;
        font-size: x-large;
        text-decoration: underline;
    }

    p{
        color: green;
    }
    
</style>