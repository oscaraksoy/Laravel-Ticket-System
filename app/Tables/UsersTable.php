<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\ShowRowAction;
use Okipa\LaravelTable\Table;

class UsersTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(User::class)
            ->rowActions(fn(User $user) => [
                new ShowRowAction(route('panel.users.show', $user)),
                (new DestroyRowAction())
                    ->when(Auth::user()->isNot($user))
            ]);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->sortable()->title("ID"),
            Column::make('name')->searchable()->sortable()->title("Name"),
            Column::make('username')->searchable()->sortable()->title("Username"),
            Column::make('email')->searchable()->sortable()->title("Email"),
            Column::make('created_at')->format(new DateFormatter('d/m/Y H:i'))->sortable()->title("Created At"),
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
