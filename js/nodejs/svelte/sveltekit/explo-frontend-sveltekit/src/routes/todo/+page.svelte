<script lang="ts">
    let todoList: string[] = [];
    let todo: string = '';

    function addTodo() {
        console.log(todo);

        todoList = [...todoList, todo];
        console.log(todoList);
        todo = '';
    }

    function removeTodo(i: number) {
        todoList = todoList.filter((_, index) => index !== i); 
    }
</script>

<h1>Todo</h1>

<input type="text" bind:value={todo} placeholder="Add todo">
<button on:click={() => addTodo() }>Add</button>

<ul>
    {#each todoList as todo, i}
        <li>{todo} <button on:click={() => removeTodo(i)} >remove</button></li>
    {/each}
</ul>