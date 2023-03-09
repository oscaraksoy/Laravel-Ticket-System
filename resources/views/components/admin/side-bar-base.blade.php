<aside class="flex flex-col justify-between w-80 border-r border-r-gray-900 h-screen">
    <div class="py-4 px-6">
        <h1 class="font-bold text-2xl mb-6">Ticket System</h1>
        <div class="space-y-12">
            {{ $slot }}
        </div>
    </div>
    <div class="flex flex-row items-center justify-between bg-gray-200 px-4 py-6">
        <div class="flex flex-row space-x-4">
            <div class="flex items-center justify-center text-red-500 text-xl w-12 h-12 rounded-full bg-gray-300">
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
                <i class="fa-solid fa-right-from-bracket text-lg hover:cursor-pointer text-xl hover:text-red-500 duration-100 transition-all ease-in-out"></i>
            </button>
        </form>
    </div>
</aside>
