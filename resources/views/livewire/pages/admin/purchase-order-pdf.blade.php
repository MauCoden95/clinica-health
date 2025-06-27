<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Orden de Compra</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
        }
        .order-info {
            margin-bottom: 20px;
        }
        .order-info h3 {
            margin: 10px 0;
        }
        .order-info p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .total {
            margin-top: 20px;
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Orden de Compra</h1>
        <p>Número de Orden: {{ $purchaseOrder->id }}</p>
    </div>

    <div class="order-info">
        <h3>Información del Proveedor</h3>
        <p><strong>Proveedor:</strong> {{ $supplier->name }}</p>
        <p><strong>Fecha:</strong> {{ $date->format('d/m/Y') }}</p>
        <p><strong>Hora:</strong> {{ $time }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product['product_name'] }}</td>
                <td>{{ $product['quantity'] }}</td>
                <td>${{ number_format($product['unit_price'], 2) }}</td>
                <td>${{ number_format($product['quantity'] * $product['unit_price'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <h3>Total: ${{ number_format($total, 2) }}</h3>
    </div>

    <div class="footer">
        <p>Gracias por su atención</p>
    </div>
</body>
</html>
