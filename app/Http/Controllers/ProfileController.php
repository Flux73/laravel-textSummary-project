<?php

namespace App\Http\Controllers;

use App\Models\Text;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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
