<?php

namespace App\Tables;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\RowActions\DestroyRowAction;
use Okipa\LaravelTable\RowActions\EditRowAction;
use Okipa\LaravelTable\Table;

class UsersTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()->model(User::class)
            ->rowActions(fn(User $user) => [
                (new DestroyRowAction())
                    // Destroy action will not be available for authenticated user
                    ->when(Auth::user()->isNot($user))
                    // Override the action default confirmation question
                    // Or set `false` if you do not want to require any confirmation for this action
                    ->confirmationQuestion('Are you sure you want to delete user ' . $user->name . '?')
                    // Override the action default feedback message
                    // Or set `false` if you do not want to trigger any feedback message for this action
                    ->feedbackMessage('User ' . $user->name . ' has been deleted.')
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
