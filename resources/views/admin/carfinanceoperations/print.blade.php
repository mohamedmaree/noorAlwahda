<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('admin.receipt_voucher') }}</title>
    {{-- <link rel="stylesheet" href="index.css"> --}}
    <style>
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
}

.container {
    width: 80%;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid black;
    background-color: #fff;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 24px;
    margin-bottom: 20px;
    text-transform: uppercase;
    border: 2px solid black;
    padding: 10px;
}

.receipt-info, .customer-info {
    text-align: right;
}

.details-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

.details-table th, .details-table td {
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}

.amount-section p {
    text-align: right;
    padding: 5px 0;
}

.signature-section {
    margin-top: 20px;
    text-align: left;
}

.signature-line {
    border-bottom: 1px solid black;
    margin-top: 10px;
}

.footer {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
    border: 1px solid black;
    padding: 10px;
}

.footer .contact-info, .footer .address-info {
    text-align: center;
}
    </style>

</head>
<body>
    <div class="container">
        <div class="header">
            <div class="receipt-info">
                <p>{{ __('admin.receipt') }}: #{{ $carfinanceoperations->id }} </p>
                <p>{{ __('admin.date') }}: {{ date('Y-m-d') }}</p>
            </div>
            <h1>{{ __('admin.receipt_voucher') }}</h1>
            <?php $user = $carfinanceoperations->car->user??'';?>
            <div class="customer-info">
                <p>{{ __('admin.customer_name') }}: {{ $user->name??'' }}</p>
                <p>{{ __('admin.phone') }}: {{ $user->full_phone??'' }}</p>
            </div>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th>{{ __('admin.amount') }}</th>
                    <th>{{ __('admin.lot') }}</th>
                    <th>{{ __('admin.vin') }}</th>
                    <th>{{__('admin.details')}}</th>
                    <th>#</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $carfinanceoperations->amount }}</td>
                    <td>{{ $carfinanceoperations->car->lot??'' }}</td>
                    <td>{{ $carfinanceoperations->car->vin??'' }}</td>
                    <td>{{ $carfinanceoperations->priceType->name??''}}</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>

        {{-- <div class="amount-section">
            
            <p>______ AED Total Amount</p>
            <p>Discount</p>
            <p>Total</p>
            <p>Paid Amount</p>
            <p>Remaining Amount</p>
        </div> --}}

        <div class="signature-section">
            <p>{{ __('admin.recipient_signature') }}:</p>
            <div class="signature-line"></div>
        </div>

        <div class="footer">
            <div class="contact-info">
                <p> {{ $settings['country_code'].$settings['phone'] }}</p>
                <p>{{ $settings['email']}} </p>
            </div>
            <div class="address-info">
                <p>{{ $settings['intro_address']}} </p>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            window.print();
        };
    </script>
</body>
</html>