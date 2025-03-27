<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { Toast, useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

// Props
const props = defineProps({
    incidencia: {
        type: Object,
        required: true,
    },
});

// Toast
const toast = useToast();

// Reactive state
const mostrarModal = ref(false);
const nuevoEstado = ref("");
const estados = ["Pendiente", "En proceso", "Finalizada"];

const form = useForm({
    comentario: '',
});

// Methods
const actualizarEstado = () => {
    if (!props.incidencia || !props.incidencia.id) {
        toast.error("No se pudo actualizar el estado porque falta información de la incidencia.");
        return;
    }

    router.put(
        route("ticket.update", props.incidencia.id),
        { estado: nuevoEstado.value },
        {
            onSuccess: () => {
                toast.success("El estado del ticket ha sido actualizado.");
                mostrarModal.value = false;
            },
            onError: (errors) => {
                toast.error("Ocurrió un error al actualizar el estado.");
                console.error(errors);
            },
        }
    );
};

const limpiarSignosDePuntuacion = (texto) => {
    // Usar una expresión regular para eliminar los signos de puntuación
    return texto.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g, "").replace(/\s{2,}/g, " ");
};



const guardarComentario = () => {
    console.log("Aca", props.incidencia.id);
    let comentarioLimpio = limpiarSignosDePuntuacion(form.comentario);

    if (comentarioLimpio.trim()) {
        router.post(
            route('comentarios.store', props.incidencia.id),
            { comentario: comentarioLimpio },
            {
                onSuccess: () => {
                    toast.success("Comentario guardado exitosamente.");
                    form.comentario = ""; // Limpiar el comentario solo una vez

                    // Actualizar la lista de comentarios localmente

                },
                onError: (errors) => {
                    toast.error("Ocurrió un error al guardar el comentario.");
                    console.error(errors);
                },
            }
        );
    } else {
        alert("El comentario no puede estar vacío.");
    }
};







</script>

<template>

    <Head title="Detalle de Ticket" />
    <AuthenticatedLayout>
        <template #header>
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold text-xl mb-2">Detalle del Ticket</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="flex flex-col md:flex-row gap-6 bg-white shadow-sm sm:rounded-lg p-6">
            <div class="w-full md:w-2/3 border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-semibold mb-4">Ticket</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">Asunto:</p>
                        <p class="text-gray-600">{{ incidencia.titulo }}</p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">Estado:</p>
                        <p>
                            <span class="inline-block px-2 py-1 text-sm font-medium text-white rounded" :class="{
                                'bg-red-600': incidencia.estado === 'Pendiente',
                                'bg-orange-500': incidencia.estado === 'En proceso',
                                'bg-green-600': incidencia.estado === 'Finalizada',
                            }">
                                {{ incidencia.estado }}
                            </span>
                            <button @click="mostrarModal = true"
                                v-if="$page.props.user.permissions.includes('Cambiar estado ticket')"
                                class="ml-4 px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-500">
                                Actualizar estado
                            </button>
                        </p>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">
                            Descripción :
                        </p>
                        <p class="text-gray-600">{{ incidencia.descripcion }}</p>
                    </div>

                </div>

                <div class="mt-4">
                    <p class="font-semibold text-gray-700 mb-1">
                        Dependencia solicitante:
                    </p>
                    <p class="text-gray-600">{{ incidencia.dependencia }}</p>
                </div>
            </div>

            <div class="w-full md:w-1/3 border border-gray-300 p-4 rounded-md">



                <div>

                    <section class="rounded-b-lg mt-4" v-if="incidencia.comentariosUsuarios.length > 0">
                        <div class="mt-4">
                            <h2 class="text-lg font-semibold mb-4">Comentarios anteriores</h2>

                        </div>
                        <ul>
                            <li v-for="(comentarioUsuario, index) in incidencia.comentariosUsuarios" :key="index">
                                <div id="task-comments" class="pt-4">
                                    <div
                                        class="bg-white rounded-lg p-3 flex flex-col justify-center items-center md:items-start shadow-lg mb-4">
                                        <div class="flex flex-row justify-center mr-2">
                                            <h3 class="text-black font-semibold text-lg text-center md:text-left">
                                                @{{ comentarioUsuario.usuario }} </h3>
                                        </div> <!-- Contenido del comentario -->
                                        <p style="width: 90%" class="text-gray-600 text-lg text-center md:text-left"> {{
                                            comentarioUsuario.comentario }} </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </section>

                </div>


                <textarea v-model="form.comentario"
                    class="w-full shadow-inner p-4 border-0 mb-4 rounded-lg focus:shadow-outline text-2xl"
                    placeholder="Comenta aquí" cols="6" rows="4" id="comment_content" spellcheck="false"></textarea>

                <button @click="guardarComentario"
                    class="font-bold py-2 px-4 w-full bg-green-800 text-lg text-white shadow-md rounded-lg ">Guardar
                </button>

            </div>
        </div>

        <div v-if="mostrarModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center z-50">
            <div class="bg-white p-6 rounded shadow-lg w-96">
                <h2 class="text-lg font-semibold mb-4 text-center">
                    Actualizar Estado
                </h2>
                <p class="mb-4">
                    <span class="font-semibold">Incidencia:</span>
                    {{ incidencia.titulo }}
                </p>
                <label class="block mb-2 font-semibold text-gray-700">
                    Nuevo Estado:
                </label>
                <select v-model="nuevoEstado" class="w-full p-2 border border-gray-300 rounded-md">
                    <option value="" disabled>Selecciona un estado</option>
                    <option v-for="estado in estados" :key="estado" :value="estado">
                        {{ estado }}
                    </option>
                </select>

                <div class="mt-4 flex justify-end gap-2">
                    <button @click="mostrarModal = false"
                        class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-400">
                        Cancelar
                    </button>
                    <button @click="actualizarEstado" :disabled="!nuevoEstado"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-500 disabled:opacity-50">
                        Actualizar
                    </button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
