<script setup>
const props = defineProps({
    item: Object, // 親コンポーネントから記事データを受け取る
});
</script>

<template>
    <div class="my-4 bg-gray-900 text-center rounded-xl shadow-lg border border-gray-700 w-full p-4">
        <p class="text-left text-white my-2 text-xl">
            {{ item.title }}
        </p>
        <div class="mt-4 text-left w-full mb-2">
            <span class="text-gray-200">{{ item.summary }}</span>
        </div>
        <div class="mt-4 text-left w-full">
            <a :href="item.url" target="_blank" class="text-blue-400 underline break-all">
                {{ item.url }}
            </a>
        </div>
    </div>
</template>
