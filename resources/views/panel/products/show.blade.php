<x-layouts.with-title
    title="Product: {{ $product->name }}"
    subtitle="You can edit the category in this page."
>
    <x-table-confirmation-modal
        icon="fa-solid fa-eraser"
        title="Are you sure you want to delete this item?"
        subtitle="Be careful! This item will be deleted forever!" />
    <form action="/admin/products/{{ $product->id }}" method="post" class="flex flex-col h-full rounded-md">
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
                value="{{ $product->id }}"
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
                value="{{ $product->created_at }}"
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
                value="{{ $product->name }}"
                required
            />
            @error("name")
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 w-1/2">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="product_category_id">
                Categories
            </label>
            <select class="mt-2 px-4 py-2 bg-white w-full rounded border" name="product_category_id">
                @foreach($categories as $parentCategory => $subs)
                    <option class="text-red-500 font-medium" disabled>
                        {{ $parentCategory }}
                    </option>
                    @foreach($subs as $sub)
                        <option value="{{ $sub->id }}" {{ $sub->id == $product->product_category_id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                    <br>
                @endforeach
            </select>
            @error("product_category_id")
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
            @enderror
        </div>
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
