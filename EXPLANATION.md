# Explanation

## Fallback loading

Here I render the `Comments` on the client-side. This is because I stored the data inside `ref` so that I can integrate the pagination as well.

```jsx
<ClientOnly fallback="Loading comments...">
    ...
<ClientOnly/>
```

## Fallback empty data

```jsx
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

```jsx
<button
    class="bg-[#00DB81] w-max mx-auto p-2 rounded-lg text-white hover:opacity-80 transition"
    @click="handleLoadMoreComments"
    v-if="comments.length > 0 && nextPageUrl !== null"
>
    Load More
</button>
```
