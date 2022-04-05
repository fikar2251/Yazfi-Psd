<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class MacAddr
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $macAddr = substr(exec('getmac'), 0, 17);

        if (Auth::user()->is_verified == 'pending') {
            $user = User::find(Auth::user()->id);
            $user->update([
                'is_verified' => 'verified',
                'mac_address' => $macAddr
            ]);
            return $next($request);
        }

        if (Auth::user()->mac_address == $macAddr) {
            return $next($request);
        }

        Auth::logout();
        return back();
    }
}
