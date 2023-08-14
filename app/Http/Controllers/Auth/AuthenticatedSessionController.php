<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('sesi.index');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        // $request->session()->regenerate();
        // if (Auth::user()->hasRole('admin')) {
        //     return redirect()->to('pengguna');
        // }

        // if (Auth::user()->hasRole('staff')) {
        //     return redirect()->to('barang');
        // }
        // if (Auth::user()->hasRole('kasir')) {
        //     return redirect()->to('barang');
        // }
        // if (Auth::user()->hasRole('gudang')) {
        //     return redirect()->to('gudang');
        // }
        // if (Auth::user()->hasRole('pemasok')) {
        //     return redirect()->to('dashboard');
        // }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
