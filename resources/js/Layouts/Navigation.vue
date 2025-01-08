<script setup>
import NavLink from '@/Components/NavLink.vue';
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue'
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'
import { onMounted } from 'vue';

let showingTwoLevelMenu = ref(false)
let showingTwoLevelMenuUsers = ref(false)
let showingTwoLevelMenuDependencias = ref(false)

const page = usePage()

const incidenciasPendientes = computed(() => page.props.incidenciasPendientes);

onMounted(() => {
    console.log(page.props.user.permissions); // Ver permisos en la consola al montar el componente
});
</script>



<template>
    <div :class="$page.props.showingMobileMenu ? 'block' : 'hidden'" @click="$page.props.showingMobileMenu = false"
        class="fixed inset-0 z-20 bg-black opacity-50 transition-opacity lg:hidden"></div>

    <div :class="$page.props.showingMobileMenu ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
        class="overflow-y-auto fixed inset-y-0 left-0 z-30 w-64 bg-gray-900 transition duration-300 transform lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex justify-center items-center mt-8">
            <div class="flex items-center">

                <span class="mx-2 text-2xl font-semibold text-white text-center">Gestión de incidencias</span>
            </div>
        </div>

        <nav class="mt-10" x-data="{ isMultiLevelMenuOpen: false }">



            <!-- MENU PARA GESTION DE DEPENDECIAS -->
            <a v-if="$page.props.user.permissions.includes('ver usuario')"
                class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#"
                @click="showingTwoLevelMenuDependencias = !showingTwoLevelMenuDependencias">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 9h3m-3 3h3m-3 3h3m-6 1c-.306-.613-.933-1-1.618-1H7.618c-.685 0-1.312.387-1.618 1M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Zm7 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                </svg>

                <span class="mx-3">Dependencias</span>
            </a>
            <transition enter-to-class="transition-all duration-300 ease-in-out" enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl" leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenuDependencias">
                    <ul class=" overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700
                        bg-opacity-50 rounded-md shadow-inner" aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 12h14m-7 7V5" />
                            </svg>

                            <Link class="w-full mx-2" :href="route('dependencias.create')">Añadir</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-width="2"
                                    d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                            </svg>
                            <Link class="w-full ml-2" :href="route('dependencias.index')">Listado</Link>
                        </li>
                    </ul>
                </div>
            </transition>

            <!-- MENU PARA GESTION DE USUARIOS -->
            <a v-if="$page.props.user.permissions.includes('ver usuario')"
                class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#"
                @click="showingTwoLevelMenuUsers = !showingTwoLevelMenuUsers">
                <svg class="w-6 h-6 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                    height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-width="2"
                        d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
                <span class="mx-3">Usuarios</span>
            </a>
            <transition enter-to-class="transition-all duration-300 ease-in-out" enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl" leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenuUsers">
                    <ul class=" overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700
                        bg-opacity-50 rounded-md shadow-inner" aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <Link class="w-full" :href="route('users.create')">Añadir</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-width="2"
                                    d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                            </svg>
                            <Link class="w-full ml-2" :href="route('users.index')">Listado</Link>
                        </li>
                    </ul>
                </div>
            </transition>


            <!-- MENU PARA GESTION DE INCIDENCIAS -->
            <a class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#"
                @click="showingTwoLevelMenu = !showingTwoLevelMenu">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="white" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M3.559 4.544c.355-.35.834-.544 1.33-.544H19.11c.496 0 .975.194 1.33.544.356.35.559.829.559 1.331v9.25c0 .502-.203.981-.559 1.331-.355.35-.834.544-1.33.544H15.5l-2.7 3.6a1 1 0 0 1-1.6 0L8.5 17H4.889c-.496 0-.975-.194-1.33-.544A1.868 1.868 0 0 1 3 15.125v-9.25c0-.502.203-.981.559-1.331ZM7.556 7.5a1 1 0 1 0 0 2h8a1 1 0 0 0 0-2h-8Zm0 3.5a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2H7.556Z"
                        clip-rule="evenodd" />
                </svg>
                <span class="mx-3">Incidencias</span>
                <span class="ml-2 px-2 py-0.5 text-xs font-bold text-white bg-red-500 rounded-full"
                    v-if="$page.props.user.permissions.includes('Tickets generales')">
                    {{ incidenciasPendientes }}
                </span>
            </a>
            <transition enter-to-class="transition-all duration-300 ease-in-out" enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl" leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenu">
                    <ul class=" overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700
                        bg-opacity-50 rounded-md shadow-inner" aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white mr-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12h4m-2 2v-4M4 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <Link class="w-full" :href="route('ticket.create')">Añadir</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center"
                            v-if="$page.props.user.permissions.includes('Tickets generales')">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-width="2"
                                    d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                            </svg>
                            <Link class="w-full ml-2" :href="route('ticket.ticketsGenerales')">Tickets creados</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center"
                            v-if="$page.props.user.permissions.includes('Mis tickets')">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-width="2"
                                    d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5" />
                            </svg>

                            <Link class="w-full ml-2" :href="route('ticket.index')">Mis tickets</Link>
                        </li>
                    </ul>
                </div>
            </transition>

        </nav>
    </div>
</template>


<script>
export default {
    props: {
        incidenciasPendientes: Number,
    },
};
</script>
