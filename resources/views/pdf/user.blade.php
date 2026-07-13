<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Restaurant Invoice</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans;
            font-size: 12px;
            color: #333;
            padding: 25px;
        }

        .invoice-box {
            border: 1px solid #ccc;
            padding: 20px;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 28px;
        }

        .header p {
            margin-top: 5px;
        }

        .section-title {
            background: #222;
            color: #fff;
            padding: 6px 10px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td,
        table th {
            border: 1px solid #bbb;
            padding: 8px;
        }

        table th {
            background: #f2f2f2;
        }

        .details td:first-child {
            width: 180px;
            font-weight: bold;
            background: #fafafa;
        }

        .summary {
            width: 40%;
            margin-left: auto;
            margin-top: 20px;
        }

        .summary td:first-child {
            font-weight: bold;
        }

        .notes {
            margin-top: 25px;
        }

        .signature {
            margin-top: 70px;
            text-align: right;
        }

        .signature hr {
            width: 180px;
            margin-left: auto;
        }
    </style>

</head>

<body>

    <div class="invoice-box">

        <div class="header">
            <h1>{{ $invoices->restaurant_name }}</h1>
            <p>Phone : {{ $invoices->mobile_nu }}</p>
        </div>

        <!-- Restaurant Details -->
        <div class="section-title">Restaurant Details</div>

        <table class="details">
            <tr>
                <td>Name</td>
                <td>{{ $invoices->restaurant_name }}</td>
            </tr>

            <tr>
                <td>Phone</td>
                <td>{{ $invoices->mobile_nu }}</td>
            </tr>
        </table>

        <!-- Invoice Details -->

        <div class="section-title">Invoice Details</div>

        <table class="details">
            <tr>
                <td>Invoice No.</td>
                <td>{{ $invoices->invoice_no }}</td>
            </tr>

            <tr>
                <td>Date</td>
                <td>{{ $invoices->date }}</td>
            </tr>

            <tr>
                <td>Customer Name</td>
                <td>{{ $invoices->name }}</td>
            </tr>
        </table>

        <!-- Order Items -->

        <div class="section-title">Order Items</div>

        <table>

            <thead>

                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                </tr>

            </thead>

            <tbody>

                @php
                    $subtotal = 0;
                @endphp

                @foreach ($invoices->items as $index => $item)
                    @php
                        $price = $invoices->price[$index];
                        $qty = $invoices->qty[$index];
                        $total = $price * $qty;
                        $subtotal += $total;
                    @endphp

                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item }}</td>
                        <td>₹ {{ number_format($price, 2) }}</td>
                        <td>{{ $qty }}</td>
                        <td>₹ {{ number_format($total, 2) }}</td>
                    </tr>
                @endforeach

            </tbody>

        </table>

        @php
            $gst = $invoices->gst ?? 5;
            $discount = $invoices->discount ?? 0;

            $gstAmount = ($subtotal * $gst) / 100;

            $grandTotal = $subtotal + $gstAmount - $discount;
        @endphp

        <table class="summary">

            <tr>
                <td>Subtotal</td>
                <td>₹ {{ number_format($subtotal, 2) }}</td>
            </tr>

            <tr>
                <td>GST ({{ $gst }}%)</td>
                <td>₹ {{ number_format($gstAmount, 2) }}</td>
            </tr>

            <tr>
                <td>Discount</td>
                <td>₹ {{ number_format($discount, 2) }}</td>
            </tr>

            <tr>
                <td><strong>Grand Total</strong></td>
                <td><strong>₹ {{ number_format($grandTotal, 2) }}</strong></td>
            </tr>

        </table>

        <div class="notes">

            <div class="section-title">Notes</div>

            <p>{{ $invoices->notes ?? 'Thank you for visiting...' }}</p>

        </div>

        <div class="signature">

            <hr>

            Authorized Signature

        </div>

    </div>

</body>

</html>
