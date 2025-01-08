<template>

    <Head title="Users" />
    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Mis tickets</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
                <a href="ticketcreate"
                    class="bg-emerald-500 text-white active:bg-emerald-600 font-bold uppercase text-m px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 ease-linear transition-all duration-150 flex items-center">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 7.757v8.486M7.757 12h8.486M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Agregar
                </a>
            </div>

            <!-- Filtro de estado -->

        </div>

        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow bg-gray-300">
            <div class="flex space-x-6 mb-4 m-5">
                <button class="bg-blue-500 text-white px-4 py-2 rounded focus:outline-none"
                    @click="filterByState('Pendiente')">
                    Pendiente
                </button>
                <button class="bg-orange-500 text-white px-4 py-2 rounded focus:outline-none"
                    @click="filterByState('En proceso')">
                    En curso
                </button>
                <button class="bg-green-500 text-white px-4 py-2 rounded focus:outline-none"
                    @click="filterByState('Finalizada')">
                    Finalizado
                </button>
                <button class="bg-gray-500 text-white px-4 py-2 rounded focus:outline-none" @click="clearFilter">
                    Todos
                </button>
            </div>
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Fecha de creación
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Titulo
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Descripción
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Dependencia solicitante
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Tipo de incidencia
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nivel de prioridad
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Estado
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="incidencia in filteredIncidencias" :key="incidencia.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ formatDate(incidencia.created_at) }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ incidencia.titulo }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ incidencia.descripcion }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ incidencia.dependencia }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ incidencia.tipo_incidencia }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ incidencia.criticidad }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <span v-if="incidencia.estado === 'Finalizada'"
                                class="bg-green-500 text-white py-1 px-3 rounded-full text-xs">
                                Finalizado
                            </span>
                            <span v-else-if="incidencia.estado === 'En proceso'"
                                class="bg-orange-500 text-white py-1 px-3 rounded-full text-xs">
                                En curso
                            </span>
                            <span v-else-if="incidencia.estado === 'Pendiente'"
                                class="bg-red-500 text-white py-1 px-3 rounded-full text-xs">
                                Pendiente
                            </span>
                            <span v-else class="bg-gray-300 text-white py-1 px-3 rounded-full text-xs">
                                {{ incidencia.estado }}
                            </span>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <div class="flex space-x-3">
                                <a href="#" class="text-blue-500 hover:text-blue-700"
                                    @click.prevent="editUser(incidencia.id)">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </a>
                                <a href="#" class="text-red-500 hover:text-red-700"
                                    @click.prevent="deleteUser(incidencia.id)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18 6L6 18M6 6l12 12"></path>
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="incidencias.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const props = defineProps({
    incidencias: Object
});

const filteredIncidencias = ref(props.incidencias.data);

// Método para formatear la fecha
const formatDate = (date) => {
    const options = { day: '2-digit', month: '2-digit', year: 'numeric' };
    return new Date(date).toLocaleDateString('es-ES', options);
};

// Métodos para manejar la edición y eliminación
const editUser = (userId) => {
    // Lógica para editar un usuario
    console.log('Editar usuario', userId);
};

const deleteUser = (userId) => {
    // Lógica para eliminar un usuario
    console.log('Eliminar usuario', userId);
};

// Métodos para filtrar las incidencias
const filterByState = (state) => {
    filteredIncidencias.value = props.incidencias.data.filter(incidencia => incidencia.estado === state);
};

const clearFilter = () => {
    filteredIncidencias.value = props.incidencias.data;
};
</script>
