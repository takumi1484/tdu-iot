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
        $places=array_unique(User::select('place')->get()->toArray(), SORT_REGULAR);
        $exist_places=array_column(Weather::select('place')->get()->toArray(),'place');

        $before='http://api.openweathermap.org/data/2.5/weather?q=';
        $after=',jp&units=metric&appid=e526b100f3374389f6a8fc91560623ef';
        for ($i=0; $i < count($places); $i++) {
            $name=(object)$places[$i];
            $url = $before.$name->place.$after;
            $weather = json_decode(file_get_contents($url), true);
            if (in_array($name->place,$exist_places,true)) {
                Weather::where('place',$name->place)->update([
                    
                    'weather'=>$weather['weather'][0]['main'],
                    'weather_description'=>$weather['weather'][0]['description'],
                    'weather_icon'=>$weather['weather'][0]['icon'],
                    'temp'=>$weather['main']['temp'],
                    'temp_max'=>$weather['main']['temp_max'],
                    'temp_min'=>$weather['main']['temp_min'],
                    'humidity'=>$weather['main']['humidity'],
                    'wind_speed'=>$weather['wind']['speed'],
                    'pressure'=>$weather['main']['pressure'],
                    'updated_at' => now()
                ]);
            }else{
                Weather::insert([
                    'place'=>$name->place,
                    'weather'=>$weather['weather'][0]['main'],
                    'weather_description'=>$weather['weather'][0]['description'],
                    'weather_icon'=>$weather['weather'][0]['icon'],
                    'temp'=>$weather['main']['temp'],
                    'temp_max'=>$weather['main']['temp_max'],
                    'temp_min'=>$weather['main']['temp_min'],
                    'humidity'=>$weather['main']['humidity'],
                    'wind_speed'=>$weather['wind']['speed'],
                    'pressure'=>$weather['main']['pressure'],
                    'created_at'=>now(),
                    'updated_at' => now()
                ]);
            }


        }
    }

}
