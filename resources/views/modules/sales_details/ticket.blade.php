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
            padding: 0;
            background-color: white;
        }

        .ticket {
            width: 76mm;
            max-width: 76mm;
            margin: 0 auto;
            padding: 3mm 5mm;
            box-sizing: border-box;
        }

        .header {
            text-align: center;
            margin-bottom: 8px;
            padding-bottom: 5px;
            border-bottom: 1px dashed #000;
        }

        .title {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .business-info {
            font-size: 10px;
            margin: 5px 0;
            line-height: 1.3;
        }

        .info {
            margin-bottom: 10px;
            line-height: 1.4;
            padding: 5px 0;
            border-bottom: 1px dashed #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 8px 0;
        }

        th {
            padding: 5px 3px;
            text-align: left;
            border-bottom: 1px dashed #000;
            font-weight: bold;
        }

        td {
            padding: 4px 3px;
            vertical-align: top;
        }

        .text-right {
            text-align: right;
            padding-right: 5px;
            width: 22%;
            font-family: 'Courier New', monospace;
        }

        .text-center {
            text-align: center;
        }

        .product-column {
            width: 34%;
            padding-left: 2px;
        }

        .total {
            font-weight: bold;
            font-size: 14px;
            margin: 10px 0 5px 0;
            padding-top: 5px;
            border-top: 2px solid #000;
            text-align: right;
            font-family: 'Courier New', monospace;
        }

        .footer {
            font-size: 10px;
            text-align: center;
            margin-top: 10px;
            padding-top: 5px;
            border-top: 1px dashed #000;
            line-height: 1.4;
        }

        .barcode {
            margin: 8px auto 5px auto;
            text-align: center;
            font-family: 'Libre Barcode 128', cursive;
            font-size: 28px;
        }

        .qr-code {
            margin: 5px auto;
            text-align: center;
        }

        .monetary {
            font-family: 'Courier New', monospace;
            letter-spacing: 0.5px;
        }

        @media print {
            @page {
                size: 80mm 200mm;
                margin: 0;
                padding: 0;
            }
            
            body {
                width: 76mm;
                padding: 0;
            }
            
            .ticket {
                border: none;
                padding: 3mm 5mm;
            }

            .no-print {
                display: none !important;
            }
        }

        .print-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Barcode+128&display=swap" rel="stylesheet">
</head>

<body>
    <div class="ticket">
        <div class="header">
            <div class="title">Ventas HN</div>
            <div class="business-info">
                Av. Principal 123, Tegucigalpa<br>
                Tel: 2662-2025 | NIT: 1234-567890-123-4<br>
                www.ventashn.com
            </div>
        </div>

        <div class="info">
            <strong>FECHA:</strong> {{ $sale->created_at->format('d/m/Y H:i:s') }}<br>
            <strong>CAJERO:</strong> {{ $sale->user_name }}<br>
            <strong>TICKET #:</strong> {{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}
        </div>

        <table>
            <thead>
                <tr>
                    <th class="product-column">DESCRIPCIÓN</th>
                    <th class="text-right">CANT.</th>
                    <th class="text-right">PRECIO</th>
                    <th class="text-right">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $item)
                    <tr>
                        <td class="product-column">{{ Str::limit($item->product_name, 20) }}</td>
                        <td class="text-right">{{ number_format($item->quantity, 0) }}</td>
                        <td class="text-right monetary">L{{ number_format($item->unit_price, 2) }}</td>
                        <td class="text-right monetary">L{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total monetary">
            TOTAL: L{{ number_format($sale->total, 2) }}
        </div>

        <div class="barcode">
            *{{ str_pad($sale->id, 6, '0', STR_PAD_LEFT) }}*
        </div>

        {{-- <div class="qr-code">
            <!-- Espacio para código QR (implementar con librería como QRious) -->
            <svg width="80" height="80" viewBox="0 0 80 80">
                <rect width="80" height="80" fill="#FFF"/>
                <text x="40" y="45" text-anchor="middle" font-size="10">[CÓDIGO QR]</text>
            </svg>
        </div> --}}

        <div class="footer">
            ¡GRACIAS POR SU COMPRA!<br>
            Productos vendidos no tienen cambio ni devolución<br>
            {{ now()->format('d/m/Y H:i') }}
        </div>
    </div>

    {{-- <button class="print-button no-print" onclick="window.print()">Imprimir Ticket</button>

    <script>
        // Auto-impresión en entorno de producción
        if(window.location.hostname !== 'localhost') {
            window.onload = function() {
                setTimeout(function() {
                    window.print();
                    setTimeout(function() {
                        window.close();
                    }, 500);
                }, 500);
            };
        }
    </script> --}}
</body>

</html>