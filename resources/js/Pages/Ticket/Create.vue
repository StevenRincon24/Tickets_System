<script setup>
import FloatingInput from '@/Components/FloatingInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3'
import { Toast, useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';  // Asegúrate de importar el estilo

const toast = useToast();
const props = defineProps({
    tipo_incidencias: {
        type: Array
    },

    dependencias: {
        type: Array
    },
})


const form = useForm({
    titulo: '',
    descripcion: '',
    tipo_incidencia_id: '',
    criticidad: '',
    dependencia_id: '',
});

const guardar_Incidencia = () => {
    // Validar formulario
    if (!form.data().titulo || !form.data().descripcion || !form.data().tipo_incidencia_id || !form.data().criticidad || !form.data().dependencia_id) {
        toast.error('Hubo un error al crear la incidencia.');
        return;
    }

    form.post(route('storeIncidencia'), {
        onSuccess: (response) => {
            // Muestra el toast con el mensaje de éxito
            toast.success(response.props.flash.success);
            form.reset();
        },
        onError: (errors) => {
            // Muestra el toast con el mensaje de error
            toast.error('Hubo un error al registrar la dependencia.');
            console.error(errors);
        }
    });

};
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Incidencias</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">

                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-center items-center">
                        <h6 class="text-blueGray-700 text-xl font-bold">Registro de incidencias</h6>
                    </div>
                </div>

                <div class="flex-auto px-4 lg:p-3 pt-0">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="nombre" id="nombre"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required v-model="form.titulo" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Titulo</label>
                    </div>


                    <div class="relative z-0 w-full mb-5 group">
                        <label for="tipo_incidencia_id" class="block mb-2 text-sm font-medium text-gray-900 ">Tipo
                            de incidencia</label>

                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            aria-label="Default select example" v-model="form.tipo_incidencia_id">
                            <option value="" disabled selected>Selecciona un tipo de incidencia</option>

                            <option v-for="tipo_incidencia in tipo_incidencias" :key="tipo_incidencia.id"
                                :value="tipo_incidencia.id">
                                {{ tipo_incidencia.nombre }}
                            </option>
                        </select>
                    </div>

                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción general</label>
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Describe detalladamente el problema..." :value="form.descripcion"
                        @input="form.descripcion = $event.target.value" />



                    <div class="relative z-0 w-full mb-5 group">
                        <label for="dependencia_id" class="block mb-2 text-sm font-medium text-gray-900 ">Dependencia
                            solicitante</label>
                        <select
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            aria-label="Default select example" v-model="form.dependencia_id">
                            <option value="" disabled selected>Seleccione una dependencia</option>

                            <option v-for="dependencia in dependencias" :key="dependencia.id" :value="dependencia.id">
                                {{ dependencia.nombre }}
                            </option>
                        </select>
                    </div>


                    <div class="relative z-0 w-full mb-5 group">
                        <label for="countries"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Criticidad
                        </label>
                        <select id="countries" v-model="form.criticidad"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="" disabled selected>Seleccione el nivel de criticidad</option>

                            <option>Alta</option>
                            <option>Media</option>
                            <option>Baja</option>
                        </select>
                    </div>

                    <div class="text-center flex justify-center">

                        <button @click="guardar_Incidencia"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
