<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

// 画像を格納する状態変数を定義
const selectedImage = ref(null);

function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            selectedImage.value = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}

function handleSubmit() {
    if (selectedImage.value) {
        alert('画像が送信されました！');
        // ここで送信処理を追加できます。例: API呼び出しなど
    } else {
        alert('画像を選択してください。');
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="min-h-screen py-12 bg-gradient-to-b from-blue-500 to-black flex flex-col items-center">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-black shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white text-center text-xl font-semibold">
                        Moon Portal にログインしました。
                    </div>
                </div>

                <!-- モダンな画像アップロードセクション -->
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

                    <!-- プレビューがあれば表示 -->
                    <div v-if="selectedImage" class="mb-4">
                        <img :src="selectedImage" alt="Uploaded image preview" class="w-full h-auto rounded-lg shadow-md" />
                    </div>

                    <!-- 送信ボタン -->
                    <button
                        @click="handleSubmit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg shadow-md hover:bg-indigo-700 focus:outline-none focus:ring focus:ring-indigo-200"
                    >
                        画像を送信
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
</style>
