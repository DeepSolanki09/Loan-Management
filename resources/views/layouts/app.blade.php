<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ asset('css\new\google_fonts') }}" rel="stylesheet">
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
</head>
<body>
    <div class="container">
        @yield('content')  <!-- This will display the page-specific content -->
    </div>

    <footer>
        <!-- Add footer content here (optional) -->
    </footer>
</body> 
</html>
