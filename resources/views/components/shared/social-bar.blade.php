@props([
    'post' => null,
])

<div class="flex items-center gap-4">
    <button x-data="{
        handleCopy: () => {
            navigator.clipboard.writeText('{{ url()->current() }}');
            alert('Đã sao chép')
        }
    }" @click="handleCopy" class="text-gray-400 hover:text-primary transition-all">
        <x-heroicon-m-link class="size-7" />
    </button>
    <button class="text-gray-400 hover:text-primary transition-all" x-data="{
        shareUrl: '{{ 'https://www.facebook.com/sharer/sharer.php?u=' . url()->current() }}',
        handleShare: () => {
            window.open($data.shareUrl, 'Facebook', 'height=600,width=600,top=50%,left=50%');
        }
    }" @click="handleShare">
        <svg class="size-7 fill-current"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64h98.2V334.2H109.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H255V480H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64z"/></svg>
    </button>
    <button class="text-gray-400 hover:text-primary transition-all" x-data="{
        shareUrl: '{{ 'https://twitter.com/intent/post?text=' . $post->name . '&url=' . urlencode(url()->current()) }}',
        handleShare: () => {
            window.open($data.shareUrl, 'Facebook', 'height=600,width=600,top=50%,left=50%');
        }
    }" @click="handleShare">
        <x-carbon-logo-twitter class="size-7" />
    </button>
</div>
