<script setup>
import { ref } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: true,
    },
});
</script>

<template>

    <!-- 使用するアイコンにv-if="showSpinner"を適用させてください。 -->


    <!-- アイコン1 -->
    <div v-if="show" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[9999]">
        <svg class="fill-black h-[40rem] w-[40rem] spinner" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
            <circle cx="25" cy="10" r="2" />
            <circle opacity=".3" cx="25" cy="40" r="2" />
            <circle opacity=".3" cx="32.5" cy="12" r="2" />
            <circle opacity=".3" cx="17.5" cy="38" r="2" />
            <circle opacity=".93" cx="17.5" cy="12" r="2" />
            <circle opacity=".3" cx="32.5" cy="38" r="2" />
            <circle opacity=".65" cx="10" cy="25" r="2" />
            <circle opacity=".3" cx="40" cy="25" r="2" />
            <circle opacity=".86" cx="12" cy="17.5" r="2" />
            <circle opacity=".3" cx="38" cy="32.5" r="2" />
            <circle opacity=".44" cx="12" cy="32.5" r="2" />
            <circle opacity=".3" cx="38" cy="17.5" r="2" />
        </svg>
    </div>

    <!-- アイコン2 -->
    <div v-if="false" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[9999]">
        <svg class="fill-black h-[20rem] w-[20rem] animate-spin" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
            <g id="spinner--loading--dots-">
                <path
                    d="M46.03,32c0,-2.751 2.233,-4.985 4.985,-4.985c2.751,0 4.985,2.234 4.985,4.985c0,2.751 -2.234,4.985 -4.985,4.985c-2.752,0 -4.985,-2.234 -4.985,-4.985Z"
                    style="fill:#d9d9d9;" />
                <path
                    d="M41.92,41.92c1.946,-1.945 5.105,-1.945 7.051,0c1.945,1.946 1.945,5.105 0,7.051c-1.946,1.945 -5.105,1.945 -7.051,0c-1.945,-1.946 -1.945,-5.105 0,-7.051Z"
                    style="fill:#b3b3b3;" />
                <circle cx="32" cy="51.015" r="4.985" style="fill:#8c8c8c;" />
                <path
                    d="M22.08,41.92c1.945,1.946 1.945,5.105 0,7.051c-1.946,1.945 -5.105,1.945 -7.051,0c-1.945,-1.946 -1.945,-5.105 0,-7.051c1.946,-1.945 5.105,-1.945 7.051,0Z"
                    style="fill:#666;" />
                <path
                    d="M17.97,32c0,2.751 -2.233,4.985 -4.985,4.985c-2.751,0 -4.985,-2.234 -4.985,-4.985c0,-2.751 2.234,-4.985 4.985,-4.985c2.752,0 4.985,2.234 4.985,4.985Z"
                    style="fill:#404040;" />
                <path
                    d="M22.08,22.08c-1.946,1.945 -5.105,1.945 -7.051,0c-1.945,-1.946 -1.945,-5.105 0,-7.051c1.946,-1.945 5.105,-1.945 7.051,0c1.945,1.946 1.945,5.105 0,7.051Z"
                    style="fill:#404040;" />
                <circle cx="32" cy="12.985" r="4.985" />
            </g>
        </svg>

    </div>

    <!-- アイコン3 -->
    <div v-if="false" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[9999]">
        <svg class="fill-black h-[20rem] w-[20rem] animate-spin" viewBox="0 0 32 32" version="1.1"
            xmlns="http://www.w3.org/2000/svg">
            <title>spinner</title>
            <path
                d="M16 1.25c-1.519 0-2.75 1.231-2.75 2.75s1.231 2.75 2.75 2.75c1.519 0 2.75-1.231 2.75-2.75v0c-0.002-1.518-1.232-2.748-2.75-2.75h-0zM16 5.25c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0zM6.75 16c0-1.519-1.231-2.75-2.75-2.75s-2.75 1.231-2.75 2.75c0 1.519 1.231 2.75 2.75 2.75v0c1.518-0.002 2.748-1.232 2.75-2.75v-0zM4 17.25c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0zM16 25.25c-1.519 0-2.75 1.231-2.75 2.75s1.231 2.75 2.75 2.75c1.519 0 2.75-1.231 2.75-2.75v0c-0.002-1.518-1.232-2.748-2.75-2.75h-0zM16 29.25c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0zM28 13.25c-1.519 0-2.75 1.231-2.75 2.75s1.231 2.75 2.75 2.75c1.519 0 2.75-1.231 2.75-2.75v0c-0.002-1.518-1.232-2.748-2.75-2.75h-0zM28 17.25c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0zM24.486 21.736c-1.519 0-2.75 1.231-2.75 2.75s1.231 2.75 2.75 2.75c1.519 0 2.75-1.231 2.75-2.75v0c-0.002-1.518-1.232-2.748-2.75-2.75h-0zM24.486 25.736c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0zM7.508 21.742c-1.519 0-2.75 1.231-2.75 2.75s1.231 2.75 2.75 2.75c1.519 0 2.75-1.231 2.75-2.75v0c-0.002-1.518-1.232-2.748-2.75-2.75h-0zM7.508 25.742c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0zM7.533 4.783c-1.519 0-2.75 1.231-2.75 2.75s1.231 2.75 2.75 2.75c1.519 0 2.75-1.231 2.75-2.75v0c-0.002-1.518-1.232-2.748-2.75-2.75h-0zM7.533 8.783c-0.69 0-1.25-0.56-1.25-1.25s0.56-1.25 1.25-1.25c0.69 0 1.25 0.56 1.25 1.25v0c-0.001 0.69-0.56 1.249-1.25 1.25h-0z">
            </path>
        </svg>
    </div>

    <!-- アイコン4 -->
    <div v-if="false" class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 z-[9999]">
        <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"
            class="fill-black h-[25rem] w-[25rem] animate-spin">
            <g fill-rule="evenodd" clip-rule="evenodd">
                <path d="M8 1.5a6.5 6.5 0 100 13 6.5 6.5 0 000-13zM0 8a8 8 0 1116 0A8 8 0 010 8z" opacity=".2" />
                <path
                    d="M7.25.75A.75.75 0 018 0a8 8 0 018 8 .75.75 0 01-1.5 0A6.5 6.5 0 008 1.5a.75.75 0 01-.75-.75z" />
            </g>
        </svg>
    </div>


</template>

<style scoped>
/**回転速度等を変更したい場合はtailwindの'animate-spin'を消して
以下cssを変更して適用させてください。 */

.spinner {
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}
</style>
