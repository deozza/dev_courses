<script lang="ts">
    import '../app.css'
</script>

<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/await">Await</a></li>
        <li><a href="/cat">Cat</a></li>
        <li><a href="/count">Count</a></li>
        <li><a href="/reactive">Reactive</a></li>
        <li><a href="/sum">Sum</a></li>
        <li><a href="/todo">Todo</a></li>

    </ul>
</nav>

<main>
    <slot></slot>
</main>

<p>In layout</p>

<style>
    p {
        color: blue;
    }
</style>

