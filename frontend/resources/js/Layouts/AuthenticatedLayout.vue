<script setup>
import { ref } from 'vue';
import NavLink from '@/Components/NavLink.vue';
import MoonAuthenticatedIcon from '@/Components/MoonAuthenticatedIcon.vue';
import { usePage } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);

const props = defineProps({
    auth: {
        type: Object,
    },
});
const login_name = usePage().props.auth.user?.login_name;
</script>

<template>
    <div>
        <div class="min-h-screen bg-black">
            <nav class="bg-black border-b-2 border-b-blue-700">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 w-[375px] py-4">
                    <!-- Top Row: Icon and Logout -->
                    <div class="flex justify-between items-center h-16 mb-4">
                        <moon-authenticated-icon />
                        <NavLink :href="route('logout')" method="post" as="button" class="text-yellow-300">
                            Log Out
                        </NavLink>
                    </div>

                    <!-- Navigation Links -->
                    <div class="overflow-x-auto whitespace-nowrap">
                        <div class="flex space-x-1 text-yellow-300 overflow-hidden">
                            <NavLink :href="route('customer')" :active="route().current('customer')">User登録</NavLink>
                            <NavLink :href="route('customer-view')" :active="route().current('customer-view')">User情報</NavLink>
                            <NavLink :href="route('customer-news')" :active="route().current('customer-news')">News</NavLink>
                            <NavLink :href="route('keyword-search')" :active="route().current('keyword-search')">ワード検索</NavLink>
                            <NavLink :href="route('favorited-news-list')" :active="route().current('favorited-news-list')">お気に入り</NavLink>
                        </div>
                    </div>
                </div>
                
                <div class="text-white w-full flex justify-center items-center my-4">
                    <span class="flex justify-between w-[375px]">
                        <span class="hover:text-yellow-200 hover:cursor-crosshair transition duration-500">-あなたのビジネスに光射す-</span>
                        <span>{{ login_name || "guest" }} 様</span>
                    </span>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="mx-auto max-w-7xl px-4 py-6">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <div class="flex justify-center items-center w-full">
                <main class="flex justify-center items-center w-[375px]">
                    <slot />
                </main>
            </div>
        </div>
    </div>
</template>
