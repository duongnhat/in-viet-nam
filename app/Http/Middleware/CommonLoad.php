<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CommonLoad
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share('PANO_1', $this->loadPano1());
        return $next($request);
    }

    private function loadPano1()
    {
        return DB::table('image')
            ->where('pano_id', '=', 1)
            ->get();
    }
}
