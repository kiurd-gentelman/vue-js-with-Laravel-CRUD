<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
	public function authentication(Request $request)
    {
       // $this->validate($request, [
       //     'login_email' => ['required', 'string', 'email', 'max:255'],
       //     'login_password' => ['required', 'string', 'min:8', 'max:20'],
       // ]);
//        return Hash::make($request->password);
        $authentication = $this->login($request->email,$request->password);
//        return $authentication;

        if($authentication['error'] == false){
//            return redirect(route('home.index'))->with('success', 'Successfully login ');
            return response()->json([
                "token" => $authentication['token'],
                "error" => false,
                "message" => "Successfully Login"
            ]);
        }
        else{
            return response()->json([
                "error" => true,
                "message" => $authentication['message']
            ]);
        }
    }
    public function authenticationStore(Request $request){
        /*$this->validate($request,[
            'phone' => ['required', 'string', 'min:11', 'max:14'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8' , 'max:20'],
        ]);*/
        $duplicate = User::select('email')->where('email', $request->email)->get();

        if (sizeof($duplicate) <= 0 ){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
//            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->	remember_token = Str::random(60);
            if($user->save()){
                return response()->json([
                    "error" => false,
                    "message" => "Successfully Registered"
                ]);
            }
        }
        else{
            return response()->json([
                "error" => true,
                "message" => 'This email already used !!'
            ]);
//            return response()->json(array('message'=>));
        }
    }

    public function login($email,$password)
    {
           $user = User::where('email',$email )->first();
           if (!empty($user)) {
            if (Hash::check($password, $user->password)) {
                //var_dump($user->password);
                        // unset($user->password);
                        // $user['login'] = true;
                   // Session::put(['customer_id' => $user->id,'name' => $user->name,'username'=>$user->username,'email'=>$user->email,'phone'=>$user->phone,'login'=>true,'picture'=>$user->picture]);
//                    return true;
                return ["token" => $user->remember_token,
                    "error" => false,
                    "message" => "Successfully Login"
                ];
                   /* return response()->json([
                        "token" => $user->remember_token,
                        "error" => false,
                        "message" => "Successfully Login"
                    ]);*/

                }else {
                return [
                    "token" => '',
                    "error" => true,
                    "message" => 'Login failed !!'
                ];
//                    return redirect(route('loginRegister.index'))->with('error', 'Login failed !!');
                }
            }else{
               return [
                   "token" => '',
                   "error" => true,
                   "message" => 'you are not registered'
               ];
//                return redirect(route('loginRegister.index'))->with('error', 'you are not registered');
            }
    }	
}
