<div class="-mt-5 mb-8 py-16 h-[44rem] lg:h-[60vh] bg-gradient-to-br from-secondary-100 to-primary-200">
    <div class="h-full container">
        <div class="h-full grid lg:grid-cols-2 items-center gap-4">
            <div>
                <h1 class="mb-4 text-4xl font-extrabold tracking-wider leading-tight bg-gradient-to-r from-primary-900 to-primary-600 text-transparent bg-clip-text">
                    {{ config('app.title') }}
                </h1>
                <p class="text-default text-xl">
                    {{ config('app.description') }}
                </p>
            </div>
            <div class="flex justify-center lg:justify-end">
                <img class="h-80" src="{{ asset('images/illustration/hero.webp') }}" alt="{{ config('app.name') }}" loading="lazy">
            </div>
        </div>
    </div>
</div>