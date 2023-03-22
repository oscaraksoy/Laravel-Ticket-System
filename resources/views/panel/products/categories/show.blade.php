<x-layouts.with-title
    title="Product Category: {{ $productCategory->name }}"
    subtitle="You can edit the product category in this page."
>
    <form action="/admin/product-categories/{{ $productCategory->id }}" method="post" class="flex flex-col h-full rounded-md">
        @csrf
        @method('PATCH')
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="id">
                ID
            </label>
            <input
                class="border bg-gray-100 border-gray-300 w-full p-2 rounded"
                type="text"
                name="id"
                id="id"
                value="{{ $productCategory->id }}"
                readonly
            />
        </div>
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="created_at">
                Created At
            </label>
            <input
                class="border bg-gray-100 border-gray-300 p-2 w-full rounded"
                type="text"
                name="created_at"
                id="created_at"
                value="{{ $productCategory->created_at }}"
                readonly
            />
        </div>
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="name">
                Name
            </label>
            <input
                class="border border-gray-300 p-2 w-full rounded"
                type="text"
                name="name"
                id="name"
                value="{{ $productCategory->name }}"
                required
            />
            @error("name")
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
            @enderror
        </div>
        @if($productCategory->parent_id != null )
            <div class="mb-6 w-1/2">
                <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="parentCategory">
                    Parent Category
                </label>
                <select name="parentCategory" class="mt-2 px-4 py-2 bg-white w-full rounded border">
                    <option selected disabled>
                        Choose...
                    </option>
                    @foreach($parentCategories as $category)
                        <option value="{{ $category->id }}" {{ $productCategory->parent_id == $category->id ? 'selected' : ''}}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error("parentCategory")
                <p class="text-red-500 text-xs mt-1">
                    {{ $message }}
                </p>
                @enderror
            </div>
        @endif
        <div class="flex flex-end w-1/2">
            <button type="submit" class="p-2 rounded-md w-full transition-all ease-in-out duration-100 bg-blue-500 text-white hover:bg-blue-400 ">
                Submit
            </button>
            <a href="{{ url()->previous() }}" class="p-2 text-center rounded-md ml-6 w-full transition-all ease-in-out duration-100 bg-blue-500 text-white hover:bg-blue-400 ">
                Back
            </a>
        </div>
    </form>
</x-layouts.with-title>
