<x-layout>
    <x-staff.navbar />
    <div class="px-44 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold">Hi, {{ auth()->user()->name }}!</h1>
            <div class="flex font-medium flex-col flex-end items-end space-y-1">
                <p>{{ date('l, F t Y') }}</p>
                <p class="text-lg">{{ date('h:m A') }}</p>
            </div>
        </div>
        <h1 class="text-2xl font-medium mt-12">Statuses</h1>
        <div class="grid grid-cols-3 gap-x-6">
            <x-info-bar title="Tickets with open status" subtitle="{{ $ticketsWithOpenStatusCount }}"/>
            <x-info-bar title="Tickets with replied status" subtitle="{{ $ticketsWithRepliedStatusCount }}"/>
            <x-info-bar title="Tickets with closed status" subtitle="{{ $ticketsWithClosedStatusCount }}"/>
        </div>
        <h1 class="text-2xl font-medium mt-12">Priorities</h1>
        <div class="grid grid-cols-4 gap-x-6">
            <x-info-bar title="Tickets with critical priority" subtitle="{{ $ticketsWithCriticalPriorityCount }}"/>
            <x-info-bar title="Tickets with high priority" subtitle="{{ $ticketsWithHighPriorityCount }}"/>
            <x-info-bar title="Tickets with medium priority" subtitle="{{ $ticketsWithMediumPriorityCount }}"/>
            <x-info-bar title="Tickets with low priority" subtitle="{{ $ticketsWithLowPriorityCount }}"/>
        </div>
    </div>
</x-layout>
