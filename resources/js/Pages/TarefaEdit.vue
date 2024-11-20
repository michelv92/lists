<template>
    <main class="container">
        <div class="row text-left mt-5">
            <h1>Editar Tarefa</h1>
        </div>
        <form @submit.prevent="atualizarTarefa" class="mt-5">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input
                    type="text"
                    class="form-control"
                    id="titulo"
                    v-model="form.titulo"
                    aria-describedby="titulo"
                />
            </div>
            <div class="form-group mb-3">
                <label for="descricao">Descrição</label>
                <textarea
                    class="form-control"
                    id="descricao"
                    v-model="form.descricao"
                    rows="3"
                ></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select
                    class="form-control"
                    id="status"
                    v-model="form.status"
                >
                    <option value="1">Pendente</option>
                    <option value="2">Em andamento</option>
                    <option value="3">Concluída</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a class="btn btn-secondary ml-3" href="/dashboard">Voltar</a>
        </form>
    </main>
</template>

<script>
export default {
    props: {
        tarefa: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: {
                titulo: this.tarefa.titulo,
                descricao: this.tarefa.descricao,
                status: this.tarefa.status,
            },
        };
    },
    methods: {
        async atualizarTarefa() {
            try {
                await this.$inertia.put(route('tarefa.update', this.tarefa.id), this.form);
                console.log("Tarefa atualizada com sucesso!");
            } catch (error) {
                console.error("Erro ao atualizar a tarefa:", error);
            }
        },
    },
};

const getStatusText = (status) => {
    const statusMap = {
        1: 'Pendente',
        2: 'Em andamento',
        3: 'Concluída',
    };
    return statusMap[status] || 'Desconhecido';
};
</script>
