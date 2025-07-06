<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                background: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                max-width: 500px;
                width: 100%;
            }

            h1 {
                text-align: center;
                color: #333;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                font-weight: bold;
                display: block;
                margin-bottom: 5px;
            }

            input[type="text"],
            input[type="number"],
            select,
            input[type="file"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 5px;
                box-sizing: border-box;
            }

            select {
                cursor: pointer;
            }

            button {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                border: none;
                color: white;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
                transition: 0.3s;
            }

            button:hover {
                background-color: #0056b3;
            }

            span {
                color: red;
                font-size: 14px;
            }
    </style>
</head>
<body>

<?php $__env->startSection('content'); ?>
<h1>Add Loan</h1>
<?php if(session('success')): ?>
    <script>
        alert("<?php echo e(session('success')); ?>");
    </script>
<?php endif; ?>

<form method="POST" action="<?php echo e(route('admin.loandetails.store')); ?>" enctype="multipart/form-data"> 

        <?php echo csrf_field(); ?>

        <div class="form-group">
            <label for="loan_id">Loan ID:</label>
            <input type="number" name="loan_id" id="loan_id" class="form-control" value="<?php echo e(old('loan_id')); ?>" required>
            <?php if($errors->has('loan_id')): ?>
                <span style="color: red;"><?php echo e($errors->first('loan_id')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="bank_name">Bank Name:</label>
            <input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo e(old('bank_name')); ?>" required>
                <?php if($errors->has('bank_name')): ?>
                     <span style="color: red;"><?php echo e($errors->first('bank_name')); ?></span>
                <?php endif; ?>
        </div>

        
        <div class="form-group">
            <div class="custom-dropdown">
                <label for="loan_type">Loan Type:</label>
                <select id="loan_type" name="loan_type" required>
                        <option value="" disabled selected hidden>Select</option>
                        <option value="Home Loan">Home Loan</option>
                        <option value="Car Loan">Car Loan</option>
                        <option value="Education Loan">Education Loan</option>
                        <option value="Personal Loan">Personal Loan</option>
                </select>
                    <!-- <span class="dropdown-arrow">&#9662;</span>  -->
            </div>
            <?php if($errors->has('loan_type')): ?>
                 <span style="color: red;"><?php echo e($errors->first('loan_type')); ?></span>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <label for="interest_rate">Interest Rate (In %):</label>
            <input type="text" name="interest_rate" id="interest_rate" class="interest_rate" value="<?php echo e(old('interest_rate' )); ?>" required>
            <?php if($errors->has('interest_rate')): ?>
                     <span style="color: red;"><?php echo e($errors->first('interest_rate')); ?></span>
            <?php endif; ?>
        </div>
       
        <div class="form-group">
            <label for="loan_tenure">Loan Tenure (In Years):</label>
            <input type="text" name="loan_tenure" id="loan_tenure" class="loan_tenure" value="<?php echo e(old('loan_tenure' )); ?>" required>
            <?php if($errors->has('loan_tenure')): ?>
                     <span style="color: red;"><?php echo e($errors->first('loan_tenure')); ?></span>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="bank_logo">Bank Logo:</label>
            <input type="file" name="bank_logo" id="bank_logo" class="form-control">
            <?php if($errors->has('bank_logo')): ?>
                     <span style="color: red;"><?php echo e($errors->first('bank_logo')); ?></span>
            <?php endif; ?>
        </div>
        
        <button type="submit" class="btn btn-primary">Create Loan</button>
    </form>
<?php $__env->stopSection(); ?>
</body>
</html>








<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/admin/loandetails/create.blade.php ENDPATH**/ ?>