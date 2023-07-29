<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @livewireStyles
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

<body style="background-color: @yield('bg-root')">
    @yield('content')
    @livewireScripts
    @if (session()->has('success'))
        <script>
            Toastify({
                text: '{{ session('success') }}',
                duration: 3000,
                style: {
                    background: '#198754'
                }
            }).showToast()
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Toastify({
                text: '{{ session('error') }}',
                duration: 3000,
                style: {
                    background: '#dc3545'
                }
            }).showToast()
        </script>
    @endif
    <script>
        window.addEventListener('toast:success', event => {
            Toastify({
                text: `${event.detail.message}`,
                duration: 3000,
                style: {
                    background: '#198754'
                }
            }).showToast()
        })
        window.addEventListener('toast:error', event => {
            Toastify({
                text: `${event.detail.message}`,
                duration: 3000,
                style: {
                    background: '#dc3545'
                }
            }).showToast()
        })
    </script>
    @yield('scripts')
</body>

</html>
