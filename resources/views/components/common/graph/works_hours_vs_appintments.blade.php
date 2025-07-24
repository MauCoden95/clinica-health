<div>
    @php
    $labels = collect($workHoursVsAppointments)->pluck('doctor')->toArray();
    $workHours = collect($workHoursVsAppointments)->pluck('work_hours')->toArray();
    $appointments = collect($workHoursVsAppointments)->pluck('turns')->toArray();
    @endphp

    <div
        x-data="{
        labels: {{ Js::from($labels) }},
        workHours: {{ Js::from($workHours) }},
        appointments: {{ Js::from($appointments) }},
        init() {
            const ctx = document.getElementById('hoursVsAppointmentsChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Horas trabajadas',
                            data: this.workHours,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Turnos atendidos',
                            data: this.appointments,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
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
        class="w-full h-[400px] bg-white shadow-md rounded-lg p-4 mt-6">
        <canvas id="hoursVsAppointmentsChart" class="w-full h-full"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</div>