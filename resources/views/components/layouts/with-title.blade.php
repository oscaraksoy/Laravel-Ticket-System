@props(['title', 'subtitle'])
<x-layout>
    <div class="flex flex-row h-screen bg-white">
        <x-admin.side-bar />
        <div class="flex flex-col w-full flex-1">
            <div class="border-b border-b-gray-300 p-4">
                <h1 class="text-2xl font-bold">{{ $title }}</h1>
                <small class="text-gray-500">{{ $subtitle }}</small>
            </div>
            <div class="p-2 h-full">
                <div class="px-3 py-6 bg-white rounded-sm h-full">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</x-layout>
