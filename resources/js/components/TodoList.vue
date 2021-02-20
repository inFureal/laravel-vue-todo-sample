<template>
<div>

    <div>
        <input
            type="text"
            class="border-0 w-full px-6 py-4 focus:outline-none focus:ring-0"
            placeholder="Добавить задачу..."
            @keydown.enter="addItem"
            v-model="input">
    </div>

    <div v-if="todos.length > 0" v-for="todo in todos" class="px-6 py-4 flex items-center border-t">

        <div @click="toggle(todo)" class="w-4 h-4 rounded border flex items-center justify-center" :class="{'border-blue-500': todo.finished}">
            <svg v-if="todo.finished" class="text-blue-500 w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="ml-3" :class="{'line-through': todo.finished}">
            {{ todo.text }}
        </div>

        <button @click="$emit('delete', todo)" class="focus:outline-none transition ease-in-out duration-200 ml-auto w-5 h-5 rounded text-red-300 hover:text-red-500 hover:bg-red-100 flex items-center justify-center">
            <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>

    </div>

    <div v-if="todos.length === 0" class="text-gray-500 text-center p-5 border-t">
        Задач нет...
    </div>

</div>
</template>

<script>
export default {
    props: ['todos'],
    data() {
        return {
            input: ''
        }
    },
    mounted() {
        console.log(this.todos)
    },
    methods: {
        addItem() {

            if (this.input)
                this.$emit('newItem', this.input)

            this.input = ''
        },

        toggle(todo) {
            this.$emit('toggle', todo)
        }
    }
}
</script>
