@props(['lastSixMonths', 'chartId', 'label', 'backgroundColor', 'borderColor'])

@php
    $colors = collect($lastSixMonths)->map(function($amount) use ($backgroundColor) {
        return $amount > 0 
            ? $backgroundColor  
            : 'rgba(156, 163, 175, 0.4)';
    })->values()->toArray();
@endphp

<div
    x-data="{
        labels: {{ Js::from(array_keys($lastSixMonths)) }},
        values: {{ Js::from(array_values($lastSixMonths)) }},
        colors: {{ Js::from($colors) }},
        init() {
            const ctx = document.getElementById('{{ $chartId }}').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: this.labels,
                    datasets: [{
                        label: '{{ $label }}',
                        data: this.values,
                        backgroundColor: this.colors,
                        borderColor: this.colors.map(c => c.replace('0.7', '1')),
                        borderWidth: 1
                    }]
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
