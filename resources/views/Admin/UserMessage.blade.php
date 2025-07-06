@extends('layouts.app')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Messages</title>
    <style>
        /* Centering Content */
        .content-container {
            display: flex;
            justify-content: center;
            padding: 20px;
            height: 75vh;
        }

        /* Card Style */
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
            text-align: left;
        }

        td {
            padding: 12px;
            background: #f8f9fa;
            text-align: left;
            word-wrap: break-word;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card {
                width: 95%;
                padding: 15px;
            }
            th, td {
                padding: 8px;
            }
        }
    </style>
</head>
<body>

<div class="content-container">
    <div class="card">
        <h2>📩 User Messages</h2>

        @if ($messages->isNotEmpty())    
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>SUBJECT</th>
                            <th>MESSAGE</th>
                            <th>APPLIED FROM ACCOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->email }}</td>
                                <td>{{ $message->subject }}</td>
                                <td>{{ $message->message }}</td>
                                <td>{{ $message->applied_from_account }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <a href="{{ url('/export-user-messages') }}" class="btn btn-primary mb-3" style="width: 20%;">Export</a>
            </div>
            @else
            <h3>No user messages sent yet...</h3> 
        @endif
    </div>
</div>

</body>
</html>

@endsection
