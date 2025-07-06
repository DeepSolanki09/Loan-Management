<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Profile</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 500px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); */
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Form Styling */
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            font-weight: bold;
            display: block;
            text-align: left;
            width: 100%;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus {
            border-color: #6c5ce7;
            outline: none;
        }

        /* Profile Picture */
        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #6c5ce7;
            margin-bottom: 10px;
            object-fit: cover;
        }

        /* Button Styling */
        .btn {
            width: 100%;
            background: #6c5ce7;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 15px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #5a4bbf;
        }
    </style>
</head>
<body>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        @if($user->profile_pic)
            <img src="{{ asset('storage/' . $user->profile_pic) }}" class="profile-img" alt="Profile Picture">
        @else
            <p>No profile picture uploaded.</p>
        @endif

        <label>Upload New Profile Picture:</label>
        <input type="file" name="profile_pic">
        @if ($errors->has('profile_pic'))
            <span style="color: red;">{{ $errors->first('profile_pic') }}</span>
        @endif

        <!-- Name -->
        <label>Name:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
        @if ($errors->has('name'))
             <span style="color: red;">{{ $errors->first('name') }}</span>
        @endif

        <!-- Email -->
        <label>Email:</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
        @if ($errors->has('email'))
             <span style="color: red;">{{ $errors->first('email') }}</span>
        @endif

        <!-- Phone Number -->
        <label>Phone Number:</label>
        <input type="text" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}" required>
        @if ($errors->has('phone_number'))
             <span style="color: red;">{{ $errors->first('phone_number') }}</span>
        @endif

        <!-- Current Password -->
        <label>Current Password:</label>
        <input type="password" name="current_password" required>
        @if ($errors->has('current_password'))
              <span style="color: red;">{{ $errors->first('current_password') }}</span>
        @endif

        <!-- New Password -->
        <label>New Password (Optional):</label>
        <input type="password" name="password">
        @if ($errors->has('password'))
            <span style="color: red;">{{ $errors->first('password') }}</span>
        @endif

        <!-- Confirm Password -->
        <label>Confirm Password:</label>
        <input type="password" name="password_confirmation">
        @if ($errors->has('password_confirmation'))
             <span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
        @endif

        <button type="submit" class="btn">Update Profile</button>
    </form>
</div>
@endsection
</body>
</html>
