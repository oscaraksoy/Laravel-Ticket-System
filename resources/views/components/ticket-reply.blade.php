@props(['reply', 'ticket'])

<div class="flex flex-row items-center justify-between space-x-6" x-data="{openEdit: false}">
    <div class="flex flex-row space-x-6 flex-1">
        <div class="flex flex-col justify-center items-center w-12 h-12 rounded-full bg-blue-500 text-white">
            <x-tabler-icon-svg svg="{{ $reply->user->role->name === 'user' ? 'user' : 'user-heart' }}"/>
        </div>
        <div class="flex flex-col w-full">
            <p class="font-medium text-md">{{ $reply->user->name }}</p>
            <p class="text-gray-500 text-sm max-w-5xl mt-3" x-show="!openEdit">{{ $reply->explanation }}</p>
            @if($reply->user_id == auth()->user()->id)
                <form action="/tickets/{{ $ticket->id }}/replies/{{ $reply->id }}" method="post">
                    @csrf
                    @method('PATCH')
                    <textarea name="explanation" class="max-w-5xl border border-1 p-2 mt-3 h-28 w-full" x-show="openEdit">
                        {{ $reply->explanation }}
                    </textarea>
                    <div class="flex flex-start space-x-2 mt-4" x-show="openEdit">
                        <button type="submit" class="p-2 bg-blue-500 text-white rounded-md w-24 justify-center">
                            Save
                        </button>
                        <button type="reset" @click="openEdit = !openEdit" class="flex hover:cursor-pointer p-2 bg-blue-500 text-white rounded-md w-24 justify-center">
                            Cancel
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
    <div class="flex flex-col">
        <p class="text-sm text-gray-300">
            {{ $reply->created_at->diffForHumans() }}
        </p>
        @if($reply->user_id == auth()->user()->id)
            <div class="flex flex-row mt-3 items-center justify-end space-x-3">
                <button @click="openEdit = !openEdit">
                    <x-tabler-icon-svg svg="pencil"/>
                </button>
                <form action="/tickets/{{ $ticket->id }}/replies/{{ $reply->id }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center">
                        <x-tabler-icon-svg svg="trash-x" />
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
