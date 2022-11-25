<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckWord {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
   * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
   */
  public function handle(Request $request, Closure $next) {
    $illegalWords = [
      'apple',
      'banana'
    ];

    $parameters = $request->all();


    foreach ($parameters as $key => $value) {
      if ($key === 'content') {
        foreach ($illegalWords as $illegalWord) {
          if (strpos($value, $illegalWord) !== false) {
            return response('content had illegal word', 400);
          }
        }
      }
    }

    return $next($request);
  }
}
