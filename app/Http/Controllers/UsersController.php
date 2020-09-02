<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('email')) {
            $items = DB::table('users')->where('email',$request->email)->get();
            return response()->json([
                'message' => 'User got successfully',
                'data' => $items
            ], 200);
        } else {
            return response()->json(['status' => 'not found'], 404);
        }
    }
    public function put(Request $request)
    {
        $param = [
            'profile' => $request->profile,
            'email' => $request->email
        ];
        DB::table('users')->wwhere('email', $request->email)->updata($param);
        return response()->json([
            'message' => 'User updatad successfully',
            'data' => $param
        ],200);
    }
}
