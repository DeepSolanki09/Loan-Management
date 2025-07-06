<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <style>
      /* Global Styles */
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        color: #333;
        margin: 0;
        padding: 0;
      }

      /* Container to center the content */
      .container {
        max-width: 900px;
        padding: 30px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        margin-bottom: 50px;
        transition: box-shadow 0.3s ease-in-out;
      }

      .container:hover {
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
      }

      /* Heading style */
      h1 {
        font-size: 2.5rem;
        color: #333;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 30px;
      }

      /* Input group */
      .input-group {
        margin-bottom: 1.5rem;
      }

      .input-group-prepend {
        background-color: #6c5ce7;
        border: none;
        color: white;
        font-weight: 500;
      }

      .input-group-text {
        background: linear-gradient(145deg, #6c5ce7, #5a4bbf);
        border: none;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
      }

      .form-control {
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
      }

      .form-control:focus {
        border-color: #6c5ce7;
        box-shadow: 0 0 8px rgba(108, 92, 231, 0.4);
      }

      /* Profile image container (Right side) */
      .profile-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 10px;
      }

      .profile-img-container img {
        width: 120px; /* Increased size */
        height: 120px; /* Increased size */
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }

      /* Custom padding and margin adjustments */
      .row {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .col-md-8 {
        padding-right: 20px;
      }

      .col-md-4 {
        padding-left: 20px;
      }

      .input-group:hover {
          background: linear-gradient(145deg, #5a4bbf, #6c5ce7);
          transform: translateY(-3px); /* Slight lift effect */
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
	  	}
      .btn {
        background: linear-gradient(145deg, #6c5ce7, #5a4bbf);
        border: none;
        color: white;
        font-weight: bold;
        text-transform: uppercase;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-self: self-between;
        margin-right:20px;
        }

		/* Hover Effect */
		.btn:hover {
		background: linear-gradient(145deg, #5a4bbf, #6c5ce7);
		transform: translateY(-3px); /* Slight lift effect */
		box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
		}

		/* Focus Effect */
		.btn:focus {
		outline: none;
		box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.4); /* Light blue glow */
		}

      /* Responsive Styles */
    </style>
</head>
<body>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
    @extends('layouts.app')
    @section('content')
    <form class="form-group">
  <div class="container">
    <h1 class="my-5 text-center">Welcome, {{ $user->name }}!</h1>
    <div class="row">
      <!-- User Details Section (Left Side) -->
      <div class="col-md-8">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
          </div>
          <input type="text" value="{{ $user->name }}" class="form-control bg-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
          </div>
          <input type="text" value="{{ $user->email }}" class="form-control bg-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Phone Number</span>
          </div>
          <input type="text" value="{{ $user->phone_number }}" class="form-control bg-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroup-sizing-default">Password</span>
          </div>
          <input type="text" value="**************************************" class="form-control bg-light" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" readonly>
        </div>
      </div>
      <!-- Profile Picture Section (Right Side) -->
      <div class="col-md-4 text-center">
        <div class="profile-img-container">
          <img src="{{ asset('storage/' . $user->profile_pic) }}" class="img-fluid rounded-circle" alt="" style="width: 120px; height: 120px; object-fit: cover;">
        </div>
      </div>
    </div>
        <button style="border:none"><a href="/UserApplications" class="btn">Applied Applications</a></button>
        <button style="border:none"><a href="{{ route('edit') }}" class="btn">Edit Profile</a></button>
        <button style="border:none"><a href="{{ route('logout') }}" class="btn">logout</a></button>
        <button style="border:none"><a href="{{ route('cart.show') }}" class="btn">My Wishlist</a></button>
        <!-- <a href="{{ route('logout') }}" class="hr-btn login"><button class = "btn-danger">Logout</button></a> -->
      </div>
  </div>
</form>
 @endsection
    <script src="{{ asset('js\bootstrap.min.js') }}"></script>
</body>
</html>




