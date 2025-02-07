<?php

namespace App\Http\Middleware;

use App\Models\Users;
use App\Models\UserToken;
use Closure;

class AdminAuthorization
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
        $token = $request->bearerToken();
        if (!$token || !$user_token = UserToken::where('token', $token)->first()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = Users::where("role_id", 1)->first($user_token->users_id);
        if (is_null($user)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->merge(['user' => $user, "token" => $token]);
        return $next($request);
    }
}
