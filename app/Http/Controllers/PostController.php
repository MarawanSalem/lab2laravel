<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class PostController extends Controller
{

    public function index()
    {
    $posts = Post::with('user')->paginate(3);
    return view('posts.index', compact('posts'));
    }


    public function create()
    {
        $users = User::all(); // Get all users for the dropdown
        return view('posts.create', compact('users'));
    }


    public function store(Request $request)
    {
        // Convert 'enabled' from 'on'/'off' to boolean (true/false), then to integer (1/0)
        $enabled = $request->has('enabled') ? 1 : 0;

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required',
            'user_id' => 'required|exists:users,id',
            'published_at' => 'nullable|date',
        ]);

        $requestData = $request->all();
        $requestData['enabled'] = $enabled;

        // Create the post
        $post = Post::create($requestData);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }


    public function show(string $id)
    {
        $post = Post::with('user')->findOrFail($id);
        return view('posts.show', compact('post'));
    }


    public function edit(string $id)
    {
        $post = Post::findOrFail($id);
        $users = User::all(); // Get all users for the dropdown
        return view('posts.edit', compact('post', 'users'));
    }


    public function update(Request $request, string $id)
    {
        $post = Post::findOrFail($id);
    $post->update($request->all());

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post successfully deleted.');
    }
}
