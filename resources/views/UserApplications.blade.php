<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=" {{ asset('css\new\bootstrap.min.css') }}" rel="stylesheet">
    <title>User Applications</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
        }

        .content-wrapper {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 1200px;
            width: 100%;
            margin-top: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 5px;
            overflow: hidden;
        }
        
        table, th, td {
            border: 1px solid #ddd;
        }
        
        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background: #007bff;
            color: white;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }
        
        .btn-update {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .no-data {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            color: #555;
            margin-top: 20px;
        }

    </style>
</head>
<body>

@extends('layouts.app')

@section('content')

<div class="content-wrapper">

    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @php
        // Count applications belonging to the logged-in user
        $userApplicationCount = $UserApplications->where('applied_from_account', auth()->user()->name ?? null)->count();
    @endphp

    @if ($userApplicationCount > 0)    
        <table>
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>PHONE NUMBER</th>
                    <th>LOAN TYPE</th>
                    <th>BANK NAME</th>
                    <th>STATUS</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                @foreach($UserApplications as $UserApplication)
                    @if(auth()->check() && auth()->user()->name == $UserApplication->applied_from_account)
                        <tr>
                            <td>{{ $UserApplication->name }}</td>
                            <td>{{ $UserApplication->email }}</td>
                            <td>{{ $UserApplication->phone_number }}</td>
                            <td>{{ $UserApplication->loan_type }}</td>
                            <td>{{ $UserApplication->bank_name }}</td>
                            <td>{{ $UserApplication->status }}</td>
                            <td>
                                <div class="action-buttons">
                                    <!-- <a href="{{ route('applications.edit', $UserApplication->loan_id) }}">
                                        <button class="btn-update">Update</button>
                                    </a> -->
                                    @if ($UserApplication->status == 'pending')
                                        <form action="{{ route('applications.destroy', $UserApplication->loan_id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this application?')">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    @else
    <p class="no-data">No applications has been applied yet...</p>
            <a href="/loan" class="btn btn-success">Browse Loans</a>
    @endif

</div>

@endsection

</body>
</html>
