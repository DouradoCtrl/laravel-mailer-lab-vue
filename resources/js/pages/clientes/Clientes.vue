<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, usePage, router } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';
import { defineProps } from 'vue';

import {
  Pagination,
  PaginationContent,
  PaginationEllipsis,
  PaginationItem,
  PaginationNext,
  PaginationPrevious,
} from '@/components/ui/pagination';

import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/components/ui/table';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Clientes',
        href: '/clientes',
    },
];

const props = defineProps({
    clientes: Object
});



</script>

<template>
    <Head title="Clientes" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-4 p-4">
            <div class="rounded-xl overflow-hidden border border-sidebar-border/70 dark:border-sidebar-border">

            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Id</TableHead>
                        <TableHead>Nome</TableHead>
                        <TableHead>E-mail</TableHead>
                        <TableHead>Telefone</TableHead>
                        <TableHead>Data de Nascimento</TableHead>
                        <TableHead>
                        Pontos
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                <TableRow v-for="(cliente, idx) in clientes.data" :key="cliente.id">
                    <TableCell class="font-medium">
                    {{ clientes.from + idx }}
                    </TableCell>
                    <TableCell>{{ cliente.nome }}</TableCell>
                    <TableCell>{{ cliente.email }}</TableCell>
                    <TableCell>{{ cliente.telefone }}</TableCell>
                    <TableCell>{{ cliente.data_nascimento }}</TableCell>
                    <TableCell>
                        0
                    </TableCell>
                </TableRow>
                </TableBody>
            </Table>
            </div>
            <TableCaption>Todos os clientes.</TableCaption>
            <!-- Paginação numérica elegante -->
            <Pagination
            :items-per-page="props.clientes.per_page"
            :total="props.clientes.total"
            :default-page="props.clientes.current_page"
            @update:page="page => router.get(route('clientes.index', { page }), {}, { preserveScroll: true })"
            >
                <PaginationContent v-slot="{ items }">
                    <PaginationPrevious @click="goToPage(page - 1)"/>

                    <template v-for="(item, index) in items" :key="index">
                        <PaginationItem
                            v-if="item.type === 'page'"
                            :value="item.value"
                            :is-active="item.value === page"
                            @click="goToPage(item.value)"
                        >
                            {{ item.value }}
                        </PaginationItem>
                    </template>

                    <PaginationEllipsis v-if="items.some(i => i.type === 'ellipsis')" />
                    <PaginationNext @click="goToPage(page + 1)"/>
                </PaginationContent>
            </Pagination>
        </div>
    </AppLayout>
</template>