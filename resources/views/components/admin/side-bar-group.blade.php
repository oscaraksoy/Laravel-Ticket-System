@props(['title'])
<div class="py-2 px-6 text-sm border-b-1 border-b last:border-0">
    <div class="px-2 mb-4">
        <x-admin.side-bar-title title="{{ $title }}"/>
    </div>
    <div class="space-y-2">
        {{ $slot }}
    </div>
</div>
