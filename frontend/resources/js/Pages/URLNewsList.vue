<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

// Define the properties
const props = defineProps({
    news_data: Object,
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="w-full max-w-lg mx-auto p-6 bg-gray-900 text-white rounded-lg shadow-lg transition-transform transform hover:translate-y-[-2px] hover:shadow-xl mt-10">
            <h1 class="text-2xl font-semibold mb-4 text-white">
                URLの検索結果
            </h1>

            <div v-if="news_data?.url" class="space-y-4">
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">
                        URL:
                    </p>
                    <p class="text-base break-all">
                        {{ news_data.url }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wider">
                        要約記事概要:
                    </p>
                    <p class="text-base leading-relaxed">
                        {{ news_data.answer || 'No answer available' }}
                    </p>
                </div>
            </div>

            <div v-else class="text-center text-gray-500">
                <p>No data available</p>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
