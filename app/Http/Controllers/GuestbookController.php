<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\GuestbookPosts;

class GuestbookController extends Controller
{
	public function index()
	{
		$posts = GuestbookPosts::all()->reverse();
		return view('guestbook', compact('posts'));
	}

    public function newpost(Request $request)
    {

    	$validation = Validator::make($request->all(), [
    		'name' => 'required|max:100',
    		'message' => 'required|max:5000'
    	]);

    	if ($validation->fails())
    	{
    		$posts = GuestBookPosts::all()->reverse();
    		return redirect('guestbook')
    			->with(compact($posts))
    			->withErrors($validation);
    	}

    	$new_post = new GuestbookPosts;
    	$new_post->name = $request->input('name');
    	$new_post->message = $request->input('message');
    	$new_post->save();

    	$posts = GuestBookPosts::all()->reverse();

    	return view('guestbook')
    		->with(compact('posts'))
    		->with(['post_created'=>'1']);
    }

    public function delete(int $id)
    {
    	GuestbookPosts::where('id', $id)->firstOrFail()->delete();

    	$posts = GuestBookPosts::all()->reverse();

    	return view('guestbook')
    		->with(compact('posts'))
    		->with(['post_removed'=>'1']);
    }
}
