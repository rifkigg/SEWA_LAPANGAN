<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $rentals = Rental::where('user_id', Auth::id())->get();
        return view('profile.edit', [
            'user' => $request->user(),
            'rentals' => $rentals
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {       
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        // Menambahkan logika untuk mengubah avatar
        if ($request->hasFile('avatar')) {
            // Debugging: Memeriksa apakah file avatar ada
            // dd('File avatar ditemukan.', $request->file('avatar'));

            $path = $request->file('avatar')->store('avatars', 'public');
            // Debugging: Menampilkan jalur file yang disimpan
            // dd('Avatar disimpan di: ' . $path);

            $request->user()->avatar = $path;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
