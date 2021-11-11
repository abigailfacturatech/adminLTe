<?php

namespace App\Http\Controllers;

use App\Events\PostEvent;
use App\Models\Post;
use App\Models\User;
use App\Notifications\PostNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    public function create()
    {
        return view('post.create');

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $post = Post::create($data);
        event(new PostEvent($post));
        return redirect()->back()->with('message', 'Post created successfully');

    }
    public function index()
    {

        $postNotifications = auth()->user()->unreadNotifications;
        return view('post.notification', compact('postNotifications'));
    }

    public function markAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
        ->when($request->input('id'), function($query)use ($request){
            return $query->where('id', $request->input('id'));

        })->markAsRead();
        return response()->noContent();
    }
}
