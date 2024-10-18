<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { ref } from 'vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    keyword1: '',
    keyword2: '',
    keyword3: '',
    include_user_information: true,
});

const send_form = () => {
    form.post('/show-news', {
        preserveScroll: true,
    });
}

</script>

<template>
<AuthenticatedLayout>
    <div class="w-full max-w-[600px] ml-0">
        <h1 class="text-white text-2xl font-semibold mt-4">ワード検索</h1>
        <div class="flex flex-col w-full text-white mt-6 gap-y-4">
            <input type="text" v-model="form.keyword1" class="input-text" placeholder="検索キーワード1">
            <input type="text" v-model="form.keyword2" class="input-text" placeholder="検索キーワード2">
            <input type="text" v-model="form.keyword3" class="input-text" placeholder="検索キーワード3">
            <div class="flex flex-row items-center">
                <input type="checkbox" v-model="form.include_user_information" class="input-checkbox" id="exact-match">
                <label for="exact-match" class="ml-2 hover:cursor-pointer">ユーザ情報を含む</label>
            </div>
            <button @click="send_form" class="w-full p-2 bg-cyan-600 hover:bg-cyan-700 text-white rounded-lg">ニュース検索</button>
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
</style>