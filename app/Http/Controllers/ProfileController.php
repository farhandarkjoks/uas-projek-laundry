<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

    /**
     * Memperbarui Alamat User langsung ke MySQL Local
     */
    public function updateAddress(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:500',
        ]);

        /** @var User $user */
        $user = $request->user();

        // Menyimpan perubahan langsung ke database lokal Laragon
        $user->address = $request->address;
        $user->save();

        // Langsung return sukses tanpa perlu request HTTP external ke Supabase
        return response()->json([
            'message' => 'Alamat berhasil diperbarui!'
        ]);
    }

    /**
     * Memperbarui Informasi Profil Utama User langsung ke MySQL Local
     */
    public function updateInfo(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        /** @var User $user */
        $user = $request->user();

        // Update langsung ke database lokal Laragon
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        // Langsung return sukses tanpa perlu request HTTP external ke Supabase
        return response()->json([
            'message' => 'Profil berhasil diperbarui!'
        ]);
    }
}