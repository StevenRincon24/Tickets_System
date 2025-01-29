<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, watch } from 'vue';
import Chart from 'chart.js/auto';

// Props
const props = defineProps({
    incidencias: Object,
});

// Inicializa el estado para los datos del gráfico
const chartData = ref({
    labels: [],
    datasets: [],
});

// Función para generar colores aleatorios
const generateRandomColors = (count) => {
    const colors = [];
    for (let i = 0; i < count; i++) {
        const randomColor = `#${Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0')}`;
        colors.push(randomColor);
    }
    return colors;
};

// Configura los datos del gráfico basado en `props.incidencias.data`
const updateChartData = () => {
    const labels = props.incidencias.data.map(incidencia => incidencia.dependencia);

    const totalFinalizadas = props.incidencias.data.map(incidencia => incidencia.total_finalizadas);
    const totalEnProceso = props.incidencias.data.map(incidencia => incidencia.total_en_proceso);
    const totalPendientes = props.incidencias.data.map(incidencia => incidencia.total_pendientes);

    const colors = generateRandomColors(4); // Un color para cada conjunto de datos

    chartData.value = {
        labels,
        datasets: [

            {
                label: 'Finalizadas',
                data: totalFinalizadas,
                backgroundColor: colors[1],
            },
            {
                label: 'En Proceso',
                data: totalEnProceso,
                backgroundColor: colors[2],
            },
            {
                label: 'Pendientes',
                data: totalPendientes,
                backgroundColor: colors[3],
            },
        ],
    };

    createChart();
};

// Crea el gráfico
const createChart = () => {
    const ctx = document.getElementById('ticketsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: chartData.value,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true,
                },
                y: {
                    beginAtZero: true,
                    stacked: true,
                },
            },
        },
    });
};

onMounted(() => {
    if (props.incidencias?.data?.length) {
        updateChartData();
    }
});

watch(() => props.incidencias, () => {
    if (props.incidencias?.data?.length) {
        updateChartData();
    }
});
</script>



<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="text-center w-full mb-4">
                <h1 class="font-semibold mb-5">Dashboard</h1>
                <hr class="my-2 border-t-1 border-gray-900 w-full mx-auto" />
            </div>
        </template>

        <div class="dashboard p-1">
            <div class="grid grid-cols-4 gap-4">
                <div class="stat-card bg-white shadow p-4 rounded col-span-4">
                    <h2 class="text-lg font-semibold">Gráfico de Incidencias por Dependencia</h2>
                    <div class="chart-container">
                        <canvas id="ticketsChart"></canvas>
                    </div>
                </div>
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

.table-container {
    max-width: 100%;
    margin: auto;
}

.table-container table {
    width: 100%;
    border-collapse: collapse;
}

.table-container th,
.table-container td {
    border: 1px solid #ddd;
    padding: 8px;
}

.table-container th {
    background-color: #f2f2f2;
    text-align: left;
}

.chart-container {
    position: relative;
    height: 400px;
    width: 100%;
    margin: auto;
}

.chart-container canvas {
    width: 100% !important;
    height: 100% !important;
}
</style>
