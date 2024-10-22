<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    message:String,
    customer_data:Object,
})

</script>

<template>
    <AuthenticatedLayout>
        <Head>
            <title>Completed</title>
        </Head>
        <div class="flex flex-col">
            <div class="mt-4 bg-gray-900 p-5 mx-auto text-center max-w-sm rounded-xl shadow-lg border border-gray-700">
                <p class="text-white text-lg font-semibold tracking-wide">
                    登録が完了しました。
                </p>
            </div>
            <div class="mt-4 text-center">
                <span class="text-gray-400">クラスター情報: {{ message }}</span>
            </div>
            <div>
                <ul class="text-white">
                    <p>業種区分:{{ customer_data?.cluster?.industry_name }}</p>
                    <p>海外への関心:{{ customer_data?.preference?.foreign_interest }}</p>
                    <p>環境への興味:{{ customer_data?.preference?.environmental_concern }}</p>
                </ul>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
