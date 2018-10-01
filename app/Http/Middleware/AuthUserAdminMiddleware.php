<?php

namespace App\Http\Middleware;

use App\Shop\Entity\User;
use Closure;

class AuthUserAdminMiddleware
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
    // default set not allow to access
    $is_allow_access = false;
    // get member_id
    $user_id = session()->get('user_id');

    if(!is_null($user_id)) {
      // session has user_id, through it get user_id
      $User = User::findOrFail($user_id);

      if($User->type == 'A'){
        $is_allow_access = true;
      }
    }

    if(!$is_allow_access){
      // if not allow access,redirect to homepage
      return redirect()->to('/');
    }

    // if allow access, do the next request 
    return $next($request);
  }
}
