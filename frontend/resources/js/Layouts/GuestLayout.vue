<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
import MoonLogo from '@/Components/MoonLogo.vue';
</script>

<template>
    <!-- ロゴを挿入 -->
    <div
        class="flex min-h-screen flex-col items-center bg-black pt-6 sm:justify-center sm:pt-0"
    >
    <moon-logo />

        <div
            class="mt-6 w-full overflow-hidden bg-black px-6 py-4 shadow-md sm:max-w-md sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
