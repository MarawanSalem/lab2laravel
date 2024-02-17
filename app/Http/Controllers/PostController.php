<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Events\PostCreated;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        // Apply the auth middleware to all methods except index and show
        $this->middleware('auth')->except(['index', 'show']);
    }

     public function index()
    {
        $posts = Post::all();
        // event(new \App\Events\PostCreated($posts));
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $users=User::select('id')->get();
        return view('posts.create',['users'=>$users]); 
       }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required',
            'published_at' => 'required|date_format:Y-m-d',
        ]);
        // Retrieve the authenticated user
        $user = Auth::user();

        // Create and save the post
        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->body = $request->body;
        $post->published_at = $request->published_at;

        // Associate the post with the authenticated user
        $post->user()->associate($user);

        $post->save();

        // Dispatch the PostCreated event after successfully creating the post
        event(new PostCreated($post));

        // Redirect to the posts index page
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }
        
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $user = User::select('id', 'name')->where('id', $post->user_id)->first();
        return view('posts.show', ['post' => $post], ['user' => $user]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::select('id')->get();
        $posts = Post::findorfail($id);
        return view('posts.edit', ['post' => $posts], ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);
        $post = Post::findOrFail($id);

        // Check if the authenticated user is the owner of the post
        if ($post->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to update this post.');
        }

        $request->validate([
            'title' => 'required',
            'body' => 'required',
            // Add other validation rules as needed
        ]);

        // Update the post
        $post->update([
            'title' => $request->title,
            'body' => $request->body,
            'slug' => $request->slug,
            'published_at' => $request->published_at,
            'enabled' => $request->has('enabled'),
        ]);

        // Redirect to a success page or wherever you want
        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::findorfail($id);
        $post->delete();
        return redirect(url('/posts'));
    }
}
