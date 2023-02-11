<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Text;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index() 
    {
        $result = Text::all()->where('user_id', Auth::id())->sortByDesc('created_at');
        if (request()->query('sort') === "starred") {
            $result = $result->where('is_starred', 1);

            return view('profile.edit', ['texts' => $result]);
        }

        if (request()->query('sort') === "newest") {
            $result = $result->sortByDesc('created_at');
            return view('profile.edit', ['texts' => $result]);
        }

        if (request()->query('sort') === "oldest") {
            $result = $result->sortBy('created_at');
            return view('profile.edit', ['texts' => $result]);
        }

        return view('profile.edit', ['texts' => $result]);
    }

    public function updateStarred($id) {
        Text::findOrFail($id)->update([
            'is_starred' => !Text::findOrFail($id)->is_starred,
        ]);


        return redirect()->back();
    }

    public function destroyText($id) {

        Text::destroy($id);
        return redirect()->back();
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
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

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
