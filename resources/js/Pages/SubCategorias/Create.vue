<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';

const toast = useToast();
const props = defineProps({
    categorias: Array
});

const form = useForm({
    nombres: [''], // Ahora permite múltiples títulos
    categoria_id: ''
});

const agregarTitulo = () => {
    form.nombres.push('');
};

const eliminarTitulo = (index) => {
    if (form.nombres.length > 1) {
        form.nombres.splice(index, 1);
    }
};

const guardarIncidencias = () => {
    if (!form.categoria_id || form.nombres.some(titulo => !titulo.trim())) {
        toast.error('Debes seleccionar una categoría y agregar al menos una actividad.');
        return;
    }

    form.post(route('storeSubcategorias'), {
        onSuccess: (response) => {
            toast.success(response.props.flash.success);
            form.reset();
        },
        onError: () => {
            toast.error('Hubo un error al registrar las incidencias.');
        }
    });
};
</script>

<template>

    <Head title="Gestión de Incidencias" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h2 class="text-xl font-bold text-center mb-4">Añadir tareas específicas a una categoría de servicio</h2>

            <div class="mb-4">
                <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900">Categoría</label>


                <select v-model="form.categoria_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled>Selecciona una categoría</option>
                    <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                        {{ categoria.nombre }}
                    </option>
                </select>
            </div>

            <div v-for="(nombre, index) in form.nombres" :key="index" class="mb-4 flex items-center">
                <input v-model="form.nombres[index]" type="text"
                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                    placeholder="Tareas específicas" />
                <button @click="eliminarTitulo(index)" v-if="form.nombres.length > 1"
                    class="px-3 py-1 bg-red-500 text-white rounded">-</button>
            </div>

            <button @click="agregarTitulo" class="mb-4 px-4 py-2 bg-green-500 text-white rounded">Añadir otra
                actividad</button>

            <div class="text-center">
                <button @click="guardarIncidencias" class="px-5 py-2 bg-blue-600 text-white rounded">Guardar</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
