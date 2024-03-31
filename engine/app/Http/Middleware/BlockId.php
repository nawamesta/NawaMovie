<?php

/**
 * Movos = The php Script for Landing Page Movies and TV Series
 *
 * @author Mas Zee <facebook.com/mas.zee.9619>
 * @copyright 2022 Nanosia.com
 * @link https://Nanosia.com
 * @license Reselling is prohibited, or can only be used alone
 * @version 1.0.0
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockId
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
        if($request->route()->hasParameter('id')) {
            $block = conf('block_id');
            $id = $request->route()->parameter('id');

            if (in_array($id, $block)) {
                return redirect()->route('home');
            }
        }

        return $next($request);
    }
}
