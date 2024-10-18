<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import axios from 'axios';

const selectedImage = ref(null);
const imageFile = ref(null);

//ocr結果を格納する変数
const ocr_result = ref("");
const form = useForm({
    name: '',
    company_name: '',
    department: '',
    yakushoku: '',
    company_zipcode: '',
    company_address: '',
    company_url: '',
    company_overview: '',
});


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

            console.log("Parsed data:", JSON.stringify(parsedData, null, 2));

            form.company_name = parsedData.company_name;
            form.name = parsedData.name;
            form.department = parsedData.department;
            form.yakushoku = parsedData.yakushoku;
            form.company_zipcode = parsedData.company_zipcode;
            form.company_address = parsedData.company_address;
            form.company_url = parsedData.company_url;
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
    if (form.company_name) {
        loading.value = true;
        const extractData = {
            company_name: form.company_name,
            name: form.name,
            department: form.department,
            yakushoku: form.yakushoku,
            company_zipcode: form.company_zipcode,
            company_address: form.company_address,
            company_url: form.company_url,
        };

        try {
            const response = await axios.post('/api/extract-text', extractData, {
                headers: {
                    'Content-Type': 'application/json',
                },
            });
            console.log("Extraction response:", response.data);
            form.company_overview = response.data.data.answer;
            // Process response if needed
            console.log("Extracted response:", response.data);
        } catch (error) {
            console.error('Error during extraction:', error);
        } finally {
            loading.value = false;
        }
    } else {
        alert('会社名を入力してください。');
    }
}

//登録ボタンを押したら、formの値を送信する
const submit_items = () => {
    const data = {
        name: form.name,
        company_name: form.company_name,
        department: form.department,
        yakushoku: form.yakushoku,
        company_zipcode: form.company_zipcode,
        company_address: form.company_address,
        company_url: form.company_url,
        company_overview: form.company_overview,
    };
    console.log("Submit data:", data);
    // ここでデータを送信する処理を書く
    form.post('/customer/completed', data);
};

</script>
<template>
    <Head title="登録画面" />
    <AuthenticatedLayout>
            <div class="min-h-screen bg-black flex flex-col items-center mb-10 text-sm w-[600px]">
                <div class="w-full">
                    <!-- 画像アップロードセクション -->
                    <div class="mt-10 bg-white shadow-lg rounded-lg w-full mx-auto p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2 text-center">
                            名刺から情報を取得
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
                            {{ loading ? '処理中...' : '顧客情報の入力' }}
                        </button>
                    </div>
                </div>
                <div class="flex flex-col w-full my-10 gap-y-4">
                    <input type="text" v-model="form.company_name" class="input-text" placeholder="会社名" />
                    <span v-if="form.errors?.company_name" class="text-red-600">{{ form.errors?.company_name }}</span>
                    <input type="text" v-model="form.name" class="input-text" placeholder="名前" />
                    <input type="text" v-model="form.department" class="input-text" placeholder="部署" />
                    <input type="text" v-model="form.yakushoku" class="input-text" placeholder="役職" />
                    <input type="text" v-model="form.company_zipcode" class="input-text" placeholder="郵便番号" />
                    <input type="text" v-model="form.company_address" class="input-text" placeholder="会社所在地" />
                    <input type="text" v-model="form.company_url" class="input-text" placeholder="URL" />
                    <span v-if="form.errors?.company_name" class="text-red-600">{{ form.errors?.company_url }}</span>
                </div>
                
                <!-- Extraction Button -->
                <button
                    @click="handleExtract"
                    :disabled="loading"
                    class="extract-button"
                >
                    {{ loading ? '処理中...' : '事業内容 抽出' }}
                </button>
                <textarea v-model="form.company_overview" class="jigyonaiyo-text" placeholder="事業内容"></textarea>
                <button class="register-button" @click="submit_items">
                    登録
                </button>
            </div>

    </AuthenticatedLayout>
</template>
<style scoped>
.input-text{
    @apply w-full p-3 border text-sm py-2 bg-gradient-to-r from-gray-600 to-gray-500 rounded-lg text-white placeholder-gray-500;
}

.jigyonaiyo-text{
    @apply bg-gradient-to-r from-gray-600 to-gray-500 w-full p-2 border border-gray-500 rounded-lg text-white placeholder-gray-500 mb-10 h-[300px];
}

.extract-button{
    @apply w-full py-2 px-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring focus:ring-green-200 disabled:opacity-50 mb-4
}

.register-button{
    @apply w-full py-2 px-2 bg-cyan-600 text-white font-semibold rounded-lg shadow-md w-full hover:bg-cyan-700 focus:outline-none focus:ring focus:ring-cyan-200;
}
</style>