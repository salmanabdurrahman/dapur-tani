<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            color: #333;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #16a34a;
        }

        .header p {
            margin: 0;
        }

        .details {
            margin-bottom: 30px;
        }

        .details table {
            width: 100%;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .items-table th,
        .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total {
            text-align: right;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Dapur Tani</h1>
            <p>Platform Pasokan Pangan B2B</p>
        </div>
        <h2>Invoice #{{ $order->order_number }}</h2>
        <div class="details">
            <table>
                <tr>
                    <td style="width: 50%; vertical-align: top;">
                        <strong>Ditagihkan Kepada:</strong><br>
                        {{ $order->buyer->profile->business_name ?? $order->buyer->name }}<br>
                        {{ $order->shipping_address }}<br>
                        {{ $order->buyer->email }}
                    </td>
                    <td style="width: 50%; text-align: right; vertical-align: top;">
                        <strong>Tanggal Invoice:</strong> {{ $order->created_at->format('d F Y') }}<br>
                        <strong>Status:</strong> {{ Str::title(str_replace('_', ' ', $order->status->value)) }}
                    </td>
                </tr>
            </table>
        </div>
        <table class="items-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kuantitas</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }} {{ $item->product->unit ?? '' }}</td>
                        <td>Rp {{ number_format($item->price_per_unit, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->price_per_unit * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="total">
            <p><strong>Subtotal:</strong> Rp
                {{ number_format($order->items->sum(fn($item) => $item->price_per_unit * $item->quantity), 0, ',', '.') }}
            </p>
            <p><strong>Biaya Lainnya:</strong> Rp
                {{ number_format($order->total_amount - $order->items->sum(fn($item) => $item->price_per_unit * $item->quantity), 0, ',', '.') }}
            </p>
            <h3><strong>Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</strong></h3>
        </div>
        <div class="footer">
            <p>Terima kasih telah berbelanja di Dapur Tani!</p>
        </div>
    </div>
</body>

</html>
