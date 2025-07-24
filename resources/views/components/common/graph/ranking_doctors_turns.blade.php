@php
    $rankingLabels = $rankingDoctors ? $rankingDoctors->pluck('name')->toArray() : [];
    $rankingValues = $rankingDoctors ? $rankingDoctors->pluck('turns_count')->toArray() : [];
@endphp
<div
    x-data="{
        labels: {{ Js::from($rankingLabels) }},
        values: {{ Js::from($rankingValues) }},
        init() {
            const ctx = document.getElementById('rankingChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: 'Top 3 Médicos por Turnos',
                        data: this.values,
                        backgroundColor: ['#FFD700', '#C0C0C0', '#CD7F32'], // Oro, Plata, Bronce
                        borderColor: '#333',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { precision: 0 }
                        }
                    }
                }
            });
        }
    }"
    x-init="init()"
    class="w-full h-[400px] bg-white shadow-md rounded-lg p-4 mt-6"
>
    <canvas id="rankingChart" class="w-full h-full"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
