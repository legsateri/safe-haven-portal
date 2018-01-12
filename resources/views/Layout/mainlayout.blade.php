<!DOCTYPE html>
<html lang="en">
<head>
    @include('Layout.partials.head')
</head>
<body>
@include('Layout.partials.nav')
<main role="main">
@yield('content')
</main>
@include('Layout.partials.footer')
@include('Layout.partials.footer-scripts')
</body>
</html>
