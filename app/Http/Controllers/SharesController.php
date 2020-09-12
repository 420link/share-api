<?php

namespace App\Http\Controllers;

use App\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SharesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Share::all();
        return response()->json([
            'message' => 'OK',
            'data' => $items
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Share;
        $item->user_id = $request->user_id;
        $item->share = $request->share;
        $item->save();
        return response()->json([
            'message' => 'Share created successfully',
            'data' => $item
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function show(Share $share)
    {
        $item = Share::where('id', $share->id)->first();
        $like = DB::table('likes')->where('share_id', $share->id)->get();
        $user = DB::table('users')->where('id', $item->user_id)->first();
        $comment = DB::table('comments')->where('share_id', $share->id)->get();
        $comment_data = array();
        foreach ($comment as $value) {
            $comment_user = DB::table('users')->where('id', $value->user_id)->first();
            $comments = [
                "comment" => $value,
                "comment_user" => $comment_user
            ];
            array_push($comment_data, $comments);
            }
            $items = [
                "item" => $item,
                "like" => $like,
                "comment" => $comment_data,
                "name" => $user->name,
            ];
            return response()->json($items,200);
        

    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Share  $share
     * @return \Illuminate\Http\Response
     */
    public function destroy(Share $share)
    {
        $item = Share::where('id', $share->id)->delete();
        if ($item) {
            return response()->json(
                ['message' => 'Share deleted successfully'],
                200
            );
        } else {
            return response()->json(
                ['message' => 'Share not found'],
                404
            );
        }
    }
    }

