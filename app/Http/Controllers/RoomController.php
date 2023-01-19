<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Room;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rooms.create');
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
            'name' => 'required',
            'image' => 'required',
            'adults' => 'required|max:14',
            'children' => 'required|max:14',
            'quantity' => 'required|max:10',
            'facilities' => 'required',
            'features' => 'required',
            'price' => 'required',
            'description' => 'required',
        ]);

        $room = new Room();
        $room->name = $request->name;
        $room->max_children = $request->children;
        $room->max_adults = $request->adults;
        $room->quantity = $request->quantity;
        $room->facilities = json_encode($request->facilities);
        $room->features = json_encode($request->features);
        $room->price = $request->price;
        $room->status = "Pending";

        $room->description = $request->description;

        $file = request('image');
        $fileName =  time() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put('rooms/' . $fileName, File::get($file));
        $room->image = $fileName;

        $room->save();

        return redirect()->route('room.index')->with('message', 'Room added successfully');
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
