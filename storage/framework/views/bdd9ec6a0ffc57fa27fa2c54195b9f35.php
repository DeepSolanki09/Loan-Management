

<?php $__env->startSection('content'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Applications</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }
        
        .content-container {
            display: flex;
            justify-content: center;
            height: 75vh;
        }
        
        .card {
            background: #ffffff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 25px;
            width: 100%;
            max-width: 1100px;
            text-align: center;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 5px;
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

        /* Buttons Styling */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .approve-btn, .reject-btn {
            border: none;
            padding: 8px 12px;
            cursor: pointer;
            font-weight: bold;
            border-radius: 5px;
        }

        .approve-btn {
            background-color: green;
            color: white;
        }

        .reject-btn {
            background-color: red;
            color: white;
        }

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

<?php if(session('success')): ?>
    <script>alert("<?php echo e(session('success')); ?>");</script> 
<?php endif; ?>
<?php if(session('error')): ?>
    <script>alert("<?php echo e(session('error')); ?>");</script> 
<?php endif; ?>

<div class="content-container">
    <div class="card">
        <h2>📄 Loan Applications</h2>

        <?php if($loans->isNotEmpty()): ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>PHONE NUMBER</th>
                        <th>LOAN ID</th>
                        <th>LOAN TYPE</th>
                        <th>BANK</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $loans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $loan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($loan->name); ?></td>
                        <td><?php echo e($loan->email); ?></td>
                        <td><?php echo e($loan->phone_number); ?></td>
                        <td><?php echo e($loan->loan_id); ?></td>
                        <td><?php echo e($loan->loan_type); ?></td>
                        <td><?php echo e($loan->bank_name); ?></td>
                        <td class="status"><?php echo e($loan->status); ?></td>
                        <td>
                            <?php if($loan->status === 'pending'): ?>
                                <div class="action-buttons">
                                    <form action="<?php echo e(route('update.loan.status')); ?>" method="POST" onsubmit="return confirm('Are you sure you want to approve this loan application?');">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="loan_id" value="<?php echo e($loan->loan_id); ?>">
                                        <input type="hidden" name="status" value="Approved">
                                        <button type="submit" class="approve-btn">Approve</button>
                                    </form>

                                    <form action="<?php echo e(route('update.loan.status')); ?>" method="POST" onsubmit="return confirm('Are you sure you want to reject this loan application?');">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="loan_id" value="<?php echo e($loan->loan_id); ?>">
                                        <input type="hidden" name="status" value="Rejected">
                                        <button type="submit" class="reject-btn">Reject</button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <strong><?php echo e($loan->status); ?></strong>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <a href="<?php echo e(url('export-loan-application')); ?>" class="btn btn-primary mb-3 my-3" style="width: 20%;">
                     Export
                </a>
        </div>
        <?php else: ?>
        <h3>No loan applications available yet...</h3>
        <?php endif; ?>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".approve-btn").forEach(button => {
        button.addEventListener("click", function () {
            updateLoanStatus(this.dataset.id, "Approved");
        });
    });

    document.querySelectorAll(".reject-btn").forEach(button => {
        button.addEventListener("click", function () {
            updateLoanStatus(this.dataset.id, "Rejected");
        });
    });

    function updateLoanStatus(loanId, status) {
        fetch("<?php echo e(route('update.loan.status')); ?>", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
            },
            body: JSON.stringify({ id: loanId, status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector(`#loan-${loanId} .status`).textContent = status;
            } else {
                alert("Failed to update status!");
            }
        })
        .catch(error => console.error("Error:", error));
    }
});
</script>

<?php $__env->stopSection(); ?>
</body>
</html>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/admin/LoanApplications.blade.php ENDPATH**/ ?>