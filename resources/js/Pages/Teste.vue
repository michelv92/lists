<template>
    <table ref="tableRef" class="table table-hover table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <!-- O DataTables irá popular os dados aqui via AJAX -->
        </tbody>
    </table>
</template>

<script>
import { onMounted, ref } from 'vue';

export default {
    props: {
        tarefas: {
            type: Array,
            default: () => []
        },
    },
    setup(props) {

        console.log(props.tarefas);
        
        onMounted(() => {
            console.log("Componente montado");
        });

        return {
           
        };
    },
};
</script>