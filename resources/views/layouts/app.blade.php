@php
    use App\Models\BlogCategory; 
    use App\Models\Tag; 
    $categories = BlogCategory::where(['parent_id' => null])->limit(20)->get();
@endphp


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
            <header class="sticky top-0 lg:static z-50">
                @if (!empty($header))
                    {{ $header }}
                @else   
                    @include('/layouts/partials/navbar', [
                        'categories' => $categories
                    ])
                @endif
            </header>

            <!-- Page Content -->
            <main>
                @include('/layouts/partials/category-navbar', [
                    'categories' => $categories
                ])
                <div class="py-5">
                    {{ $slot }}
                </div>
            </main>

            @if (!empty($footer))
                {{ $footer }}
            @else   
                @include('/layouts/partials/footer', [
                    'categories' => $categories
                ])
            @endif
        </div>

    </body>
</html>
