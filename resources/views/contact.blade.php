<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOANS2GO | Loans HTML Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="loans HTML Template">
	<meta name="keywords" content="loans, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
	<link href="{{ asset('Images/favicon.ico') }}"" rel="shortcut icon"/>

	<link href="public\google_fonts">
 
	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}"/>
	<link rel="stylesheet" href="{{ asset('css/flaticon.css') }}"/>

	<!-- Main Stylesheets -->
	<link rel="stylesheet" href="{{ asset('css/style.css') }}"/>


	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
@if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif
@include('navbar')
	<!-- Page top Section end -->
	<section class="page-top-section set-bg" data-setbg="{{  asset('Images/page-top-bg/4.jpg') }}" style="margin-top: 122px;">
		<div class="container">
			<h2>Contact</h2>
			<nav class="site-breadcrumb">
				<a class="sb-item" href="/home">Home</a>
				<span class="sb-item active">Contact</span>
			</nav>
		</div>
	</section>
	<!-- Page top Section end -->

	<!-- Contact Section end -->
	<section class="contact-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<div class="contact-text">
						<h2>Get in touch</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tem por incididunt ut labore et dolore mag na aliqua.  Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos hime-naeos. Suspendisse potenti. </p>
						<ul>
							<li><i class="flaticon-032-placeholder"></i>1525  Loans Lane, Los Angeles, CA</li>
							<li><i class="flaticon-029-telephone-1"></i>+1 (603)535-4592</li>
							<li><i class="flaticon-025-arroba"></i>hello@youremail.com</li>
							<li><i class="flaticon-038-wall-clock"></i>Everyday: 06:00 -22:00</li>
						</ul>
						<div class="social-links">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-instagram"></i></a>
							<a href="#"><i class="fa fa-linkedin"></i></a>
							<a href="#"><i class="fa fa-pinterest"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-youtube-play"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-8">										
				<form class="contact-form" action="{{ route('userMessage') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<input type="text" name="name" placeholder="Your Name" required>
							@if ($errors->has('name'))
							<span style="color: red;">{{ $errors->first('name') }}</span>
							@endif
						</div>
						<div class="col-md-6">
							<input type="email" name="email" placeholder="Your E-mail" required>
							@if ($errors->has('email'))
								<span style="color: red;">{{ $errors->first('email') }}</span>
							@endif
						</div>
						<div class="col-md-12">
							<input type="text" name="subject" placeholder="Subject" required>
							@if ($errors->has('subject'))
								<span style="color: red;">{{ $errors->first('subject') }}</span>
							@endif
							<textarea name="message" placeholder="Your Message" required></textarea>
							@if ($errors->has('message'))
								<span style="color: red;">{{ $errors->first('message') }}</span>
							@endif
						</div> 
						<button class="site-btn" type="submit">Send Message</button>
					</div>
				</form>
				</div>
			</div>
			<div class="map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d10784.188505644011!2d19.053119335158936!3d47.48899529453826!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1543907528304" style="border:0" allowfullscreen></iframe>
			</div>
		</div>
	</section>
	<!-- Contact Section end -->
	<!-- Score Section end -->

	
@include('footer')
	
		
	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('js\jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js\bootstrap.min.js') }}"></script>
	<script src="{{ asset('js\jquery.slicknav.min.js') }}"></script>
	<script src="{{ asset('js\owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js\main.js') }}"></script>

	</body>
</html>
