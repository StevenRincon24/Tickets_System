<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { onMounted } from 'vue';


</script>

<template>
    <Head title="Detalle de Ticket" />
    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold text-xl mb-2">Detalle del Ticket</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <!-- Contenedor principal -->
        <div
            class="flex flex-col md:flex-row gap-6 bg-white shadow-sm sm:rounded-lg p-6"
        >

            <!-- Información del ticket -->
            <div class="w-full md:w-2/3 border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-semibold mb-4">Ticket</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Columna 1 -->
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">Asunto:</p>
                        <p class="text-gray-600">{{ incidencia.titulo }}</p>
                    </div>

                    <!-- Columna 2 -->
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">Estado:</p>
                        <p>
                            <span
                                class="inline-block px-2 py-1 text-sm font-medium text-white rounded"
                                :class="{
                                    'bg-red-600':
                                        incidencia.estado === 'Pendiente',
                                    'bg-orange-500':
                                        incidencia.estado === 'En proceso',
                                    'bg-green-600':
                                        incidencia.estado === 'Finalizada',
                                }"
                            >
                                {{ incidencia.estado }}
                            </span>
                            <button
                                @click="actualizarEstado"
                                class="ml-4 px-3 py-1 bg-blue-600 text-white text-sm rounded hover:bg-blue-500"
                            >
                                Actualizar Estado
                            </button>
                        </p>
                    </div>

                    <!-- Columna 1 -->
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">Descripción	:</p>
                        <p class="text-gray-600">{{ incidencia.descripcion }}</p>
                    </div>

                    <!-- Columna 2 -->
                    <div>
                        <p class="font-semibold text-gray-700 mb-1">
                           Nivel de prioridad:
                        </p>
                        <p>
                            <span
                                class="inline-block px-2 py-1 text-sm font-medium text-white rounded"
                                :class="{
                                    'bg-red-600':
                                        incidencia.criticidad === 'Alta',
                                    'bg-orange-500':
                                        incidencia.criticidad === 'Media',
                                    'bg-blue-500':
                                        incidencia.criticidad === 'Baja',
                                }"
                            >
                                {{ incidencia.criticidad }}
                            </span>
                        </p>

                    </div>
                </div>

                <!-- Descripción -->
                <div class="mt-4">
                    <p class="font-semibold text-gray-700 mb-1">Dependencia solicitante:</p>
                    <p class="text-gray-600">{{ incidencia.dependencia }}</p>
                </div>
            </div>

            <!-- Sección de comentarios -->
            <div class="w-full md:w-1/3 border border-gray-300 p-4 rounded-md">
                <h2 class="text-lg font-semibold mb-4">Comentario</h2>
                <textarea
                    v-model="comentario"
                    placeholder="Escribe tu comentario aquí..."
                    class="w-full p-2 border border-gray-300 rounded-md resize-none"
                ></textarea>
                <button
                    @click="guardarComentario"
                    class="mt-4 px-3 py-1 bg-green-600 text-white text-sm rounded hover:bg-green-500"
                >
                    Guardar
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    props: {
        incidencia: Object,
    },


    data() {
        return {
            comentario: "",
        };
    },

    mounted() {
        console.log('Props recibidos:', this.incidencia);
    },
    methods: {
        actualizarEstado() {
            alert("Función para actualizar el estado.");
        },
        guardarComentario() {
            if (this.comentario.trim()) {
                alert(`Comentario guardado: ${this.comentario}`);
                this.comentario = "";
            } else {
                alert("El comentario no puede estar vacío.");
            }
        },
    },
};
</script>

<style scoped>
textarea {
    min-height: 120px;
}
</style>
