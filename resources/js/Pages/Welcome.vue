<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { Code2, Database, Server, Mail, Phone, MapPin, LogIn, UserPlus } from 'lucide-vue-next';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>

    <Head title="Mesa de Ayuda - Alcaldía de Nobsa" />
    <div class="min-h-screen bg-gray-50">
        <!-- Header -->
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3 bg-red-600 text-white">
            <div class="flex lg:col-start-2 ">
                <img src="https://i.postimg.cc/pr1mFYdR/Logo.png" alt="Logo Nobsa" class="h-12 rounded-full" />
                <h1 class="text-2xl font-bold">Alcaldía de Nobsa</h1>
            </div>
            <nav v-if="canLogin" class="-mx-3 flex flex-1 justify-center">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="rounded-md px-3 py-2 text-white  ">
                Dashboard
                </Link>

                <template v-else>
                    <Link :href="route('login')" class="rounded-md px-3 py-2 text-white flex items-center space-x-2">
                    <LogIn class="h-5 w-5" />
                    <span>Iniciar sesión</span>
                    </Link>
                    <!--
                    BOTON PARA REGISTRARSE NO USAR
                    <Link v-if="canRegister" :href="route('register')"
                        class="rounded-md px-3 py-2 text-white flex items-center space-x-2">
                    <UserPlus class="h-5 w-5" />
                    <span>Registrarse</span>
                    </Link> -->
                </template>
            </nav>
        </header>



        <!-- Hero Section -->
        <div class=" text-black py-16 text-center">
            <h2 class="text-4xl font-bold mb-4">Mesa de Ayuda</h2>
            <p class="text-xl text-black max-w-2xl mx-auto">
                Bienvenido al sistema de soporte técnico de la Alcaldía de Nobsa. Estamos aquí para ayudarte
                con todas
                tus
                necesidades tecnológicas.
            </p>
        </div>

        <!-- Services Section -->
        <div class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <h3 class="text-2xl font-bold text-center mb-12">Nuestros Servicios</h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition bg-white">
                        <component :is="Code2" class="w-8 h-8 text-blue-600 mb-4" />
                        <h4 class="text-xl font-semibold mb-2">Desarrollo Web</h4>
                        <p class="text-gray-600"> Desarrollo de aplicaciones web con tecnologías modernas.
                        </p>
                    </div>

                    <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition bg-white">
                        <component :is="Code2" class="w-8 h-8 text-blue-600 mb-4" />
                        <h4 class="text-xl font-semibold mb-2">Desarrollo Web</h4>
                        <p class="text-gray-600"> Desarrollo de aplicaciones web con tecnologías modernas.
                        </p>
                    </div>

                    <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition bg-white">
                        <component :is="Code2" class="w-8 h-8 text-blue-600 mb-4" />
                        <h4 class="text-xl font-semibold mb-2">Desarrollo Web</h4>
                        <p class="text-gray-600"> Desarrollo de aplicaciones web con tecnologías modernas.
                        </p>
                    </div>

                    <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition bg-white">
                        <component :is="Code2" class="w-8 h-8 text-blue-600 mb-4" />
                        <h4 class="text-xl font-semibold mb-2">Desarrollo Web</h4>
                        <p class="text-gray-600"> Desarrollo de aplicaciones web con tecnologías modernas.
                        </p>
                    </div>

                    <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition bg-white">
                        <component :is="Code2" class="w-8 h-8 text-blue-600 mb-4" />
                        <h4 class="text-xl font-semibold mb-2">Desarrollo Web</h4>
                        <p class="text-gray-600"> Desarrollo de aplicaciones web con tecnologías modernas.
                        </p>
                    </div>

                    <div class="p-6 border rounded-lg shadow-sm hover:shadow-md transition bg-white">
                        <component :is="Code2" class="w-8 h-8 text-blue-600 mb-4" />
                        <h4 class="text-xl font-semibold mb-2">Desarrollo Web</h4>
                        <p class="text-gray-600"> Desarrollo de aplicaciones web con tecnologías modernas.
                        </p>
                    </div>


                </div>
            </div>
        </div>

        <!-- Contact Section -->
        <div class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">
                <h3 class="text-2xl font-bold text-center mb-12">Información de Contacto</h3>
                <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">

                    <div class="flex flex-col items-center text-center">
                        <component :is="Mail" class="w-6 h-6 text-blue-600 mb-2" />
                        <h4 class="font-semibold mb-1">Correo electrónico</h4>
                        <p class="text-gray-600">ticygobiernodigital@nobsa-boyaca.gov.co</p>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <component :is="Phone" class="w-6 h-6 text-blue-600 mb-2" />
                        <h4 class="font-semibold mb-1">Telefono</h4>
                        <p class="text-gray-600">(608) 7773271</p>
                    </div>

                    <div class="flex flex-col items-center text-center">
                        <component :is="MapPin" class="w-6 h-6 text-blue-600 mb-2" />
                        <h4 class="font-semibold mb-1">Dirección</h4>
                        <p class="text-gray-600">Carrera 9 N° 4-40, Nobsa, Boyacá</p>
                    </div>


                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-blue-900 text-white py-8 text-center">
            <p>© 2024 Alcaldía de Nobsa. Todos los derechos reservados.</p>
            <p>Oficina de las TIC y Gobierno Digital</p>
        </footer>
    </div>
</template>
