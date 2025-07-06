<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <style>
        /* Ensure the main content does not affect the sidebar */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9; /* Matches AdminLTE */
            margin: 0;
            padding: 0;
        }

        /* Center the users table content */
        .content-container {
            display: flex;
            justify-content: center;
            /* align-items: center; */
            height: 75vh; /* Full screen height */
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

        /* Users List Heading */
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
        <h2>👥 Users List</h2>

        <?php if($users->isNotEmpty()): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>PHONE NUMBER</th>
                            <th>PROFILE PICTURE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td><?php echo e($user->phone_number); ?></td>
                            <td><img src="<?php echo e(Storage::url($user->profile_pic)); ?>" alt="Profile"></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <a href="<?php echo e(url('/export-users')); ?>" class="btn btn-primary mb-3 my-3" style="width: 20%;">Export</a>
            </div>
        <?php else: ?>
            <h3>No users available yet...</h3>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
<?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/admin/UserDetails.blade.php ENDPATH**/ ?>