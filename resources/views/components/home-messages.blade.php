@props(['messages'])

<div class="flex flex-col justify-center p-6 bg-white rounded-xl mt-6">
    @if($messages->count())
        @foreach($messages as $message)
            <a class="flex flex-row items-center justify-between w-full" href="{{ $message->link_to }}?notificationId={{ $message->id }}">
                <div class="flex flex-row items-center">
                    <div class="flex items-center justify-center text-white w-12 h-12 mr-6 rounded-full bg-blue-500">
                        <x-tabler-icon-svg svg="{{ $message->is_read ? 'bell' : 'bell-ringing'}}"/>
                    </div>
                    @unless($message->is_read)
                        <div class="p-1 bg-red-500 rounded-full mr-3">
                            <div class="p-1 bg-white rounded-full"></div>
                        </div>
                    @endunless
                    <p class="{{ $message->is_read == 1 ? 'font-normal' : 'font-bold' }}">{{ $message->explanation }}</p>
                </div>
                <p class="font-light text-xs text-gray-400">{{ $message->created_at->diffForHumans() }}</p>
            </a>
            @unless($loop->last)
                <hr class="divider my-6 w-full h-2" />
            @endunless
        @endforeach
    @else
        <p class="font-medium">Your message box is empty!</p>
    @endif
    <div class="{{ $messages->total() > 3 ? 'mt-8' : '' }}">
        {{ $messages->links() }}
    </div>
</div>
