<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { defineProps } from 'vue';
import Pagination from '@/components/Pagination.vue'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Clientes',
        href: '/clientes',
    },
];

const props = defineProps({
    clientes: Object
});

function goToPage(page: number) {
    if (page < 1 || page > props.clientes.last_page || page === props.clientes.current_page) return;
    router.get(route('clientes.index', { page }), {}, { preserveScroll: true });
}

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
            <Pagination :data="clientes" @page-change="goToPage" />
        </div>
    </AppLayout>
</template>