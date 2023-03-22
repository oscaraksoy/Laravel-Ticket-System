<x-layouts.with-title title="Product Categories" subtitle="Make product category operations in this page.">
    <x-table-confirmation-modal
        icon="fa-solid fa-eraser"
        title="Are you sure you want to delete this item?"
        subtitle="Be careful! This item will be deleted forever!" />
    <livewire:table :config="App\Tables\ProductCategoriesTable::class"/>
</x-layouts.with-title>
