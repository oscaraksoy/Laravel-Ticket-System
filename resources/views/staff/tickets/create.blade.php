<x-layout>
    <x-staff.navbar />
    <div class="px-40 py-6">
        <div class="bg-white border p-6 rounded-md">
            <livewire:table :config="App\Tables\TicketsTable::class"/>
        </div>
    </div>
</x-layout>
