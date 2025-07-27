<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('admin.profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Validate the request
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Max 2MB
        ]);

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new avatar
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        }

        // Update user
        $user->fill($validated);

        // Reset email verification if email changed
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('admin.profile.edit')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update the user's password.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ], [
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return Redirect::route('admin.profile.edit')->with('success', 'Password berhasil diperbarui!');
    }

    /**
     * Delete avatar
     */
    public function deleteAvatar(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
            $user->update(['avatar' => null]);
        }

        return Redirect::route('admin.profile.edit')->with('success', 'Avatar berhasil dihapus!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ], [
            'password.current_password' => 'Password tidak sesuai.',
        ]);

        $user = $request->user();

        // Don't allow super admin to delete their account if they are the only super admin
        if ($user->isSuperAdmin()) {
            $superAdminCount = \App\Models\User::where('role', 'super_admin')->where('is_active', true)->count();
            if ($superAdminCount <= 1) {
                return Redirect::route('admin.profile.edit')->with('error', 'Tidak dapat menghapus akun Super Admin terakhir!');
            }
        }

        // Delete avatar if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Akun Anda berhasil dihapus.');
    }

    /**
     * Toggle account active status (for self-deactivation)
     */
    public function toggleActive(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Don't allow super admin to deactivate if they are the only active super admin
        if ($user->isSuperAdmin() && $user->is_active) {
            $activeSuperAdminCount = \App\Models\User::where('role', 'super_admin')->where('is_active', true)->count();
            if ($activeSuperAdminCount <= 1) {
                return Redirect::route('admin.profile.edit')->with('error', 'Tidak dapat menonaktifkan Super Admin terakhir!');
            }
        }

        $user->update(['is_active' => !$user->is_active]);

        $status = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        // If user deactivated themselves, log them out
        if (!$user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return Redirect::to('/')->with('success', "Akun Anda berhasil {$status}.");
        }

        return Redirect::route('admin.profile.edit')->with('success', "Akun berhasil {$status}!");
    }

    /**
     * Download user data (GDPR compliance)
     */
    public function downloadData(Request $request)
    {
        $user = $request->user();

        $userData = [
            'personal_information' => [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'address' => $user->address,
                'role' => $user->role,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ],
            'account_status' => [
                'is_active' => $user->is_active,
                'email_verified_at' => $user->email_verified_at,
            ],
        ];

        $fileName = 'user_data_' . $user->id . '_' . now()->format('Y-m-d') . '.json';

        return response()->json($userData)
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->header('Content-Type', 'application/json');
    }
}
