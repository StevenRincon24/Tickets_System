<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';

// Props
const props = defineProps({
    incidenciasPendientes: Number,
    incidenciasEnProceso: Number,
    incidenciasFinalizadas: Number,
    incidenciasCerradas: Number, // Asumiendo que existe esta propiedad
});

// Inicializa ticketsData con valores predeterminados
const ticketsData = ref({
    totalTickets: 0,
    ticketsPendientes: 0,
    ticketsEnProceso: 0,
    ticketsFinalizados: 0,
});

const createChart = () => {
    const canvas = document.getElementById('ticketsChart');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pendientes', 'En proceso', 'Finalizados'],
                datasets: [
                    {
                        label: 'Tickets',
                        data: [
                            ticketsData.value.ticketsPendientes,
                            ticketsData.value.ticketsEnProceso,
                            ticketsData.value.ticketsFinalizados,
                        ],
                        backgroundColor: ['#FFA500', '#800080', '#32CD32'],
                    },
                ],
            },
        });
    }
};

// Actualiza ticketsData con los valores de los props en onMounted
onMounted(() => {
    ticketsData.value.ticketsPendientes = props.incidenciasPendientes;
    ticketsData.value.ticketsEnProceso = props.incidenciasEnProceso;
    ticketsData.value.ticketsFinalizados = props.incidenciasFinalizadas;
    ticketsData.value.ticketsCerrados = props.incidenciasCerradas;

    createChart();
});
</script>

<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <!-- Título centrado -->
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Dashboard</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>
        <div class="dashboard p-1" v-if="$page.props.user.permissions.includes('ver usuario')">
            <div class="grid grid-cols-4 gap-4">
                <div class="stat-card bg-yellow-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets Pendientes</h2>
                    <p class="text-2xl font-bold">{{ props.incidenciasPendientes }}</p>
                </div>
                <div class="stat-card bg-purple-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets en Proceso</h2>
                    <p class="text-2xl font-bold">{{ props.incidenciasEnProceso }}</p>
                </div>
                <div class="stat-card bg-green-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets Finalizados</h2>
                    <p class="text-2xl font-bold">{{ props.incidenciasFinalizadas }}</p>
                </div>
                <div class="stat-card bg-white shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Total Tickets atendidos</h2>
                    <p class="text-2xl font-bold">{{ Number(props.incidenciasFinalizadas) +
                        Number(props.incidenciasEnProceso) +
                        Number(props.incidenciasPendientes) }}</p>
                </div>
            </div>
            <div class="chart-container mt-6">
                <h2 class="text-lg font-bold">Gráfico de Tickets</h2>
                <canvas id="ticketsChart"></canvas>
            </div>
        </div>
        <!-- Mensaje de permisos insuficientes -->
        <div v-else class="p-4 text-center">
            <p>Usted no tiene permisos para ver este contenido.</p>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
.dashboard {
    max-width: 1200px;
    margin: auto;
}

.stat-card {
    text-align: center;
}

.chart-container {
    max-width: 300px;
    margin: auto;
}
</style>
