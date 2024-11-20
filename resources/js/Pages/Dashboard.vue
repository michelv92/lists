<script setup>
import { onMounted, ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import $ from 'jquery';
import 'datatables.net-dt/css/dataTables.dataTables.css';
import 'datatables.net';
import dayjs from 'dayjs';
import { route } from 'ziggy-js';

defineProps({
    tarefa: {
        type: Array,
        default: () => [],
    },
});


const getStatusText = (status) => {
    const statusMap = {
        1: 'Pendente',
        2: 'Em andamento',
        3: 'Concluída',
    };
    return statusMap[status] || 'Desconhecido';
};

const tableRef = ref(null);

onMounted(() => {
    $(tableRef.value).DataTable();
});

const deleteTarefa = async (id) => {
    if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
        try {
            await axios.delete(route('tarefa.delete', { id }));
            alert('Tarefa excluída com sucesso.');
            window.location.reload();
        } catch (error) {
            console.error(error);
            alert('Erro ao excluir a tarefa.');
        }
    }
};
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="container flex justify-between items-center">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">
                    Lists
                </h2>
                <Link :href="route('tarefa.create')" class="btn btn-primary">
                Nova Tarefa
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <table ref="tableRef" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Título</th>
                                    <th>Descrição</th>
                                    <th>Status</th>
                                    <th>Data de criação</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(tarefa, index) in tarefa" :key="tarefa.id">
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ tarefa.titulo }}</td>
                                    <td>{{ tarefa.descricao }}</td>
                                    <td>{{ getStatusText(tarefa.status) }}</td>
                                    <td>{{ dayjs(tarefa.created_at).format('DD/MM/YYYY HH:mm:ss') }}</td>
                                    <td class="text-center">
                                        <Link :href="route('tarefa.edit', tarefa.id)" class="btn btn-sm btn-warning">
                                        Editar
                                        </Link>
                                        <button @click="deleteTarefa(tarefa.id)" class="btn btn-sm btn-danger ml-3">
                                            Excluir
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
