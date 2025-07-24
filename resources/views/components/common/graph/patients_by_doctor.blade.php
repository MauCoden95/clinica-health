<div
    x-data="{
        labels: {{ Js::from(array_column($patientsByDoctor->toArray(), 'doctor')) }},
        values: {{ Js::from(array_column($patientsByDoctor->toArray(), 'total_pacientes')) }},
        init() {
            const ctx = document.getElementById('patientsDoctorChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Pacientes únicos por Doctor',
                        data: this.values,
                        backgroundColor: 'rgba(255, 159, 64, 0.7)',
                        borderColor: 'rgba(255, 159, 64, 1)',
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
    class="w-full min-h-[400px] bg-white shadow-md rounded-lg p-4 mt-6"
>
    <canvas id="patientsDoctorChart" class="w-full h-full"></canvas>
</div>
