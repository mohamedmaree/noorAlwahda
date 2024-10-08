<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('admin.invoice') }}</title>
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
.logo{
    display: flex;
    justify-content: center;
    align-items: center;
    margin: auto;
}
.logo img{
    max-height: 100px;
}
</style>

</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ $settings['logo'] }}" alt="">
        </div>
        <div class="header">
            <div class="receipt-info">
                <p>{{ __('admin.invoice') }}: #{{ $user->id }} </p>
                <p>{{ __('admin.date') }}: {{ date('Y-m-d') }}</p>
            </div>
            <h1>{{ __('admin.invoice') }}</h1>
            <div class="customer-info">
                <p>{{ __('admin.customer_name') }}: {{ $user->name??'' }}</p>
                <p>{{ __('admin.phone') }}: {{ $user->full_phone??'' }}</p>
            </div>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{ __('admin.lot') }}</th>
                    <th>{{ __('admin.vin') }}</th>
                    <th>{{__('admin.pricetype')}}</th>
                    <th>{{__('admin.required_amount')}}</th>
                    <th>{{__('admin.paid_amount')}}</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $total_required = 0;
                    $total_paid = 0;
                ?>
                @forelse($user->carFinance() as $key => $carfinance)
                <tr class="delete_row">
                    <td class="text-center">
                        {{ $key + 1 }}
                    </td>

                    <td>{{ $carfinance->car->lot??'' }}</td>
                    <td>{{ $carfinance->car->vin??'' }}</td>
                    <td>{{ $carfinance->priceType->name??'' }}</td>
                    <td>{{ $carfinance->required_amount }}</td>
                    <td>{{ $carfinance->paid_amount }}</td>
                    
                </tr>
                <?php 
                    $total_required += str_replace(',','',$carfinance->required_amount); 
                    $total_paid +=str_replace(',','',$carfinance->paid_amount); 
                ?>
            @empty
            @endforelse
            </tbody>
        </table>

        <div class="amount-section">
            <p>{{ __('admin.total') }}: {{ $total_required }}</p>
            <p>{{ __('admin.paid_amount') }}: {{ $total_paid }}</p>
            <p>{{ __('admin.remaining_amount') }}:{{ number_format($total_required - $total_paid) }}</p>
        </div>

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