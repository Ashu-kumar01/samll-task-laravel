<!DOCTYPE html>
<html>

<head>

    <style>
        body {
            font-family: DejaVu Sans;
            font-size: 13px;
        }

        .header {
            text-align: center;
        }

        .company {
            font-size: 24px;
            font-weight: bold;
        }

        .invoice-info {
            margin-top: 20px;
        }

        .customer {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: #343a40;
            color: white;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 8px;
        }

        .total-table {
            width: 40%;
            float: right;
            margin-top: 20px;
        }

        .footer {
            margin-top: 80px;
            text-align: right;
        }
    </style>

</head>

<body>

    <div class="header">

        <div class="company">
            ABC TECHNOLOGIES
        </div>

        GST : 22AAAAA0000A1Z5

    </div>

    <div class="invoice-info">

        Invoice :
        {{ $invoice['invoice_no'] }}

        <br>

        Date :
        {{ $invoice['date'] }}

    </div>

    <div class="customer">

        <h3>Customer Details</h3>

        <b>Name :</b>
        {{ $invoice['customer']['name'] }}

        <br>

        <b>Email :</b>
        {{ $invoice['customer']['email'] }}

        <br>

        <b>Phone :</b>
        {{ $invoice['customer']['phone'] }}

    </div>

    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>Product</th>

                <th>Qty</th>

                <th>Price</th>

                <th>GST</th>

                <th>Total</th>

            </tr>

        </thead>

        <tbody>

            @php
                $subtotal = 0;
            @endphp

            @foreach ($invoice['products'] as $key => $item)
                @php

                    $total = $item['qty'] * $item['price'];

                    $subtotal += $total;

                @endphp

                <tr>

                    <td>{{ $key + 1 }}</td>

                    <td>{{ $item['name'] }}</td>

                    <td>{{ $item['qty'] }}</td>

                    <td>{{ $item['price'] }}</td>

                    <td>{{ $item['gst'] }}%</td>

                    <td>{{ $total }}</td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <table class="total-table">

        <tr>

            <td>Subtotal</td>

            <td>{{ $subtotal }}</td>

        </tr>

        <tr>

            <td>GST</td>

            <td>{{ ($subtotal * 18) / 100 }}</td>

        </tr>

        <tr>

            <td><b>Grand Total</b></td>

            <td>

                <b>

                    {{ $subtotal + ($subtotal * 18) / 100 }}

                </b>

            </td>

        </tr>

    </table>

    <div class="footer">

        Authorized Signature

    </div>

</body>

</html>
