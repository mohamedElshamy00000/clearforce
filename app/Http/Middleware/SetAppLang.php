<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetAppLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(\Session::has('locale'))
        {
            \App::setlocale(\Session::get('locale'));
        }
        return $next($request);

        // if (! in_array($request->segment(1), config('app.available_locales') )) {
        //     // dd($request->segment(1));
        //     return redirect('/en');
        // }
     
        // App::setLocale($request->segment(1));

        // return $next($request);

    }
}
