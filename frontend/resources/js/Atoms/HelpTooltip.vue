<template>
    <div class="relative inline-block">
      <!-- ツールチップトリガー -->
      <button
        class="w-4 h-4 rounded-full bg-gray-100 border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
        @mouseover="showTooltip"
        @mouseleave="hideTooltip"
        aria-label="ヘルプ"
      >
        ?
      </button>
   
      <!-- ツールチップ本体 -->
      <div
        v-if="isTooltipVisible"
        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 p-3 bg-slate-800 border border-gray-200 rounded-lg shadow-lg w-max max-w-sm z-50"
        role="tooltip"
      >
        <!-- 三角形の矢印 -->
        <div class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-0 h-0 border-8 border-transparent border-t-white"></div>
   
        <p class="mb-2">事業内容の抽出ボタンを押下すると、</p>
        <ol class="list-decimal pl-5 space-y-1">
          <li>URLがない場合、会社名をキーワードに事業概要を検索、抽出します。</li>
          <li>URLがある場合、対象URLから事業内容を抽出します。</li>
        </ol>
      </div>
    </div>
   </template>
   
   <script setup>
   import { ref } from 'vue'
   
   const isTooltipVisible = ref(false)
   
   const showTooltip = () => {
    isTooltipVisible.value = true
   }
   
   const hideTooltip = () => {
    isTooltipVisible.value = false
   }
   </script>