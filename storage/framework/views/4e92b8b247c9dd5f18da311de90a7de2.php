<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?> ">
    <title>Login Page</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>"/>
     <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background: linear-gradient(135deg, #74ebd5, #ACB6E5);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        margin: 0;
    }

    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh; 
    }
    
    .login-container {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 350px; /* Increased width */
        max-width: 90%;
        text-align: center;
        /* position: relative; */
    }

    h2 {
        margin-bottom: 20px;
        color: #333;
    }

    .input-group {
        margin-bottom: 15px;
         text-align: left;
    }

    label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
        color: #666;
    }

    input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
    }

    span {
        color: red;
        font-size: 12px;
        display: block;
        margin-top: 5px;
    }

    input:focus {
        border-color: #74ebd5;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .login-btn {
        width: 100%;
        padding: 10px;
        background-color: #5ac4c2;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        color: white;
        cursor: pointer;
        margin-top: 10px;
    }

    .login-btn:hover {
        background-color: #5ac4c2;
    }

    .checkbox-container {
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 5px; /* Adjust spacing between checkbox and text */
    }
    /* Centering the profile list */
    .profile-popup {
        display: flex;
        flex-direction: column;
        align-items: center; /* Centers the profile items */
        justify-content: center;
        width: 100%;
        }

    /* Styling for individual saved profiles */
    .saved-profile {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Gmail left, X right */
        width: 100%;
        max-width: 280px; /* Adjust based on design */
        background: #f9f9f9;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ddd;
        cursor: pointer;
        transition: background 0.3s ease;

    }

    /* Email left-aligned */
    .saved-profile span {
        font-size: 14px;
        color: #333;
        font-weight: 500;
        text-align: left;
        flex-grow: 1; /* Ensures email text takes full left space */
    }
    .saved-profile:hover{
        border : 1px solid black;
    }
    /* Delete button (X) right-aligned */
    .delete-btn, #delete-btn {
        background: none;
        border: none;
        font-size: 16px;
        color: red;
        cursor: pointer;
        font-weight: bold;
        transition: color 0.3s ease;
        margin-left: auto; /* Push X button to the right */
    }

    .delete-btn:hover, #delete-btn:hover{
        color: darkred;
    }

    /* Adjust modal-body to center the profile-popup */
    .modal-body {
        display: flex;
        flex-direction: column;
        align-items: center; /* Ensures the profile-popup is centered */
        justify-content: center;
    }

    .check-box {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }
     </style>
</head>
<body>
<?php if(session('success')): ?>
    <script>
        alert("<?php echo addslashes(session('success')); ?>");
    </script> 
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        alert("<?php echo addslashes(session('error')); ?>");
    </script> 
<?php endif; ?>


<?php $__env->startSection('content'); ?>
<div class="login-container">
    <h2>Login</h2>

        <form method="POST" action="<?php echo e(route('login')); ?>" autocomplete="on">
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" required autocomplete="username">
                <?php if($errors->has('email')): ?>
                 <span style="color: red;"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <div class="input-group">
                    <input id="password" type="password" name="password" placeholder="Enter your password"  style="width: 100%; padding-right: 45px; padding-left: 10px;" required autocomplete="current-password">
                    <span onclick="togglePassword()" style="position: absolute; right: 10px; cursor: pointer; font-size: 24px; color: #666;">
                        👁️
                    </span>
                </div>
                <?php if($errors->has('password')): ?>
                  <span style="color: red;"><?php echo e($errors->first('password')); ?></span>
                <?php endif; ?>
            <div class="input-group checkbox-container">
                  <input type="checkbox" id="is_admin" name="is_admin" class="check-box">
                  <label for="is_admin">Login as Admin</label>
            </div>
            
            <!-- <div style="margin-top: 10px;">
                <a href="#">Forgot Password?</a>
            </div> -->
            </div>
                <button type="submit" class="login-btn">Login</button>
                <div style=" margin-top: 10px; "></div>
                <a href="<?php echo e(route('register')); ?>">Don't have an account?</a>
        </form> 
    </div>
</div> 
<script>
    function togglePassword() {
    var passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text"; // Show password
    } else {
        passwordInput.type = "password"; // Hide password
    }
}
</script>
<script src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>
</body>
</html>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/auth/login.blade.php ENDPATH**/ ?>