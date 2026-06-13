<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AccountUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountController extends Controller
{
    /**
     * Show the admin account edit form.
     */
    public function edit(): View
    {
        $admin = Auth::user();

        return view('admin.account.edit', compact('admin'));
    }

    /**
     * Update the admin account.
     */
    public function update(AccountUpdateRequest $request): RedirectResponse
    {
        $admin = Auth::user();
        $validated = $request->validated();

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.account.edit')
            ->with('success', 'Akun admin berhasil diperbarui.');
    }
}
