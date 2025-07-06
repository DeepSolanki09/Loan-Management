<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist</title>
    <link href=" <?php echo e(asset('css\new\bootstrap.min.css')); ?>" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .table {
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
        }
        .btn-danger {
            background: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background: #c82333;
        }
        .btn-primary {
            background: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .btn-success {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 20px;
            padding: 10px;
        }
        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
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


<?php $__env->startSection('content'); ?>

<div class="container">
    <h2>Your Wishlist</h2>
    <?php if(count($cartItems) > 0): ?>
    <table class="table table-striped text-center">
        <thead class="table-dark">
            <tr>
                <th>Bank Name</th>
                <th>Loan Type</th>
                <th>Interest Rate</th>
                <th>Tenure</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($item->bank_name); ?></td>
                <td><?php echo e($item->loan_type); ?></td>
                <td><?php echo e($item->interest_rate); ?>%</td>
                <td><?php echo e($item->loan_tenure); ?> years</td>
                <td>
                    <div class="action-buttons">
                    <form action="<?php echo e(route('application.place')); ?>" method="POST"  onsubmit="return confirm('Are you sure you want to proceed with this loan application?');">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="loan_id" value="<?php echo e($item->loan_id); ?>">
                        <button type="submit" class="btn btn-primary">Proceed to Apply</button>
                    </form>
                    <!-- <a href="<?php echo e(route('application.place')); ?>" class="btn btn-primary">Proceed to Apply</a> -->
                        <form action="<?php echo e(route('cart.remove', $item->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to remove this loan from the wishlist?');">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <a href="/loan" class="btn btn-success">Browse Loans</a>
    <?php else: ?>
    <p>Your wishlist is empty.</p>
    <a href="/loan" class="btn btn-success">Browse Loans</a>
    <?php endif; ?>
</div>

<?php $__env->stopSection(); ?>
</body>
</html>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/cart/cart.blade.php ENDPATH**/ ?>