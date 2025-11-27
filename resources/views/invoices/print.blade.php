<!DOCTYPE html>
<html>
<head>
    <title>Invoice {{ $invoice->invoice_no }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        .invoice-box {
            width: 100%;
        }

        .header {
            margin-bottom: 20px;
        }

        .info-table, .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table td {
            padding: 6px 0;
        }

        .items-table th, .items-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .items-table th {
            background: #f2f2f2;
        }

        .total-box {
            margin-top: 20px;
            width: 300px;
            float: right;
        }

        .total-box table {
            width: 100%;
            border-collapse: collapse;
        }

        .total-box td {
            padding: 6px 0;
        }

        .qr-box {
            margin-top: 30px;
        }

        .sign-box {
            margin-top: 60px;
            text-align: right;
        }

        .print-btn {
            padding: 10px 16px;
            background: #3490dc;
            color: white;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
        }

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
</head>
<body>

<button class="print-btn" onclick="window.print()">Print Invoice</button>

<div class="invoice-box">

    <h2>Invoice: {{ $invoice->invoice_no }}</h2>

    <table class="info-table">
        <tr>
            <td><strong>Customer:</strong> {{ $invoice->customer->name }}</td>
            <td><strong>Date:</strong> {{ $invoice->invoice_date }}</td>
        </tr>

        <tr>
            <td><strong>Due Date:</strong> {{ $invoice->due_date }}</td>
            <td><strong>Status:</strong> {{ ucfirst($invoice->status) }}</td>
        </tr>
    </table>

    <h3>Items</h3>

    <table class="items-table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Qty</th>
                <th>Unit Price</th>
                <th>Tax %</th>
                <th>Total</th>
            </tr>
        </thead>

        <tbody>
        @foreach($invoice->items as $item)
            <tr>
                <td>{{ $item->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ $item->tax_rate }}%</td>
                <td>₹{{ number_format($item->line_total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <table>
            <tr>
                <td><strong>Subtotal:</strong></td>
                <td>₹{{ number_format($invoice->subtotal, 2) }}</td>
            </tr>

            <tr>
                <td><strong>Tax:</strong></td>
                <td>₹{{ number_format($invoice->tax_total, 2) }}</td>
            </tr>

            <tr>
                <td><strong>Total:</strong></td>
                <td><strong>₹{{ number_format($invoice->total, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    <div style="clear: both;"></div>

    <!-- OPTIONAL QR CODE -->
    <div class="qr-box">
        <p><strong>Scan to Pay:</strong></p>

        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=Invoice{{ $invoice->invoice_no }}" />
    </div>

    <div class="sign-box">
        <p>_________________________</p>
        <p><strong>Authorized Signature</strong></p>
    </div>

</div>

</body>
</html>
