<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';
import Spinner from '@/Atoms/Spinner.vue';
const form = useForm({
    url: '',
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

const send_url = () => {
    isLoading.value = true; // 送信開始時にローディングを有効化
    form.post('/show-news-by-url', {
        preserveScroll: true,
        onFinish: () => {
            isLoading.value = false; // 送信終了時にローディングを無効化
        },
        onError: () => {
            isLoading.value = false; // エラー発生時にもローディングを無効化
        }
    });
}

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

const selected_radio = ref('Keyword');


</script>

<template>
<AuthenticatedLayout>
    <spinner v-if="isLoading" />
    <div class="w-full ml-0 mb-12">
        <h1 class="text-white text-2xl font-semibold mt-4">ワード検索</h1>
        <div class="flex flex-col w-full text-white mt-6 gap-y-4">
            <div class="radio gap-x-2">
                <p>🔍検索のタイプ</p>
                <label class="custom-radio">
                    <input type="radio" id="URL" v-model="selected_radio" value="URL">
                    <span class="checkmark"></span>
                    URL
                </label>
                <label class="custom-radio">
                    <input type="radio" id="Keyword" v-model="selected_radio" value="Keyword">
                    <span class="checkmark"></span>
                    Keyword
                </label>
            </div>

            <label for="url" class="text-white">URL</label>
            <input type="text" 
                   v-model="form.url" 
                   class="input-text" 
                   placeholder="URL" 
                   :disabled="selected_radio === 'Keyword'"
                   :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'Keyword' }">
            <span v-if="form.errors.url" class="text-red-500 text-xs">{{ form.errors.url }}</span>

            <button @click="send_url" 
                    class="w-full p-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg"
                    :disabled="selected_radio === 'Keyword'"
                   :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'Keyword' }">
                <span v-if="isLoading">ロード中...</span>
                <span v-else>URL検索</span>
            </button>

            <label for="keyword1" class="text-white">検索キーワード</label>
            <input type="text" 
                   v-model="form.keyword1" 
                   class="input-text" 
                   placeholder="検索キーワード1" 
                   :disabled="selected_radio === 'URL'"
                   :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'URL' }">
            <span v-if="form.errors.keyword1" class="text-red-500">{{ form.errors.keyword1 }}</span>

            <input type="text" 
                   v-model="form.keyword2" 
                   class="input-text" 
                   placeholder="検索キーワード2" 
                   :disabled="selected_radio === 'URL'"
                   :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'URL' }">

            <input type="text" 
                   v-model="form.keyword3" 
                   class="input-text" 
                   placeholder="検索キーワード3" 
                   :disabled="selected_radio === 'URL'"
                   :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'URL' }">

            <label for="search_num" class="text-white">取得件数</label>
            <select v-model="form.search_num" class="input-pulldown" :disabled="selected_radio === 'URL'"
            :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'URL' }">
                <option value="1">1件</option>
                <option value="2">2件</option>
                <option value="3">3件</option>
                <option value="4">4件</option>
                <option value="5">5件</option>
            </select> 
            <button @click="send_form" 
                    class="w-full p-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg"
                    :disabled="selected_radio === 'URL'"
                   :class="{ 'opacity-50 cursor-not-allowed': selected_radio === 'URL' }">
                <span v-if="isLoading">ロード中...</span>
                <span v-else>キーワード検索</span>
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

.radio-group {
    display: flex;
    flex-direction: column;
}

.custom-radio {
    position: relative;
    display: flex;
    align-items: center;
    cursor: pointer;
}

.custom-radio input[type="radio"] {
    display: none; /* ラジオボタンを非表示にする */
}

.checkmark {
    width: 15px;
    height: 15px;
    border: 1px solid #ffffff;
    border-radius: 50%;
    margin-right: 10px;
    transition: background-color 0.3s, border-color 0.3s;
}

.custom-radio input[type="radio"]:checked + .checkmark {
    @apply bg-cyan-300 border-cyan-300;
}

.custom-radio:hover .checkmark {
    border-color: rgba(255, 255, 255, 0.207); /* ホバー時のボーダー色 */
}

</style>
