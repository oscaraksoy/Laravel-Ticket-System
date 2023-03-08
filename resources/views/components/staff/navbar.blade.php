<nav class="w-full flex justify-between items-center px-6 py-6 border border-b-gray-500 bg-white">
    <p class="font-medium">
        Ticket System
    </p>
    <ul class="flex flex-row space-x-6 font-medium">
        <li>
            <a href="/staff/dashboard">
                Dashboard
            </a>
        </li>
        <li>
            <a href="/staff/tickets">
                Tickets
            </a>
        </li>
        <li>
            <form action="/logout" method="post">
                @csrf
                <button type="submit" class="font-medium">Logout</button>
            </form>
        </li>
    </ul>
</nav>
