<div
    x-data="{
        labels: ['Activos', 'Inactivos'],
        values: @json(array_values($patientsActive)),
        init() {
            const ctx = document.getElementById('patientsActivityChart').getContext('2d');

            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Pacientes últimos 12 meses',
                        data: this.values,
                        backgroundColor: ['#4ade80', '#f87171'], // verde, rojo
                        borderColor: ['#22c55e', '#ef4444'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        }
    }"
    x-init="init()"
    class="w-full h-[400px] bg-white shadow-md rounded-lg p-4"
>
    <canvas id="patientsActivityChart" class="w-full h-full"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
