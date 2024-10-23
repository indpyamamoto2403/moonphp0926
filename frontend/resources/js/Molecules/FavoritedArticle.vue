<!-- src/components/ArticleItem.vue -->
<template>
    <li class="mb-4 p-4 bg-gray-700 rounded">
        <h2 class="text-xl font-semibold mb-4">{{ item.instant_news_title }}</h2>
        <p class="text-sm">{{ item.instant_news_summary }}</p>
        <p class="text-xs text-gray-300">キーワード: {{ item.combined_keyword }}</p>
        <a :href="item.instant_news_url" target="_blank" rel="noopener noreferrer" class="text-blue-400 underline">記事を読む</a>
    </li>
</template>

<script setup>
const props = defineProps({
    item: Object // itemは記事データオブジェクトとして受け取る
});
</script>
