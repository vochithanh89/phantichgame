@props([
    'title' => '',
    'description' => '',
    'image' => config('app.default_image'),
])

<div class="relative -mt-5 h-80 w-full bg-cover bg-fixed" style="background-image: url('{{ $image }}')">
    <div class="absolute inset-0 w-full h-full bg-black/80"></div>
    <div class="absolute inset-0 w-full h-full flex flex-col items-center z-10">
        <div class="container">
            <h1 class="text-center mb-4 text-4xl font-extrabold tracking-wider leading-tight text-white">
                {{ $title }}
            </h1>
            <p class="text-center text-white text-lg">
                {{ $description }}
            </p>
        </div>
    </div>
</div>