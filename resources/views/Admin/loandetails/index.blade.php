@extends('layouts.app') 

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loans</title>
    <style>
        /* Overall Styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        /* Centering Content */
        .content-container {
            display: flex;
            justify-content: center;
            height: 75vh;
        }

        /* Card Container */
        .card {
            background: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 25px;
            width: 100%;
            max-width: 1100px;
            text-align: center;
        }

        /* Table Styling */
        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #343a40;
            color: white;
            font-weight: bold;
            padding: 14px;
        }

        td {
            padding: 12px;
            background: #f8f9fa;
        }

        /* Buttons Container */
        .btn-group {
            display: flex;
            gap: 8px; /* Space between buttons */
        }

        /* Update Button */
        .btn-update {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-update:hover {
            background-color: #218838;
        }

        /* Delete Button */
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

        /* Primary Button */
        .btn-primary {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Responsive Table */
        @media (max-width: 768px) {
            .card {
                width: 95%;
                padding: 15px;
            }
            th, td {
                padding: 8px;
            }
            .btn-group {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>

<div class="content-container">
    <div class="card">
        <h2>🏦 Loan Details</h2>

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
        @if ($loandetails->isNotEmpty())    
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>LOAN ID</th>
                            <th>BANK NAME</th>
                            <th>LOAN TYPE</th>
                            <th>INTEREST RATE (IN %)</th>
                            <th>LOAN TENURE (IN YEARS)</th>
                            <th>BANK LOGO</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loandetails as $loandetail)
                            <tr>
                                <td>{{ $loandetail->loan_id }}</td>
                                <td>{{ $loandetail->bank_name }}</td>
                                <td>{{ $loandetail->loan_type }}</td>
                                <td>{{ $loandetail->interest_rate }}</td>
                                <td>{{ $loandetail->loan_tenure }}</td>
                                <td>
                                    @if($loandetail->bank_logo)
                                        <img src="{{ asset('storage/' . $loandetail->bank_logo) }}" width="50" alt="Bank Logo">
                                    @else
                                        No Logo
                                    @endif
                                </td>
                                <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.loandetails.edit', $loandetail->loan_id) }}" class="btn-update">Update</a>
                                    <form action="{{ route('admin.loandetails.delete', $loandetail->loan_id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this loan?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this loan?')">Delete</button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; margin-top: 20px; gap: 10px;">
                <form action="{{ route('loans.bulkUpload') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                    @csrf

                    <div style="margin-bottom: 10px;">
                        <label for="file"><strong>📂 Upload Loans (CSV or Excel):</strong></label>
                        <input type="file" name="file" required accept=".csv, .xlsx, .xls" style="margin-left: 10px;">
                            
                    </div>
                        <a href="{{ route('loans.downloadDemoCsv') }}" class="btn-primary">📥 Download Demo CSV</a>
                        <button type="submit" class="btn-primary">⬆️ Bulk Upload</button>
                        <a href="{{ route('admin.loandetails.create') }}" class="btn-primary">➕ Add Loan</a>
                        <a href="{{ url('/export-loan-details') }}" class="btn-primary">Export</a>
                </form>
            </div>
            
        @else
            <h3>No Loans available.</h3>
            <form action="{{ route('loans.bulkUpload') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                    @csrf

                    <div style="margin-bottom: 10px;">
                        <label for="file"><strong>📂 Upload Loans (CSV or Excel):</strong></label>
                        <input type="file" name="file" required accept=".csv, .xlsx, .xls" style="margin-left: 10px;">
                        <div style="margin-top: 20px;">
                            <a href="{{ route('loans.downloadDemoCsv') }}" class="btn-primary">📥 Download Demo CSV</a>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">⬆️ Bulk Upload</button>
                    <a href="{{ route('admin.loandetails.create') }}" class="btn-primary">➕ Add Loan</a>
                </form>
        @endif
    </div>
</div>

</body>
</html>

@endsection
