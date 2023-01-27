<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;

class BookingTable extends DataTableComponent
{
    protected $model = Booking::class;

    public function query(): Builder
    {
        return Booking::query()->where('user_id', auth()->user()->id);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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

                Column::make("Is Paid", "is_paid")
                    ->sortable(),
                Column::make("Status")
                    ->sortable(),


            ];
        }
    }
}
