<?php

namespace App\Http\Middleware;

use App\Button;
use App\Device;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckDevice
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

        if (Auth::id() == Device::where('id',$query_id)->first()->user->id){
            return $next($request);
        }else{
            abort(419);
        }
    }
}
