<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 8px; border: 1px solid #ddd; }
    </style>
</head>

<body>

<h2>Invoice #{{ $invoice->invoice_no }}</h2>

<p><strong>Customer:</strong> {{ $invoice->customer->name }}</p>
<p><strong>Date:</strong> {{ $invoice->invoice_date }}</p>

<table>
    <thead>
        <tr>
            <th>Description</th><th>Qty</th><th>Price</th><th>Tax</th><th>Total</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($invoice->items as $item)
        <tr>
            <td>{{ $item->description }}</td>
            <td>{{ $item->quantity }}</td>
            <td>₹{{ $item->unit_price }}</td>
            <td>{{ $item->tax_rate }}%</td>
            <td>₹{{ $item->line_total }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>Total: ₹{{ $invoice->total }}</h3>

<!-- QR CODE -->
<p>
    {!! QrCode::size(120)->generate('Invoice: '.$invoice->invoice_no) !!}
</p>

<!-- SIGNATURE -->
<h3>Authorized Signature</h3>
<p>__________________________</p>

</body>
</html>
