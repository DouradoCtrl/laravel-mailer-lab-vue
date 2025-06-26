<template>
  <div class="flex justify-between items-center mt-4">
    <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
      <button
        class="relative inline-flex items-center px-3 py-1 border border-sidebar-border/70 even:bg-black/5 odd:bg-transparent text-sm font-medium text-gray-700 hover:bg-black/10 dark:even:bg-white/5 dark:odd:bg-transparent dark:border-sidebar-border dark:text-gray-100 dark:hover:bg-white/10 rounded-l-md"
        :disabled="!data.prev_page_url"
        @click="goToPage(data.current_page - 1)"
        aria-label="Anterior"
      >
        Anterior
      </button>
      <template v-for="page in data.last_page" :key="page">
        <button
          class="relative inline-flex items-center px-3 py-1 border-t border-b border-l border-sidebar-border/70 even:bg-black/5 odd:bg-transparent text-sm font-medium text-gray-700 hover:bg-black/10 dark:even:bg-white/5 dark:odd:bg-transparent dark:border-sidebar-border dark:text-gray-100 dark:hover:bg-white/10"
          :class="{
            'z-10 border-x border-blue-500 bg-blue-100/80 text-blue-700 dark:bg-blue-900/60 dark:text-white': page === data.current_page
          }"
          @click="goToPage(page)"
          :disabled="page === data.current_page"
          style="border-radius: 0;"
        >
          {{ page }}
        </button>
      </template>
      <button
        class="relative inline-flex items-center px-3 py-1 border border-sidebar-border/70 even:bg-black/5 odd:bg-transparent text-sm font-medium text-gray-700 hover:bg-black/10 dark:even:bg-white/5 dark:odd:bg-transparent dark:border-sidebar-border dark:text-gray-100 dark:hover:bg-white/10 rounded-r-md"
        :disabled="!data.next_page_url"
        @click="goToPage(data.current_page + 1)"
        aria-label="Próxima"
      >
        Próxima
      </button>
    </nav>
    <span class="text-sm text-gray-600 dark:text-gray-300">
      {{ data.from }} a {{ data.to }} de {{ data.total }}
    </span>
  </div>
</template>

<script setup lang="ts">
import { defineProps, defineEmits } from 'vue'

interface PaginationData {
  current_page: number;
  last_page: number;
  prev_page_url: string | null;
  next_page_url: string | null;
  from: number;
  to: number;
  total: number;
  data: any[];
}

const props = defineProps<{
  data: PaginationData
}>()

const emit = defineEmits(['page-change'])

function goToPage(page: number) {
  if (page < 1 || page > props.data.last_page || page === props.data.current_page) return
  emit('page-change', page)
}
</script>
