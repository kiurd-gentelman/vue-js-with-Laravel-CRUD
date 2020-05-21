<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

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
