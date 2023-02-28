@props(['name', 'explanation', 'date'])
<div class="flex flex-row items-center justify-between space-x-6">
    <div class="flex flex-row space-x-6">
        <div class="w-12 h-12 rounded-full bg-blue-500"></div>
        <div class="flex flex-col">
            <p class="font-medium text-md">{{ $name }}</p>
            <p class="text-gray-500 text-sm max-w-5xl mt-3">{{ $explanation }}</p>
        </div>
    </div>
    <p class="text-sm text-gray-300">
        {{ $date }}
    </p>
</div>
