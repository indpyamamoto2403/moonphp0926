<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref, computed } from 'vue';
import UserNewsArticle from '@/Molecules/UserNewsArticle.vue';

const props = defineProps({
    news: Array, // news を配列として受け取る
    user_pref: Object,
});

// 表示する記事の数を管理
const displayedCount = ref(5); // 初期表示件数
const totalNewsCount = props.news.length; // 総記事数

// 表示する記事のリスト
const displayedNews = computed(() => {
    return props.news.slice(0, displayedCount.value);
});

// さらに表示する関数
const showMore = () => {
    displayedCount.value = Math.min(displayedCount.value + 5, totalNewsCount); // 5件ずつ増やす
};
</script>

<template>
    <AuthenticatedLayout>
        <Head>
            <title>User News</title>
        </Head>
        <div class="flex flex-col w-[600px] mb-10">
            <p class="text-2xl text-white text-center my-4">
                ユーザーニュース
            </p>
            <p class="text-white">
                あなたの業種区分: {{ user_pref?.cluster?.industry_name }}
            </p>
            
            <!-- ニュースがある場合 -->
            <div v-if="news && news.length > 0" class="w-full">
                <div v-for="item in displayedNews" :key="item.id">
                    <UserNewsArticle :item="item" />
                </div>
                <button 
                    v-if="displayedCount < totalNewsCount" 
                    @click="showMore" 
                    class="mt-4 text-blue-500 underline">
                    さらに表示
                </button>
            </div>
            
            <!-- ニュースが0件の場合 -->
            <div v-else class="text-white text-center py-8 bg-slate-800 w-full rounded-lg">
                現在表示できるニュースはありません
            </div>
        </div>
    </AuthenticatedLayout>
</template>
