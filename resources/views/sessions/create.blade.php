<x-layout>
    <div class="flex justify-center items-center h-full">
        <div class="w-1/4 max-w-xl border border-gray-200 p-6 rounded-xl bg-white">
            <h1 class="font-bold text-center">Log In!</h1>
            <form action="/" method="post" class="mt-12">
                @csrf
                <div class="mb-8">
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
                        Log In
                    </button>
                </div>
            </form>
            <div class="text-center w-full">
                Don't you have an account? <a href="/register" class="text-blue-500 hover:cursor-pointer hover:font-bold">Sign in!</a>
            </div>
        </div>
    </div>
</x-layout>
