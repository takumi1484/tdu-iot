<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Weather;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $error_messages = [
            "name.unique"=>"その名前は既に使われています。ほかの名前を入力してください",
            "password.min:6"=>"パスワードは6文字以上にしてください"
        ];

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'ken'=>'required',
            'siku'=>'required',

        ],$error_messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {   
        
        $url = 'https://zipcoda.net/api/?address='.$data['ken'].$data['siku'];
        $ch = curl_init(); // 1. 初期化
            curl_setopt( $ch, CURLOPT_URL, $url ); // 2. オプションを設定
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $name = curl_exec( $ch ); // 3. 実行してデータを得る
            $name = json_decode($name , true );
            curl_close($ch); // 4. 終了

            $test_user=User::create([
                'name' => $data['name'],
                //'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'place'=>$name['items'][0]['zipcode']
            ]);
            $weather_places=array_column(Weather::select('place')->get()->toArray(),'place');#weatherから引っ張ってきたやつ

            $before='http://api.openweathermap.org/data/2.5/weather?lat=';
            $middle='&lon=';
            $after='&units=metric&appid=e526b100f3374389f6a8fc91560623ef';
            $ik='http://geoapi.heartrails.com/api/json?method=searchByPostal&postal='.$name['items'][0]['zipcode'];
            $ch1 = curl_init(); // 1. 初期化
            curl_setopt( $ch1, CURLOPT_URL, $ik ); // 2. オプションを設定
            curl_setopt( $ch1, CURLOPT_RETURNTRANSFER, true );
            $location = curl_exec( $ch1 ); // 3. 実行してデータを得る
            $location = json_decode($location , true );                    
            curl_close($ch1); // 4. 終了

            $url = $before.$location['response']['location']['0']['y'].$middle.$location['response']['location']['0']['x'].$after;
            $ch2 = curl_init(); // 1. 初期化
            curl_setopt( $ch2, CURLOPT_URL, $url ); // 2. オプションを設定
            curl_setopt( $ch2, CURLOPT_RETURNTRANSFER, true );
            $weather = curl_exec( $ch2 ); // 3. 実行してデータを得る
            $weather = json_decode($weather , true );
            curl_close($ch2); // 4. 終了

            if(!(in_array($name['items'][0]['zipcode'], $weather_places))){
                Weather::where('place',$name['items'][0]['zipcode'])->insert([
                    'place'=>$name['items'][0]['zipcode'],
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
                    'updated_at' => now()]);
            }

        return $test_user;
    }
}
