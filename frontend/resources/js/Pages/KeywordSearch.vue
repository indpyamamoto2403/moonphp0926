<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    keyword1: '',
    keyword2: '',
    keyword3: '',
    search_num: 2,
});

const props = defineProps({
    error: {
        type: String,
    },
});

const isLoading = ref(false); // ローディング状態を管理する変数

const send_form = () => {
    isLoading.value = true; // 送信開始時にローディングを有効化
    form.post('/show-news', {
        preserveScroll: true,
        onFinish: () => {
            isLoading.value = false; // 送信終了時にローディングを無効化
        },
        onError: () => {
            isLoading.value = false; // エラー発生時にもローディングを無効化
        }
    });
}
</script>

<template>
<AuthenticatedLayout>
    <div class="w-full max-w-[600px] ml-0">
        <h1 class="text-white text-2xl font-semibold mt-4">ワード検索</h1>
        <div class="flex flex-col w-full text-white mt-6 gap-y-4">
            <label for="keyword1" class="text-white">検索キーワード</label>
            <input type="text" v-model="form.keyword1" class="input-text" placeholder="検索キーワード1" required>
            <span v-if="form.errors.keyword1" class="text-red-500">{{ form.errors.keyword1 }}</span>
            <input type="text" v-model="form.keyword2" class="input-text" placeholder="検索キーワード2">
            <input type="text" v-model="form.keyword3" class="input-text" placeholder="検索キーワード3">
            <label for="search_num" class="text-white">取得件数</label>
            <select v-model="form.search_num" class="input-pulldown">
                <option value="1">1件</option>
                <option value="2">2件</option>
                <option value="3">3件</option>
                <option value="4">4件</option>
                <option value="5">5件</option>
            </select> 
            <button @click="send_form" class="w-full p-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg">
                <span v-if="isLoading">ロード中...</span>
                <span v-else>ニュース検索</span>
            </button>
            <div v-if="error">
                <span class="text-red-500">{{ error }}</span>
            </div>
        </div>
    </div>
</AuthenticatedLayout>
</template>

<style scoped>
.input-text{
    @apply w-full p-3 border text-sm py-2 bg-gradient-to-r from-gray-600 to-gray-500 rounded-lg text-white placeholder-gray-400;
}

.input-checkbox {
    @apply text-gray-600 bg-gray-600 w-6 h-6 rounded-md focus:outline-none focus:ring-0 hover:cursor-pointer;
}

.input-pulldown{
    @apply w-full p-3 border text-sm py-2 rounded-md text-black placeholder-gray-400;
}
</style>
