<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    function index(Request $request) {
        $api_keys = \Auth::user()->tokens()->get();
        return view('api_keys.index', ['api_keys' => $api_keys]);
    }

    function store(Request $request) {
        $data = $request->validate([
            'name' => 'required|string'
        ]);
        $token = \Auth::user()->createToken($data['name']);

        return response($token->plainTextToken)->header('Content-Type', 'text/plain');
    }
}
