<!DOCTYPE html>
<html lang="en">
<head>
	<title>LOANS2GO | Loans HTML Template</title>
	<meta charset="UTF-8">
	<meta name="description" content="loans HTML Template">
	<meta name="keywords" content="loans, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- Favicon -->
	<!-- <link href="img/favicon.ico" rel="shortcut icon"/> -->

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
	
@include('navbar')

@include('footer')
	
	<!--====== Javascripts & Jquery ======-->
	<script src="{{ asset('js\jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('js\bootstrap.min.js') }}"></script>
	<script src="{{ asset('js\jquery.slicknav.min.js') }}"></script>
	<script src="{{ asset('js\owl.carousel.min.js') }}"></script>
	<script src="{{ asset('js\main.js') }}"></script>

	

	</body>
</html>
