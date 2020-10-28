<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    //
    public function index()
    {
        $users = User::orderBy('id','desc')->get();
        return response()->json($users);
    }
    public function store(Request $request){
        try{
            $data = $request->all();
            $user = User::create($data);
            return response()->json($user);
        }
        catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
    public function edit(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id)->update($request->all());
            return response() -> json($user);
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
    public function search($name){
        try{
            return User::where('name','like',"%{$name}%")->get();
        }
        catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function login(Request $request){
        try {
            $data = $request->all();
            $user = User::where('email', $data['email'])->where('password', $data['password'])->get();
            $count = $user->count();
            return response()->json($count);
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
}
