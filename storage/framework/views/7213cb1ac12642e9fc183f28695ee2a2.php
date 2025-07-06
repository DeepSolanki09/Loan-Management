
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="<?php echo e(asset('css\new\google_fonts')); ?>">
 
        <!-- Stylesheets -->
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/flaticon.css')); ?>"/>
        <link rel="stylesheet" href="<?php echo e(asset('css/slicknav.min.css')); ?>"/>

        <!-- Main Stylesheets -->
        <link rel="stylesheet" href=" <?php echo e(asset('css/style.css')); ?>"/>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 50px auto;
        }

        /* Loan Details Card */
        .content-wrapper {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 50px;
        }

        h2 {
            font-size: 32px;
            font-weight: bold;
            color: #007BFF;
            text-align: center;
            margin-bottom: 20px;
        }

        .card {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
            border: 2px solid #007BFF;
            margin-bottom: 20px;
            text-align: center;
        }

        .card img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            display: block;
            margin: 0 auto 15px;
        }

        .loan-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 15px 0;
        }

        .loan-details p {
            font-size: 16px;
            color: #333;
            padding: 5px 0;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #ddd;
        }

        /* Buttons */
        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .apply-btn, .cart-btn {
            display: inline-block;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            transition: 0.3s;
        }

        .apply-btn {
            background-color: #007BFF;
            color: white;
        }

        .cart-btn {
            background-color: #28a745;
            color: white;
        }

        .apply-btn:hover {
            background-color: #0056b3;
        }

        .cart-btn:hover {
            background-color: #218838;
        }

        /* EMI Calculator */
        .emi-calculator {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
            margin-top: 30px;
            text-align: center;
        }

        .emi-calculator h3 {
            color: #007BFF;
            margin-bottom: 15px;
        }

        .emi-calculator input {
            width: 80%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .emi-calculator button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 16px;
        }

        .emi-calculator button:hover {
            background-color: #0056b3;
        }

        .emi-result {
            font-size: 18px;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        /* Two-column Layout */
        .info-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 40px;
        }

        .info-box {
            flex: 1;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.08);
        }

        .info-box h3 {
            color: #007BFF;
            margin-bottom: 15px;
        }

        .info-box ul {
            list-style: none;
            padding: 0;
        }

        .info-box ul li {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            padding-left: 20px;
            position: relative;
        }

        .info-box ul li::before {
            position: absolute;
            left: 0;
            color: #007BFF;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .info-container {
                flex-direction: column;
            }

            .loan-details p {
                flex-direction: column;
            }

            .buttons {
                flex-direction: column;
                gap: 10px;
            }

            .apply-btn, .cart-btn {
                width: 100%;
            }
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
    <?php echo $__env->make('navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="container">
            <div class="content-wrapper">
                <h2>Loan Details</h2>
                
                <div class="card">
                    <img src="<?php echo e(asset('storage/' . $loan->bank_logo)); ?>" alt="Bank Logo">
                    <h2><?php echo e($loan->loan_type); ?></h2>
                    
                    <div class="loan-details">
                        <p><strong>Bank Name:</strong> <?php echo e($loan->bank_name); ?></p>
                        <p><strong>Interest Rate:</strong> <?php echo e($loan->interest_rate); ?>% per annum</p>
                        <p><strong>Loan Tenure:</strong> Up to <?php echo e($loan->loan_tenure); ?> years</p>
                        <!-- <p><strong>Description:</strong> <?php echo e($loan->description ?? 'No additional details available.'); ?></p> -->
                    </div>
                    
                </div>
                
                <!-- EMI Calculator -->
                <div class="emi-calculator">
                    <h3>EMI Calculator 🧮</h3>
                    <label>Loan Amount (₹):</label>
                    <input type="number" id="loanAmount" placeholder="Enter amount">
                    
                    <label>Interest Rate (%):</label>
                    <input type="number" id="interestRate" value="<?php echo e($loan->interest_rate); ?>" readonly>
                    
                    <label>Loan Tenure (Years):</label>
                    <input type="number" id="loanTenure" value="<?php echo e($loan->loan_tenure); ?>" readonly>
                    
                    <button onclick="calculateEMI()">Calculate EMI</button>
                    <p class="emi-result"><strong>Estimated EMI:</strong> ₹ <span id="emiResult">0</span></p>
                </div>

                <!-- Two-Column Layout for Eligibility & Documents -->
                <div class="info-container">
                    <div class="info-box">
                        <h3>Eligibility Criteria ✅</h3>
                        <ul>
                            <li>✔️ Minimum age: 21 years</li>
                            <li>✔️ Maximum age: 60 years</li>
                            <li>✔️ Minimum salary: ₹25,000 per month</li>
                            <li>✔️ Employment: Salaried or Self-Employed</li>
                        </ul>
                    </div>

                    <div class="info-box">
                        <h3>Required Documents 📄</h3>
                        <ul>
                            <li>📜 Aadhaar/PAN Card</li>
                            <li>🏦 Bank Statements (Last 6 months)</li>
                            <li>💰 Salary Slips or ITR</li>
                            <li>📋 Address Proof</li>
                        </ul>
                    </div>
                </div>
                <!-- Buttons -->
                <div class="buttons">
                <?php if(Auth::check()): ?> 
                    <form action="<?php echo e(route('loans.store')); ?>" method="POST"  onsubmit="return confirm('Are you sure you want to apply for this loan?');">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="name" value="<?php echo e(old('name', Auth::user()->name ?? '')); ?>" required>
                        <input type="hidden" name="email" value="<?php echo e(old('email', Auth::user()->email ?? '')); ?>" required>
                        <input type="hidden" name="phone_number" value="<?php echo e(old('phone_number', Auth::user()->phone_number ?? '')); ?>" required>
                        <input type="hidden" name="loan_id" value="<?php echo e($loan->id); ?>">
                        <input type="hidden" name="loan_type" value="<?php echo e($loan->loan_type); ?>">
                        <input type="hidden" name="bank_name" value="<?php echo e($loan->bank_name); ?>">

                        <button type="submit" class="apply-btn">Apply Now</button>
                    </form> 
                        <?php
                        $loanExists = \App\Models\Cart::where('user_id', Auth::id())->where('loan_id', $loan->loan_id)->exists();
                        ?>

                        <?php if(!$loanExists): ?>
                            <form action="<?php echo e(url('/cart/add')); ?>" method="POST" onsubmit="return confirm('Are you sure you want to add this loan into your wishlist?');">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="loan_id" value="<?php echo e($loan->loan_id); ?>">
                                <button type="submit" class="cart-btn">Add to Wishlist</button>
                            </form>
                        <?php else: ?>
                            <button class="cart-btn" disabled>Already in Wishlist</button>
                        <?php endif; ?>
                <?php else: ?> 
                   <!-- If the user is NOT logged in, show buttons that redirect to login -->
                    <a href="<?php echo e(route('login')); ?>">
                      <button class="apply-btn">Apply Now</button>
                    </a>
                    <a href="<?php echo e(route('login')); ?>">
                        <button class="cart-btn">Add to Wishlist</button>
                    </a>
                <?php endif; ?>
                </div>
            </div>
        </div>
    <?php echo $__env->make('footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <script>
            function calculateEMI() {
                let P = document.getElementById('loanAmount').value;
                let r = document.getElementById('interestRate').value / 1200;
                let n = document.getElementById('loanTenure').value * 12;
                
                if (!P || P <= 0) {
                    alert("Please enter a valid loan amount.");
                    return;
                }
                
                let EMI = (P * r * Math.pow(1 + r, n)) / (Math.pow(1 + r, n) - 1);
                document.getElementById('emiResult').innerText = isNaN(EMI) ? "0" : EMI.toFixed(2);
            }
        </script>

<!--====== Javascripts & Jquery ======-->
            <script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
            <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
            <script src="<?php echo e(asset('js/jquery.slicknav.min.js')); ?>"></script>
            <script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
            <script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
            <script src="<?php echo e(asset('js/main.js')); ?>"></script>
    <?php $__env->stopSection(); ?>

</body>
</html>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/loans/show.blade.php ENDPATH**/ ?>