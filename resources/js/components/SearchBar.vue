<template>
<div>
    <input
        type="text"
        class="border-0 w-full px-6 py-4 focus:outline-none focus:ring-0"
        placeholder="Поиск по задачам..."
        v-model="value" @input="$emit('input', value)" />
</div>
</template>

<script>
export default {
    data() {
        return {
            value: ''
        }
    }
}
</script>
