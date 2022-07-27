<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Twilio\Rest\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
  // protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest')->except('logout', 'fastAuth', 'authentication');
  }
  protected function authenticated()
  {
    if (Auth::user()->isAdmin()) {
      return redirect()->route('dashboard');
    }

    return redirect()->route('home');
  }

  public function fastAuth(Request $request)
  {
    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_sid = getenv("TWILIO_SID");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    $twilio = new Client($twilio_sid, $token);
    $twilio->verify->v2->services($twilio_verify_sid)
      ->verifications
      ->create('+966' . $request->phone, "sms");
    return redirect()->route('authentication')->with(['phone' =>  $request->phone]);
  }

  public function verify(Request $request)
  {
    $request->session()->keep(['phone']);

    $data = $request->validate([
      'code' => ['required', 'numeric', 'digits:4'],
      'phone' => ['required', 'string'],
    ]);

    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio_sid = getenv("TWILIO_SID");
    $twilio_verify_sid = getenv("TWILIO_VERIFY_SID");
    $twilio = new Client($twilio_sid, $token);
    $verification = $twilio->verify->v2->services($twilio_verify_sid)
      ->verificationChecks
      ->create($data['code'], array('to' => '+966' . $data['phone']));

    if ($verification->valid) {

      $user = User::where('phone', $data['phone'])->first();
      if ($user) {
        Auth::login($user);
      } else {
        $user =
          User::create([
            'name'  => 'Guest',
            'email' => 'guest@guest.com',
            'phone'  => $data['phone'],
            'password' => Hash::make('12345678'),
            'blocked'  => '0',
          ]);

        Auth::login($user);
      }

      return redirect()->route('home');
    } else {
      return back()->with(['phone' => $data['phone'], 'error' => 'رمز التحقق غير صحيح!']);
    }
  }
}
