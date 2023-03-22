<x-layouts.with-title title="Add Product Category" subtitle="You can add new product category in this page.">
    <div class="mx-auto rounded-xl max-w-4xl bg-white p-6">
        <div class="w-full">
            <h1 class="font-bold text-xl">New</h1>
            <hr class="divide-x-reverse my-5"/>
        </div>
        <div class="flex flex-row mt-5 w-full">
            <p>
                About Product Category
            </p>
            <form action="/admin/product-categories/add" method="post" class="flex-1 ml-24">
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
                <div class="mb-6" x-data="{show: false}">
                    <div class="flex flex-row">
                        <input type="checkbox" id="subcategory" x-model="show">
                        <label class="block ml-2 uppercase font-bold text-xs text-gray-700" for="subcategory">
                            Is Subcategory?
                        </label>
                    </div>
                    <div x-show="show" class="mt-4">
                        <label class="block uppercase font-bold text-xs text-gray-700" for="category">
                            Choose Parent Category
                        </label>
                        <select name="category" class="mt-2 px-4 py-2 bg-white w-full rounded border">
                            <option selected disabled>
                                Choose...
                            </option>
                            @foreach($parentCategories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error("category")
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
