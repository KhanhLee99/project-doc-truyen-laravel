<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    //
    private $status_code    =        200;
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        return response()->json($users);
    }
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $user = User::create($data);
            return response()->json($user);
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id)->update($request->all());
            return response()->json($user);
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
    public function delete($id)
    {
        try {
            $user = User::findOrFail($id)->delete();
            return response()->json($user); //return true
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
    public function search($name)
    {
        try {
            return User::where('name', 'like', "%{$name}%")->get();
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator          =       Validator::make(
                $request->all(),
                [
                    "email"             =>          "required|email",
                    "password"          =>          "required"
                ]
            );

            if ($validator->fails()) {
                return response()->json(["status" => "failed", "validation_error" => $validator->errors()]);
            }

            // check if entered email exists in db
            $email_status       =       User::where("email", $request->email)->first();
            if (!is_null($email_status)) {
                $password_status    =   User::where("email", $request->email)->where("password", md5($request->password))->first();
                if (!is_null($password_status)) {
                    $user           =       $password_status;
                    if ($user->role != 'user') {
                        return response()->json(["status" => $this->status_code, "success" => true, "message" => "You have logged in successfully", "data" => $user]);
                    }
                    else{
                        return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. You not Admin !!!."]);
                    }
                } else {
                    return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Incorrect password."]);
                }
            } else {
                return response()->json(["status" => "failed", "success" => false, "message" => "Unable to login. Email doesn't exist."]);
            }
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
}
