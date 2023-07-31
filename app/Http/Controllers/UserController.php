<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{


    function LoginPage(){
        return view('pages.auth.login-page');
    }

    function RegistrationPage(){
        return view('pages.auth.registration-page');
    }
    function SendOtpPage(){
        return view('pages.auth.send-otp-page');
    }
    function VerifyOTPPage(){
        return view('pages.auth.verify-otp-page');
    }

    function ResetPasswordPage() {
        return view('pages.auth.reset-pass-page');
    }

    function ProfilePage(){
        return view('pages.dashboard.profile-page');
    }




    function UserRegistration(Request $request){ 

        try {

            User::create([
                'firstName'=>$request->input('firstName'),
                'lastName'=>$request->input('lastName'),
                'email'=>$request->input('email'),
                'mobile'=>$request->input('mobile'),
                'password'=>$request->input('password')
            ]);

            return response()->json([
                'status'=>'success',
                'message'=>'user registration successful'
            ],status:200);

        } catch(Exception $e){
            return response()->json([
                'status'=>'failed',
               // 'message'=>$e->getMessage() used to get message description
               'message'=>'registration failed'
            ]);

        }
     
       
    }

    function UserLogin(Request $request){
      $count=  User::where('email','=',$request->input('email'))
        ->where('password','=',$request->input('password'))
        ->select('id')->first();
        if($count!==null){
            //user login and token issue
            $token = JWTToken::CreateToken($request->input('email'),$count->id);

            return response()->json([
                'status'=>'success',
                'message'=>'user login successful',
                //'token'=>$token
            ],status:200)->cookie('token',$token,60*24*60);//cookie for 2 minutes


        } else {

            return response()->json([
                'status'=>'failed',
                'message'=>'unathorized'
            ]);

        }
    }

    function SendOTPCode(Request $request){
        $email=$request->input('email');
        $otp=rand(1000,9999);
        $count=User::where('email','=',$email)->count();
        if($count===1){

            //send OTP to user email
            Mail::to($email)->send(new OTPMail($otp));
            //send OTP to database
            User::where('email','=',$email)->update(['otp'=>$otp]);

            return response()->json([
                'status'=>'success',
                'message'=>'4 digit otp code has been sent to your email address'
            ],status:200);


        } else {

            return response()->json([
                'status'=>'failed',
                'message'=>'unauthorized'
            ]);

        }
    }

    function VerifyOTP(Request $request){
        $email=$request->input('email');
        $otp=$request->input('otp');
        $count=User::where('email','=',$email)
        ->where('otp','=',$otp)->count();
        if($count===1){
         //update otp in database
         User::where('email','=',$email)->update(['otp'=>'0']);
         //issue token to reset password

         $token=JWTToken::CreateTokenForSetPassword($request->input('email'));
         return response()->json([
            'status'=>'success',
            'message'=>'otp verification successful',
            //'token'=>$token
         ],status:200)->cookie('token',$token,60*24*30);

        } else {

            return response()->json([
                'status'=>'failed',
                'message'=>'unauthorized'
            ]);

        }
    }

   function ResetPassword(Request $request){
    try {
        $email=$request->header('email');
        $password=$request->input('password');
        User::where('email','=',$email)->update(['password'=>$password]);

        return response()->json([
            'status'=>'success',
            'message'=>'password reset successful'
        ],status:200);
    } catch (Exception $exception) {
        return response()->json([
            'status'=>'failed',
            'message'=>'password reset failed'
        ]);
       
    }


   }
function UserLogout(){
    return redirect('/userLogin')->cookie('token','',-1);
}
function UserProfile(Request $request){
    $email = $request->header('email');
    $user = User::where('email','=',$email)->first();

    return response()->json([
        'status'=>'success',
        'message'=>'request successful',
        'data'=>$user
    ],status:200);
}

function UpdateProfile(Request $request){
    
    try {
        $email = $request->header('email');
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');
        $mobile = $request->input('mobile');
        $password=$request->input('password');
        User::where('email','=',$email)->update([
            'firstName'=>$firstName,
            'lastName'=>$lastName,
            'mobile'=>$mobile,
            'password'=>$password
        ]);

        return response()->json([
            'status'=>'success',
            'message'=>'request successful'
        ],status:200);
        
    } catch (Exception $exception) {
       return response()->json([
        'status'=>'fail',
        'message'=>'something went wrong'
       ]);
    }
}



  
}
