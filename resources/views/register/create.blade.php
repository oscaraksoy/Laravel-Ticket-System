<x-layout>
    <div class="flex justify-center items-center h-full">
        <div class="w-1/4 max-w-xl border border-gray-200 p-6 rounded-xl bg-white">
            <h1 class="font-bold text-center">Register</h1>
            <form action="/register" method="post" class="mt-12">
                @csrf
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700 text" for="name">
                        Name
                    </label>
                    <input
                        class="border border-gray-200 p-2 w-full rounded"
                        type="name"
                        name="name"
                        value="{{ old("name") }}"
                        id="name"
                        required
                    />
                    @error("name")
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="username">
                        Username
                    </label>
                    <input
                        class="border border-gray-200 p-2 w-full rounded"
                        type="username"
                        name="username"
                        id="username"
                        value="{{ old("username") }}"
                        required
                    />

                    @error("username")
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700 text" for="email">
                        Email
                    </label>
                    <input
                        class="border border-gray-200 p-2 w-full rounded"
                        type="email"
                        name="email"
                        value="{{ old("email") }}"
                        id="email"
                        required
                    />
                    @error("email")
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700 text" for="password">
                        Password
                    </label>
                    <input
                        class="border border-gray-200 p-2 w-full rounded"
                        type="password"
                        name="password"
                        id="password"
                        required
                    />
                    @error("password")
                    <p class="text-red-500 text-xs mt-1">
                        {{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="mb-6 flex justify-center mt-12">
                    <button type="submit" class="w-full bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500 transition-all ease-in-out">
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
