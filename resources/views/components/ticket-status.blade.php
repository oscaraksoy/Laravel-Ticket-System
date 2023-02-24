@props(['type'])
<div class="rounded px-6 py-2 text-center w-24 text-white {{ $type == 0 ? 'bg-red-500' : 'bg-green-500'}}">
    <span class="font-bold">
        {{ $type == 0 ? 'Closed' : 'Open' }}
    </span>
</div>
