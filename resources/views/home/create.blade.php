<x-layout>
    <x-navbar />
        <div class="py-6 px-48">
            <h1 class="text-lg font-bold">Welcome, {{ auth()->user()->name }}! </h1>
            <div class="grid grid-cols-2 gap-x-6">
                <x-info-bar title="Tickets with open status" subtitle="{{ $openTicketsCount}}" icon="lock-open"/>
                <x-info-bar title="Tickets with closed status" subtitle="{{ $closedTicketsCount }}" icon="lock"/>
            </div>
            <hr class="divider my-12"/>
            <h1 class="text-lg font-bold">
                Messages
                @if($unreadMessagesCount > 0)
                    - You have {{ $unreadMessagesCount }} unread messages!
                @endif
            </h1>
            <x-home-messages :messages='$messages'/>
            <hr class="divider my-12"/>
            <h1 class="text-lg font-bold">Your last 3 tickets</h1>
            <x-home-last-tickets :tickets='$tickets' />
        </div>
    <x-create-ticket-float-button />
</x-layout>
