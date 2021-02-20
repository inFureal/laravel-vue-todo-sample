<template>
<div class="w-full min-h-screen bg-gray-200 flex items-center justify-center p-6">

    <div v-if="loading" class="fixed w-screen h-screen bg-black opacity-25 text-white">
    </div>

    <div class="w-full max-w-xl">

        <div class="mb-6">
            <card>
                <search-bar v-model="searchText" @input="filterItems" />
            </card>
        </div>

        <card>
            <todo-list @newItem="onNewItem" @toggle="toggleItem" @delete="deleteItem" :todos="todos" />
        </card>

        <div class="flex justify-center mt-6">
            <form action="/logout" method="post">
                <input type="hidden" name="_token" :value="csrf">
                <button class="px-4 py-2 rounded-md focus:outline-none bg-red-500 text-white">
                    Выход
                </button>
            </form>
        </div>

    </div>

</div>
</template>

<script>
import SearchBar from "./components/SearchBar";
import TodoList from "./components/TodoList";
import Card from "./components/Card";

export default {
    components: {Card, TodoList, SearchBar },
    data() {
        return {
            todos: [],
            original: [],
            searchText: '',
            loading: false,
        }
    },
    mounted() {
        this.getAllTodos()
    },
    computed: {
        csrf() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },
    methods: {
        onNewItem(text) {
            this.loading = true

            axios.post('todos', { text })
                .then((response) => {
                    this.todos.unshift(response.data.data)
                })
                .finally(() => this.loading = false)

        },

        getAllTodos() {
            this.loading = true

            axios.get('todos')
                .then((response) => {
                    this.todos = response.data.data
                    this.original = response.data.data
                })
                .finally(() => this.loading = false)

        },

        toggleItem(todo) {
            let finished = !todo.finished
            this.loading = true

            axios.put('todos/' + todo.id, {
                id: todo.id,
                text: todo.text,
                finished
            })
                .then((response) => {
                    let newItem = response.data.data

                    this.todos = this.todos.map((item) => {

                        if (item.id === newItem.id)
                            return newItem

                        return item
                    })

                })
                .finally(() => this.loading = false)

        },

        filterItems() {

            if (!this.searchText) {
                this.todos = this.original
                return
            }

            this.todos = this.original.filter((item) => {
                return item.text.includes(this.searchText)
            })

        },

        deleteItem(todo) {
            this.loading = true
            axios.delete('todos/' + todo.id)
                .then((response) => {
                    this.todos = this.removeFrom(this.todos, todo.id)
                    this.original = this.removeFrom(this.original, todo.id)
                })
                .finally(() => this.loading = false)

        },

        removeFrom(array, id) {
            return array.filter((item) => {
                return item.id !== id;
            })
        }
    }
}
</script>
