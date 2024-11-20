
<template>
    <main class="container">
        <div class="row text-left mt-5">
            <h1>Criar nova tarefa</h1>
        </div>
        <form @submit.prevent="criarTarefa" class="mt-5">
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
            <button type="submit" class="btn btn-primary">Criar</button>
        </form>
    </main>
</template>

<script>

export default {
    data() {
        return {
            form: {
                titulo: '',
                descricao: '',
                status: 1,
            },
        };
    },
    methods: {
        async criarTarefa() {
            try {
                await this.$inertia.post(route('tarefa.store'), this.form);
                
                console.log("Tarefa criada com sucesso!");
            } catch (error) {
                console.error("Erro ao criar a tarefa:", error);
            }
        },
    },
};
</script>
