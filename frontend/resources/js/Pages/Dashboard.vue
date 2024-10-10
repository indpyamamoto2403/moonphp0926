<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

const selectedImage = ref(null);
const imageFile = ref(null);
const ocr_result = ref("");
const loading = ref(false);

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            selectedImage.value = e.target.result;
        };
        reader.readAsDataURL(file);
        imageFile.value = file;
    }
}

async function handleSubmit() {
    if (imageFile.value) {
        loading.value = true;
        const formData = new FormData();
        formData.append('image', imageFile.value);

        try {
            const response = await axios.post('/api/upload-image', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            });
            console.log(response.data);
            //data.ocr_dataをJSONに変換する
            ocr_result.value = JSON.stringify(response.data.ocr_data, null, 2) || "OCR 結果が見つかりませんでした。";
        } catch (error) {
            console.error('Error:', error);
            ocr_result.value = "画像の送信に失敗しました。";
        } finally {
            loading.value = false;
        }
    } else {
        alert('画像を選択してください。');
    }
}
</script>

<template>
    <Head title="Dashboard" />
    <AuthenticatedLayout>
        <div class="min-h-screen py-12 bg-gradient-to-b from-blue-600 to-black flex flex-col items-center">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- 画像アップロードセクション -->
                <div class="mt-10 bg-white p-6 shadow-lg rounded-lg w-full max-w-lg mx-auto">
                    <label class="block text-lg font-medium text-gray-700 mb-2 text-center">
                        画像をアップロードしてください
                    </label>
                    <input
                        type="file"
                        accept="image/*"
                        @change="handleImageUpload"
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer p-2 mb-4 focus:ring focus:ring-indigo-200 focus:outline-none"
                    />

                    <!-- プレビュー -->
                    <div v-if="selectedImage" class="mb-4">
                        <img :src="selectedImage" alt="Uploaded image preview" class="w-full h-auto rounded-lg shadow-md" />
                    </div>

                    <!-- 送信ボタン -->
                    <button
                        @click="handleSubmit"
                        :disabled="loading"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200 disabled:opacity-50"
                    >
                        {{ loading ? '処理中...' : '画像を送信' }}
                    </button>
                </div>
            </div>
            <!-- OCR 結果表示セクション -->
            <div class="mt-10 bg-white p-6 shadow-lg rounded-lg w-full max-w-lg mx-auto">
                <label class="block text-lg font-medium text-gray-700 mb-2 text-center">
                    OCR結果
                </label>
                <div class="text-center">
                    <p v-if="loading">OCR処理中...</p>
                    <p v-else>{{ ocr_result }}</p>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>