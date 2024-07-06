<div class="flex flex-col px-4 py-2 mx-auto rounded md:mx-0 max-w-max bg-fuchsia-600 hover:bg-fuchsia-700">
    <a href="{{ $href }}" class="flex items-center justify-center text-white">
        @if($arrowType === 'left')
            <i class="mr-2 fas fa-arrow-left"></i>
        @elseif($arrowType === 'right')
            <i class="mr-2 fas fa-arrow-right"></i>
        @endif
        {{ $text }}
    </a>
</div>
