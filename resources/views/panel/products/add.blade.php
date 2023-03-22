<x-layouts.with-title title="Add Product" subtitle="You can add new product in this page.">
    <div class="mx-auto rounded-xl max-w-4xl bg-white p-6">
        <div class="w-full">
            <h1 class="font-bold text-xl">New</h1>
            <hr class="divide-x-reverse my-5"/>
        </div>
        <div class="flex flex-row mt-5 w-full">
            <p>
                About Product
            </p>
            <form action="/admin/products/add" method="post" class="flex-1 ml-24">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="name">
                        Name
                    </label>
                    <input
                        class="border border-gray-200 p-2 w-full rounded"
                        type="text"
                        name="name"
                        id="name"
                        value="{{ old("name") }}"
                        required
                    />

                    @error("name")
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="product_category_id">
                        Categories
                    </label>
                    <select class="mt-2 px-4 py-2 bg-white w-full rounded border" name="product_category_id">
                        @foreach($categories as $parentCategory => $subs)
                            <option class="text-red-500 font-medium" disabled>
                                {{ $parentCategory }}
                            </option>
                            @foreach($subs as $sub)
                                <option value="{{ $sub->id }}">
                                    &emsp;{{ $sub->name }}
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
                <div class="mb-6 flex justify-start">
                    <button type="submit" class="w-64 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 transition-all ease-in-out">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.with-title>
