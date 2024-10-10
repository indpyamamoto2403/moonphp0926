<template>
    <Head title="Welcome" />
    <div class="min-h-screen bg-gradient-to-b from-blue-600 to-black text-black/50 dark:text-white/50 pr-5 pt-3">
        <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-end">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-gray-300 focus:outline-none focus-visible:ring-[#FF2D20]"
            >
                Dashboard
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-md px-3 py-2 text-white ring-1 ring-transparent transition hover:text-gray-300 focus:outline-none focus-visible:ring-[#FF2D20]"
                >
                    Log in
                </Link>
            </template>
        </nav>
    </div>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<style scoped>
</style>
