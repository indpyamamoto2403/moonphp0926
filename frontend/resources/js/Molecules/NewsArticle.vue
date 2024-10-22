<script setup>
import { ref } from 'vue';
import GoodButton from '@/Atoms/GoodButton.vue';
import BadButton from '@/Atoms/BadButton.vue';

const props = defineProps({
    article: {
        type: Object,
        required: true,
    },
});

const hidden = ref(false);

const handleGood = async () => {
    try {
        const response = await axios.post('/api/push-favorite-to-search-news', {
            url: props.article.url, // instant_news_urlをPOSTデータに含める
        });

        console.log(response.data); // 成功した場合のレスポンスを表示
        hidden.value = true; // ボタンが押された後に隠す

    } catch (error) {
        console.error('Error:', error); // エラー処理
    }
};

const handleBad = () => {
    hidden.value = true;
    // ここに後でBadボタンの機能を追加
};

const handleClose = () => {
    hidden.value = true;
};


console.log(props.article);
</script>

<template>
    <transition name="fade">
        <div v-if="!hidden" class="section flex flex-col relative">
            <button @click="handleClose" class="absolute top-2 right-2 text-white hover:text-gray-300 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="flex-grow overflow-y-auto pr-2 mt-8">
                <span class="font-semibold text-lg mb-2 block">ニュースタイトル: {{ article.title }}</span>
                <p class="mb-2">{{ article.summary }}</p>
                <p class="text-xs text-white">URL: <a :href="article.url" target="_blank" rel="noopener noreferrer" class="text-white underline">{{ article.url }}</a></p>
            </div>
            <div class="mt-2 flex justify-end space-x-2">
                <div @click="handleGood">
                    <GoodButton />
                </div>
                <div @click="handleBad">
                    <BadButton />
                </div>
            </div>
        </div>
    </transition>
</template>

<style scoped>
.section {
    @apply bg-gradient-to-r from-gray-600 to-gray-500 text-white p-2 rounded-lg;
    height: 200px;
}

.section > div:first-child {
    scrollbar-width: thin;
    scrollbar-color: rgba(255, 255, 255, 0.5) transparent;
}

.section > div:first-child::-webkit-scrollbar {
    width: 6px;
}

.section > div:first-child::-webkit-scrollbar-track {
    background: transparent;
}

.section > div:first-child::-webkit-scrollbar-thumb {
    background-color: rgba(255, 255, 255, 0.5);
    border-radius: 3px;
}

/* フェードアニメーションのスタイル */
.fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
    opacity: 0;
}
</style>
