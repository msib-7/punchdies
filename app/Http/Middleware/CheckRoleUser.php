<?php

namespace App\Http\Middleware;

use App\Models\Permissions;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRoleUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        //Cek Apakah User sudah login dan memiliki Role
        if (!$user || !$user->role_id) {
            return redirect('/')->with('error', 'Silakan login untuk melanjutkan.');
        }

        //Dapatkan Route Saat ini
        $currentRoute = $request->route()->getName();

        // Cek apakah permission untuk jobLvl dan URL saat ini ada di database
        $hasPermission = Permissions::where('role_id', $user->role_id)
            ->where('url', $currentRoute)
            ->exists();

        // Jika tidak ada izin, tampilkan halaman forbidden
        if (!$hasPermission) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda Tidak Memiliki Akses Pada Action ini',
                ]);
            } else {
                return response()->view('layouts.forbidden');
            }
        }
        return $next($request);
    }
}
