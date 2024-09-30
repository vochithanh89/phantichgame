<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="text-[14px] lg:text-[16px]">
    <head>
        @include('/layouts/partials/head')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=noto-sans:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @include('/layouts/partials/scripts')
    </head>
    <body class="antialiased dark:bg-gray-900">

        <div class="min-h-screen flex flex-col justify-between">
            <!-- Page Heading -->
            <header class="sticky top-0 z-50">
                @include('/layouts/partials/navbar')
            </header>

            <!-- Page Content -->
            <main>
                <div class="py-5">
                    {{ $slot }}
                </div>
            </main>

            <footer>
                @include('/layouts/partials/footer')
            </footer>
            @include('/layouts/partials/plugin-chat')
        </div>

    </body>
</html>
