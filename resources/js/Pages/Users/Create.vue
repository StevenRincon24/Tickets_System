<script setup>
import FloatingInput from '@/Components/FloatingInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { Toast, useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';


const props = defineProps({
    roles: {
        Array
     },

    dependencias: {
        type: Array
    },
})
const toast = useToast();
// Inicialización del formulario
const form = useForm({
    nombre: '',
    email: '',
    password: '',
    role: '',
    dependencia_id: '',
});

// Función para guardar los datos
const guardar = () => {
    if (form.nombre === '' || form.email === '' || form.password === '' || form.role === '' || form.dependencia_id === '') {
        toast.error('Todos los campos son obligatorios.');
        return;
    }else{
        // Valida que el email sea válido
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(form.email)) {
            toast.error('El email no es válido.');
            return;
        }
        // Valida que la contraseña tenga al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial
        const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        if (!passwordRegex.test(form.password)) {
            toast.warning('La contraseña debe tener al menos 8 caracteres, una letra mayúscula, una letra minúscula, un número y un carácter especial.');
            return;
        }
    }
    form.post(route('storeUsers'), {
        onSuccess: (response) => {
            // Limpia el formulario o muestra un mensaje de éxito
            toast.success(response.props.flash.success);
            form.reset();
        },
        onError: (errors) => {
            toast.error('Hubo un error al registrar la dependencia.');
            console.error(errors);
        }
    });
};
</script>


<template>

    <Head title="Crear usuario" />

    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Usuarios</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div
                class="relative flex flex-col min-w-0 break-words w-full shadow-lg rounded-lg bg-blueGray-100 border-0">
                <div class="rounded-t bg-white mb-0 px-6 py-6">
                    <div class="text-center flex justify-center items-center">
                        <h6 class="text-blueGray-700 text-xl font-bold">Registro de usuarios</h6>
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


                    <div class="relative z-0 w-full mb-5 group">
                        <input type="email" name="email" id="email"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required v-model="form.email" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo
                            electrónico</label>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="password" name="password" id="password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required v-model="form.password" />
                        <label for="floating_email"
                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Contraseña
                        </label>
                        <span v-if="form.errors.password" class="text-red-500 text-sm mt-1">{{ form.errors.password
                            }}</span>

                    </div>


                    <div class="relative z-0 w-full mb-5 group">
                        <label for="dependencia_id" class="block text-sm font-medium text-gray-700">Dependencia</label>
                        <select id="dependencia_id" name="dependencia_id" v-model="form.dependencia_id"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="" disabled selected>--Dependencia--</option>

                            <option v-for="dependencia in dependencias" :key="dependencia.id" :value="dependencia.id">
                                {{ dependencia.nombre }}
                            </option>
                        </select>
                        <span v-if="form.errors.role" class="text-red-500 text-sm mt-1">{{ form.errors.role }}</span>
                    </div>



                    <div class="relative z-0 w-full mb-5 group">
                        <label for="role" class="block text-sm font-medium text-gray-700">Rol</label>
                        <select id="role" name="role" v-model="form.role"
                            class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="" disabled selected>--Rol--</option>

                            <option v-for="role in roles" :key="role.id" :value="role.name">{{ role.name }}</option>
                        </select>
                        <span v-if="form.errors.role" class="text-red-500 text-sm mt-1">{{ form.errors.role }}</span>
                    </div>

                    <PrimaryButton @click="guardar()" class="w-full" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Guardar
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
