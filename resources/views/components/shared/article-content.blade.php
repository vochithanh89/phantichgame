@props([
    'content' => '',
])

@php
    use PHPHtmlParser\Dom;
    use Illuminate\Support\Str;

    $html = new Dom();
    $html->loadStr($content);
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
        <ul class="mb-8 p-6 space-y-4 rounded-lg border bg-gray-50/30 list-decimal list-inside dark:text-gray-400">
            <p class="mb-6 text-xl font-semibold text-primary-500">
                <i class="mr-1"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512"
                        style="display: inline-block; overflow: visible; box-sizing: content-box; fill: currentcolor; height: 1em; vertical-align: -0.125em;"><!--! Font Awesome Pro 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                        <path
                            d="M40 48C26.7 48 16 58.7 16 72v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V72c0-13.3-10.7-24-24-24H40zM192 64c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zm0 160c-17.7 0-32 14.3-32 32s14.3 32 32 32H480c17.7 0 32-14.3 32-32s-14.3-32-32-32H192zM16 232v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V232c0-13.3-10.7-24-24-24H40c-13.3 0-24 10.7-24 24zM40 368c-13.3 0-24 10.7-24 24v48c0 13.3 10.7 24 24 24H88c13.3 0 24-10.7 24-24V392c0-13.3-10.7-24-24-24H40z">
                        </path>
                    </svg></i>
                Mục lục:
            </p>
            @foreach ($contents as $content)
                <li class="font-medium list-disc list-inside">
                    <a class="text-gray-700 dark:text-gray-400 hover:text-primary-600 dark:hover:text-primary-500 transition-all"
                        href="{{ $content['url'] }}">
                        {!! $content['title'] !!}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
    
    <div id="content">
        {!! $html !!}
    </div>
    
</div>