<script lang="ts">
    import '../app.css';
</script>

<div class="navbar bg-base-100 mb-5">
    <div class="navbar-start">
      <div class="dropdown">
        <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
        </div>
      </div>
      <a class="btn btn-ghost text-xl" href="/">Pokedex en svelte</a>
    </div>
    <div class="navbar-center hidden lg:flex">
      <ul class="menu menu-horizontal px-1">
        <li><a href="/search">Rechercher un pokemon</a></li>
      </ul>
    </div>
  </div>

  <main>
    <div class="container mx-auto flex flex-row">
      <div class="flex flex-row justify-center w-full">
        <div class="flex flex-col w-6/12">
            <slot />
          </div>
        </div>
      </div>
  </main>
