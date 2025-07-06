 

<?php $__env->startSection('content'); ?>

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

<?php if(session('success')): ?>
    <script>
        alert("<?php echo e(session('success')); ?>");
    </script>
<?php endif; ?>
<?php if(session('error')): ?>
    <script>
        alert("<?php echo e(session('error')); ?>");
    </script>
<?php endif; ?>
        <?php if($loandetails->isNotEmpty()): ?>    
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
                        <?php $__currentLoopData = $loandetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loandetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($loandetail->loan_id); ?></td>
                                <td><?php echo e($loandetail->bank_name); ?></td>
                                <td><?php echo e($loandetail->loan_type); ?></td>
                                <td><?php echo e($loandetail->interest_rate); ?></td>
                                <td><?php echo e($loandetail->loan_tenure); ?></td>
                                <td>
                                    <?php if($loandetail->bank_logo): ?>
                                        <img src="<?php echo e(asset('storage/' . $loandetail->bank_logo)); ?>" width="50" alt="Bank Logo">
                                    <?php else: ?>
                                        No Logo
                                    <?php endif; ?>
                                </td>
                                <td>
                                <div class="btn-group">
                                    <a href="<?php echo e(route('admin.loandetails.edit', $loandetail->loan_id)); ?>" class="btn-update">Update</a>
                                    <form action="<?php echo e(route('admin.loandetails.delete', $loandetail->loan_id)); ?>" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this loan?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this loan?')">Delete</button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; margin-top: 20px; gap: 10px;">
                <form action="<?php echo e(route('loans.bulkUpload')); ?>" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                    <?php echo csrf_field(); ?>

                    <div style="margin-bottom: 10px;">
                        <label for="file"><strong>📂 Upload Loans (CSV or Excel):</strong></label>
                        <input type="file" name="file" required accept=".csv, .xlsx, .xls" style="margin-left: 10px;">
                            
                    </div>
                        <a href="<?php echo e(route('loans.downloadDemoCsv')); ?>" class="btn-primary">📥 Download Demo CSV</a>
                        <button type="submit" class="btn-primary">⬆️ Bulk Upload</button>
                        <a href="<?php echo e(route('admin.loandetails.create')); ?>" class="btn-primary">➕ Add Loan</a>
                        <a href="<?php echo e(url('/export-loan-details')); ?>" class="btn-primary">Export</a>
                </form>
            </div>
            
        <?php else: ?>
            <h3>No Loans available.</h3>
            <form action="<?php echo e(route('loans.bulkUpload')); ?>" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
                    <?php echo csrf_field(); ?>

                    <div style="margin-bottom: 10px;">
                        <label for="file"><strong>📂 Upload Loans (CSV or Excel):</strong></label>
                        <input type="file" name="file" required accept=".csv, .xlsx, .xls" style="margin-left: 10px;">
                        <div style="margin-top: 20px;">
                            <a href="<?php echo e(route('loans.downloadDemoCsv')); ?>" class="btn-primary">📥 Download Demo CSV</a>
                        </div>
                    </div>

                    <button type="submit" class="btn-primary">⬆️ Bulk Upload</button>
                    <a href="<?php echo e(route('admin.loandetails.create')); ?>" class="btn-primary">➕ Add Loan</a>
                </form>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/admin/loandetails/index.blade.php ENDPATH**/ ?>