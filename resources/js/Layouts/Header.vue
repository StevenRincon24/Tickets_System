<script setup>
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
</script>

<template>
    <header class="flex items-center justify-between border-b-4 border-black bg-red-500 px-6 py-4">
        <div class="flex items-center">
            <button @click="$page.props.showingMobileMenu = !$page.props.showingMobileMenu"
                class="text-gray-500 focus:outline-none lg:hidden">
                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
            </button>
        </div>

        <div class="flex items-center space-x-4">
            <!-- Botón de Notificaciones -->
            <dropdown>
                <template #trigger>
                    <div class="relative cursor-pointer"
                        v-if="$page.props.user.permissions.includes('Tickets generales')">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="white" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                        <!-- Contador de notificaciones -->
                        <span
                            class="absolute top-0 right-0 transform translate-x-2 -translate-y-2 px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full"
                            v-if="$page.props.incidenciasPendientes > 0">
                            {{ $page.props.incidenciasPendientes }}
                        </span>
                    </div>
                </template>

                <template #content>
                    <!-- Información de las notificaciones con scroll -->
                    <div class="p-4 max-h-64 overflow-y-auto">
                        <h3 class="font-bold text-lg">Notificaciones</h3>
                        <div v-for="(notificacion, index) in $page.props.notificaciones" :key="index"
                            class="mt-2 border-b pb-2">
                            <p class="text-sm font-semibold">{{ notificacion.titulo }}</p>
                            <p class="text-xs">{{ truncate(notificacion.descripcion, 100) }}</p>
                            <p class="text-xs text-gray-500">Área solicitante: {{ notificacion.dependencia }} </p>
                            <p class="text-xs text-gray-500">Hecho por: {{ notificacion.usuario }} </p>
                        </div>
                    </div>
                </template>
            </dropdown>

            <!-- Botón de Perfil -->
            <dropdown>
                <template #trigger>
                    <button @click="dropdownOpen = !dropdownOpen" class="relative overflow-hidden text-white">
                        {{ $page.props.auth.user.name }}
                    </button>
                </template>

                <template #content>
                    <dropdown-link :href="route('profile.edit')">
                        Perfil
                    </dropdown-link>

                    <dropdown-link class="w-full text-left" :href="route('logout')" method="post" as="button">
                        Salir
                    </dropdown-link>
                </template>
            </dropdown>
        </div>
    </header>
</template>

<script>
export default {
    methods: {
        truncate(text, length) {
            return text.length > length ? text.substring(0, length) + '...' : text;
        },
    },
};
</script>
