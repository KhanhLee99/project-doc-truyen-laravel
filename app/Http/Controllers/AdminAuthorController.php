<?php

namespace App\Http\Controllers;

use App\Author;
use Exception;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    //
    public function index()
    {
        try {
            $authors = Author::all();
            return response()->json($authors);
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function add(Request $request)
    {
        try {
            $data = $request->all();
            $author = Author::create($data);
            return response()->json($author);
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            $data = $request->all();
            $author = Author::findOrFail($id)->update($data);
            return response()->json($author);
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function delete($id){
        try {
            $author = Author::findOrFail($id)->delete();
            return response()->json($author); //return true
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }

    public function search($name){
        try{
            $author = Author::where('name','like',"%{$name}%")->get();
            return response()->json($author);
        }
        catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
}