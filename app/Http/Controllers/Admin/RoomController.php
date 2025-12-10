<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        return view('admin.rooms.index', compact('rooms')); 
    }

    public function create()
    {
        return view('admin.rooms.create'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_code' => 'required|string|max:20|unique:rooms',
            'room_name' => 'required|string|max:100',
            'building' => 'required|string|max:50',
            'floor' => 'required|integer',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|array', 
            'description' => 'nullable|string',
            'status' => 'required|in:available,maintenance,unavailable',
        ]);

        Room::create($request->all());

        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function show(Room $room)
    {
        return view('admin.rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_code' => 'required|string|max:20|unique:rooms,room_code,' . $room->room_id . ',room_id',
            'room_name' => 'required|string|max:100',
        ]);

        $room->update($request->all());
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('admin.rooms.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}