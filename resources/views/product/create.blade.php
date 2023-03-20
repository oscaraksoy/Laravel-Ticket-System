
<x-layout>
    <x-navbar />
    <div class="mx-auto px-24 py-10 overflow-x-auto">
        <div class="bg-white rounded-xl p-6 flex flex-col">
            <h1 class="text-2xl font-medium">Products in {{ $productCategory->name }} category.</h1>
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 my-12">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Parent Category
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sub Category
                    </th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr class="bg-white {{ $loop->last ? '' : 'border-b' }} hover:bg-gray-50 ease-in-out duration-100">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <a class="hover:cursor-pointer" href="#">
                                {{ $product->product_name }}
                            </a>
                        </th>
                        <td class="px-6 py-4">
                            <a href="#">
                                {{ $product->parent_category_name }}
                            </a>
                        </td>
                        <td class="px-6 py-4">
                            {{ $product->subcategory_name }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</x-layout>
