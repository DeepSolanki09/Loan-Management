<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>LOANS2GO | Loans HTML Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="loans HTML Template">
	<meta name="keywords" content="loans, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<link href=" <?php echo e(asset('Images\favicon.ico')); ?>" rel="shortcut icon"/>

	<!-- Google font -->
	<link href="public\google_fonts">
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('css/font-awesome.min.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('css/owl.carousel.min.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('css/flaticon.css')); ?>"/>
	<link rel="stylesheet" href="<?php echo e(asset('css/slicknav.min.css')); ?>"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href=" <?php echo e(asset('css/style.css')); ?>"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	
<?php echo $__env->make('navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

	<!-- Page top Section end -->
	<section class="page-top-section set-bg" data-setbg="<?php echo e(asset('Images/page-top-bg/1.jpg')); ?>">
		<div class="container">
			<h2>About us</h2>
			<nav class="site-breadcrumb">
				<a class="sb-item" href="#">Home</a>
				<span class="sb-item active">About us</span>
			</nav>
		</div>
	</section>
	<!-- Page top Section end -->

	<!-- About Section end -->
	<section class="about-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">
					<img src=" <?php echo e(asset('Images/about-img.jpg')); ?>" alt="">
				</div>
				<div class="col-lg-7">
					<div class="about-text">
						<h2>A team to help you</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl.</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- About Section end -->

	<!-- Review Section end -->
	<!-- <section class="review-section spad">
		<div class="container">
			<div class="text-center text-white mb-5 pb-2">
				<h2>What Our Clients Say</h2>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="review-item">
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<p>Lorem ipsum dolor sit amet, consecte-tur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia.</p>
						<h6>Maria Smith, <span>25 min ago</span></h6>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="review-item">
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<p>Sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia.</p>
						<h6>Marta Black, <span>25 min ago</span></h6>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="review-item">
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse po-tenti. Ut gravida mattis magna, non varius lorem sodales nec. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
						<h6>Carl Brown, <span>25 min ago</span></h6>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="review-item">
						<div class="rating">
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
						<p>Per conubia nostra, per inceptos hime-naeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec.</p>
						<h6>Paul David, <span>25 min ago</span></h6>
					</div>
				</div>
			</div>
		</div>
	</section> -->
	<!-- Review Section end -->
	
	<!-- Authorities Section end -->
	<section class="authorities-section spad">
		<div class="container">
			<div class="text-center">
				<h2>We’re regulated by these authorities</h2>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="authoritie-item">
						<img src=" <?php echo e(asset('Images/brands/1.png')); ?>" alt="">
						<h4>Financial Conduct Authority</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hime-naeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl.</p>
						<a href="./loans.php" class="readmore">Apply for a loan now <img src=" <?php echo e(asset('Imagesss/arrow.png')); ?>" alt=""></a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="authoritie-item">
						<img src="<?php echo e(asset('Images/brands/2.png')); ?>" alt="">
						<h4>Prudential Regulation Authority</h4>
						<p>Prudential Regulation Authority ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Pruden-tial Regulation Authority taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero.</p>
						<a href="./loans.php" class="readmore">Apply for a loan now <img src=" <?php echo e(asset('Imagesss/arrow.png')); ?>" alt=""></a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="authoritie-item">
						<img src="<?php echo e(asset('Images/brands/3.png')); ?>" alt="">
						<h4>Peer-to-Peer Finance Association</h4>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hime-naeos. Suspendisse potenti. Ut gravida mattis magna, non varius lorem sodales nec. In libero orci, ornare non nisl.</p>
						<a href="./loans.php" class="readmore">Apply for a loan now <img src="<?php echo e(asset('Images/arrow.png')); ?>" alt=""></a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Authorities Section end -->

	<!-- Score Section end -->
	<section class="score-section text-white set-bg" data-setbg=" <?php echo e(asset('Images/score-bg.jpg')); ?>">
		<div class="container">
			<div class="row">
				<div class="col-xl-6 col-lg-8">
					<h2>Calculate my Score</h2>
					<h4>Check your credit reports as often as you want, it won't affect your scores.</h4>
					<a href="#" class="site-btn sb-big">show my score</a>
				</div>
			</div>
			<img src="<?php echo e(asset('Images/hand.png')); ?>" alt="" class="hand-img">
		</div>
	</section>
	<!-- Score Section end -->

	<?php echo $__env->make('footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
	
	<!--====== Javascripts & Jquery ======-->
	<script src="<?php echo e(asset('js/jquery-3.2.1.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery.slicknav.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/owl.carousel.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/jquery-ui.min.js')); ?>"></script>
	<script src="<?php echo e(asset('js/main.js')); ?>"></script>

	</body>
</html>
<?php /**PATH D:\Deep\Laravel Project\Loan Management\resources\views/about-us.blade.php ENDPATH**/ ?>