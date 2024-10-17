<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    message:String,
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
        </div>
    </AuthenticatedLayout>
</template>
