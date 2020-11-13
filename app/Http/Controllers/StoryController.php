<?php

namespace App\Http\Controllers;

use App\Story;
use Exception;
use Illuminate\Http\Request;

class StoryController extends Controller
{
    //
    public function getStoriesManyView($number)
    {
        try {
            return Story::orderBy('view','desc')->limit($number)->get();
        } catch (Exception $e) {
            $response['error'] = $e->getMessage();
            return response()->json($response);
        }
    }
}
