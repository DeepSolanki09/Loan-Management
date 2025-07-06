<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href=" <?php echo e(asset('css\new\bootstrap.min.css')); ?>" rel="stylesheet">
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



<?php $__env->startSection('content'); ?>

<div class="content-wrapper">

    <?php if(session('success')): ?>
        <script>
            alert("<?php echo e(session('success')); ?>");
        </script>
    <?php endif; ?>

    <?php
        // Count applications belonging to the logged-in user
        $userApplicationCount = $UserApplications->where('applied_from_account', auth()->user()->name ?? null)->count();
    ?>

    <?php if($userApplicationCount > 0): ?>    
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
                <?php $__currentLoopData = $UserApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $UserApplication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(auth()->check() && auth()->user()->name == $UserApplication->applied_from_account): ?>
                        <tr>
                            <td><?php echo e($UserApplication->name); ?></td>
                            <td><?php echo e($UserApplication->email); ?></td>
                            <td><?php echo e($UserApplication->phone_number); ?></td>
                            <td><?php echo e($UserApplication->loan_type); ?></td>
                            <td><?php echo e($UserApplication->bank_name); ?></td>
                            <td><?php echo e($UserApplication->status); ?></td>
                            <td>
                                <div class="action-buttons">
                                    <!-- <a href="<?php echo e(route('applications.edit', $UserApplication->loan_id)); ?>">
                                        <button class="btn-update">Update</button>
                                    </a> -->
                                    <?php if($UserApplication->status == 'pending'): ?>
                                        <form action="<?php echo e(route('applications.destroy', $UserApplication->loan_id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this application?')">Delete</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php else: ?>
    <p class="no-data">No applications has been applied yet...</p>
            <a href="/loan" class="btn btn-success">Browse Loans</a>
    <?php endif; ?>

</div>

<?php $__env->stopSection(); ?>

</body>
</html>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/UserApplications.blade.php ENDPATH**/ ?>