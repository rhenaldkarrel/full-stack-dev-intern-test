<template>
    <div class="border rounded-lg p-4">
        <h1 class="text-xl font-semibold">{{ props.username }}</h1>
        <p>{{ props.comment }}</p>
    </div>
</template>

<script setup lang="ts">
const props = defineProps({
    username: String,
    comment: String,
});
</script>
