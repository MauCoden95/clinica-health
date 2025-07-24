<div
            x-data="{
        chart: null,
        turnsToday: @json($turnsToday),
        turnsWeek: @json($turnsWeek),
        turnsMonth: @json($turnsMonth),
        init() {
            const ctx = document.getElementById('barChart').getContext('2d');

            this.chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Hoy', 'Esta Semana', 'Este Mes'],
                    datasets: [{
                        label: 'Turnos',
                        data: [this.turnsToday, this.turnsWeek, this.turnsMonth],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.7)',
                            'rgba(54, 162, 235, 0.7)',
                            'rgba(75, 192, 192, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }
    }"
            x-init="init()"
            class="w-full h-[300px]">
            <canvas id="barChart" class="w-full h-full"></canvas>
        </div>