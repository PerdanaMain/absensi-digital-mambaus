<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Request;

class AuthController extends Controller
{
    public function index()
    {
        return view('pages.welcome');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                "username" => "required",
                "password" => "required",
            ]);

            $user = User::with([
                'role',
                'guru',
                'pengurus',
                'wali',
            ])
                ->where('username', $request->username)->first();

            $match = Hash::check($request->password, $user->password);
            if ($user && $match) {
                Auth::login($user);

                $request->session()->regenerate();
                return redirect()->intended('dashboard');
            } else {
                return back()->with('auth.error', 'username atau password salah');
            }

        } catch (\Throwable $th) {
            return back()->with('auth.error', $th->getMessage());
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        return redirect('/');
    }
}
