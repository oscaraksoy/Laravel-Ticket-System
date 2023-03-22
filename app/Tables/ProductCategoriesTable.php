<?php

namespace App\Tables;

use App\Models\ProductCategory;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class ProductCategoriesTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(ProductCategory::class)
            ->rowActions(fn(ProductCategory $productCategory) => [
                new ShowRowAction(route('panel.products.categories.show', $productCategory)),
                new DestroyRowAction(),
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable()->title('ID'),
            Column::make('name')->sortable()->title('Name'),
            Column::make('parent')->format(function($query){
                return $query->parent->name ?? '---';
            })->title('Parent Category'),
            Column::make('created_at')->format(new DateFormatter('d/m/Y H:i'))->sortable()->title('Created At'),
            Column::make('updated_at')->format(new DateFormatter('d/m/Y H:i'))->sortable()->sortByDefault('desc')->title('Updated At'),
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
