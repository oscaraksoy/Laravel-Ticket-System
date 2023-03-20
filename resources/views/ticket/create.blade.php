<x-layout>
    <x-navbar />
        <div class="mx-auto mt-10 rounded-xl max-w-4xl bg-white p-6">
                <div class="w-full">
                    <h1 class="font-bold text-xl">Create Ticket</h1>
                    <hr class="divide-x-reverse my-5"/>
                </div>
                <div class="flex flex-row mt-5 w-full">
                    <p>
                        New Ticket
                    </p>
                    <form action="/tickets/create" method="post" class="flex-1 ml-24">
                        @csrf
                        <div class="mb-8">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="title">
                                Title
                            </label>
                            <input
                                class="border border-gray-200 p-2 w-full rounded"
                                type="text"
                                name="title"
                                id="title"
                                value="{{ old("title") }}"
                                required
                            />

                            @error("title")
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="products">
                                Products
                            </label>
                            <select class="w-full h-12 bg-white border-gray-200 border rounded" name="product">
                                @foreach($parentCategories as $parentCategory => $subcategories)
                                    <option value="" class="text-red-500 font-bold" disabled>
                                        - {{ $parentCategory}}
                                    </option>
                                    @foreach($subcategories as $subcategory => $products)
                                        <option value="" class="text-red-400 font-medium" disabled>
                                            &emsp;- {{ $subcategory }}
                                        </option>
                                        @foreach($products as $product)
                                            <option value="{{ $product->id }}" class="font-normal">
                                                &emsp;&emsp;{{ $product->name }}
                                            </option>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            @error("products")
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-8">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="categories">
                                Categories
                            </label>
                            <select class="w-full h-12 bg-white border-gray-200 border rounded" name="category">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error("categories")
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block mb-2 uppercase font-bold text-xs text-gray-700 text" for="explanation">
                                Explanation
                            </label>
                            <textarea
                                class="border border-gray-200 p-2 w-full"
                                rows="6"
                                name="explanation"
                                id="explanation"
                                required
                            ></textarea>
                            @error("explanation")
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mb-6 flex justify-start mt-12">
                            <button type="submit" class="w-64 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 transition-all ease-in-out">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
</x-layout>
