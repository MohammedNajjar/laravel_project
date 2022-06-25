<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\TweetResource;
use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tweets = Tweet::all();
        $tweets = $tweets->map(function($tweet){
            Return [
                'Tweet' => $tweet->content,
                'date' => $tweet->created_at
            ];
        });

        return response()->json(['tweet'=>$tweets]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        $user = auth()->user();

        $tweet = Tweet::create([
            'content' => $request->content,
            'user_id' => $user->id
        ]);

        return response()->json(['status' => 'ok', 'data' => ['tweet' => $tweet]]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::with('user')
            ->withCount('user')
            ->find($id);
        return response()->json(['tweet'=>$tweet]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */

        public function update(Request $request, Tweet $tweet)
    {
        $request->validate([
            'content' => 'required|string'
        ]);
        $tweet->update([
            'content' => $request->content,
        ]);

        return response()->json(['status' => 'ok', 'data' => ['tweet' => $tweet]]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $tweet = Tweet::find($id);

        if (!$tweet) {
            return response()->json([
                'success' => false,
                'message' => 'Tweet not found.'
            ], 404);
        }

        $tweet->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tweet deleted successfully.'
        ], 200);
    }
}
