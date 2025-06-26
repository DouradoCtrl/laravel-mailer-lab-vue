<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import route from 'ziggy-js';
import { Ziggy } from '../../ziggy';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Clientes',
        href: '/clientes',
    },
];

function goToPage(page: number) {
    router.get(route('clientes', { page }, undefined, Ziggy), {}, { preserveState: true });
}

const { clientes } = usePage().props;
</script>

<template>
    <Head title="Clientes" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <div class="rounded-xl overflow-hidden border border-sidebar-border/70 dark:border-sidebar-border">
                <table class="min-w-full table-fixed">
                    <thead class="bg-black/5 text-black dark:bg-white/5 dark:text-white">
                        <tr>
                            <th class="w-16 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">ID</th>
                            <th class="w-40 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nome</th>
                            <th class="w-56 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Email</th>
                            <th class="w-40 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Telefone</th>
                            <th class="w-40 px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Data Nascimento</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white-200 bg-transparent dark:bg-transparent">
                        <tr v-for="(cliente, idx) in clientes.data" :key="cliente.id" class="even:bg-black/5 odd:bg-transparent dark:even:bg-white/5 dark:odd:bg-transparent">
                            <td class="px-6 py-4 whitespace-nowrap dark:text-gray-200 ">{{ clientes.from + idx }}</td>
                            <td class="px-6 py-4 whitespace-nowrap dark:text-gray-200 ">{{ cliente.nome }}</td>
                            <td class="px-6 py-4 whitespace-nowrap dark:text-gray-200 ">{{ cliente.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap dark:text-gray-200 ">{{ cliente.telefone }}</td>
                            <td class="px-6 py-4 whitespace-nowrap dark:text-gray-200 ">{{ cliente.data_nascimento }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- Paginação numérica elegante -->
            <div class="flex justify-between items-center mt-4">
                <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                    <button
                        class="relative inline-flex items-center px-3 py-1 border border-sidebar-border/70 even:bg-black/5 odd:bg-transparent text-sm font-medium text-gray-700 hover:bg-black/10 dark:even:bg-white/5 dark:odd:bg-transparent dark:border-sidebar-border dark:text-gray-100 dark:hover:bg-white/10 rounded-l-md"
                        :disabled="!clientes.prev_page_url"
                        @click="goToPage(clientes.current_page - 1)"
                        aria-label="Anterior"
                    >
                        Anterior
                    </button>
                    <template v-for="page in clientes.last_page" :key="page">
                        <button
                            class="relative inline-flex items-center px-3 py-1 border-t border-b border-l border-sidebar-border/70 even:bg-black/5 odd:bg-transparent text-sm font-medium text-gray-700 hover:bg-black/10 dark:even:bg-white/5 dark:odd:bg-transparent dark:border-sidebar-border dark:text-gray-100 dark:hover:bg-white/10"
                            :class="{
                                'z-10 border-x border-blue-500 bg-blue-100/80 text-blue-700 dark:bg-blue-900/60 dark:text-white': page === clientes.current_page
                            }"
                            @click="goToPage(page)"
                            :disabled="page === clientes.current_page"
                            style="border-radius: 0;"
                        >
                            {{ page }}
                        </button>
                    </template>
                    <button
                        class="relative inline-flex items-center px-3 py-1 border border-sidebar-border/70 even:bg-black/5 odd:bg-transparent text-sm font-medium text-gray-700 hover:bg-black/10 dark:even:bg-white/5 dark:odd:bg-transparent dark:border-sidebar-border dark:text-gray-100 dark:hover:bg-white/10 rounded-r-md"
                        :disabled="!clientes.next_page_url"
                        @click="goToPage(clientes.current_page + 1)"
                        aria-label="Próxima"
                    >
                        Próxima
                    </button>
                </nav>
                <span class="text-sm text-gray-600 dark:text-gray-300">
                    {{ clientes.from }} a {{ clientes.to }} de {{ clientes.total }}
                </span>
            </div>
        </div>
    </AppLayout>
</template>