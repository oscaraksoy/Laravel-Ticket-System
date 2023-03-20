<?php

namespace App\Tables;

use App\Models\Product;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class ProductsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()
            ->model(Product::class)
            ->rowActions(fn(Product $product) => [
                new ShowRowAction(route('panel.products.show', $product)),
                new DestroyRowAction()
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable()->title('ID')->searchable()->sortable(),
            Column::make('name')->title('Name')->searchable()->sortable(),
            Column::make('product_category')->title('Category')->format(function (Product $product) {
                return $product->productCategory->parent->name;
            }),
            Column::make('product_subcategory')->title('Subcategory')->format(function (Product $product) {
                return $product->productCategory->name;
            }),
            Column::make('created_at')->title('Created')->format(new DateFormatter('d/m/Y H:i'))->sortable(),
        ];
    }

    protected function results(): array
    {
        return [
            // The table results configuration.
            // As results are optional on tables, you may delete this method if you do not use it.
        ];
    }
}
