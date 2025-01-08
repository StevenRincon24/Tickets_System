<script setup>
import FloatingInput from '@/Components/FloatingInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, useForm } from '@inertiajs/vue3';
import { Toast, useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';  // Asegúrate de importar el estilo

const toast = useToast(); // Crea la instancia del toast


const form = useForm({
    nombre: '',
});

const guardar_Dependencia = () => {
    console.log('Datos a enviar:', form.data());
    // VALIDAR FORMULARIO
    if (form.data().nombre == '') {
        toast.error('Todos los campos son obligatorios.');
        return;
    }
    form.post(route('storeDependencias'), {
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
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Dependencias</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />

            </div>
        </template>

        <div class="bg-white  shadow-sm sm:rounded-lg">
            <div
                class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-center">
                        <h6 class="text-blueGray-700 text-xl font-bold">Agregar dependencia</h6>
                    </div>
                </div>
                <div class="flex-auto px-4 lg:p-3 pt-0">
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="nombre" id="nombre"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required v-model="form.nombre" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nombre</label>
                    </div>
                    <div class="text-center flex justify-center">

                        <button @click="guardar_Dependencia"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Agregar</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
