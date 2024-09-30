@props([
    'title' => 'Title default',
    'description' => null,
    'size' => 'xl'
])

<div class="max-w-4xl mb-4">
    <h2 class="flex items-stretch gap-3 text-default text-{{ $size }} font-bold">
        <span class="block w-1 bg-primary-500"></span>
        {{ $title }}
    </h2>
    @if ($description)
        <p class="text-gray-500">
            {{ $description }}
        </p>
    @endif
</div>
