<x-layout>
    <x-navbar />
    <div class="mx-auto px-24 py-10 overflow-x-auto">
        <div class="bg-white rounded-xl p-6">
            <h1 class="text-2xl font-medium mb-6">Categories</h1>
            <span x-data="{@foreach($categories as $category)open{{ $category->id }}:false,@endforeach}">
                <div class="flex flex-row">
                <div class="flex flex-col">
                    <div class="space-y-4 mt-4">
                        @foreach($categories as $category)
                            <div
                                @click="
                                open{{$category->id}} = !open{{$category->id}}
                                @foreach($categories as $other)
                                    @if($category->id == $other->id)
                                        @continue($other)
                                    @endif
                                    open{{$other->id}} = false
                                @endforeach">
                                <x-category-button
                                    label="{{ $category->name }}"
                                    ::class="open{{$category->id}} ? 'bg-blue-100 ' : ''"
                                />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col ml-12 mt-6">
                    @foreach($categories as $category)
                        <a
                            href="products/category/{{ $category->id }}"
                            class="text-3xl font-medium mb-6"
                            x-show="open{{$category->id}}" >
                                {{ $category->name }}
                                {!! $counts->contains('name', $category->name)
                                    ? '<span class="text-sm font-normal text-gray-400">has '.$counts->where('name', $category->name)->first()->count.' product.</span>'
                                    : '' !!}
                        </a>
                        @foreach($category->children as $child)
                            <a href="#" class="font-medium hover:text-red-500 transition-all ease-in-out {{ !$loop->first ? 'mt-4' : '' }}" x-show="open{{$category->id}}" >{{ $child->name }}</a>
                        @endforeach
                    @endforeach
                </div>
            </div>
            </span>

        </div>
    </div>
</x-layout>
