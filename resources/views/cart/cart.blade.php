<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <link href=" {{ asset('css\new\bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .table {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        .btn-danger {
            background: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .btn-primary {
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-success {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
@if (session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

@extends('layouts.app')
@section('content')

<div class="container">
    <h2>Your Wishlist</h2>
    @if(count($cartItems) > 0)
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Bank Name</th>
                <th>Loan Type</th>
                <th>Interest Rate</th>
                <th>Tenure</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($cartItems as $item)
            <tr>
                <td>{{ $item->bank_name }}</td>
                <td>{{ $item->loan_type }}</td>
                <td>{{ $item->interest_rate }}%</td>
                <td>{{ $item->loan_tenure }} years</td>
                <td>
                    <div class="action-buttons">
                    <form action="{{ route('application.place') }}" method="POST"  onsubmit="return confirm('Are you sure you want to proceed with this loan application?');">
                        @csrf
                        <input type="hidden" name="loan_id" value="{{ $item->loan_id }}">
                        <button type="submit" class="btn btn-primary">Proceed to Apply</button>
                    </form>
                    <!-- <a href="{{ route('application.place') }}" class="btn btn-primary">Proceed to Apply</a> -->
                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this loan from the wishlist?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/loan" class="btn btn-success">Browse Loans</a>
    @else
    <p>Your wishlist is empty.</p>
    <a href="/loan" class="btn btn-success">Browse Loans</a>
    @endif
</div>

@endsection
</body>
</html>
