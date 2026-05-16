<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('status', 'profile-updated');
    }

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

    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
        ]);

        /** @var User $user */
        $user = $request->user();

        $user->address = $request->address;
        $user->save();

        $response = Http::withHeaders([
            'apikey'       => env('SUPABASE_KEY'),
            'Authorization'=> 'Bearer ' . env('SUPABASE_KEY'),
            'Content-Type' => 'application/json',
        ])->patch(
            env('SUPABASE_URL') . '/rest/v1/users?id=eq.' . $user->id,
            [
                'address'    => $request->address,
                'updated_at' => now(),
            ]
        );

        if ($response->successful()) {
            return response()->json([
                'message' => 'Alamat berhasil diperbarui!'
            ]);
        }

        return response()->json([
            'message' => 'Gagal sinkronisasi ke database'
        ], 500);
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        /** @var User $user */
        $user = $request->user();

        // Update Lokal Laravel
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Sinkronisasi ke Supabase menggunakan kolom 'phone'
        $response = Http::withHeaders([
            'apikey'       => env('SUPABASE_KEY'),
            'Authorization'=> 'Bearer ' . env('SUPABASE_KEY'),
            'Content-Type' => 'application/json',
        ])->patch(
            env('SUPABASE_URL') . '/rest/v1/users?id=eq.' . $user->id,
            [
                'name'       => $request->name,
                'email'      => $request->email,
                'phone'      => $request->phone, // Sudah diganti menjadi phone
                'updated_at' => now(),
            ]
        );

        if ($response->successful()) {
            return response()->json([
                'message' => 'Profil berhasil diperbarui!'
            ]);
        }

        return response()->json([
            'message' => 'Gagal sinkronisasi ke database external'
        ], 500);
    }
}