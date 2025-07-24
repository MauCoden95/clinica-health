<div
    x-data="{
        labels: ['Últimas 24h', 'Últimos 7 días', 'Últimos 30 días'],
        values: {{ Js::from(array_values($newPatients)) }},
        init() {
            const ctx = document.getElementById('newPatientsChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar', // o 'bar' con 'indexAxis: y' para barras horizontales
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Nuevos pacientes',
                        data: this.values,
                        backgroundColor: 'rgba(37, 99, 235, 0.7)', // azul
                        borderColor: 'rgba(37, 99, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // barras horizontales, quitá esta línea si querés vertical
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }
                }
            });
        }
    }"
    x-init="init()"
    class="w-full h-[300px] bg-white shadow-md rounded-lg p-4 mt-6"
>
    <canvas id="newPatientsChart" class="w-full h-full"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
