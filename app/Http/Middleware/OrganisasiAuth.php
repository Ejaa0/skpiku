<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OrganisasiAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->get('is_org_logged_in')) {
            return redirect()->route('organisasi.login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return $next($request);
    }
}
