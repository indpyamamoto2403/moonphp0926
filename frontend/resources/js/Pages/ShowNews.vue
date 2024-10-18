<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
const props = defineProps({
    news_data: {
        type: String,
    },
})

console.log("News data:", props.news_data);

</script>
<template>
    <AuthenticatedLayout>
        <div class="w-[600px] gap-y-4">
            <div class="bg-green-800 mt-4 rounded-lg p-6 gap-y-2 w-full">
                <h1 class="text-white text-2xl">キーワード検索の結果</h1>
                <p class="text-white">検索したキーワード1:{{ news_data?.keyword1 }}</p>
                <p class="text-white">検索したキーワード2:{{ news_data?.keyword2 }}</p>
                <p class="text-white">検索したキーワード3:{{ news_data?.keyword3 }}</p>
            </div>
            <div class="flex flex-col w-full my-6 gap-y-4">
                <div class="section">
                    <span class="font-semibold text-right">ニュースタイトル: </span>
                    <p>{{ news_data.title }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">ニュースタイトル: </span>
                    <p>{{ news_data.title }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">ニュースタイトル: </span>
                    <p>{{ news_data.title }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">ニュースタイトル: </span>
                    <p>{{ news_data.title }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">ニュースタイトル: </span>
                    <p>{{ news_data.title }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style scoped>
.section{
    @apply bg-gradient-to-r from-gray-600 to-gray-500 text-white h-[180px] p-2 rounded-lg;
}
</style>