<x-layouts.with-title title="Tickets" subtitle="Make ticket operations in this page.">
    <x-table-confirmation-modal
        icon="fa-solid fa-eraser"
        title="Are you sure you want to delete this item?"
        subtitle="Be careful! This item will be deleted forever!" />
    <div class="flex flex-col">
        <livewire:table :config="App\Tables\TicketsTable::class"/>
    </div>
</x-layouts.with-title>
