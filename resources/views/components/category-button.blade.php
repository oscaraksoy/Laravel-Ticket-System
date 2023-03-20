@props(['icon' => 'category', 'href' => '#', 'label', 'active' => false])
<button href="{{ $href }}"
        {{
            $attributes->merge(['class' => 'flex flex-row items-center justify-between px-3 py-2 border border-gray-200 rounded-md w-64 transition-all ease-in-out duration-100'])
        }}>
    <div class="flex flex-row items-center">
        <div class="px-3 py-2">
            <x-tabler-icon-svg svg="{{ $icon }}"/>
        </div>
        <span class="ml-3 font-medium">{{ $label }}</span>
    </div>
    <x-tabler-icon-svg svg="chevron-right" class="w-5 h-5"/>
</button>
