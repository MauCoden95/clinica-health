<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Financiero - {{ now()->format('d/m/Y') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
        }
        .section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #f4f4f4;
            padding: 8px;
            font-weight: bold;
            border-left: 4px solid #4CAF50;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
            font-weight: bold;
            text-align: center;
        }
        .total {
            font-weight: bold;
            text-align: right;
            margin-top: 10px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .text-green {
            color: #22c55e;
        }
        .text-red {
            color: #ef4444;
        }
        .mb-4 {
            margin-bottom: 1rem;
        }
        .mt-4 {
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Reporte Financiero</h1>
        <p>Generado el: {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- Resumen Financiero -->
    <div class="section">
        <div class="section-title">Resumen Financiero</div>
        <table>
            <tr>
                <th>Concepto</th>
                <th>Monto</th>
            </tr>
            <tr>
                <td>Total Ingresos del Día</td>
                <td class="text-right">${{ number_format($todayIncomes->sum('amount'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Total Egresos del Día</td>
                <td class="text-right">${{ number_format($todayExpenses->sum('amount'), 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Neto del Día</strong></td>
                <td class="text-right"><strong>${{ number_format($todayIncomes->sum('amount') - $todayExpenses->sum('amount'), 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    <!-- Resumen de los últimos 6 meses -->
    <div class="section">
        <div class="section-title">Resumen de los últimos 6 meses</div>
        <table>
            <thead>
                <tr>
                    <th>Mes</th>
                    <th>Ingresos</th>
                    <th>Egresos</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalIngresos = 0;
                    $totalEgresos = 0;
                    $meses = [];
                    
                    // Obtener los últimos 6 meses
                    for ($i = 5; $i >= 0; $i--) {
                        $fecha = Carbon\Carbon::now()->subMonths($i);
                        $meses[] = [
                            'nombre' => $fecha->isoFormat('MMMM YYYY'),
                            'ingresos' => $incomes[$fecha->format('Y-m')] ?? 0,
                            'egresos' => $expenses[$fecha->format('Y-m')] ?? 0
                        ];
                        $totalIngresos += $incomes[$fecha->format('Y-m')] ?? 0;
                        $totalEgresos += $expenses[$fecha->format('Y-m')] ?? 0;
                    }
                @endphp
                
                @foreach($meses as $mes)
                <tr>
                    <td>{{ ucfirst($mes['nombre']) }}</td>
                    <td class="text-right text-green">${{ number_format($mes['ingresos'], 0, ',', '.') }}</td>
                    <td class="text-right text-red">${{ number_format($mes['egresos'], 0, ',', '.') }}</td>
                    <td class="text-right {{ ($mes['ingresos'] - $mes['egresos']) >= 0 ? 'text-green' : 'text-red' }}">
                        ${{ number_format($mes['ingresos'] - $mes['egresos'], 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
                
                <!-- Total -->
                <tr>
                    <td><strong>Total</strong></td>
                    <td class="text-right text-green"><strong>${{ number_format($totalIngresos, 0, ',', '.') }}</strong></td>
                    <td class="text-right text-red"><strong>${{ number_format($totalEgresos, 0, ',', '.') }}</strong></td>
                    <td class="text-right {{ ($totalIngresos - $totalEgresos) >= 0 ? 'text-green' : 'text-red' }}">
                        <strong>${{ number_format($totalIngresos - $totalEgresos, 0, ',', '.') }}</strong>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Detalle de Ingresos del Día -->
    <div class="section">
        <div class="section-title">Ingresos del Día ({{ now()->format('d/m/Y') }})</div>
        @if($todayIncomes->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Método de Pago</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todayIncomes as $income)
                    <tr>
                        <td>{{ $income->description }}</td>
                        <td>{{ $income->paymentMethod->name ?? 'No especificado' }}</td>
                        <td class="text-right">${{ number_format($income->amount, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right"><strong>Total:</strong></td>
                        <td class="text-right"><strong>${{ number_format($todayIncomes->sum('amount'), 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        @else
            <p>No hay ingresos registrados para el día de hoy.</p>
        @endif
    </div>

    <!-- Detalle de Egresos del Día -->
    <div class="section">
        <div class="section-title">Egresos del Día ({{ now()->format('d/m/Y') }})</div>
        @if($todayExpenses->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Método de Pago</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($todayExpenses as $expense)
                    <tr>
                        <td>{{ $expense->description }}</td>
                        <td>{{ $expense->paymentMethod->name ?? 'No especificado' }}</td>
                        <td class="text-right">${{ number_format($expense->amount, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2" class="text-right"><strong>Total:</strong></td>
                        <td class="text-right"><strong>${{ number_format($todayExpenses->sum('amount'), 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        @else
            <p>No hay egresos registrados para el día de hoy.</p>
        @endif
    </div>

    <!-- Métodos de Pago Utilizados -->
    <div class="section">
        <div class="section-title">Métodos de Pago Utilizados</div>
        @if($paymentMethods->isNotEmpty())
            <table>
                <thead>
                    <tr>
                        <th>Método de Pago</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $paymentTotals = [];
                        
                        // Calcular totales por método de pago para ingresos
                        foreach($todayIncomes as $income) {
                            $methodName = $income->paymentMethod->name ?? 'No especificado';
                            if (!isset($paymentTotals[$methodName])) {
                                $paymentTotals[$methodName] = 0;
                            }
                            $paymentTotals[$methodName] += $income->amount;
                        }
                        
                        // Calcular totales por método de pago para egresos
                        foreach($todayExpenses as $expense) {
                            $methodName = $expense->paymentMethod->name ?? 'No especificado';
                            if (!isset($paymentTotals[$methodName])) {
                                $paymentTotals[$methodName] = 0;
                            }
                            $paymentTotals[$methodName] -= $expense->amount;
                        }
                    @endphp
                    
                    @foreach($paymentTotals as $method => $total)
                    <tr>
                        <td>{{ $method }}</td>
                        <td class="text-right {{ $total >= 0 ? 'text-green' : 'text-red' }}">
                            ${{ number_format(abs($total), 0, ',', '.') }}
                            ({{ $total >= 0 ? 'Ingreso' : 'Egreso' }})
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No se han registrado transacciones con métodos de pago.</p>
        @endif
    </div>

    <div class="section">
        <div class="section-title">Métodos de Pago</div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($paymentMethods as $method)
                <tr>
                    <td>{{ $method->name }}</td>
                    <td>{{ $method->description ?? 'Sin descripción' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Facturación por Médico (Mes Actual)</div>
        <table>
            <thead>
                <tr>
                    <th>Médico</th>
                    <th>Total Facturado</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalBilled = 0;
                @endphp
                @foreach($doctors as $doctor)
                    @php
                        $doctorTotal = $incomes->where('doctor_id', $doctor->id)->sum('amount');
                        $totalBilled += $doctorTotal;
                    @endphp
                    @if($doctorTotal > 0)
                    <tr>
                        <td>Dr. {{ $doctor->name }} {{ $doctor->lastname }}</td>
                        <td>${{ number_format($doctorTotal, 2) }}</td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Total Facturado:</th>
                    <th>${{ number_format($totalBilled, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por el sistema de Gestión Clínica</p>
        <p> {{ date('Y') }} - Todos los derechos reservados</p>
    </div>
</body>
</html>
