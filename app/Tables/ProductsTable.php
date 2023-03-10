<?php

namespace App\Tables;

use App\Models\Product;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class ProductsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(Product::class);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable()->title('ID')->searchable()->sortable(),
            Column::make('name')->title('Name')->searchable()->sortable(),
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
