@props([
    'icon',
    'url',
    'label',
    'active' => false
    ])

<div class=
         "flex justify-between items-center w-full font-normal
         {{ $active == true ? 'bg-gray-300 font-medium rounded-lg' : '' }}
         {{ request()->path() == $url ? 'bg-gray-300 font-medium rounded-lg' : '' }}
         ">
    <a href="/{{ $url }}" class=" hover:bg-gray-300 w-full p-3 rounded-lg hover:font-medium ease-in-out transition-all duration-100">
        <div class="space-x-4">
            <i class="fa-solid {{ $icon }}"></i>
            <span>{{ $label }}</span>
        </div>
    </a>
</div>
