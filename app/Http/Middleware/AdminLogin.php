<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session, DB;
use Illuminate\Support\Facades\Config;


class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        date_default_timezone_set('Asia/Kolkata');
        if (Session::has('token')) {

            $user_type = Session::get('user_type');

            switch ($user_type) {
                case 3:
                    Config::set('session.lifetime', 25);
                    break;
                case 4:
                    Config::set('session.lifetime', 25);
                    break;
                case 5:
                    Config::set('session.lifetime', 25);
                    break;
                case 6:
                    Config::set('session.lifetime', 25);
                    break;
                case 7:
                    Config::set('session.lifetime', 25);
                    break;
                case 8:
                    Config::set('session.lifetime', 25);
                    break;
                case 9:
                    Config::set('session.lifetime', 25);
                    break;

                default:
                Config::set('session.lifetime', 60);
                    break;
            }



            return $next($request);
        } else {

            return redirect('/user_login');
        }
    }
}
