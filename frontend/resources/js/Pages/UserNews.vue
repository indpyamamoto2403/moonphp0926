<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import UserNewsArticle from '@/Molecules/UserNewsArticle.vue';

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
            
            <!-- ニュースがある場合 -->
            <div v-if="news && news.length > 0" class="w-full">
                <div v-for="item in news" :key="item.id">
                    <UserNewsArticle :item="item" />
                </div>
            </div>
            
            <!-- ニュースが0件の場合 -->
            <div v-else class="text-white text-center py-8 bg-slate-800 w-full rounded-lg">
                現在表示できるニュースはありません
            </div>
        </div>
    </AuthenticatedLayout>
</template>