<?php

namespace App\Http\Livewire;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filter;
use App\Models\Booking;

class BookingTable extends DataTableComponent
{
    protected $model = Booking::class;



    public array $bulkActions = [
        'Paid' => 'Paid',
        'No Paid' => 'No Paid',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        if (auth()->user()->hasAnyRole(['User'])) {
            $this->setBulkActionsDisabled();
            $this->setHideBulkActionsWhenEmptyDisabled();
        } else {
            $this->setBulkActionsEnabled();
            $this->setHideBulkActionsWhenEmptyEnabled();
        }
    }

    public function builder(): Builder
    {
        return Booking::query()
            ->when(auth()->user()->hasAnyRole(['User']), fn ($query, $name) => $query->where('user_id', auth()->user()->id));
    }

    public function bulkActions(): array
    {

        return [
            'Paid' => 'Paid',
            'NoPaid' => 'No Paid',
        ];
    }

    public function Paid()
    {
        Booking::whereIn('id', $this->getSelected())->update(['is_paid' => "Paid"]);

        $this->clearSelected();
    }

    public function NoPaid()
    {
        Booking::whereIn('id', $this->getSelected())->update(['is_paid' => "No paid"]);

        $this->clearSelected();
    }


    public function columns(): array
    {
        if (auth()->user()->hasAnyRole(['Admin'])) {
            # code...
            return [
                Column::make("Id", "id")
                    ->sortable(),

                Column::make("Checkin", "form_time")
                    ->sortable(),
                Column::make("Checkout", "to_time")
                    ->sortable(),
                Column::make("User", "user.name")
                    ->sortable(),

                Column::make("total", "total")
                    ->sortable(),

                Column::make("Room", "room.name")
                    ->sortable(),

                Column::make("Is Paid", "is_paid")
                    ->sortable(),

                Column::make("Status")
                    ->sortable(),

                Column::make('Action')->label(function ($row, Column $column) {
                    return view('columns.actions.bookings', ['row' => $row]);
                },),


            ];
        } else {
            return [
                Column::make("Id", "id")
                    ->sortable(),

                Column::make("Checkin", "form_time")
                    ->sortable(),
                Column::make("Checkout", "to_time")
                    ->sortable(),


                Column::make("total", "total")
                    ->sortable(),

                Column::make("Room", "room.name")
                    ->sortable(),

                Column::make("Is Paid", "is_paid")
                    ->sortable(),
                Column::make("Status")
                    ->sortable(),


            ];
        }
    }
}
