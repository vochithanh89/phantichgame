@props([
    'title' => '',
    'description' => '',
])

<div class="max-w-4xl mb-8">
    <h1 class="mb-1 text-default text-2xl lg:text-3xl font-bold">
        {{ $title }}
    </h1>
    <p class="max-w-screen-md text-gray-500 md:text-lg">
        {{ $description }}
    </p>
</div>
