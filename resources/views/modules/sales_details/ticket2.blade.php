<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket de Compra - VentasHN</title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            font-size: 12px;
            margin: 0;
            padding: 5mm;
        }

        .ticket {
            width: 76mm;
            margin: 0 auto;
            padding: 2mm;
            border: 2px solid #000;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            border-bottom: 1px dashed #000;
            padding-bottom: 5px;
        }

        .title {
            font-size: 14px;
            font-weight: bold;
            margin: 5px 0;
        }

        .business-info {
            font-size: 10px;
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        th,
        td {
            padding: 3px 0;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
            margin-top: 10px;
            border-top: 2px solid #000;
            padding-top: 5px;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 10px;
            border-top: 1px dashed #000;
            padding-top: 5px;
        }

        @media print {
            body {
                padding: 0;
            }

            .ticket {
                border: none;
            }
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="header">
            <div class="title">Ventas HN</div>
            <div class="business-info">
                Dirección: Av. Principal 123<br>
                Tel: 2662-2025<br>
                NIT: 1234-567890-123-4
            </div>
        </div>

        <div class="info">
            <strong>Fecha:</strong> {{ $sale->created_at->format('d/m/Y H:i:s') }}<br>
            <strong>Cajero:</strong> {{ $sale->user_name }}<br>
            <strong>Ticket #:</strong> {{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th class="text-right">Cant.</th>
                    <th class="text-right">Precio</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $item)
                    <tr>
                        <td>{{ Str::limit($item->product_name, 15) }}</td>
                        <td class="text-right">{{ number_format($item->quantity) }}</td>
                        <td class="text-right">L {{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-right">L {{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total text-right">
            TOTAL: L {{ number_format($sale->total, 2) }}
        </div>

        <div class="footer">
            ¡Gracias por su compra!<br>
            Ventas HN<br>
            {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>
</body>

</html>
