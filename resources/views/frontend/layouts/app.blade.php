<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Classic Blog')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/frontend.css'])
</head>

<body>

@include('frontend.partials.header')
@include('frontend.partials.navbar')

<main class="main-wrapper">
    <div class="container">
        @yield('content')
    </div>
</main>

@include('frontend.partials.footer')

</body>
</html>