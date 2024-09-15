@props(['post'])

<div class="">
    <div class="p-4 border rounded-xl w-full">
        <div class="flex items-center justify-start gap-4 font-semibold">
            <figure class="flex-none">
                <a href="{{ $post->url }}">
                    <img 
                        alt="{{ $post->alias }}" 
                        loading="lazy"
                        class="rounded-md w-32 h-20 object-cover"
                        src="{{ $post->thumbnail_url }}"
                    />
                </a>
            </figure>
            <div>
                <h3>
                    <a 
                        href="{{ $post->url }}"
                        class="line-clamp-2 font-semibold text-base text-default leading-5 hover:text-primary transition hover:duration-300 line-clam-2"
                    >
                        {{ $post->name }}
                    </a>
                </h3>
                <p class="mt-2.5 text-content text-sm">{{ $post->created_at_string }}</p>
            </div>
        </div>
    </div>
</div>