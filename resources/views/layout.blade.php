<!doctype html>
<html lang="fr">
<head>
    @include('layout.head')
    @include('layout.style')
</head>
<body>
<div class="container">
    @include('component.errors')
@yield('content')
</div>
@include('layout.script')
</body>
</html>