@props(['months', 'incomes', 'expenses', 'chartId'])

<div
    x-data="{
        labels: {{ Js::from($months) }},
        incomeValues: {{ Js::from($incomes) }},
        expenseValues: {{ Js::from($expenses) }},
        init() {
            const ctx = document.getElementById('{{ $chartId }}').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: 'Ingresos',
                            data: this.incomeValues,
                            backgroundColor: 'rgba(34, 197, 94, 0.7)', // verde
                            borderColor: 'rgba(34, 197, 94, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Gastos',
                            data: this.expenseValues,
                            backgroundColor: 'rgba(239, 68, 68, 0.7)', // rojo
                            borderColor: 'rgba(239, 68, 68, 1)',
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
                            ticks: {
                                callback: value => '$' + value.toLocaleString()
                            }
                        }
                    },
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: context => '$' + context.raw.toLocaleString()
                            }
                        }
                    }
                }
            });
        }
    }"
    x-init="init()"
    class="w-full px-14 h-[300px] bg-white shadow-md rounded-lg p-4 my-10"
>
    <canvas id="{{ $chartId }}" class="w-full h-full"></canvas>
</div>
