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
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;


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
        return $next($request);
    }
}
