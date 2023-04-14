<template>
    <div class="max-w-7xl mx-auto border min-h-[calc(100vh_-_68px)] p-8 space-y-4">
        <CommentSearchForm />
        <div class="flex flex-col space-y-4">
            <CommentItem
                :username="'John Doe'"
                :comment="'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil consectetur, ex maxime quo accusamus soluta quasi. Quos blanditiis, ab aspernatur ea temporibus sapiente illo! Adipisci impedit dolorum, explicabo nesciunt, quos ullam quasi maxime natus, alias eius aspernatur consequuntur perferendis magnam!'"
            />
            <CommentItem
                :username="'John Doe'"
                :comment="'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil consectetur, ex maxime quo accusamus soluta quasi. Quos blanditiis, ab aspernatur ea temporibus sapiente illo! Adipisci impedit dolorum, explicabo nesciunt, quos ullam quasi maxime natus, alias eius aspernatur consequuntur perferendis magnam!'"
            />
            <CommentItem
                :username="'John Doe'"
                :comment="'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil consectetur, ex maxime quo accusamus soluta quasi. Quos blanditiis, ab aspernatur ea temporibus sapiente illo! Adipisci impedit dolorum, explicabo nesciunt, quos ullam quasi maxime natus, alias eius aspernatur consequuntur perferendis magnam!'"
            />
        </div>
    </div>
</template>

<script setup>
import CommentSearchForm from "~/components/CommentSearchForm.vue";
import CommentItem from "~/components/CommentItem.vue";
</script>
