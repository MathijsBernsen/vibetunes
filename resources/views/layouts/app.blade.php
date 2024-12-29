<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Add any CSS or meta tags here -->
</head>
<body>
<header>
    <h1>{{ env('APP_NAME') }}</h1>
    <!-- Add navigation or header content -->
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }} </p>
    <!-- Add footer content -->
</footer>
</body>
</html>
