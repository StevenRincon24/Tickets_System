<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import Chart from 'chart.js/auto';

const ticketsData = ref({
    totalClientes: 2,
    totalEmpleados: 3,
    totalDepartamentos: 3,
    totalTickets: 3,
    ticketsPendientes: 2,
    ticketsEnProceso: 1,
    ticketsFinalizados: 4,
    ticketsCerrados: 5,
});

const createChart = () => {
    const ctx = document.getElementById('ticketsChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Pendientes', 'En proceso', 'Finalizados', 'Cerrados'],
            datasets: [
                {
                    label: 'Tickets',
                    data: [
                        ticketsData.value.ticketsPendientes,
                        ticketsData.value.ticketsEnProceso,
                        ticketsData.value.ticketsFinalizados,
                        ticketsData.value.ticketsCerrados,
                    ],
                    backgroundColor: ['#FFA500', '#800080', '#32CD32', '#FF0000'],
                },
            ],
        },
    });
};

onMounted(() => {
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
        <div class="dashboard p-1">
            <div class="grid grid-cols-4 gap-4">
                <div class="stat-card bg-white shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Total Clientes</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.totalClientes }}</p>
                </div>
                <div class="stat-card bg-white shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Total Empleados</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.totalEmpleados }}</p>
                </div>
                <div class="stat-card bg-white shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Total Departamentos</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.totalDepartamentos }}</p>
                </div>
                <div class="stat-card bg-white shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Total Tickets</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.totalTickets }}</p>
                </div>
                <div class="stat-card bg-yellow-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets Pendientes</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.ticketsPendientes }}</p>
                </div>
                <div class="stat-card bg-purple-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets en Proceso</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.ticketsEnProceso }}</p>
                </div>
                <div class="stat-card bg-green-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets Finalizados</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.ticketsFinalizados }}</p>
                </div>
                <div class="stat-card bg-red-100 shadow p-4 rounded">
                    <h2 class="text-sm font-semibold">Tickets Cerrados</h2>
                    <p class="text-2xl font-bold">{{ ticketsData.ticketsCerrados }}</p>
                </div>
            </div>

            <div class="chart-container mt-6">
                <h2 class="text-lg font-bold">Gráfico de Tickets</h2>
                <canvas id="ticketsChart"></canvas>
            </div>
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
    max-width: 600px;
    margin: auto;
}
</style>
