<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link href="<?php echo e(asset('css\new\google_fonts')); ?>" rel="stylesheet">
    <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> -->
</head>
<body>
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>  <!-- This will display the page-specific content -->
    </div>

    <footer>
        <!-- Add footer content here (optional) -->
    </footer>
</body> 
</html>
<?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/layouts/app.blade.php ENDPATH**/ ?>