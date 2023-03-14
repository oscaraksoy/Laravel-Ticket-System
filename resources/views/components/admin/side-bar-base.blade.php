<aside class="flex flex-col justify-between w-64 bg-gray-50 border-r border-r-gray-900 h-screen text-sm">
        <h1 class="font-medium text-2xl mx-4 my-4">Ticket System</h1>
    <div class="px-4">
        <div class="flex flex-row items-center justify-between px-4 py-4 bg-white border rounded-md">
            <div class="flex flex-row space-x-4">
                <div class="flex items-center justify-center text-blue-500 text-xl w-12 h-12 rounded-full bg-gray-100">
                    {!!
                        (auth()->user()->role->name == "admin" ? '<i class="fa-solid fa-user-ninja"></i>' :
                        (auth()->user()->role->name == "staff" ? '<i class="fa-solid fa-user-tie"></i>' :
                        (auth()->user()->role->name == "user" ? '<i class="fa-solid fa-user"></i>' : '')))
                    !!}
                </div>
                <div class="flex flex-col">
                <span class="font-bold">
                    {{ ucwords(auth()->user()->name) }}
                </span>
                    <span class="font-normal">
                    {{ ucwords(auth()->user()->role->name) }}
                </span>
                </div>
            </div>
            <form action="/logout" method="post">
                @csrf
                <button type="submit">
                    <x-tabler-icon-svg svg="logout" class="text-lg hover:cursor-pointer text-xl hover:text-red-500 duration-100 transition-all ease-in-out"/>
                </button>
            </form>
        </div>
    </div>
        {{ $slot }}
</aside>
