<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::all();
        return view('pages.rental.rental', compact('rentals'));
    }

    public function create($id)
    {
        $field = Field::find($id);
        $fields = Field::all();
        $users = User::all(); // Ambil semua pengguna
        $rentals = Rental::all();
        return view('pages.rental.rental-create', compact('fields','field', 'users', 'rentals')); // Kirim pengguna ke view
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'field_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'booking_date' => 'required',
        ]);
        // dd($request->all());
        $rental = new Rental();
        $rental->field_id = $request->field_id;
        $rental->user_id = $request->user_id;
        $rental->status = $request->status;
        $rental->payment_status = $request->payment_status;
        $rental->payment_method = $request->payment_method;
        $rental->start_time = $request->start_time;
        $rental->end_time = $request->end_time;
        $rental->booking_date = $request->booking_date;
        $rental->save();

        return redirect()->route('rental.index')->with('success', 'Rental created successfully.');
    }

    public function edit($id)
    {
        $rental = Rental::find($id);
        $fields = Field::all();
        $users = User::all(); // Ambil semua pengguna
        $rentals = Rental::all();
        return view('pages.rental.rental-edit', compact('rental', 'fields', 'users', 'rentals')); // Kirim pengguna ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'field_id' => 'required',
            'user_id' => 'required',
            'status' => 'required',
            'payment_status' => 'required',
            'payment_method' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'booking_date' => 'required',
        ]);

        $rental = Rental::find($id);
        $rental->update($request->all());
        return redirect()->route('rental.index')->with('success', 'Rental updated successfully.');
    }

    public function destroy($id)
    {
        $rental = Rental::find($id);
        $rental->delete();
        return redirect()->route('rental.index')->with('success', 'Rental deleted successfully.');
    }
}
