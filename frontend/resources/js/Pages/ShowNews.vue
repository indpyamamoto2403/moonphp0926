<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NewsArticle from '@/Molecules/NewsArticle.vue'; // コンポーネントをインポート
const props = defineProps({
    news_data: {
        type: Object,
    },
})
</script>

<template>
    <AuthenticatedLayout>
        <div class="w-[600px] gap-y-4">
            <div class="bg-green-800 mt-4 rounded-lg p-6 gap-y-2 w-full">
                <h1 class="text-white text-2xl">キーワード検索の結果</h1>
                <p class="text-white">検索したキーワード1: {{ news_data?.input_dataset?.keyword1 }}</p>
                <p class="text-white">検索したキーワード2: {{ news_data?.input_dataset?.keyword2 }}</p>
                <p class="text-white">検索したキーワード3: {{ news_data?.input_dataset?.keyword3 }}</p>
            </div>

            <!-- ニュースデータのループを追加 -->
            <div class="flex flex-col w-full my-6 gap-y-4">
                <NewsArticle
                    v-for="(article, index) in news_data?.output_dataset"
                    :key="index"
                    :article="article"/>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.section {
    @apply bg-gradient-to-r from-gray-600 to-gray-500 text-white h-[180px] p-2 rounded-lg overflow-y-auto;
}
</style>
