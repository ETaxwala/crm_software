<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session, DB;
use Carbon\Carbon;

class CheckSessionExpiry
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    

    public function handle(Request $request, Closure $next)
    {
        $token = Session::get('token');
        $user_id = Session::get('user_id');
        if ($token) {
            $userActivity = DB::table('user_activity')->where('user_id', $user_id)->orderBy('id', 'desc')->first();
            if ($userActivity) {
                $now = Carbon::now();
                if ($now->diffInMinutes($userActivity->last_activity) > config('session.lifetime')) {
                    
                    // DB::table('user_activity')->where('session_token', $token)->delete();
                    DB::table('user_activity')->where('user_id', $user_id)
                    ->orderBy('id', 'desc')->limit(1)
                    ->update(['last_logout_time' => $now]);
                    Session::forget('token');
                    return redirect('/')->withErrors(['Your session has expired. Please log in again.']);
                } else {
                    DB::table('user_activity')->where('user_id', $user_id)
                    ->orderBy('id', 'desc')->limit(1)
                    ->update(['last_activity' => $now]);
                }
            } else {
                return redirect('/')->withErrors(['Invalid session token. Please log in again.']);
            }
        } else {
            return redirect('/')->withErrors(['You are not logged in. Please log in again.']);
        }
        return $next($request);
    }
}
