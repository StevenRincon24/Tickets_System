<template>

    <Head title="Dependencias" />

    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Lista de dependencias</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />

            </div>
        </template>



        <div class="rounded-t mb-3 px-6 py-1">

            <div class="text-center flex justify-between">
                <a href="addDependencia"
                    class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-m px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 flex items-center">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Agregar
                </a>
            </div>
        </div>
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">

                <thead>
                    <tr
                        class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left font-semibold uppercase tracking-wider text-gray-600 text-xl">
                            Nombre
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">

                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="dependencia in dependencias.data" :key="dependencia.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap text-lg">{{ dependencia.nombre }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm text-right">
                            <!-- Botón Editar a la derecha -->
                            <button @click="openModal(dependencia)"
                                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Editar
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="dependencias.links" />
            </div>
        </div>

        <!-- Modal -->
        <div v-if="isModalOpen" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h3 class="text-xl font-semibold mb-4">Editar Dependencia</h3>
                <form @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                        <input v-model="selectedDependencia.nombre" type="text" id="nombre"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                    </div>
                    <div class="flex justify-end">
                        <button type="button" @click="closeModal"
                            class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                            Cancelar
                        </button>
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                            Guardar
                        </button>
                    </div>
                </form>
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
import { Toast, useToast } from 'vue-toast-notification';

const toast = useToast(); // Crea la instancia del toast

const props = defineProps({
    dependencias: {
        type: Object,
        required: true,
    },
});

const isModalOpen = ref(false);
const selectedDependencia = ref(null);

// Inicializa el formulario de actualización
const form = useForm({
    nombre: '',
});

const openModal = (dependencia) => {
    selectedDependencia.value = { ...dependencia };  // Duplicamos la dependencia para no modificar la original
    form.nombre = dependencia.nombre;  // Asignamos el nombre a la variable de formulario
    isModalOpen.value = true;
};

const closeModal = () => {
    isModalOpen.value = false;
};

// Enviar el formulario de actualización
const submitForm = () => {
    form.nombre = selectedDependencia.value.nombre;

    form.put(route('dependencias.update', selectedDependencia.value.id), {
        onSuccess: (response) => {
            // Muestra el toast con el mensaje de éxito
            toast.success(response.props.flash.success);

            closeModal();
        },
        onError: (errors) => {
            // Manejar errores de validación u otros errores
            console.error(errors);
        }
    });
};
</script>

<style scoped>
/* Estilos para el modal */
.fixed {
    z-index: 50;
}

.bg-black {
    background-color: rgba(0, 0, 0, 0.5);
}
</style>
