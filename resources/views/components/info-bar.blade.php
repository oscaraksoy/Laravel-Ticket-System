@props(['title', 'subtitle', 'icon'])
<div class="p-6 bg-white mt-6 flex flex-row items-center rounded-xl">
    <div class="w-16 rounded-full h-16 bg-blue-500 flex items-center justify-center text-white">
        <x-tabler-icon-svg svg="{{ $icon }}"/>
    </div>
    <div class="flex flex-col ml-6">
        <p class="font-medium">{{ $title }}</p>
        <p class="font-bold text-lg">{{ $subtitle }}</p>
    </div>
</div>
