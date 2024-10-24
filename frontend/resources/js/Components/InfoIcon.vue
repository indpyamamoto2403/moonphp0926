<template>
  <div class="flex items-center space-x-2 relative">
    <span class="text-sm text-white">業種区分</span>
    <button @click="togglePopup" class="w-4 h-4 text-white">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
      </svg>
    </button>
    <div v-if="isOpen" class="absolute z-10 top-full mt-2 w-64 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 overflow-hidden text-xs">
      <div class="flex flex-col h-[200px]">
        <div class="flex justify-between items-center px-4 py-2 border-b">
          <p class="text-sm font-medium text-gray-700">業種区分：</p>
          <button @click="togglePopup" class="text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
            </svg>
          </button>
        </div>
        <div class="overflow-y-auto flex-grow">
          <a 
            v-for="item in cluster_data" 
            :key="item.id" 
            href="#" 
            class="block px-4 py-2 text-sm text-gray-800 hover:bg-gray-100 text-left"
            @click="selectIndustry(item)"
          >
            <span class="inline-block w-6 text-right mr-2">{{ item.id }}.</span>
            <span>{{ item.industry_name }}</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';


const props = defineProps({
  cluster_data: {
    type: Array,
    required: true,
    validator: (value) => {
      return value.every(item => 'id' in item && 'industry_name' in item);
    }
  }
});

const emit = defineEmits(['select']);

const isOpen = ref(false);

const togglePopup = () => {
  isOpen.value = !isOpen.value;
};

const selectIndustry = (item) => {
  emit('select', item);
  isOpen.value = false;
};
</script>