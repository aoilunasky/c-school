<!DOCTYPE html>
<html lang="en">

<head>
    <title>Document</title>
    <style>
        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .text-center {
            text-align: center !important;
        }

        .text-start {
            text-align: left !important;
        }

        .text-end {
            text-align: right !important;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            vertical-align: top;
            border-color: #dee2e6;
            border-spacing: 0;
        }

        th {
            display: table-cell;
            vertical-align: inherit;
            font-weight: bold;
        }

        table,
        th,
        td {
            border: 0.2px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 0.5rem 0.5rem;
        }

        .bg-light {
            background-color: #e5e7e8 !important;
        }
        .text-decoration-underline {
            text-decoration: underline !important
        }
        .fst-italic {
            font-style: italic !important
        }
        h3,h4,h5{
            line-height: 0.2;
        }
    </style>
</head>
<body>
    <img src="{{ public_path().'/logo.png'}}" class="img-fluid">
    <h3 class="text-center">Invoice</h3>
    <h4 class="text-start">To {{ $data['studentName']}} </h4>
    <h5 class="text-end">Date: {{ $data['date']}} </h5>
    <h5 class="text-end">Invoice No:: {{ $data['invoiceNo']}}</h5>
    <table class="table table-bordered">
        <thead>
            <tr class="bg-light text-center">
                <th>Description</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data['packageName'] }}</td>
                <td class="text-end">{{ ($data['amount'] * 100 ) / (100 +$data['tax'] )}} USD</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Tax {{ $data['tax'] }}%</td>
                <td class="text-end">{{ $data['amount'] - ($data['amount'] * 100 ) / (100 +$data['tax'] )}} USD</td>
            </tr>
            <tr>
                <td class="bg-light text-end">Subtotal</td>
                <td class="text-end">{{ $data['amount']}} USD</td>
            </tr>
            <tr>
                <td class="bg-light text-end">Total</td>
                <td class="text-end">{{ $data['amount']}} USD</td>
            </tr>
        </tbody>
    </table>
    <h4>Payment can be made by Cash Only</h4>
    <h4 class="text-end  text-decoration-underline ">Suzuki Kei</h4>
    <h5 class="text-end">Authorized Person</h5>
    <h4 class="fst-italic text-end">C-MEISTER MYANMAR LTD</h4>
    <h5 class="text-end">Reg No. 114546445</h5>
    <h5 class="fst-italic text-end">* This is a computer generated Quotation and requires no signature.</h5>
</body>

</html>