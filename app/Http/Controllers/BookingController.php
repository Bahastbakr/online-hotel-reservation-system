<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Booking;
use App\Models\Room;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function updateStatus($id, $status)
    {
        $booking = Booking::find($id);
        $booking->status = $status;
        $booking->save();

        return redirect(route('booking.index'))->with('message', 'Booking status updated successfully');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'from_time' => 'required',
            'to_time' => 'required',
            'total' => 'required',
            'room_id' => 'required',

        ]);

        $booking = new Booking();
        $booking->form_time = $request->from_time;
        $booking->to_time = $request->to_time;
        $booking->total = $request->total;
        $booking->status = "Pending";
        $booking->user_id = auth()->user()->id;
        $booking->room_id = $request->room_id;

        $booking->save();

        return redirect(route('room.guest.index'))->with('message', 'Your room has been booked successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function view($roomId)
    {
        $room = Room::find($roomId);
        return view('book', ['room' => $room, 'request' => request()]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
