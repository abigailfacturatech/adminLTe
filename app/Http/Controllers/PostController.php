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

        // auth()->user()->notify(new PostNotification($post));

        // User::all()
        //     ->except($post->user_id)
        //     ->each(function(User $user) use ($post)
        //     {
        //        $user->notify(new PostNotification($post));
        //     });

        event(new PostEvent($post));

        return redirect()->back()->with('message', 'Post created successfully');
        // return 'el registro se guardo con exito';

    }
}
