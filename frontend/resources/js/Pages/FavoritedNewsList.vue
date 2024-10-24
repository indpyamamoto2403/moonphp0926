<script setup>
import { ref, computed } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    favorited_news: Array,
    recommended_news: Array,
});

const displayedFavoritedNews = ref(5);
const displayedRecommendedNews = ref(5);

const showMoreFavorited = () => {
    displayedFavoritedNews.value += 5;
};

const showMoreRecommended = () => {
    displayedRecommendedNews.value += 5;
};

const favoritedNewsToShow = computed(() => {
    return props.favorited_news.slice(0, displayedFavoritedNews.value);
});

const recommendedNewsToShow = computed(() => {
    return props.recommended_news.slice(0, displayedRecommendedNews.value);
});

console.log(props);
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex justify-center items-center text-white w-[600px]">
            <div class="flex flex-col w-full">
                <div class="flex justify-center items-center mt-6">
                    <h1 class="text-2xl font-bold">お気に入りニュース一覧</h1>
                </div>
                <div class="mt-4">
                    <ul>
                        <li v-for="(item, index) in favoritedNewsToShow" :key="index" class="mb-4 p-4 bg-gray-700 rounded">
                            <h2 class="text-xl font-semibold mb-2">{{ item?.news?.title }}</h2>
                            <p class="text-sm">{{ item?.news?.summary }}</p>
                            <a :href="item?.news?.url" target="_blank" rel="noopener noreferrer" class="text-blue-400 underline">記事を読む</a>
                        </li>
                    </ul>
                    <button v-if="props.favorited_news.length > displayedFavoritedNews" @click="showMoreFavorited" class="text-blue-400 underline mt-2">さらに表示</button>
                </div>

                <div class="flex flex-col justify-center items-center mt-6">
                    <p class="text-2xl font-bold">おすすめニュース一覧</p>
                    <p class="text-red-100 text-right">🌟あなたと同じ業種の、他のユーザーは</p>
                    <p class="text-red-100 text-right">こんな記事も読んでいます。</p>
                </div>
                <div class="mt-4">
                    <ul>
                        <li v-for="(item, index) in recommendedNewsToShow" :key="index" class="mb-4 p-4 bg-gray-700 rounded">
                            <h2 class="text-xl font-semibold">{{ item?.news?.title }}</h2>
                            <p class="text-sm">{{ item?.news?.summary }}</p>
                            <a :href="item?.news?.url" target="_blank" rel="noopener noreferrer" class="text-blue-400 underline">記事を読む</a>
                        </li>
                    </ul>
                    <button v-if="props.recommended_news.length > displayedRecommendedNews" @click="showMoreRecommended" class="text-blue-400 underline mt-2">さらに表示</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
