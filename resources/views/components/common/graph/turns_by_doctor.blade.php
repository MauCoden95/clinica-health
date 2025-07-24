<div
    x-data="{
        labels: {{ Js::from(array_keys($turnsByDoctor->toArray())) }},
        values: {{ Js::from(array_values($turnsByDoctor->toArray())) }},
        init() {
            const ctx = document.getElementById('doctorChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Turnos por Doctor',
                        data: this.values,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
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
    class="w-full h-[300px] bg-white shadow-md rounded-lg p-4 mt-6"
>
    <canvas id="doctorChart" class="w-full h-full"></canvas>
</div>
