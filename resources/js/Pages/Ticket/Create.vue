<script setup>
import { ref, watch } from 'vue';
import { useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Toast, useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';  // Asegúrate de importar el estilo

const toast = useToast();

const props = defineProps({
    tipo_incidencias: Array,
    dependencias: Array,
    categorias: Array,
});

const form = useForm({
    titulo: '',
    descripcion: '',
    dependencia_id: '',
    categoria_id: '',
    subcategoria_id: '',
});

const subcategoriasFiltradas = ref([]);

watch(() => form.categoria_id, (nuevaCategoria) => {
    if (nuevaCategoria) {
        const categoriaSeleccionada = props.categorias.find(cat => cat.id === nuevaCategoria);
        subcategoriasFiltradas.value = categoriaSeleccionada ? categoriaSeleccionada.subcategorias : [];
        form.subcategoria_id = '';
    } else {
        subcategoriasFiltradas.value = [];
    }
});

const guardar_Incidencia = () => {
    if (!form.titulo || !form.descripcion || !form.dependencia_id || !form.categoria_id || !form.subcategoria_id) {
        toast.error('Todos los datos son obligatorios');
        return;
    }

    form.post(route('storeIncidencia'), {
        onSuccess: (response) => {
            toast.success(response.props.flash.success);
            form.reset();
        },
        onError: (errors) => {
            toast.error('Hubo un error al registrar la incidencia.');
            console.error(errors);
        }
    });
};
</script>


<template>

    <Head title="Tickets" />


    <AuthenticatedLayout>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="px-6 py-6">
                <h6 class="text-blueGray-700 text-xl font-bold text-center">Registro de incidencias</h6>
            </div>

            <div class="px-4 lg:p-3 pt-0">


                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="nombre" id="nombre"
                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                        placeholder=" " required v-model="form.titulo" />
                    <label for="floating_email"
                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Titulo</label>
                </div>



                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción
                    general</label>
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







                <div class="grid md:grid-cols-2 md:gap-6">
                    <div class="relative z-0 w-full mb-5 group">
                        <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900">Tipo de
                            actividad</label>
                        <select v-model="form.categoria_id"
                            class="bg-gray-50 border text-gray-900 text-sm rounded-lg w-full p-2.5">
                            <option value="" disabled selected>Seleccione una categoría</option>
                            <option v-for="categoria in props.categorias" :key="categoria.id" :value="categoria.id">
                                {{ categoria.nombre }}
                            </option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <div v-if="subcategoriasFiltradas.length > 0" class="relative z-0 w-full mb-5 group">
                            <label for="subcategoria_id" class="block mb-2 text-sm font-medium text-gray-900">Actividad
                                especifica</label>
                            <select v-model="form.subcategoria_id"
                                class="bg-gray-50 border text-gray-900 text-sm rounded-lg w-full p-2.5">
                                <option value="" disabled selected>Seleccione una actividad</option>
                                <option v-for="subcategoria in subcategoriasFiltradas" :key="subcategoria.id"
                                    :value="subcategoria.id">
                                    {{ subcategoria.nombre }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>



                <div class="text-center">
                    <button @click="guardar_Incidencia"
                        class="bg-blue-700 text-white px-5 py-2.5 rounded-lg">Agregar</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
