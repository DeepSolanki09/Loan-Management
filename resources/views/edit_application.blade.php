<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update_application</title>
    <style>
        /* Center the form */
h2 {
    text-align: center;
    font-family: Arial, sans-serif;
    color: #333;
}

form {
    width: 50%;
    margin: 0 auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style labels */
label {
    font-weight: bold;
    font-family: Arial, sans-serif;
    display: block;
    margin-bottom: 5px;
    color: #555;
}

/* Style inputs */
input {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Readonly fields */
input[readonly] {
    background-color: #e9ecef;
    cursor: not-allowed;
}

/* Style the update button */
button {
    width: 100%;
    background: #28a745;
    color: white;
    font-size: 16px;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button:hover {
    background: #218838;
}

/* Responsive design */
@media (max-width: 768px) {
    form {
        width: 80%;
    }
}

@media (max-width: 480px) {
    form {
        width: 95%;
    }
}

    </style>
</head>
<body>    
        @extends('layouts.app')
        
        @section('content')
        
        <h2>Update Loan Application</h2>
        
        <form action="{{ route('applications.update', $UserApplication->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $UserApplication->name }}" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ $UserApplication->email }}" required><br><br>
            
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="{{ $UserApplication->phone_number }}" required><br><br>
        
        <label for="loan_type">Loan Type:</label>
        <input type="text" id="loan_type" name="loan_type" value="{{ $UserApplication->loan_type }}" readonly><br><br>
        
        <label for="bank_name">Bank Name:</label>
        <input type="text" id="bank_name" name="bank_name" value="{{ $UserApplication->bank_name }}" readonly><br><br>
        
        <button type="submit">Update</button>
    </form>

    @endsection
</body>
</html>
