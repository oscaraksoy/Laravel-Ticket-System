<x-layouts.with-title title="Products" subtitle="Make product operations in this page.">
    <x-table-confirmation-modal
        icon="fa-solid fa-eraser"
        title="Are you sure you want to delete this item?"
        subtitle="Be careful! This item will be deleted forever!" />
    <livewire:table :config="App\Tables\ProductsTable::class"/>
</x-layouts.with-title>
