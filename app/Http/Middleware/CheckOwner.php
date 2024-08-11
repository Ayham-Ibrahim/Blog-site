<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $blog = $request->route('blog');
        if ($blog->user_id !== Auth::user()->id) {
            return redirect()->back()->with('error', 'You are not authorized to perform this action.');
        }
        return $next($request);
    }
}
