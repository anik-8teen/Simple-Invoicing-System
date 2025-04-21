<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice {{ $invoice_number ?? 'N/A' }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }
        .container {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
        }
        .header, .footer {
            width: 100%;
            text-align: center;
            position: fixed;
        }
        .header { top: 0px; }
        .footer { bottom: 0px; font-size: 10px; color: #777; }
        .invoice-header {
            margin-bottom: 30px;
            overflow: hidden; /* Clear floats */
        }
        .invoice-header .logo {
            float: left;
            max-width: 150px; /* Adjust as needed */
            max-height: 70px; /* Adjust as needed */
        }
        .invoice-header .company-details {
            float: right;
            text-align: right;
        }
        .invoice-details {
            margin-bottom: 30px;
            overflow: hidden; /* Clear floats */
        }
        .invoice-details .bill-to {
            float: left;
            width: 50%;
        }
        .invoice-details .invoice-meta {
            float: right;
            width: 45%;
            text-align: right;
        }
        h1, h2, h3 {
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        h1 { font-size: 24px; color: #000; }
        h2 { font-size: 16px; }
        h3 { font-size: 14px; }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .totals {
            width: 40%;
            float: right;
            margin-top: 20px;
        }
        .totals table {
            width: 100%;
        }
        .totals th, .totals td {
            border: none;
            padding: 5px 8px;
        }
        .totals th { text-align: right; width: 50%; }
        .totals td { text-align: right; }
        .totals .grand-total td, .totals .grand-total th {
            font-weight: bold;
            font-size: 14px;
            border-top: 1px solid #aaa;
            padding-top: 10px;
        }
        .notes {
            margin-top: 30px;
            border-top: 1px solid #eee;
            padding-top: 15px;
            clear: both;
        }
        address { font-style: normal; }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="invoice-header">
            <div style="float: left; width: 50%;">
                 <h1>INVOICE</h1>
            </div>
            <div class="company-details" style="float: right; width: 50%; text-align: right;">
                <h2>{{ $sender_name ?? 'Your Company Name' }}</h2>
                <address>
                    {!! nl2br(e($sender_address ?? 'Your Address')) !!}<br>
                    {{ $sender_phone ?? '' }}<br>
                    {{ $sender_email ?? '' }}
                </address>
            </div>
            <div style="clear: both;"></div>
        </div>

        <!-- Customer and Invoice Meta -->
        <div class="invoice-details">
            <div class="bill-to">
                <h3>Bill To:</h3>
                <strong>{{ $customer_name ?? 'Customer Name' }}</strong><br>
                <address>
                    {!! nl2br(e($customer_address ?? 'Customer Address')) !!}<br>
                     {{ $customer_email ?? '' }}
                </address>
            </div>
            <div class="invoice-meta">
                <table>
                    <tr><th>Invoice #:</th><td>{{ $invoice_number ?? 'N/A' }}</td></tr>
                    <tr><th>Issue Date:</th><td>{{ \Carbon\Carbon::parse($issue_date ?? now())->format('Y-m-d') }}</td></tr>
                    <tr><th>Due Date:</th><td>{{ \Carbon\Carbon::parse($due_date ?? now())->format('Y-m-d') }}</td></tr>
                </table>
            </div>
             <div style="clear: both;"></div>
        </div>

        <!-- Items Table -->
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-right">Unit Price</th>
                    <th class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($items) && count($items) > 0)
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item['description'] ?? '' }}</td>
                            <td class="text-center">{{ number_format($item['quantity'] ?? 0, 2) }}</td>
                            <td class="text-right">{{ number_format($item['unit_price'] ?? 0, 2) }}</td>
                            <td class="text-right">{{ number_format($item['line_total'] ?? 0, 2) }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr><td colspan="4" class="text-center">No items added.</td></tr>
                @endif
            </tbody>
        </table>

        <!-- Totals Section -->
        <div class="totals">
            <table>
                <tr>
                    <th>Subtotal:</th>
                    <td>{{ number_format($subtotal ?? 0, 2) }}</td>
                </tr>
                @if(isset($tax_rate) && $tax_rate > 0)
                <tr>
                    <th>Tax ({{ number_format($tax_rate ?? 0, 2) }}%):</th>
                    <td>{{ number_format($tax_amount ?? 0, 2) }}</td>
                </tr>
                @endif
                <tr class="grand-total">
                    <th>Grand Total:</th>
                    <td>{{ number_format($grand_total ?? 0, 2) }}</td>
                </tr>
            </table>
        </div>
         <div style="clear: both;"></div>

        <!-- Notes -->
        @if(isset($notes) && !empty($notes))
            <div class="notes">
                <h3>Notes:</h3>
                <p>{!! nl2br(e($notes)) !!}</p>
            </div>
        @endif

    </div> <!-- /.container -->
</body>
</html>