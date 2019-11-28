<?php

namespace App\Http\Controllers;

use App\User;
use App\Weather;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public static function getWeather(){
        $exist_places=array_column(User::select('place')->get()->toArray(),'place');#ユーザーから引っ張ってきたやつ
        $weather_places=array_column(Weather::select('place')->get()->toArray(),'place');#weatherから引っ張ってきたやつ

        $before='http://api.openweathermap.org/data/2.5/weather?lat=';
        $middle='&lon=';
        $after='&units=metric&appid=e526b100f3374389f6a8fc91560623ef';
        for ($i=0; $i < count($exist_places); $i++) {
            $ik='http://geoapi.heartrails.com/api/json?method=searchByPostal&postal='.$exist_places[$i];
            $ch1 = curl_init(); // 1. 初期化
            curl_setopt($ch1, CURLOPT_URL, $ik); // 2. オプションを設定
            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
            $location = curl_exec($ch1); // 3. 実行してデータを得る
            $location = json_decode($location, true);
            curl_close($ch1); // 4. 終了

            $url = $before.$location['response']['location']['0']['y'].$middle.$location['response']['location']['0']['x'].$after;
            $ch2 = curl_init(); // 1. 初期化
            curl_setopt($ch2, CURLOPT_URL, $url); // 2. オプションを設定
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, true);
            $weather = curl_exec($ch2); // 3. 実行してデータを得る
            $weather = json_decode($weather, true);
            curl_close($ch2); // 4. 終了

            
            Weather::where('place', $exist_places[$i])->update([
                    'weather'=>$weather['weather'][0]['main'],
                    'weather_description'=>$weather['weather'][0]['description'],
                    'weather_icon'=>$weather['weather'][0]['icon'],
                    'temp'=>$weather['main']['temp'],
                    'temp_max'=>$weather['main']['temp_max'],
                    'temp_min'=>$weather['main']['temp_min'],
                    'humidity'=>$weather['main']['humidity'],
                    'wind_speed'=>$weather['wind']['speed'],
                    'pressure'=>$weather['main']['pressure'],
                    'updated_at' => now()]);
        }
    }
}
