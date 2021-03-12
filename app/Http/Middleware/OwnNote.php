<?php

namespace App\Http\Middleware;

use App\Models\Note;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class OwnNote
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
        $noteId = $request->route('postId');

        if (authCustomer()->notes()->find($noteId)) {
            return $next($request);
        }

        abort(405, 'Permission denied');
    }
}
