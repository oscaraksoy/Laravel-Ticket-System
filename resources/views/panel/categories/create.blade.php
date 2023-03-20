<x-layouts.with-title title="Categories" subtitle="Make category operations in this page.">
    <x-table-confirmation-modal
        icon="fa-solid fa-eraser"
        title="Are you sure you want to delete this item?"
        subtitle="Be careful! This item will be deleted forever!" />
    <div class="flex flex-col">
        <div class="flex justify-end">
            <a href="/admin/categories/add" class="px-4 py-2 bg-blue-500 rounded-md transition-all duration-100 hover:bg-blue-600 w-24 flex flex-row items-center justify-center text-white mb-4">
                <x-tabler-icon-svg svg="plus" />
                Add
            </a>
        </div>
        <livewire:table :config="App\Tables\CategoriesTable::class"/>
    </div>
</x-layouts.with-title>
