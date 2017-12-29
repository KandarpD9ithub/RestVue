<?php
/**
 * @package App/Http/Middleware
 *
 * @class BasicAuth
 *
 * @author Kandarp Pandya <kandarp.d9ithub@gmail.com>
 *
 */
namespace App\Http\Middleware;

use Closure;
use Auth;

class BasicAuth
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
        return Auth::onceBasic('username');
    }
}
