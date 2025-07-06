<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>  
    <script>
         document.getElementById("dropdownButton").addEventListener("click", function () {
            document.getElementById("dropdownMenu").classList.toggle("hidden");
         });
    </script>
     <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
            }

        body {
            background: linear-gradient(135deg, #f5af19, #f12711);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup-container {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-group {
            margin-bottom: 20px;
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

        input:focus {
            border-color: #f5af19;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        /* input:invalid {
            border-color: red;
        } */

        span {
            color: red;
            font-size: 12px;
            display: block;
            margin-top: 5px;
        }

        .signup-btn {
            width: 100%;
            padding: 10px;
            background-color: #f5af19;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            cursor: pointer;
        }

        .signup-btn:hover {
            background-color: #d88415;
        }

        #error-message {
            color: red;
            margin-top: 10px;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: white;
            cursor: pointer;
            appearance: none; /* Removes default dropdown styles */
        }

        select:focus {
            border-color: #f5af19;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .custom-dropdown {
            position: relative;
            width: 100%;
        }

        select {
            width: 100%;
            padding: 10px;
            padding-right: 30px; /* Space for the arrow */
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: white;
            cursor: pointer;
            appearance: none; /* Removes default dropdown styles */
        }

        select::-ms-expand {
            display: none;
        }

        /* Add custom down arrow at the end of the input box */
        .dropdown-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none; /* Prevents interfering with select functionality */
            font-size: 16px;
            color: #666;
        }

        /* Add focus effect */
        select:focus {
            border-color: #f5af19;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .dropdown-arrow {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none; /* Prevents interfering with select functionality */
            font-size: 16px;
            color: #666;
        }

        /* Custom focus effect */
        select:focus {
            border-color: #f5af19;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
     </style>
</head>
<body>
<?php if(session('success')): ?>
    <script>
        alert("<?php echo e(session('success')); ?>");
    </script> 
<?php endif; ?>
     <div class="signup-container">
        <h2>Create Account</h2>
        <form id="signupForm" action="<?php echo e(route('register')); ?>" method="post" enctype="multipart/form-data">     
            <?php echo csrf_field(); ?>
            <div class="input-group">
                <label for="name">Username</label>
                <input type="text" id="name" name="name" placeholder="Enter Your name" value="<?php echo e(old('name')); ?>" required>
                <?php if($errors->has('name')): ?>
                     <span style="color: red;"><?php echo e($errors->first('name')); ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" value="<?php echo e(old('email')); ?>" required>
                <?php if($errors->has('email')): ?>
                     <span style="color: red;"><?php echo e($errors->first('email')); ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" value="<?php echo e(old('phone_number')); ?>" placeholder="Enter Phone Number" required>
                <?php if($errors->has('phone_number')): ?>
                    <span style="color: red;"><?php echo e($errors->first('phone_number')); ?></span>
                <?php endif; ?>
            </div>
            <!-- <div class="input-group">
                <label for="role">Role</label>
                <div class="custom-dropdown">
                    <select id="role" name="role" required>
                        <option value="" disabled selected hidden>Select Role</option>
                        <option value="User">User</option>
                        <option value="Admin">Admin</option>
                    </select>
                    <span class="dropdown-arrow">&#9662;</span> 
                </div>
                <?php if($errors->has('role')): ?>
                    <span style="color: red;"><?php echo e($errors->first('role')); ?></span>
                <?php endif; ?>
            </div> -->
            <input type="hidden" name="role" value="User">

            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Create a password" autocomplete="new-password" required>
                <?php if($errors->has('password')): ?>
                  <span style="color: red;"><?php echo e($errors->first('password')); ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label for="password_confirmation">Confirm Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password" required>
                <?php if($errors->has('password_confirmation')): ?>
                     <span style="color: red;"><?php echo e($errors->first('password_confirmation')); ?></span>
                <?php endif; ?>
            </div>
            <div class="input-group">
                <label for="profile_pic">Profile Picture: </label>
                <input type="file" id="profile_pic" name="profile_pic" accept="image/*" required>
                <?php if($errors->has('profile_picture')): ?>
                 <span style="color: red;"><?php echo e($errors->first('profile_picture')); ?></span>
                <?php endif; ?>
            </div>
            <button type="submit" class="signup-btn">Register</button>
        </form>
        <div id="error-message"></div>
        <a href="<?php echo e(route('login')); ?>">Already have an account?</a>
    </div>
    <?php if(session('js_alert')): ?>
        <script>
                alert("<?php echo e(session('js_alert')); ?>")
        </script>
    <?php endif; ?>
</body>
</html>
 

 <?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/auth/register.blade.php ENDPATH**/ ?>