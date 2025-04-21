<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Optional: Add custom CSS *after* Bootstrap -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    <div id="app">
        {{-- Include Breeze navigation if it exists, otherwise our custom navbar --}}
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @else
            <x-navbar /> {{-- Use only the navbar --}}
        @endif

        <!-- Page Content -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3" id="sidebar-container" style="margin-left: -250px; transition: margin-left 0.3s ease;">
                    <x-sidebar />
                </div>
                <main class="col-md-9 ms-sm-auto col-lg-9 px-md-4 py-4">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Optional: Add custom JS *after* Bootstrap -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarContainer = document.getElementById('sidebar-container');
            const sidebarToggle = document.createElement('button');
            sidebarToggle.classList.add('btn', 'btn-light', 'mb-3');
            sidebarToggle.style.cssText = 'position: absolute; top: 10px; left: 10px;';
            sidebarToggle.innerHTML = '<i class="bi bi-arrow-right"></i>';
            document.body.appendChild(sidebarToggle);

            let isCollapsed = true;

            sidebarToggle.addEventListener('click', function() {
                if (isCollapsed) {
                    sidebarContainer.style.marginLeft = '0';
                    sidebarToggle.innerHTML = '<i class="bi bi-arrow-left"></i>';
                } else {
                    sidebarContainer.style.marginLeft = '-250px';
                    sidebarToggle.innerHTML = '<i class="bi bi-arrow-right"></i>';
                }
                isCollapsed = !isCollapsed;
            });
        });
    </script>
</body>
</html>
