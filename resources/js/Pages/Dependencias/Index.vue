<template>
    <Head title="Dependencias" />

    <AuthenticatedLayout>
        <template #header>
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5 text-2xl">Lista de Dependencias</h1>
                <hr class="my-2 border-t-2 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="rounded-t mb-3 px-6 py-1 flex justify-between">
            <a href="addDependencia" class="bg-emerald-500 text-white font-bold uppercase text-sm px-4 py-2 rounded shadow hover:shadow-md transition ease-in-out flex items-center">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 5v14M5 12h14" />
                </svg>
                Agregar Dependencia
            </a>
        </div>

        <div class="overflow-hidden rounded-lg shadow-lg items-center">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-600 uppercase text-sm">
                        <th class="px-6 py-3 border-b">Nombre</th>
                        <th class="px-6 py-3 border-b">Usuarios</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dependencia in dependencias.data" :key="dependencia.id" class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 text-lg">{{ dependencia.nombre }}</td>

                        <td class="px-6 py-4">
                            <ul class="list-disc pl-5 text-sm text-gray-700">
                                <li v-for="usuario in dependencia.usuarios" :key="usuario.id">
                                    <span class="font-medium">{{ usuario.name }}</span> - {{ usuario.email }}
                                </li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="items-center bg-white px-5 py-5 border-t">
                <pagination :links="dependencias.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';

const toast = useToast();
const props = defineProps({
    dependencias: { type: Object, required: true },
});
const isModalOpen = ref(false);
const selectedDependencia = ref(null);
const form = useForm({ nombre: '' });

const openModal = (dependencia) => {
    selectedDependencia.value = { ...dependencia };
    form.nombre = dependencia.nombre;
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

const submitForm = () => {
    form.nombre = selectedDependencia.value.nombre;
    form.put(route('dependencias.update', selectedDependencia.value.id), {
        onSuccess: (response) => {
            toast.success(response.props.flash.success);
            closeModal();
        },
        onError: (errors) => {
            console.error(errors);
        }
    });
};
</script>

<style scoped>
table {
    border-collapse: separate;
    border-spacing: 0 10px;
}
th, td {
    padding: 12px;
}
tr:nth-child(even) {
    background-color: #f9fafb;
}
</style>
