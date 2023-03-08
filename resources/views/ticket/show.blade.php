<x-layout>
    @if(auth()->user()->role->name == 'staff')
        <x-staff.navbar />
    @elseif(auth()->user()->role->name == 'user')
        <x-navbar />
    @endif
    <div class="px-6 py-4">
        <div class="flex flex-row items-center justify-between p-4 bg-white rounded-tl-md rounded-tr-md">
            <div class="flex flex-row space-x-2 border border-blue-500 rounded">
                <div class="px-4 py-2">{{ $ticket->user->name }}</div>
                <div class="px-4 py-2 bg-blue-500 text-white">Ticket #{{ $ticket->id }}</div>
            </div>
            <div class="flex flex-row space-x-2 items-center">
                <div class="px-4 py-2 border border-blue-500 rounded text-sm ">
                    {{ $ticket->product->name }}
                </div>
                <div class="px-4 py-2 border border-blue-500 rounded text-sm">
                    {{ $ticket->category->name }}
                </div>
            </div>
        </div>
        <hr class="divider "/>
        <div class="flex flex-row h-full">
            <div class="px-4 py-6 w-1/4 space-y-6">
                <div class="space-y-2">
                    <h1>Requestor</h1>
                    <div class="px-4 py-2 bg-white w-full rounded border">
                        {{ $ticket->user->name }}
                    </div>
                </div>
                <div class="space-y-2">
                    <h1>Email</h1>
                    <div class="px-4 py-2 bg-white w-full rounded border">
                        {{ $ticket->user->email}}
                    </div>
                </div>
                @can('staff')
                    <form action="/tickets/ticket/{{ $ticket->id }}" method="post" class="space-y-6">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-2">
                            <h1>Statuses</h1>
                            <div class="flex flex-row space-x-2">
                                <select name="status" class="px-4 py-2 bg-white w-full rounded border">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}" {{ $status->id == $ticket->status->id ? 'selected' : ''}}>
                                            {{ $status->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <h1>Priority</h1>
                            <div class="flex flex-row space-x-2">
                                <select name="priority" class="px-4 py-2 bg-white w-full rounded border">
                                    @foreach($priorities as $priority)
                                        <option value="{{ $priority->id }}" {{ $priority->id == $ticket->priority->id ? 'selected' : ''}}>
                                            {{ $priority->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="w-full mt-8 px-4 py-2 rounded-md text-white bg-blue-500">
                            Update
                        </button>
                    </form>
                @elsecan('user')
                    <div class="space-y-2">
                        <h1>Status</h1>
                        <div class="px-4 py-2 bg-white w-full rounded border">
                            {{ $ticket->status->name}}
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h1>Priority</h1>
                        <div class="px-4 py-2 bg-white w-full rounded border">
                            {{ $ticket->priority->name}}
                        </div>
                    </div>
                @endcan
            </div>
            <div class="flex-1 bg-white px-16 py-8 border-l space-y-6">
                <div class="max-w-7xl break-words">
                    <h1 class="text-2xl">{{ $ticket->title }}</h1>
                    <small class="text-gray-500">from {{ $ticket->user->name }}</small>
                </div>
                <div>
                    <div class="relative text-blue-500 font-bold top-[0.1rem] p-6 border-b-2 border-blue-500 inline-block">
                        Explanation
                    </div>
                    <div class="border">
                    <div class="max-w-7xl py-6 px-6 border-b">
                        <p class="break-words">
                            {{ $ticket->explanation }}
                        </p>
                    </div>
                        <div class="px-2 py-4">
                            Attachments
                        </div>
                    </div>
                </div>
                <div class="flex flex-row items-center border-b">
                    <div class="flex flex-row items-center border-b-2 border-blue-500">
                        <h1 class="relative top-[0.1rem]text-lg font-bold p-6 text-blue-500">Replies</h1>
                        <div class="w-6 h-6 bg-blue-500 rounded-full font-bold flex items-center justify-center text-sm text-white">
                            {{ $replies->count() }}
                        </div>
                    </div>
                </div>
                <div class="px-4 py-2 space-y-12">
                    <div>
                        <h2 class="text-lg font-medium mb-6">Your Comment</h2>
                        <form action="/tickets/{{ $ticket->id }}/replies/" method="post">
                            @csrf
                            <textarea name="reply" placeholder="Write..." class="w-full border px-4 py-3" rows="4"></textarea>
                            @error('reply')
                            <p class="text-red-500 text-xs mt-1">
                                {{ $message }}
                            </p>
                            @enderror
                            <div class="flex flex-1 justify-end">
                                <button class="px-12 text-white py-2 rounded-md bg-blue-500" type="submit">
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr class="divider"/>
                    @if($replies->count())
                        @foreach($replies as $reply)
                            <x-ticket-reply :reply='$reply' :ticket='$ticket'/>
                            @unless($loop->last)
                                <hr class="divider" />
                            @endunless
                        @endforeach
                    @else
                        <p class="text-center">No reply yet. Check back later!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</x-layout>
