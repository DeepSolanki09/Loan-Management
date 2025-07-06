<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
    }

    h1 {
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    select,
    input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    select {
        cursor: pointer;
    }

    button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
        transition: 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    span {
        color: red;
        font-size: 14px;
    }

    /* Style for existing bank logo */
    img {
        display: block;
        margin-top: 10px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    }

    </style>
</head>
<body>
@extends('layouts.app')

@section('content')
<div class="contailner">
<h1>Update Loan</h1>

<form method="POST" action="{{ route('admin.loandetails.update', $loan->loan_id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="bank_name">Bank Name:</label>
        <input type="text" name="bank_name" id="bank_name" class="form-control" value="{{ old('bank_name', $loan->bank_name) }}" required>
        @error('bank_name')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="loan_type">Loan Type:</label>
        <select id="loan_type" name="loan_type" required>
            <option value="Home Loan" {{ $loan->loan_type == 'Home Loan' ? 'selected' : '' }}>Home Loan</option>
            <option value="Car Loan" {{ $loan->loan_type == 'Car Loan' ? 'selected' : '' }}>Car Loan</option>
            <option value="Education Loan" {{ $loan->loan_type == 'Education Loan' ? 'selected' : '' }}>Education Loan</option>
            <option value="Personal Loan" {{ $loan->loan_type == 'Personal Loan' ? 'selected' : '' }}>Personal Loan</option>
        </select>
        @error('loan_type')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="interest_rate">Interest Rate (In %):</label>
        <input type="text" name="interest_rate" id="interest_rate" class="interest_rate" value="{{ old('interest_rate', $loan->interest_rate) }}" required>
        @error('interest_rate')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="loan_tenure">Loan Tenure (In Years):</label>
        <input type="text" name="loan_tenure" id="loan_tenure" class="loan_tenure" value="{{ old('loan_tenure', $loan->loan_tenure) }}" required>
        @error('loan_tenure')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="bank_logo">Bank Logo:</label>
        <input type="file" name="bank_logo" id="bank_logo" class="form-control">
        @if($loan->bank_logo)
            <br>
            <img src="{{ asset('storage/' . $loan->bank_logo) }}" width="100">
        @endif
        @error('bank_logo')
            <span style="color: red;">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update Loan</button>
</form>
</div>
@endsection

</body>
</html>