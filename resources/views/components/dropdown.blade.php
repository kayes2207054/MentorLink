@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-2 rounded-3 border border-soft shadow-lg'])

@php
$alignmentClasses = match ($align) {
    'left' => 'start-0',
    'top' => 'origin-top',
    default => 'end-0',
};

$widthStyle = match ($width) {
    '48' => 'width: 12rem; min-width: 12rem;',
    default => $width,
};
@endphp

<div class="position-relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open" class="cursor-pointer">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="position-absolute z-3 mt-2 {{ $alignmentClasses }}"
            style="display: none; {{ $widthStyle }}"
            @click="open = false">
        <div class="{{ $contentClasses }}" style="background: var(--ml-card-bg); backdrop-filter: blur(16px); z-index: 1050;">
            {{ $content }}
        </div>
    </div>
</div>
