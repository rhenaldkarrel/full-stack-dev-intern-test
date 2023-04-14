# Explanation

## Fallback loading

Here I render the `Comments` on the client-side. This is because I stored the data inside `ref` so that I can integrate the pagination as well.

```vue
<ClientOnly fallback="Loading comments...">
    ...
<ClientOnly/>
```

## Fallback empty data

```vue
<CommentItem
    v-for="comment in comments"
    :key="comment.username"
    :username="comment.username"
    :comment="comment.comment"
/>
<p v-if="comments.length === 0">No data found.</p> // fallback if data is empty
```

## Conditionally render Load More button

Here I render the `Load More` button in two conditions:

- `Comments` data is not empty
- `nextPageUrl` property from Laravel is not null.

```vue
<button
    class="bg-[#00DB81] w-max mx-auto p-2 rounded-lg text-white hover:opacity-80 transition"
    @click="handleLoadMoreComments"
    v-if="comments.length > 0 && nextPageUrl !== null"
>
    Load More
</button>
```

## Debounce search functionality

I created the search functionality everytime the users typing. But, I optimized it by utilizing `debounce` function so it won't perform API Call on every single letter typed by the user. I also gave a feedback about the words searched in the UI.

`debounce.ts`

```vue
export function debounce(func: Function, delay: number) {
    let timerId: NodeJS.Timeout;
    return function (this: any, ...args: any[]) {
        clearTimeout(timerId);
        timerId = setTimeout(() => {
            func.apply(this, args);
        }, delay);
    };
}
```

`CommentSearchForm.vue`

```vue
<template>
    ...
    <input
        type="search"
        name="query"
        class="py-2 text-sm border rounded-full pl-10 pr-2 focus:outline-none w-full max-w-[512px]"
        placeholder="Search..."
        autocomplete="off"
        v-model="state.query"
        @input="handleSearch"
    />
    ...
    <p v-if="state.query" class="text-gray-500">Searching: {{ state.query }}</p> // feedback
    ...
</template>

<script setup lang="ts">
const state = reactive({
    query: "",
});

const emits = defineEmits(["handleSearch"]);

function handleSearch(e: Event) {
    e.preventDefault();

    emits("handleSearch", state.query);
}
</script>
```

`index.vue`

```vue
<template>
    ...
    <CommentSearchForm @handle-search="debouncedHandleSearch" />
    ...
</template>

<script setup>
async function handleSearch(query) {
   ...
}

const debouncedHandleSearch = debounce(handleSearch, 500);
</script>
```

## Highlight query searched

Here, I created state to store `words` (the query) searched.

```vue
const state = reactive({
    words: ""
});
```

And, everytime users perform search functionality, the query typed will be assigned to the state.

```vue
async function handleSearch(query) {
    try {
        state.words = query;
        ...
    }
    ...
```

The assigned state will be passed to the `CommentItem` component. Here I render the username and comment data inside the `WordHighlighter` component (from an open source project [`vue-word-highlighter`](https://github.com/kawamataryo/vue-word-highlighter)).

`index.vue`

```vue
<CommentItem
    v-for="comment in comments"
    :key="comment.username"
    :username="comment.username"
    :comment="comment.comment"
    :words="state.words"
/>
```

`CommentItem.vue`

```vue
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
```
