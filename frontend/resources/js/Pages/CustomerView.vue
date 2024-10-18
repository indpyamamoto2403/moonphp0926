<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InfoIcon from '@/Components/InfoIcon.vue';
const props = defineProps({
    customer_data: {
        type: Object,
    },
    cluster: {
        type: Object,
    },
})

</script>

<template>
    <AuthenticatedLayout>
        <div class="min-h-screen mt-12 text-white  mb-4 w-[600px]">
            <div class="space-y-4 flex flex-col w-full">
                <div class="section">
                    <span class="font-semibold text-right">会社名: </span>
                    <p>{{ customer_data.company_name }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">担当者名: </span>
                    <p>{{ customer_data.name }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">部署: </span>
                    <p>{{ customer_data.department }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">役職: </span>
                    <p>{{ customer_data.yakushoku }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">郵便番号: </span>
                    <p>{{ customer_data.company_zipcode }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">住所: </span>
                    <p>{{ customer_data.company_address }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">URL: </span>
                    <p>
                        <a href="{{ customer_data.company_url }}" class="text-blue-400 underline hover:text-blue-600" target="_blank">{{ customer_data.company_url }}</a>
                    </p>
                </div>
                <div class="section flex flex-col">
                    <span class="font-semibold text-left">会社概要: </span>
                    <p>{{ customer_data.company_overview }}</p>
                </div>
                <div class="section">
                <span class="font-semibold text-right"><InfoIcon :cluster_data="cluster"/></span>
                    <p>{{ customer_data?.cluster?.industry_name }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">海外への関心: </span>
                    <p>{{ customer_data?.preference?.foreign_interest }}</p>
                </div>
                <div class="section">
                    <span class="font-semibold text-right">環境への興味: </span>
                    <p>{{ customer_data?.preference?.environmental_concern }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
/* スクロールバーをカスタマイズして、背景色との調和を図ります */
::-webkit-scrollbar {
  width: 8px;
}

::-webkit-scrollbar-thumb {
  background-color: #555;
  border-radius: 4px;
}

::-webkit-scrollbar-track {
  background-color: #222;
}

.section {
    @apply bg-gradient-to-r from-gray-600 to-gray-500 p-4 rounded-lg flex justify-between shadow-lg text-sm;
}

</style>
