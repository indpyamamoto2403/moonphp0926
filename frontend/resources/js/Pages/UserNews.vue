<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import UserNewsArticle from '@/Molecules/UserNewsArticle.vue'; // 新しく作ったコンポーネントをインポート

const props = defineProps({
    news: Object,
    user_pref: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <Head>
            <title>User News</title>
        </Head>
        <div class="flex flex-col w-[600px]">
            <p class="text-2xl text-white text-center my-4">
                ユーザーニュース
            </p>
            <p class="text-white">
                あなたの業種区分: {{ user_pref?.cluster?.industry_name }}
            </p>
            <!-- userNewsArticle コンポーネントを使って記事を表示 -->
            <div v-for="item in news" :key="item.id" class="w-full">
                <UserNewsArticle :item="item" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
