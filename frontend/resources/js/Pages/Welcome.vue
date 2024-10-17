<template>
    <Head title="Welcome" />
    <GuestLayout>
        <div class="flex justify-center items-center">
        <nav v-if="canLogin" class="-mx-3 flex bg-gray-600 rounded-2xl w-[100px] shadow-2xl items-center justify-center">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="rounded-md px-3 py-2 text-white transition hover:text-gray-600 focus:outline-none focus-visible:ring-[#FF2D20]"
            >
                TOP
            </Link>

            <template v-else>
                <Link
                    :href="route('login')"
                    class="rounded-full px-3 py-2 text-white hover:text-gray-600 focus:outline-none focus-visible:ring-[#FF2D20]"
                >
                    Log in
                </Link>
            </template>
        </nav>
    </div>
    </GuestLayout>
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';
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
