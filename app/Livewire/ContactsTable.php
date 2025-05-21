<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ContactsTable extends DataTableComponent
{
    protected $model = Contact::class;


    public function configure(): void
    {


        $this->setPrimaryKey('id')
            ->setDefaultSort('name', 'asc')
            ->setPerPageAccepted([10, 25, 50, 100])
            ->setPerPage(10)
            ->setEmptyMessage(__('No contacts found.'))
            ->setTableAttributes([
                'class' => 'table table-striped table-hover',
            ])->setLoadingPlaceholderStatus(true);
    }

    public function columns(): array
    {
        return [
            Column::make(__('Name'), 'name')
                ->sortable()
                ->searchable(),

            Column::make(__('Document'), 'document')
                ->sortable()
                ->searchable(),

            Column::make(__('Type'), 'type')
                ->sortable()
                ->format(function($value) {
                    return $value == 0 ? __('Individual') : __('Company');
                }),

            Column::make(__('Status'), 'active')
                ->sortable()
                ->format(function($value) {
                    if ($value) {
                        return '<span class="badge bg-success">' . __('Active') . '</span>';
                    } else {
                        return '<span class="badge bg-danger">' . __('Inactive') . '</span>';
                    }
                })
                ->html(),

            Column::make(__('Actions'))
                ->label(function($row) {
                    return view('contacts.partials.actions', ['contact' => $row]);
                }),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make(__('Type'))
                ->options([
                    '' => __('All'),
                    '0' => __('Individual'),
                    '1' => __('Company'),
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value !== '') {
                        $builder->where('type', $value);
                    }
                }),

            SelectFilter::make(__('Status'))
                ->options([
                    '' => __('All'),
                    '1' => __('Active'),
                    '0' => __('Inactive'),
                ])
                ->filter(function(Builder $builder, string $value) {
                    if ($value !== '') {
                        $builder->where('active', $value);
                    }
                }),
        ];
    }

    public function builder(): Builder
    {


        return Contact::query()
            ->where('userid', 1);
    }
}
