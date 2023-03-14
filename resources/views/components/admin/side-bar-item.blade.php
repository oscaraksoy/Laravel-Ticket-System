@props([
    'icon',
    'url',
    'label',
    'active' => false
    ])

<div class=
         "flex justify-between items-center w-full font-normal text-gray-600
         {{ $active == true ? 'bg-blue-300 font-medium rounded-lg' : '' }}
         {{ request()->path() == $url ? 'bg-blue-100 text-blue-800 font-medium rounded-lg' : '' }}
         ">
    <a href="/{{ $url }}" class="hover:bg-blue-200 hover:text-blue-800 hover:font-medium w-full p-3 rounded-lg ease-in-out transition-all duration-100">
        <div class="space-x-4 flex flex-row items-center">
            <x-tabler-icon-svg svg="{{$icon}}"/>
            <span>{{ $label }}</span>
        </div>
    </a>
</div>
