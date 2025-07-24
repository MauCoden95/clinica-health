<div
    x-data="{
        labels: {{ Js::from(array_keys($turnsBySpecialty->toArray())) }},
        values: {{ Js::from(array_values($turnsBySpecialty->toArray())) }},
        init() {
            const ctx = document.getElementById('specialtyChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Turnos por Especialidad',
                        data: this.values,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }"
    x-init="init()"
    class="w-full h-[300px] bg-white shadow-md rounded-lg p-4"
>
    <canvas id="specialtyChart" class="w-full h-full"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
