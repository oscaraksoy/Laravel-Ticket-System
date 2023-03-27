<x-layouts.with-title
    title="Add User"
    subtitle="You can add new user in this page."
>
    <x-table-confirmation-modal
        icon="fa-solid fa-eraser"
        title="Are you sure you want to delete this item?"
        subtitle="Be careful! This item will be deleted forever!" />
    <form action="" method="post" class="flex flex-col h-full rounded-md">
        @csrf
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="name">
                Name
            </label>
            <input
                class="border border-gray-300 p-2 w-full rounded"
                type="text"
                name="name"
                id="name"
                required
            />
            @error("name")
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="username">
                Username
            </label>
            <input
                class="border border-gray-300 p-2 w-full rounded"
                type="text"
                name="username"
                id="username"
                required
            />
            @error("username")
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="password">
                Password
            </label>
            <input
                class="border border-gray-300 p-2 w-full rounded"
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
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="email">
                E-Mail
            </label>
            <input
                class="border border-gray-300 p-2 w-full rounded"
                type="email"
                name="email"
                id="email"
                required
            />
            @error("email")
            <p class="text-red-500 text-xs mt-1">
                {{ $message }}
            </p>
            @enderror
        </div>
        <div class="mb-6 w-1/2">
            <label class="block mb-4 uppercase font-medium text-xs text-gray-500 text" for="role">
                Role
            </label>
            <select name="role" class="px-4 py-2 bg-white w-full rounded border">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
            @error("role")
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
