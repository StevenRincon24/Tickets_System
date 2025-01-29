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
let showingTwoLevelMenuDashboard = ref(false)

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


            <a v-if="$page.props.user.permissions.includes('ver usuario')"
                class="flex items-center mt-4 py-2 px-6 text-gray-100" href="#"
                @click="showingTwoLevelMenuDashboard = !showingTwoLevelMenuDashboard">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v15a1 1 0 0 0 1 1h15M8 16l2.5-5.5 3 3L17.273 7 20 9.667" />
                </svg>


                <span class="mx-3">Dashboards</span>
            </a>
            <transition enter-to-class="transition-all duration-300 ease-in-out" enter-from-class="max-h-0 opacity-25"
                leave-from-class="opacity-100 max-h-xl" leave-to-class="max-h-0 opacity-0">
                <div v-show="showingTwoLevelMenuDashboard">
                    <ul class=" overflow-hidden p-2 mx-4 mt-2 space-y-2 text-sm font-medium text-white bg-gray-700
                        bg-opacity-50 rounded-md shadow-inner" aria-label="submenu">
                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                            </svg>


                            <Link class="w-full mx-2" :href="route('dashboard')">Tickets generales</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                viewBox="0 0 24 24" stroke="white">
                                <path
                                    d="M6 2c-1.10457 0-2 .89543-2 2v4c0 .55228.44772 1 1 1s1-.44772 1-1V4h12v7h-2c-.5523 0-1 .4477-1 1v2h-1c-.5523 0-1 .4477-1 1s.4477 1 1 1h5c.5523 0 1-.4477 1-1V3.85714C20 2.98529 19.3667 2 18.268 2H6Z" />
                                <path
                                    d="M6 11.5C6 9.567 7.567 8 9.5 8S13 9.567 13 11.5 11.433 15 9.5 15 6 13.433 6 11.5ZM4 20c0-2.2091 1.79086-4 4-4h3c2.2091 0 4 1.7909 4 4 0 1.1046-.8954 2-2 2H6c-1.10457 0-2-.8954-2-2Z" />
                            </svg>

                            <!-- Asegúrate de usar el nombre correcto de la ruta -->
                            <Link class="w-full ml-2" :href="route('incidenciasPorDependencia')">Tickets por area</Link>
                        </li>


                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.583 8.445h.01M10.86 19.71l-6.573-6.63a.993.993 0 0 1 0-1.4l7.329-7.394A.98.98 0 0 1 12.31 4l5.734.007A1.968 1.968 0 0 1 20 5.983v5.5a.992.992 0 0 1-.316.727l-7.44 7.5a.974.974 0 0 1-1.384.001Z" />
                            </svg>


                            <Link class="w-full ml-2" :href="route('dependencias.index')">Tickets por tipo de incidencia
                            </Link>
                        </li>
                    </ul>
                </div>
            </transition>


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
                                    d="m7.4285 11 5-6 5 6m-10 0h-3v8h16v-8h-3m-10 0H3.42851l3-4h4.33739l-3.3374 4Zm10 0V7.5m-3 5.5c0 1.1046-.8954 2-2 2s-2-.8954-2-2 .8954-2 2-2 2 .8954 2 2Zm3-8v3h4V5h-4Z" />
                            </svg>


                            <Link class="w-full mx-2" :href="route('dependencias.create')">Añadir</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 9h6m-6 3h6m-6 3h6M6.996 9h.01m-.01 3h.01m-.01 3h.01M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1Z" />
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
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M3 15v3c0 .5523.44772 1 1 1h4v-4m-5 0v-4m0 4h5m-5-4V6c0-.55228.44772-1 1-1h16c.5523 0 1 .44772 1 1v1.98935M3 11h5v4m9.4708 4.1718-.8696-1.4388-2.8164-.235-2.573-4.2573 1.4873-2.8362 1.4441 2.3893c.3865.6396 1.2183.8447 1.8579.4582.6396-.3866.8447-1.2184.4582-1.858l-1.444-2.38925h3.1353l2.6101 4.27715-1.0713 2.5847.8695 1.4388" />
                            </svg>

                            <Link class="w-full mx-2" :href="route('ticket.create')">Añadir</Link>
                        </li>

                        <li class="px-2 py-1 transition-colors duration-150 flex items-center"
                            v-if="$page.props.user.permissions.includes('Tickets generales')">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="white" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 6h8m-8 6h8m-8 6h8M4 16a2 2 0 1 1 3.321 1.5L4 20h5M4 5l2-1v6m-2 0h4" />
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
