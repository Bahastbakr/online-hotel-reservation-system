<div class="flex space-x-2">
    @if ($row->status != 'Booked' && $row->status != 'Canceled')
        <form method="POST" action="{{ route('booking.status.change', [$row->id, 'Booked']) }}">
            @csrf
            @method('PUT')
            <button type="submit" style="background-color:#2d2d2d;" class=" text-white font-bold p-2 rounded m-1">Booked
            </button>
        </form>
    @endif
    @if ($row->status != 'Canceled' && $row->status != 'Booked')
        <form method="POST" action="{{ route('booking.status.change', [$row->id, 'Canceled']) }}">
            @csrf
            @method('PUT')
            <button type="submit" style="background-color:red;" class=" text-white font-bold p-2 rounded m-1">Cancel
            </button>
        </form>
    @endif
    @if ($row->status != 'Pending' && $row->status != 'Canceled' && $row->status != 'Booked')
        <form method="POST" action="{{ route('booking.status.change', [$row->id, 'Pending']) }}">
            @csrf
            @method('PUT')
            <button type="submit" style="background-color:orange;"
                class=" text-white font-bold p-2 rounded m-1">Pending
            </button>
        </form>
    @endif
</div>
