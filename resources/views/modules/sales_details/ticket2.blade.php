<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ticket de compra</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }

        .ticket {
            width: 400px;
            margin: auto;
            padding: 10px;
            border: 1px solid #000;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .detail {
            text-align: left;
            margin-top: 10px;
        }

        .total {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border-bottom: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <p class="title">Ticket de Compra MySales</p>
        <p><strong>Cajero: </strong> {{ $sale->user_name }} </p>
        <p><strong>Fecha: </strong>{{ $sale->created_at }}</p>

        <div class="detail">
            <table border="1">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cant.</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($details as $item)
                        <tr class="text-center">
                            <td class="text-center">{{ $item->product_name }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-center">L {{ $item->unit_price }}</td>
                            <td class="text-center">L {{ $item->subtotal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="total"><strong>Total de venta</strong> L {{ $sale->total }}</p>
        <p>Gracias por su comprar!</p>
    </div>
</body>

</html>
