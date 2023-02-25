<x-layout>
    <x-navbar />
    <div class="mx-auto px-48 py-10 overflow-x-auto">
        <div class="bg-white rounded-xl p-3">
            <h1 class="mt-6 text-lg font-medium">Your tickets</h1>
            <hr class="divider my-6" />
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Title
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Product
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Category
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($tickets as $ticket)
                    <tr class="bg-white {{ $loop->last ? '' : 'border-b' }} hover:bg-gray-50 ease-in-out duration-100">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="hover:cursor-pointer" href="/tickets/{{ $ticket->id }}">
                                {{ $ticket->title }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            <a href="/tickets/{{ $ticket->id }}">
                                {{ $ticket->product->name }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->category->name }}
                        </td>
                        <td class="px-6 py-4 flex items-center justify-center">
                            <x-ticket-status type="{{ $ticket->status }}" />
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
            <div class="mt-6 mb-2 px-4">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
    <x-create-ticket-float-button />

</x-layout>
