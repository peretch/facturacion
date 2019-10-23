<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Redirect;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($proveedor)
    {
        return Socialite::driver($proveedor)->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback($proveedor)
    {
        //$userSocial = Socialite::driver('facebook')->user();
        $userSocial = Socialite::driver($proveedor)->user();

//        $user->getId();
//        $user->getNickname();
//        $user->getName();
//        $user->getEmail();
//        $user->getAvatar();

        $findUser = User::where('email',$userSocial->email)->first();
        
        if($findUser){            
            Auth::Login($findUser);            
        }else{
            $user = new User();
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(str_random(40));
            $user->save();
            Auth::Login($user);
        }
        return Redirect::to('/');
    }

}
