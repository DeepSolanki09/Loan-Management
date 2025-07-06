<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Details</title>
    <style>
        /* Ensure the main content does not affect the sidebar */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9; /* Matches AdminLTE */
            margin: 0;
            padding: 0;
        }

        /* Center the admin table content */
        .content-container {
            display: flex;
            justify-content: center;
            height: 75vh;
        }

        /* Styled card container */
        .card {
            background: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 25px; /* Increased padding */
            width: 100%;
            max-width: 1100px; /* Increased width */
            text-align: center;
        }

        /* Admin List Heading */
        .card h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        /* Responsive Table */
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
            padding: 12px;
        }

        td {
            padding: 10px;
            background: #f8f9fa;
        }

        td img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        /* Hide password securely */
        .password-hidden {
            font-weight: bold;
            letter-spacing: 3px;
            color: #555;
        }

        .add-admin-btn {
            display: inline-block;
            background: #28a745;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .add-admin-btn:hover {
            background: #218838;
        }

        /* Make table responsive */
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
        <h2>👨‍💼 Admin List</h2>

        @if ($admins->isNotEmpty())
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ADMIN</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>PROFILE PICTURE</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{ $admin->name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->phone_number }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $admin->profile_pic) }}" alt="Profile">
                            </td>
                            <td>
                                <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <a href="{{ route('admin.register') }}" class="add-admin-btn">➕ Add Admin</a>
            <a href="{{ url('/export-admins') }}" class="btn btn-primary mb-3 my-3" style="width: 20%;">Export</a>
        @else
            <h3>No admin available yet...</h3>
        @endif
    </div>
</div>

</body>
</html>
