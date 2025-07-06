<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin</title>
    <style> 
        form{
            width: 100%;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 450px;
            text-align: center;
        }
        input, button {
            width: 95%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background: #28a745;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script> 
@endif
<div class="form-container">
    <h2>Register Admin</h2>
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Full Name" required>
        @if ($errors->has('name'))
                  <span style="color: red;">{{ $errors->first('name') }}</span>
        @endif
        <input type="email" name="email" placeholder="Email Address" required>
        @if ($errors->has('email'))
                  <span style="color: red;">{{ $errors->first('email') }}</span>
        @endif
        <input type="text" name="phone_number" placeholder="Phone Number" required>
        @if ($errors->has('phone_number'))
                  <span style="color: red;">{{ $errors->first('phone_number') }}</span>
        @endif
        <input type="password" name="password" placeholder="Password" required>
        @if ($errors->has('password'))
                  <span style="color: red;">{{ $errors->first('password') }}</span>
        @endif
        <input type="password" name="password_confirmation" placeholder="Confirm password" required>
        @if ($errors->has('password_confirmation'))
                  <span style="color: red;">{{ $errors->first('password_confirmation') }}</span>
        @endif
        <input type="file" name="profile_pic" accept="image/*" required>
        @if ($errors->has('profile_pic'))
                  <span style="color: red;">{{ $errors->first('profile_pic') }}</span>
        @endif
        <button type="submit">Create Admin</button>
    </form>
</div>

</body>
</html>
