<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        $users = User::withCount('posts')->paginate(10);
    return view('users.index', compact('users'));
    }
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email
            ]);
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));
            Auth::login($user);
            // Increment the post_count for the user
            $user->increment('post_count');
        });

        return redirect(url('/users'));
    }
    public function show(User $user)
    {
        $posts = Post::select('title', 'id')->where('user_id', $user->id)->get();
        return view('users.show', ['user' => $user, 'posts' => $posts]);
    }
    public function edit($userId)
    {
        $user = User::findorfail($userId);
        return view('users.edit', ['user' => $user]);
    }
    public function update(Request $request, $userId)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        DB::transaction(function () use ($request, $userId) {
            $user = User::findOrFail($userId);
            $user->update([
                'name' => $request->name,
                'email' => $request->email
            ]);
        });

        return redirect(url('/users'));
    }
    public function destroy($userId)
    {
        $user = User::findOrFail($userId);

    // Log messages for debugging
    logger("Deleting user {$user->id}");

    // Attempt to delete associated posts
    try {
        $deletedPostsCount = $user->posts()->delete();
        logger("Deleted {$deletedPostsCount} posts");
    } catch (\Exception $e) {
        logger("Error deleting posts: {$e->getMessage()}");
    }

    // Attempt to delete the user
    try {
        $user->delete();
        logger("User deleted successfully");
    } catch (\Exception $e) {
        logger("Error deleting user: {$e->getMessage()}");
    }

    return redirect(url('/users'));
    }

}
