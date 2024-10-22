<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User,
};
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    // ================== API Functions Start ====================
    public function register(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                "name" => "required|string",
                "email" => "required|email|unique:users,email",
                "password" => "required|string",
            ]);

            $name = $validator->errors()->get('name');
            $email = $validator->errors()->get('email');
            foreach($name as $n){
                return response()->json(["success" => false, "msg" => $n, "status" => 400], 400);            
            }
            foreach($email as $em){
                return response()->json(["success" => false, "msg" => $em, "status" => 400], 400);            
            }
            
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $user = User::create([
                "name" => $name,
                "email" => $email,
                "password" => Hash::make($password),
                // "otp" => rand(1111, 9999),
                "otp"=>1234
            ]);
            $user->assignRole('user');
            // Sending Email for Verification
            Notification::route("mail", $request->email)->notify(new VerifyEmail($user->otp));
            return response()->json(["success" => true, "msg" => "OTP has been sent to verify your email.", "status" => 200], 200);
        }catch (\Exception $e) {
            return response()->json(["success" => false, "msg" => "Something went wrong", "error" => $e->getMessage()]);        
        }
    }

    // Web function for verifying Email
    public function verifyOtp(Request $request){
        // dd($request->all());
        $validator =  Validator::make($request->all(), [
            "email" => "required|string|email",
            "otp_code" => "required",
        ]);
        $email = $validator->errors()->get('email');
        foreach($email as $em){
            return response()->json(["success" => false, "msg" => $em, "status" => 400], 400);            
        }

        $otp_code = $validator->errors()->get('otp_code');
        foreach($otp_code as $otp){
            return response()->json(["success" => false, "msg" => $otp, "status" => 400], 400);            
        }

        try{
            $user = User::where('email', $request->email)->where('otp', $request->otp_code)->first();
            if(isset($user) && !empty($user)){
                $user->otp = NULL;
                $user->email_verified_at = Carbon::now();
                if($user->save()){
                    return response()->json(["success" => true, "msg" => "Email Verified Successfully.", "status" => 200], 200);
                }else{
                    return response()->json(["success" => false, "msg" => "Email Verified Failed.", "status" => 400], 400);
                }
            }else{
                return response()->json(["success" => false, "msg" => "Email not found. Please check your email and try again", "status" => 400], 400);
            }
        }catch(\Exception $e){
            return response()->json(["success" => false, "msg" => "Something went wrong. Please try again","error" => $e->getMessage() , "status" => 400], 400);
        }
        
    }

    public function login(Request $request){
        try{
            $validator =  Validator::make($request->all(), [
                "email" => "required|string|email",
                "password" => "required|string",
            ]);
            $email = $validator->errors()->get('email');
            foreach($email as $em){
                return response()->json(["success" => false, "msg" => $em, "status" => 400], 400);            
            }
            
            $email =  $request->email;
            $password = $request->password;
            // checking email is verified or not
            $user = User::where('email', $email)->first();
            if($user->email_verified_at == NULL){                
                return response()->json(["success"=>false, "msg"=>"Your email is not verified. Please verify your email", "status"=>400], 400);
            }

            if(!$token = auth()->attempt(["email" => $email, "password" => $password])){
                return response()->json(['success'=>false, 'msg' => 'Email or password is incorrect', 'status'=>401], 401);
            }

            $jwt =  $this->respondWithToken($token);
            return response()->json(["success"=>true, "msg"=>"User Login Successfully", "token"=>$jwt, "status"=>200], 200);

        }catch(\Exception $e){
            return response()->json(['succcess' => false, "msg" => "Something Went Wrong", "error" => $e->getMessage()]);
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL() * 60
            'expires_in' => 86400, // means 1 day this time is in seconds
        ]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(){
        auth()->logout();
        return response()->json(["success"=>true, "msg"=>"User Logout Successfully", "status"=>200], 200);
    }

     /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    // public function sendEmailPassword(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         "email" => "required|string|email",
    //     ]);

    //     $emailVal = $validator->errors()->get('email');
    //     foreach($emailVal as $em){
    //         return response()->json(["success" => false, "msg" => $em, "status" => 400], 400);            
    //     }
    //     try{
    //         $email = $request->email;
    //         // Check if email is exist in Database
    //         $userEmail = User::where('email', $email)->count();
    //         if($userEmail > 0){
    //             $verificationCode = rand(1111, 9999);
    //             User::where('email', $email)->update(['verification_code'=>$verificationCode]);
    //             // Getting the email data from Database
    //             $emailData = Email::where('type', 'forgot_password')->first();
    //             $emailSub = $emailData->subject;
    //             $emailSubject = str_replace("[OTP]", $verificationCode, $emailSub);
    //             $emailMessage = $emailData->message;
    //             $emailContent = str_replace("[OTP]", $verificationCode, $emailMessage);
    //             Notification::route('mail', $email)->notify(new SendEmailForgotPassword($emailSubject, $emailContent));
    //             return response(["success"=>true, "msg"=>"OTP has been sent to the given email address", "status"=>200], 200);
    //         }else{
    //             return response(["success"=>false, "msg"=>"Email doesn`t exists", "status"=>400], 400);
    //         }
    //     }catch(\Exception $e){
    //         return response()->json(["success"=>false, "msg"=>"Something Went Wrong", "error" => $e->getMessage(), "status" => 400], 400);
    //     }
    // }


    // public function verifyCode(Request $request){
    //     try{
    //         $verificationCode = $request->verificationCode;
    //         $email = $request->email;

    //         $user = User::where('email', $email)->first();
    //         if($user['verification_code'] == $verificationCode){
    //             return response()->json(["success"=>true, "msg"=>"Email Verified Successfully", "status"=> 200], 200);
    //         }else{
    //             return response()->json(["success"=>false, "msg"=>"Code doesn`t matched... Incorrect Code", "status" => 400], 400);
    //         }
    //     }catch(\Exception $e){
    //         return response()->json(["success"=>false, "msg"=>"Something Went Wrong" ,"error"=>$e->getMessage()], 400);
    //     }
    // }

    // public function updatePassword(Request $request){
    //     $validator = Validator::make($request->all(),[
    //         "email" => "required|string|email",
    //         "new_password" => "required|string",
    //     ]);

    //     $email = $validator->errors()->get('email');
    //     $new_password = $validator->errors()->get('new_password');
    //     foreach($email as $em){
    //         return response()->json(["success" => false, "msg" => $em, "status" => 400], 400);            
    //     }
    //     foreach($new_password as $pass){
    //         return response()->json(["success" => false, "msg" => $pass, "status" => 400], 400);
    //     }
    //     $email = $request->email;
    //     $newPassword = Hash::make($request->new_password);
    //     $user = User::where('email', $email)->update(["password"=>$newPassword]);
    //     return response()->json(["success"=>true, "msg"=>"Password changed successfully", "status"=>200]);
    // }


    // ==================== API Function ends here ================================
}
