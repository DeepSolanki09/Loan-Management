<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
			a{
				text-decoration: none;
			}
			.modal-body {
				display: flex;
				flex-direction: row;
				align-items: center;
				justify-content: space-between;
			}

			.profile-image-container {
				flex: 1;
				display: flex;
				justify-content: center;
				align-items: center;
			}

			.profile-image-container img {
				border-radius: 50%;
				width: 150px;
				height: 150px;
				object-fit: cover;
			}

			.header-right {
					display: flex;
					align-items: center;
					gap: 15px; /* Adjust spacing between elements */
				}
			.profileDetails {
				width: 80px; /* Increased size */
				height: 80px; /* Increased size */
				border-radius: 50%;
				object-fit: cover;
				display: flex;
				align-items: center;
				justify-content: center;
			}

			.profileImg {
				border-radius: 50%;
				width: 80px; /* Ensure the size matches */
				height: 80px; /* Ensure the size matches */
			}


			.profile-info-container {
				flex: 2;
				margin-left: 20px;
			}

			.info-label {
				font-weight: bold;
			}

			.info-box {
				background-color: #f8f9fa;
				padding: 10px 15px;
				border-radius: 5px;
				margin-bottom: 10px;
				box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
			}
			/* Button Styles */
			.btn {
				background: linear-gradient(145deg, #6c5ce7, #5a4bbf);
				border: none;
				color: white;
				font-weight: bold;
				text-transform: uppercase;
				padding: 12px 25px;
				border-radius: 8px;
				font-size: 16px;
				cursor: pointer;
				transition: all 0.3s ease-in-out;
				box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
				display: flex;
				justify-self: self-between;
				margin-right:20px;

			}


			/* Hover Effect */
			.btn:hover {
			background: linear-gradient(145deg, #5a4bbf, #6c5ce7);
			transform: translateY(-3px); /* Slight lift effect */
			box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
			}

			/* Focus Effect */
			.btn:focus {
			outline: none;
			box-shadow: 0 0 0 3px rgba(108, 92, 231, 0.4); /* Light blue glow */
			}

    </style>
</head>
<body>
	
	<div id="preloder">
			<div class="loader"></div>
	</div>
	<!-- Header Section -->
	<header class="header-section p-3 bg-dark" style="display:flex; justify-content:space-between; bg-transperem">
		<a href="" class="site-logo">
            <img src="<?php echo e(asset('Images/logo.png')); ?>" alt="">
        </a>
			<div class="header-nav" style="display:flex; align-items:center;">
				<ul class="main-menu">
					<li><a href="/home">Home</a></li>
					<li><a href="/about-us">About Us</a></li>
					<li><a href="/loan">Loans</a></li>
					<!-- <li><a href="/news">News</a></li> -->
					<li><a href="/contact">Contact</a></li>
				</ul>
				<!-- <li class="nav-item">
					<a class="nav-link" href="<?php echo e(route('cart.show')); ?>">
						View Cart (<?php echo e(count(session('cart', []))); ?>)
					</a>
				</li> -->
				<div class="header-right">
					<?php if(Auth::check()): ?>  
						<?php if(Auth::user()->role == 'Admin'): ?>  
							<div style="display: flex; align-items: center; gap: 15px;">
								<a href="<?php echo e(route('admin-panel')); ?>">
									<button class="btn">Admin</button>
								</a>
								<a href="<?php echo e(route('profile')); ?>" class="profileDetails">
									<img src="<?php echo e(asset(Auth::user()->profile_pic ? 'storage/' . Auth::user()->profile_pic : 'default-profile.png')); ?>" class="profileImg">
								</a>
							</div>
						<?php else: ?>
							<a href="<?php echo e(route('profile')); ?>" class="profileDetails">
								<img src="<?php echo e(asset(Auth::user()->profile_pic ? 'storage/' . Auth::user()->profile_pic : 'default-profile.png')); ?>" class="profileImg">
							</a>
						<?php endif; ?>
					<?php else: ?>
						<a href="<?php echo e(route('login')); ?>"><button class="btn">Log In</button></a>
						<a href="<?php echo e(route('register')); ?>"><button class="btn">Sign Up</button></a>
					<?php endif; ?>
				</div>

				</div> 
			</div>
		</header>
		<!-- Header Section end -->
</body>
</html>
<!-- Page Preloder --><?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/navbar.blade.php ENDPATH**/ ?>