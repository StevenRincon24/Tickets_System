<template>

    <Head title="Users" />
    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Usuarios registrados</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="rounded-t mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
                <a href="addUser"
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

        <div class="overflow-x-auto">
            <table class="min-w-full whitespace-no-wrap">
                <thead>
                    <tr
                        class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nombre
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Correo
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Rol
                        </th>
                        <th
                            class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Acciones
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                <!-- Mostrar los roles del usuario -->
                                {{ user.roles.map(role => role.name).join(', ') }}
                            </p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <!-- Botones de acción en fila (uno al lado del otro) -->
                            <div class="flex space-x-3">
                                <!-- Botón para editar usuario -->
                                <button class="text-blue-500 hover:text-blue-700" @click="openModal(user)">
                                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                    </svg>
                                </button>

                                <!-- Botón para cambiar contraseña -->
                                <button class="text-yellow-500 hover:text-yellow-700" @click="openPasswordModal(user)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 11c.386 0 .75-.1 1.065-.275a1.5 1.5 0 0 0-.565-.41A1.5 1.5 0 1 0 12 11Zm0-4a5 5 0 1 1-4.9 5.9H5a7 7 0 1 0 7-7Z" />
                                    </svg>
                                </button>

                                <!-- Botón para eliminar usuario -->
                                <a href="#" class="text-red-500 hover:text-red-700"
                                    @click.prevent="deleteUser(user.id)">
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
            <div v-if="isModalOpen" class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h3 class="text-xl font-semibold mb-4">Editar usuario</h3>
                    <form @submit.prevent="submitForm">
                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input v-model="selectedUser.name" type="text" id="nombre"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>

                        <div class="mb-4">
                            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                            <input v-model="selectedUser.email" type="text" id="nombre"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="closeModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                                Cancelar
                            </button>
                            <button type="submit"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>


            <!-- Modal para cambiar contraseña -->
            <div v-if="isPasswordModalOpen"
                class="fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                    <h3 class="text-xl font-semibold mb-4">Cambiar contraseña</h3>
                    <form @submit.prevent="updatePassword">
                        <div class="mb-4">
                            <label for="newPassword" class="block text-sm font-medium text-gray-700">Nueva
                                contraseña</label>
                            <input v-model="passwordForm.password" type="password" id="newPassword" ref="passwordInput"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                            <p v-if="form.errors.password" class="text-red-500 text-xs mt-1">
                                {{ form.errors.password }}
                            </p>
                        </div>

                        <div class="mb-4">
                            <label for="repeatPassword" class="block text-sm font-medium text-gray-700">Repetir
                                contraseña</label>
                            <input v-model="passwordForm.repeatPassword" type="password" id="repeatPassword"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                :class="{ 'border-red-500': !passwordsMatch }" />
                            <p v-if="!passwordsMatch" class="text-red-500 text-xs mt-1">
                                Las contraseñas no coinciden.
                            </p>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" @click="closePasswordModal"
                                class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 mr-2">
                                Cancelar
                            </button>
                            <button type="submit" :disabled="!passwordsMatch"
                                class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">
                                Guardar
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>

        <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">

            <pagination :links="users.links" />
        </div>


        <!-- Modal para agregar, editar y eliminar usuarios -->



    </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue';
import { Head } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Toast, useToast } from 'vue-toast-notification';
import 'vue-toast-notification/dist/theme-sugar.css';  // Asegúrate de importar el estilo

const toast = useToast(); // Crea la instancia del toast
const isModalOpen = ref(false);
const selectedUser = ref(null);
const isPasswordModalOpen = ref(false);
const passwordForm = ref({
    userId: null,
    password: '',
    repeatPassword: '',
});

const form = useForm({
    password: '',
    password_confirmation: '',
});

const passwordsMatch = computed(() => {
    return passwordForm.value.password === passwordForm.value.repeatPassword;
});

const openPasswordModal = (user) => {
    passwordForm.value.userId = user.id;
    isPasswordModalOpen.value = true;
};

const closePasswordModal = () => {
    isPasswordModalOpen.value = false;
    passwordForm.value.password = '';
    passwordForm.value.repeatPassword = '';
    form.reset();
};

const updatePassword = () => {
    form.password = passwordForm.value.password;
    form.password_confirmation = passwordForm.value.repeatPassword;
    form.put(route('users.editPassword', passwordForm.value.userId), {
        preserveScroll: true,
        onSuccess: (response) => {
            toast.success(response.props.flash.success);

            form.reset();
            closePasswordModal();
        },
        onError: () => {
            toast.success("Error al actualizar la contraseña");

        },
    });
};


const openModal = (usuario) => {
    console.log('Abriendo modal para editar el usuario:', usuario);
    selectedUser.value = { ...usuario }, // Establecer el usuario seleccionado =
        form.nombre = usuario.name, // Asignar el nombre al campo de formulario
        form.correo = usuario.email, // Asignar el correo al campo de formulario
        form.rol = usuario.rol, // Asignar el rol al campo de formulario
        form.contraseña = usuario.password, // Asignar la contraseña al campo de formulario
        isModalOpen.value = true
};

const props = defineProps({
    users: Object
});

// Métodos para manejar la edición y eliminación
const editUser = (userId) => {
    // Lógica para editar un usuario
    console.log('Editar usuario', userId);
    // Redirigir a una página de edición si es necesario
    // window.location.href = `/editUser/${userId}`;
};

const deleteUser = (userId) => {
    // Lógica para eliminar un usuario
    console.log('Eliminar usuario', userId);
    // Realizar la solicitud de eliminación
};
</script>
