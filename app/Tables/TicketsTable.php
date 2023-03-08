<?php

namespace App\Tables;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Okipa\LaravelTable\Abstracts\AbstractTableConfiguration;
use Okipa\LaravelTable\Column;
use Okipa\LaravelTable\Formatters\DateFormatter;
use Okipa\LaravelTable\Table;

class TicketsTable extends AbstractTableConfiguration
{
    protected function table(): Table
    {
        return Table::make()
            ->model(Ticket::class);
    }

    protected function columns(): array
    {
        return [
            Column::make('id')->title('ID')->sortable()->sortByDefault('desc'),
            Column::make('title')->title('Title')->searchable()->format(function (Ticket $ticket){
                return '
                    <a href="/tickets/ticket/'.$ticket->id.'">'.$ticket->title.'</a>
                ';
            }),
            Column::make('created_at')
                ->title('Created At')
                ->format(new DateFormatter('d/m/Y H:i'))
                ->sortable(),
            Column::make('priority')
                ->title('Priority')
                ->format(function (Ticket $ticket){
                $colorLabel = $ticket->priority->id == 1 ? "bg-red-500" : (
                ($ticket->priority->id == 2 ? "bg-red-400" :
                    ($ticket->priority->id == 3 ? "bg-yellow-500" :
                        ($ticket->priority->id == 4 ? "bg-green-500" : ""))));
                return '
                    <div class="flex flex-row justify-start w-20 items-center">
                        <div class="w-4 h-4 rounded-full mr-2 '.$colorLabel.'"></div>
                        '.ucfirst($ticket->priority->name).'
                    </div>
                ';
            })
                ->searchable(fn(Builder $query, string $searchBy) => $query->whereRelation(
                'priority',
                'name',
                'LIKE',
                '%' . $searchBy . '%'
            )),
            Column::make('status')
                ->title('Status')
                ->format(function (Ticket $ticket){
                $colorLabel = ($ticket->status->id == 1 ? "bg-red-500" :
                    ($ticket->status->id == 2 ? "bg-blue-500" :
                        ($ticket->status->id == 3 ? "bg-green-500": "")));
                return '
                    <div class="rounded py-1 text-center text-white w-24 '.$colorLabel.'">
                        <span class="flex items-center justify-center font-medium text-center">
                            '.$ticket->status->name.'
                        </span>
                    </div>
                ';
            })
                ->searchable(fn(Builder $query, string $searchBy) => $query->whereRelation(
                    'status',
                    'name',
                    'LIKE',
                    '%' . $searchBy . '%'
                )),
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
