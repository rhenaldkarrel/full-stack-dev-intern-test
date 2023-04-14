<template>
    <div class="border rounded-lg p-4">
        <h1 class="text-xl font-semibold">
            <WordHighlighter :query="props.words" :splitBySpace="true">
                {{ props.username }}
            </WordHighlighter>
        </h1>
        <p>
            <WordHighlighter :query="props.words" :splitBySpace="true">
                {{ props.comment }}
            </WordHighlighter>
        </p>
    </div>
</template>

<script setup lang="ts">
import WordHighlighter from "vue-word-highlighter";

const props = defineProps({
    username: String,
    comment: String,
    words: String,
});
</script>
