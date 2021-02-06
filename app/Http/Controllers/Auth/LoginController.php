<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Auth;
use Exception;
use App\User;
use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToFacebook() { 
        //dd(Socialite::driver('facebook')->redirect());
        return Socialite::driver('facebook')->redirect();
    }
    // public function handleFacebookCallback() {
    //     try {  
    //         $user = Socialite::driver('facebook')->user();
    //         dd($user);
    //         $finduser = User::where('facebook_id', $user->id)->first();
    //         if ($finduser) {
    //             Auth::login($finduser);
    //             return redirect('/home');
    //         } else {
    //             $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'facebook_id' => $user->id]);
    //             Auth::login($newUser);
    //             return redirect()->back();
    //         }
    //     }
    //     catch(Exception $e) {
    //         return redirect('auth/facebook');
    //     }
    // }
    public function handleFacebookCallback()
    {
      $userSocial = Socialite::driver('facebook')->user();
          //return $userSocial;
          $finduser = User::where('facebook_id', $userSocial->id)->first();
          if($finduser){
              Auth::login($finduser);
              return Redirect::to('/home');
          }else{
          $new_user = User::create([
                'name'      => $userSocial->name,
                'email'      => $userSocial->email,
                'password' => Hash::make(12345678),
                'facebook_id'=> $userSocial->id
            ]);
            Auth::login($new_user);
            return Redirect::to('/home');
            //return redirect()->back();
        }
    }
}
