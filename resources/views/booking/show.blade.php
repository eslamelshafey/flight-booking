@extends('layouts.app')

@section('styles')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header h1 {
            margin: 0;
        }
        .invoice-details {
            margin-bottom: 20px;
        }
        .invoice-footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
@endsection
@section('content')
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Booking Invoice</h1>
            <p>Flight Booking Confirmation</p>
        </div>

        <div class="invoice-details">
            <h3>Booking Details:</h3>
            <p><strong>Name:</strong> {{ $booking['name'] }}</p>
            <p><strong>Email:</strong> {{ $booking['email'] }}</p>
            <p><strong>Phone Number:</strong> {{ $booking['phone'] }}</p>
            <p><strong>Flight:</strong> {{ $booking['flight']['departure_city'] }} to {{ $booking['flight']['arrival_city'] }}</p>
            <p><strong>Travel Date:</strong> {{ $booking['flight']['travel_date'] }}</p>
            <p><strong>Booked Seats:</strong> {{ $booking['booked_seats'] }}</p>
        </div>

        <div class="invoice-footer">
            <p>Thank you for booking with us!</p>
            <button class="btn btn-primary" onclick="printInvoice()">Print Invoice</button>
        </div>
    </div>
@endsection

@section('scripts')

<script>

    window.addEventListener('load', function() {
        window.printInvoice = function() {
            document.querySelector('nav').style.cssText = 'display:none';
            
            window.print()

            setTimeout(() => {
                document.querySelector('nav').style.cssText = 'display:block';
            }, 10);
        }

    })

</script>

@endsection