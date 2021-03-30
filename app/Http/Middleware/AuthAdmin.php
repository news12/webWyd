<?php

namespace App\Http\Middleware;

use Closure;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->cargo !== 3) {

            // Redireciona o usuário para a página de login, com session flash "message"
            return redirect()
                ->route('home')
                ->with('error', 'Você não tem permissão para acessar essa área!');
        }
        return $next($request);
    }
}
