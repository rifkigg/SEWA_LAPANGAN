<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use App\Models\User; // Added for User model

class FieldController extends Controller
{
    public function index()
    {
        $fields = Field::all();
        return view('pages.field.field', compact('fields'));
    }

    public function show($id)
    {
        $field = Field::find($id);
        return view('pages.field.field-show', compact('field'));
    }

    public function create()
    {
        $fields = Field::all();
        $users = User::all(); // Ambil semua pengguna
        return view('pages.field.field-create', compact('fields', 'users')); // Kirim pengguna ke view
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required',
            'location' => 'required',
            'owner_id' => 'required',
            'description' => 'required',
        ]);

        // Memeriksa apakah file gambar ada
        if ($request->hasFile('image')) {
            // Menyimpan gambar dan mendapatkan nama file
            $imageName = $request->file('image')->store('images', 'public');

            // Menyimpan nama file ke database
            $field = new Field();
            $field->name = $request->name;
            $field->price = $request->price;
            $field->location = $request->location;
            $field->description = $request->description;
            $field->owner_id = $request->owner_id;
            $field->image = $imageName; // Simpan nama file yang benar
            $field->save();
        }

        return redirect()->route('field.index')->with('success', 'Field created successfully.');
    }

    public function edit($id)
    {
        $fields = Field::find($id);
        $users = User::all(); // Ambil semua pengguna
        return view('pages.field.field-edit', compact('fields', 'users')); // Kirim pengguna ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'location' => 'required',
            'owner_id' => 'required',
            'description' => 'required',
        ]);

        $field = Field::find($id);
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            if (file_exists(public_path('images/' . $field->image))) {
                unlink(public_path('images/' . $field->image));
            }
            $imageName = $request->file('image')->store('images', 'public');
            $field->image = $imageName;
        }
        $field->update([
            'name' => $request->name,
            'price' => $request->price,
            'location' => $request->location,
            'owner_id' => $request->owner_id,
            'description' => $request->description,
            'image' => $field->image,
        ]);
        return redirect()->route('field.index')->with('success', 'Field updated successfully.');
    }

    public function destroy($id)
    {
        $field = Field::find($id);
        $field->delete();
        return redirect()->route('field.index')->with('success', 'Field deleted successfully.');
    }
}
