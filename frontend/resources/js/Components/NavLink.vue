<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const baseClasses = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out';
const activeClasses = 'border-blue-400 bg-black text-white focus:border-indigo-700';
const inactiveClasses = 'border-transparent text-gray-500 hover:text-gray-700 hover:border-bg-300 focus:text-gray-700 focus:border-blue-600';

const classes = computed(() =>
    `${baseClasses} ${props.active ? activeClasses : inactiveClasses}`
);
</script>

<template>
    <Link :href="href" :class="classes" class="whitespace-nowrap">
        <slot />
    </Link>
</template>
