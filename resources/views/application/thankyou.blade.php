<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Submitted</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .thank-you-container {
            margin-top: 10%;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #28a745;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center">
    <div class="thank-you-container text-center">
        <h2>Thank You for Your Application!</h2>
        <p>Your loan application has been submitted successfully.</p>
        <a href="\loan" class="btn btn-primary mt-3">Browse More Loans</a>
        <a href="{{ route('cart.show') }}" class="btn btn-primary mt-3">Back To Wishlist</a>
    </div>
</div>  
@endsection

</body>
</html>
