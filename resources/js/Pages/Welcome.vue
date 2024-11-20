<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

const assetUrl = '/assets/img/list-cross-svgrepo-com.svg';
</script>

<template>
    <Head title="Home" />
    <main class="mt-4 flex items-center justify-center min-h-screen">
        <div class="container-fluid flex items-center justify-center border rounded shadow-md" style="max-width: 500px;">
            <img class="w-50" :src="assetUrl" alt="Imagem" />
                <Link
                    :href="route('login')"
                    class="btn btn-outline-primary"
                >
                    Logar
                </Link>
                <Link
                    :href="route('register')"
                    class="btn btn-outline-secondary ml-3"
                >
                    Registrar
                </Link>
        </div>
    </main>
</template>
