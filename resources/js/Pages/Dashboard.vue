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
                                        <button @click="openModal(tarefa)" class="btn btn-sm btn-secondary ml-3">
                                            Ver
                                        </button>
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

        <!-- Modal -->
        <div v-if="showModal" class="modal fade show" id="tarefaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes da Tarefa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Título:</strong> {{ selectedTarefa.titulo }}</p>
                        <p><strong>Descrição:</strong> {{ selectedTarefa.descricao }}</p>
                        <p><strong>Status:</strong> {{ getStatusText(selectedTarefa.status) }}</p>
                        <p><strong>Data de criação:</strong> {{ dayjs(selectedTarefa.created_at).format('DD/MM/YYYY HH:mm:ss') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { route } from 'ziggy-js';
import dayjs from 'dayjs';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    tarefa: {
        type: Array,
        default: () => [],
    },
});

const selectedTarefa = ref(null);
const showModal = ref(false);

const getStatusText = (status) => {
    const statusMap = {
        1: 'Pendente',
        2: 'Em andamento',
        3: 'Concluída',
    };
    return statusMap[status] || 'Desconhecido';
};


const openModal = (tarefa) => {
    selectedTarefa.value = tarefa;
    showModal.value = true;
};


const closeModal = () => {
    showModal.value = false;
    selectedTarefa.value = null;
};


const deleteTarefa = async (id) => {
    if (confirm('Tem certeza que deseja excluir esta tarefa?')) {
        try {
            await axios.delete(route('tarefa.delete', id));
            alert('Tarefa excluída com sucesso.');
            window.location.reload()
        } catch (error) {
            console.error(error);
            alert('Erro ao excluir a tarefa.');
        }
    }
};
</script>

<style scoped>
.modal.fade.show {
    display: block;
}
</style>
