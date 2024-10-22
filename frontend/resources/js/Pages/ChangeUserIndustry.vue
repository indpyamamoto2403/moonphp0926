<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    clusters: Array,
});

// useFormでフォームを初期化
const form = useForm({
    cluster_id: props.user?.cluster?.id || ''
});

// フォーム送信処理
const submitForm = () => {
    // URLに cluster_id を含めてPOSTリクエストを送信
    router.post(`/customer/edit/${form.cluster_id}`, {
        cluster_id: form.cluster_id
    }, {
        preserveScroll: true,
        onSuccess: () => {
            // 成功時の処理
            console.log('Successfully updated cluster');
        },
        onError: (errors) => {
            // エラー時の処理
            console.error('Error updating cluster:', errors);
        },
    });
};

console.log(props.user);
console.log(props.clusters);
</script>

<template>
    <AuthenticatedLayout>
        <div class="text-white">
            <h2 class="text-2xl my-4">業種区分の選択</h2>
            <form @submit.prevent="submitForm">
                <select 
                    v-model="form.cluster_id" 
                    class="bg-gray-800 text-white border border-gray-700 rounded p-2 mb-4"
                >
                    <option disabled value="">クラスターを選択してください</option>
                    <option 
                        v-for="cluster in props.clusters" 
                        :key="cluster.id" 
                        :value="cluster.id"
                    >
                        {{ cluster.industry_name }}
                    </option>
                </select>
                
                <button 
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded"
                    :disabled="form.processing"
                >
                    {{ form.processing ? '処理中...' : '変更' }}
                </button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>