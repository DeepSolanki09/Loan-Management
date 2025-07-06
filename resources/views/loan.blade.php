<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans</title>
    
    <!-- Google font -->
    <link href="{{ asset('css/new/google_fonts2') }}" rel="stylesheet">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
        }

        .content-wrapper {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px; /* Increased padding */
            margin-top: 180px;
        }

        h2 {
            font-size: 32px;
            font-weight: bold;
            color: #007BFF;
            text-align: center;
            margin-bottom: 20px;
        }

        .loan-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-content: center;
            margin-top: 30px;
        }

        .card {
            background: #f8f9fa; /* Light gray for contrast */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease-in-out;
            text-align: left;
            /* border-left: 5px solid #007BFF; */
            border: 2px solid rgb(6, 6, 6);
            margin-bottom: 20px;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            display: block;
            margin: 0 auto 10px;
        }

        .card h2 {
            color: #007BFF;
            font-size: 18px;
            text-align: center;
        }

        .card p {
            color: #555;
            font-size: 14px;
            text-align: center;
        }

        .apply-btn {
            display: block;
            text-align: center;
            margin: 10px auto;
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
            width: fit-content;
        }

        .apply-btn:hover {
            background-color: #0056b3;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #555;
            margin-top: 20px;
        }

        .search-filter {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 20px;
        }

        .search-input, .dropdown-filter {
            padding: 10px;
            font-size: 16px;
            border: 2px solid #ccc;
            border-radius: 5px;
            width: 250px;
        }

        .dropdown-filter {
            cursor: pointer;
        }
    </style>
</head>
<body>

@extends('layouts.app')
@section('content')
@include('navbar')

<div class="container">
   <div class="content-wrapper">

  <!-- Search Bar & Dropdown -->
  <h2>Available Loans</h2>
   @if ($loans->isNotEmpty())    
        <div class="search-filter">
            <input type="text" id="searchBank" placeholder="Search by bank name..." class="search-input">
            
            <select id="loanTypeFilter" class="dropdown-filter">
                <option value="">Select Loan Type</option>
                <option value="home loan">Home Loan</option>
                <option value="car loan">Car Loan</option>
                <option value="education loan">Education Loan</option>
                <option value="personal loan">Personal Loan</option>
            </select>
        </div>
    <div id="loanContainer">

        <div class="loan-cards">
            @foreach($loans as $loan)
                <div class="card loan-item"
                    data-bank="{{ strtolower($loan->bank_name) }}"
                    data-type="{{ strtolower($loan->loan_type) }}">
                           
                           <img src="{{ asset('storage/' . $loan->bank_logo) }}">
                           <h2>{{ $loan->loan_type }}</h2>
                           <p>Bank: {{ $loan->bank_name }}</p>
                           <p>Interest Rate: {{ $loan->interest_rate }}% per annum</p>
                           <p>Loan Tenure: Up to {{ $loan->loan_tenure }} years</p>
                           <a href="{{ route('loan.details.show', ['loan_id' => $loan->loan_id]) }}"  class="apply-btn">Know More</a>
                           <!-- <a href="{{ route('loans.create', ['loan_type' => $loan->loan_type, 'bank_name' => $loan->bank_name, 'loan_id' => $loan->loan_id]) }}" class="apply-btn">Apply Now</a> -->
                        </div>
                        @endforeach
                </div>
    @else
        <p class="no-data">No loans available yet...</p>
    @endif
        </div>
                
        <!-- Error Message for No Results -->
        <p id="noResultsMessage" class="no-data" style="display: none;">No matching loans found...</p>
    </div>
    </div>

    @include('footer')
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.getElementById("searchBank");
        const loanTypeFilter = document.getElementById("loanTypeFilter");
        const loanCards = document.querySelectorAll(".loan-item");
        const noResultsMessage = document.getElementById("noResultsMessage");

        function filterLoans() {
            let searchQuery = searchInput.value.trim().toLowerCase();
            let selectedLoanType = loanTypeFilter.value.toLowerCase();
            let hasResults = false;

            loanCards.forEach(card => {
                let bank = card.getAttribute("data-bank");
                let type = card.getAttribute("data-type");

                let bankMatch = !searchQuery || bank.includes(searchQuery);
                let typeMatch = !selectedLoanType || type === selectedLoanType;

                if (bankMatch && typeMatch) {
                    card.style.display = "block";
                    hasResults = true;
                } else {
                    card.style.display = "none";
                }
            });

            // Show/hide error message
            noResultsMessage.style.display = hasResults ? "none" : "block";
        }

        searchInput.addEventListener("input", filterLoans);
        loanTypeFilter.addEventListener("change", filterLoans);
    });
    </script>
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    @endsection
</body>
</html>
