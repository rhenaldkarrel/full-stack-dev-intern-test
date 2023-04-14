<template>
    <div
        class="max-w-7xl mx-auto border min-h-[calc(100vh_-_68px)] p-8 space-y-4"
    >
        <CommentSearchForm @handle-search="handleSearch" />
        <div class="flex flex-col space-y-4">
            <ClientOnly fallback="Loading comments...">
                <CommentItem
                    v-for="comment in comments"
                    :key="comment.username"
                    :username="comment.username"
                    :comment="comment.comment"
                />
                <p v-if="comments.length === 0">No data found.</p>
                <button
                    class="bg-[#00DB81] w-max mx-auto p-2 rounded-lg text-white hover:opacity-80 transition"
                    @click="handleLoadMoreComments"
                    v-if="comments.length > 0 && nextPageUrl !== null"
                >
                    Load More
                </button>
            </ClientOnly>
        </div>
    </div>
</template>

<script setup>
import CommentSearchForm from "~/components/CommentSearchForm.vue";
import CommentItem from "~/components/CommentItem.vue";

const comments = ref([]);
const nextPageUrl = ref("");
const { data } = useFetch(`http://localhost:8000/api/comments`);

if (data.value) {
    comments.value = data.value.data;
    nextPageUrl.value = data.value.next_page_url;
}

async function handleLoadMoreComments() {
    try {
        const response = await fetch(nextPageUrl.value);
        const newComments = await response.json();

        nextPageUrl.value = newComments.next_page_url;

        comments.value = [...comments.value, ...newComments.data];
    } catch (err) {
        console.log(err);
    }
}

async function handleSearch(query) {
    const response = await fetch(
        `http://localhost:8000/api/comments?query=${query}`
    );
    const data = await response.json();

    nextPageUrl.value = data.next_page_url;

    comments.value = [...data.data];
}
</script>
