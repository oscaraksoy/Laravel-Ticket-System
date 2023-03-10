<div wire:init="init">
    <style>
        div>nav>ul {
            display:flex;
            flex-direction: row;
        }

        .page-item > button and span{
            padding:6px;
            display: flex;
            align-items: center;
            font-size: 16px;
        }

        .page-item{
            padding-left: 6px;
            padding-right: 6px;
            display: flex;
            align-items: center;
            font-size: 18px;
            background-color: white;
            border:1px solid lightgray;
            border-radius: 2px;
            transition: all;
            transition-duration: 200ms;
        }

        .page-item[class~="active"]{
            font-weight: bold;
        }

        .page-item:hover{
            background-color: dodgerblue;
            cursor:pointer;
            color:white;
            border-color: dodgerblue;
        }
    </style>
    @if($initialized)
        @if($orderColumn)
            <div class="alert alert-info" role="alert">
                {{ __('You can rearrange the order of the items in this list using a drag and drop action.') }}
            </div>
        @endif
        <div class="text-sm">
            <table class="w-full text-left dark:text-gray-400s">
                {{-- Table header--}}
                <thead>
                    {{-- Filters --}}
                    @if($filtersArray)
                        <tr>
                            <td class="px-0 pb-0"{!! $columnsCount > 1 ? ' colspan="' . $columnsCount . '"' : null !!}>
                                <div class="flex flex-wrap items-center justify-end mt-2">
                                    <div class="text-gray-500 mt-2">
                                        {!! config('laravel-table.icon.filter') !!}
                                    </div>
                                    @foreach($filtersArray as $filterArray)
                                        @unless($resetFilters)
                                            <div wire:ignore>
                                        @endif
                                            {!! Okipa\LaravelTable\Abstracts\AbstractFilter::make($filterArray)->render() !!}
                                        @unless($resetFilters)
                                            </div>
                                        @endif
                                    @endforeach
                                    @if(collect($this->selectedFilters)->filter(fn(mixed $filter) => isset($filter) && $filter !== '' && $filter !== [])->isNotEmpty())
                                        <a wire:click.prevent="resetFilters()"
                                           class="p-3 ml-3 mt-2"
                                           title="{{ __('Reset filters') }}"
                                           data-bs-toggle="tooltip">
                                            {!! config('laravel-table.icon.reset') !!}
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endif
                    {{-- Search/Number of rows per page/Head action --}}
                    <tr>
                        <td class="px-0"{!! $columnsCount > 1 ? ' colspan="' . $columnsCount . '"' : null !!}>
                            <div class="flex flex-col xl:flex-row">
                                {{-- Search --}}
                                <div class="flex-1">
                                    @if($searchableLabels)
                                        <div class="flex-1 xl:pr-3 py-1">
                                            <form wire:submit.prevent="$refresh">
                                                <div class="flex items-center w-full">
                                                    <span id="search-for-rows" class="px-4 py-2 bg-white rounded border">
                                                        {!! config('laravel-table.icon.search') !!}
                                                    </span>
                                                    <input wire:model.defer="searchBy"
                                                           class="w-full px-4 py-2 bg-white rounded border"
                                                           placeholder="{{ __('Search by:') }} {{ $searchableLabels }}"
                                                           aria-label="{{ __('Search by:') }} {{ $searchableLabels }}"
                                                           aria-describedby="search-for-rows">
                                                    <button class="px-4 py-2 bg-white rounded border hover:bg-blue-300 ease-in-out duration-200 hover:cursor-pointer hover:text-white"
                                                            type="submit"
                                                            title="{{ __('Search by:') }} {{ $searchableLabels }}">
                                                        {!! config('laravel-table.icon.validate') !!}
                                                    </button>
                                                    @if($searchBy)
                                                        <a wire:click.prevent="$set('searchBy', ''), $refresh"
                                                           class="px-4 py-2 bg-white rounded border hover:bg-blue-300 ease-in-out duration-200 hover:cursor-pointer hover:text-white"
                                                           title="{{ __('Reset research') }}">
                                                            {!! config('laravel-table.icon.reset') !!}
                                                        </a>
                                                    @endif
                                                </div>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex justify-between items-center">
                                    {{-- Number of rows per page --}}
                                    @if($numberOfRowsPerPageChoiceEnabled)
                                        <div wire:ignore @class(['x:px-3' => $headActionArray, 'xl:pl-3' => ! $headActionArray, 'py-1'])>
                                            <div class="flex flex-row">
                                                <span id="rows-number-per-page-icon" class="px-4 py-2 bg-white rounded border">
                                                    {!! config('laravel-table.icon.rows_number') !!}
                                                </span>
                                                <select wire:change="changeNumberOfRowsPerPage($event.target.value)" class="px-4 py-2 bg-white rounded border" {!! (new \Illuminate\View\ComponentAttributeBag())->merge([
                                                    'placeholder' => __('Number of rows per page'),
                                                    'aria-label' => __('Number of rows per page'),
                                                    'aria-describedby' => 'rows-number-per-page-icon',
                                                    ...config('laravel-table.html_select_components_attributes'),
                                                ])->toHtml() !!}>
                                                    <option wire:key="rows-number-per-page-option-placeholder" value="" disabled>{{ __('Number of rows per page') }}</option>
                                                    @foreach($numberOfRowsPerPageOptions as $numberOfRowsPerPageOption)
                                                        <option wire:key="rows-number-per-page-option-{{ $numberOfRowsPerPageOption }}" value="{{ $numberOfRowsPerPageOption }}"{{ $numberOfRowsPerPageOption === $numberOfRowsPerPage ? ' selected' : null}}>
                                                            {{ $numberOfRowsPerPageOption }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    @endif
                                    {{-- Head action --}}
                                    @if($headActionArray)
                                        <div class="flex items-center pl-3 py-1">
                                            {{ Okipa\LaravelTable\Abstracts\AbstractHeadAction::make($headActionArray)->render() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                    </tr>
                    {{-- Column headings --}}
                    <tr class="bg-gray-50 border-t border-b">
                        {{-- Bulk actions --}}
                        @if($tableBulkActionsArray)
                            <th wire:key="bulk-actions" class="flex items-center" scope="col">
                                <div class="flex items-center">
                                    {{-- Bulk actions select all --}}
                                    <input wire:model="selectAll" class="mr-1" type="checkbox" aria-label="Check all displayed lines">
                                    {{-- Bulk actions dropdown --}}
                                    <div class="px-4 py-2 bg-white rounded border" title="{{ __('Bulk Actions') }}" data-bs-toggle="tooltip">
                                        <a id="bulk-actions-dropdown"
                                           class="dropdown-toggle"
                                           type="button"
                                           data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                        </a>
                                        <ul class="px-4 py-2 bg-white rounded border" aria-labelledby="bulk-actions-dropdown">
                                            @foreach($tableBulkActionsArray as $bulkActionArray)
                                                {{ Okipa\LaravelTable\Abstracts\AbstractBulkAction::make($bulkActionArray)->render() }}
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </th>
                        @endif
                        {{-- Sorting/Column titles --}}
                        @foreach($columns as $column)
                            <th wire:key="column-{{ Str::of($column->getAttribute())->snake('-')->slug() }}" class="p-2" scope="col">
                                @if($column->isSortable($orderColumn))
                                    @if($sortBy === $column->getAttribute())
                                        <a wire:click.prevent="sortBy('{{ $column->getAttribute() }}')"
                                           class="flex items-center"
                                           href=""
                                           title="{{ $sortDir === 'asc' ? __('Sort descending') : __('Sort ascending') }}"
                                           data-bs-toggle="tooltip">
                                            {!! $sortDir === 'asc'
                                                ? config('laravel-table.icon.sort_desc')
                                                : config('laravel-table.icon.sort_asc') !!}
                                            <span class="ml-2">{{ $column->getTitle() }}</span>
                                        </a>
                                    @else
                                        <a wire:click.prevent="sortBy('{{ $column->getAttribute() }}')"
                                           class="flex items-center"
                                           href=""
                                           title="{{ __('Sort ascending') }}"
                                           data-bs-toggle="tooltip">
                                            {!! config('laravel-table.icon.sort') !!}
                                            <span class="ml-2">{{ $column->getTitle() }}</span>
                                        </a>
                                    @endif
                                @else
                                    {{ $column->getTitle() }}
                                @endif
                            </th>
                        @endforeach
                        {{-- Row actions --}}
                        @if($tableRowActionsArray)
                            <th wire:key="row-actions" class="text-end" scope="col">
                                {{ __('Actions') }}
                            </th>
                        @endif
                    </tr>
                </thead>
                {{-- Table body--}}
                <tbody{!! $orderColumn ? ' wire:sortable="reorder"' : null !!}>
                    {{-- Rows --}}
                    @forelse($rows as $model)
                        <tr class="transition-all duration-100 hover:bg-gray-100 {{ $loop->even ? 'bg-gray-50' : '' }}" wire:key="row-{{ $model->getKey() }}"{!! $orderColumn ? ' wire:sortable.item="' . $model->getKey() . '"' : null !!} @class(array_merge(Arr::get($tableRowClass, $model->laravel_table_unique_identifier, []), ['border-b']))>
                            {{-- Row bulk action selector --}}
                            @if($tableBulkActionsArray)
                                <td>
                                    <input wire:model="selectedModelKeys" type="checkbox" value="{{ $model->getKey() }}" aria-label="Check line {{ $model->getKey() }}">
                                </td>
                            @endif
                            {{-- Row columns values --}}
                            @foreach($columns as $column)
                                @if($loop->first)
                                    <th class="p-4 max-w-sm" wire:key="cell-{{ Str::of($column->getAttribute())->snake('-')->slug() }}-{{ $model->getKey() }}" {!! $orderColumn ? ' wire:sortable.handle style="cursor: move;"' : null !!} scope="row">
                                        {!! $orderColumn ? '<span class="mr-2">' . config('laravel-table.icon.drag_drop') . '</span>' : null !!}{{ $column->getValue($model, $tableColumnActionsArray) }}
                                    </th>
                                @else
                                    <td class="p-4 max-w-sm overflow-ellipsis overflow-hidden whitespace-nowrap" wire:key="cell-{{ Str::of($column->getAttribute())->snake('-')->slug() }}-{{ $model->getKey() }}">
                                        {{ $column->getValue($model, $tableColumnActionsArray) }}
                                    </td>
                                @endif
                            @endforeach
                            {{-- Row actions --}}
                            @if($tableRowActionsArray)
                                <td class="text-end">
                                    <div class="flex items-center justify-end">
                                        @if($rowActionsArray = Okipa\LaravelTable\Abstracts\AbstractRowAction::retrieve($tableRowActionsArray, $model->getKey()))
                                            @foreach($rowActionsArray as $rowActionArray)
                                                {{ Okipa\LaravelTable\Abstracts\AbstractRowAction::make($rowActionArray)->render($model) }}
                                            @endforeach
                                        @endif
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <tr class="border-b">
                            <th class="font-normal text-center p-3" scope="row"{!! $columnsCount > 1 ? ' colspan="' . $columnsCount . '"' : null !!}>
                                <span class="text-blue-500 text-white">
                                    {!! config('laravel-table.icon.info') !!}
                                </span>
                                {{ __('No results were found.') }}
                            </th>
                        </tr>
                    @endforelse
                </tbody>
                {{-- Table footer--}}
                <tfoot class="bg-gray-100">
                    {{-- Results --}}
                    @foreach($results as $result)
                        <tr wire:key="result-{{ Str::of($result->getTitle())->snake('-')->slug() }}" class="border-b">
                            <td class="font-bold"{!! $columnsCount > 1 ? ' colspan="' . $columnsCount . '"' : null !!}>
                                <div class="flex flex-wrap justify-between">
                                    <div class="px-2 py-1">{{ $result->getTitle() }}</div>
                                    <div class="px-2 py-1">{{ $result->getValue() }}</div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td {!! $columnsCount > 1 ? ' colspan="' . $columnsCount . '"' : null !!}>
                            <div class="flex flex-wrap justify-between">
                                <div class="flex items-center p-2">
                                    <div wire:key="navigation-status">{!! $navigationStatus !!}</div>
                                </div>
                                <div class="p-2" style="">
                                    {!! $rows->links() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                </tfoot>
            </table>
    @else
        <div class="flex flex-col justify-center py-3">
            <div class="spinner-border text-dark me-3" role="status">
                <span class="visually-hidden">{{ __('Loading in progress...') }}</span>
            </div>
            {{ __('Loading in progress...') }}
        </div>
    @endif
        </div>
</div>
