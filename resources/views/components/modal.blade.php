@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$maxWidthStyle = [
    'sm' => 'max-width: 300px;',
    'md' => 'max-width: 500px;',
    'lg' => 'max-width: 800px;',
    'xl' => 'max-width: 1140px;',
    '2xl' => 'max-width: 1140px;',
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)].filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-hidden');
        }
    })"
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="position-fixed top-0 start-0 w-100 h-100 px-4 py-5"
    style="display: {{ $show ? 'block' : 'none' }}; z-index: 1055; overflow-y: auto;"
>
    <div
        x-show="show"
        class="position-fixed top-0 start-0 w-100 h-100 transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="mx-auto card card-elevated overflow-hidden shadow-lg transition-all w-100 position-relative"
        style="{{ $maxWidthStyle }} margin-top: 10vh;"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-middle-y scale-95"
        x-transition:enter-end="opacity-100 translate-middle-y scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-middle-y scale-100"
        x-transition:leave-end="opacity-0 translate-middle-y scale-95"
    >
        {{ $slot }}
    </div>
</div>
