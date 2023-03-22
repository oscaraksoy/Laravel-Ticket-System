<x-layouts.with-title title="Add Category" subtitle="You can add new category in this page.">
    <div class="mx-auto rounded-xl max-w-4xl bg-white p-6">
        <div class="w-full">
            <h1 class="font-bold text-xl">New</h1>
            <hr class="divide-x-reverse my-5"/>
        </div>
        <div class="flex flex-row mt-5 w-full">
            <p>
                About Category
            </p>
            <form action="" method="post" class="flex-1 ml-24">
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
                <div class="mb-6 flex justify-start">
                    <button type="submit" class="w-64 bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 transition-all ease-in-out">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-layouts.with-title>
