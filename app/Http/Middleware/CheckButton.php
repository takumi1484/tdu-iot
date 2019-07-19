<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Device;
use App\Button;

class CheckButton
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
        $query_id = $request->route()->parameter('id');
        //ボタンIDからデバイスIDを取ってそのデバイスIDはログイン中のユーザーが持っているか

        if (Auth::id() == Button::where('id',$query_id)->first()->device->user->id){
            return $next($request);
        }else{
            abort(419);
        }

//        if ($query_id==1){
//            abort(419);
//        }else {
//            return $next($request);
//        }
    }
}