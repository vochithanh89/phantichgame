@props([
    'post' => null,
])

@php
    use PHPHtmlParser\Dom;
    use Illuminate\Support\Str;

    $html = new Dom();
    $html->loadStr($post->content);
    $contents = [];

    foreach ($html->find('h2') as $h2) {
        $h2->setAttribute('id', Str::slug($h2->text(true)));
        $contents[] = [
            'title' => $h2->text(true),
            'url' => '#' . Str::slug($h2->text(true)),
        ];
    }

@endphp

<div>
    @if (count($contents) > 1)
        <div class="mb-8 p-6 rounded-lg border">
            <p class="mb-4 text-lg font-semibold text-primary-500">
                <i class="mr-1"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                        style="display: inline-block; overflow: visible; box-sizing: content-box; fill: currentcolor; height: 1em; vertical-align: -0.125em;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z">
                        </path>
                    </svg></i>
                Mục lục:
            </p>
            <ul class="ml-4 space-y-2">
                @foreach ($contents as $content)
                    <li class="font-medium">
                        <a class="text-gray-700 hover:text-primary-600 dark:hover:text-primary-500 transition-all"
                            href="{{ $content['url'] }}">
                            {!! $content['title'] !!}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div x-data>
        <div x-ref="content" class="content">
            {!! $html !!}
        </div>
        <div x-data="{isOpen: false}" class="fixed top-1/2 left-[calc((100%-650px)/2-14vw)]">
            <div 
                x-show="isOpen"
                x-transition
                x-init="() => {
                    window.addEventListener('scroll', () => {
                        if (window.scrollY > 200 && (window.scrollY < ($refs.content.clientHeight + 150))) {
                            $data.isOpen = true;
                        } else {
                            $data.isOpen = false;
                        }
                    })
                }"    
            >
                <div class="flex flex-col items-center gap-4">
                    <button @click="window.history.back()" class="text-gray-400 hover:text-primary transition-all">
                        <x-heroicon-s-arrow-left class="size-6" />
                    </button>
                    <button 
                        x-data="{
                            handleCopy: () => {
                                navigator.clipboard.writeText('{{ url()->current() }}');
                                alert('Đã sao chép')
                            }   
                        }"
                        @click="handleCopy" class="text-gray-400 hover:text-primary transition-all">
                        <x-heroicon-m-link class="size-6" />
                    </button>
                    <button class="my-4 border-[4px] border-gray-100 rounded-full border-dashed overflow-hidden">
                        <img src="{{ $post->author->profile_photo_url }}" loading="lazy" alt="{{ $post->slug }}" class="w-12 h-12">
                    </button>
                    <button 
                        class="text-gray-400 hover:text-primary transition-all"
                        x-data="{
                            shareUrl: '{{ 'https://www.facebook.com/sharer/sharer.php?u=' . url()->current() }}',
                            handleShare: () => {
                                window.open($data.shareUrl, 'Facebook', 'height=600,width=600,top=50%,left=50%');
                            }
                        }"
                        @click="handleShare"  
                    >
                        <svg class="size-6 fill-current"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
                    </button>
                    <button 
                        class="text-gray-400 hover:text-primary transition-all"
                        x-data="{
                            shareUrl: '{{ 'https://twitter.com/intent/post?text=' . $post->name . '&url=' . urlencode(url()->current()) }}',
                            handleShare: () => {
                                window.open($data.shareUrl, 'Facebook', 'height=600,width=600,top=50%,left=50%');
                            }
                        }"
                        @click="handleShare"  
                    >
                        <x-carbon-logo-twitter class="size-6" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    
</div>

