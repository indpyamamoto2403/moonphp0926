<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import axios from 'axios';

const selectedImage = ref(null);
const imageFile = ref(null);

//ocr結果を格納する変数
const ocr_result = ref("");
const company_name = ref("");
const name = ref("");
const birthday = ref("");
const department = ref("");
const position = ref("");
const zip_code = ref("");
const company_location = ref("");
const URL = ref("");

const jigyonaiyo = ref("");

//処理中かどうかを示す変数
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
            console.log("Response:", response.data);
            // response.data.ocr_data の内容を確認
            console.log("Original ocr_data:", response.data.ocr_data);
            
            const ocrData = response.data.ocr_data;
            // JSONとして問題がないか確認
            const isStringJson = ocrData.startsWith('"') && ocrData.endsWith('"');
            console.log("Is JSON string:", isStringJson);

            let parsedData;
            if (isStringJson) {
                // 前後の " を除去し、エスケープされた \" を " に変換してからパース
                const cleanedData = ocrData
                    .slice(1, -1)  // 前後の " を除去
                    .replace(/\\"/g, '"')  // エスケープされた \" を " に変換
                    .replace(/\\n/g, '')  // 改行文字 \n を削除
                    .replace(/\\t/g, '')  // タブ文字 \t を削除
                    .replace(/\\r/g, ''); // キャリッジリターン \r を削除

                parsedData = JSON.parse(cleanedData);
            } else {
                // もしエスケープされていないJSONだった場合そのままパース
                parsedData = JSON.parse(ocrData);
            }
            ocr_result.value = parsedData;
            company_name.value = parsedData.CompanyName;
            name.value = parsedData.Name;
            birthday.value = parsedData.Birthday;
            department.value = parsedData.Department;
            position.value = parsedData.Position;
            zip_code.value = parsedData.ZipCode;
            company_location.value = parsedData.CompanyLocation;
            URL.value = parsedData.URL;
            // パース結果を確認
            console.log("Parsed data:", parsedData);

            // ocr_result に変換した JSON オブジェクトを表示
            ocr_result.value = JSON.stringify(parsedData, null, 2) || "OCR 結果が見つかりませんでした。";
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

async function handleExtract() {
    // Ensure that the text fields contain data before proceeding
    if (company_name.value || name.value || department.value || position.value || zip_code.value || company_location.value || URL.value) {
        loading.value = true;
        const extractData = {
            company_name: company_name.value,
            name: name.value,
            birthday: birthday.value,
            department: department.value,
            position: position.value,
            zip_code: zip_code.value,
            company_location: company_location.value,
            URL: URL.value,
        };

        try {
            const response = await axios.post('/api/extract-text', extractData, {
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            console.log("Extraction response:", response.data);
            jigyonaiyo.value = response.data.data.answer;
            // Process response if needed
            console.log("Extracted response:", response.data);
        } catch (error) {
            console.error('Error during extraction:', error);
        } finally {
            loading.value = false;
        }
    } else {
        alert('必要な情報を入力してください。');
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
                        名刺から入 力情報を取得
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
                        {{ loading ? '処理中...' : '📷' }}
                    </button>
                </div>
            </div>
            <div class="flex flex-col w-5/12 my-10 gap-y-4">
                <input type="text" v-model="company_name" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="会社名" />
                <input type="text" v-model="name" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="名前" />
                <input type="text" v-model="birthday" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="生年月日" />
                <input type="text" v-model="department" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="部署" />
                <input type="text" v-model="position" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="役職" />
                <input type="text" v-model="zip_code" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="郵便番号" />
                <input type="text" v-model="company_location" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="会社所在地" />
                <input type="text" v-model="URL" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="URL" />
            </div>
            
            <!-- Extraction Button -->
            <button
                @click="handleExtract"
                :disabled="loading"
                class="w-50 py-1 px-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-200 disabled:opacity-50 mb-4"
            >
                {{ loading ? '処理中...' : '事業内容抽出' }}
            </button>
            <textarea v-model="jigyonaiyo" class="w-5/12 p-2 border border-gray-300 rounded-lg h-[200px] mb-4" placeholder="事業内容"></textarea>

            <button
                @click="window.location.href='/news'"
                class="w-50 py-1 px-2 bg-cyan-600 text-white font-semibold rounded-lg shadow-md w-[200px] hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-aqua-200"
            >
                登録
            </button>
        </div>
    </AuthenticatedLayout>
</template>