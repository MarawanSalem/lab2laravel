<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        // Pass users to the view
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Show create user form
        return view('users.create');
    }

    /**
     * Store a newly created user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user and save it to the database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // Make sure to hash the password
            'password' => bcrypt($request->password),
        ]);

        // Redirect to the users index with a success message
        return redirect()->route('users.index')->with('success', 'User successfully created.');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the user by id
        $user = User::findOrFail($id);
        // Show user details
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Find the user by id
        $user = User::findOrFail($id);
        // Show edit form with user data
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            // You might not want to require password on update
            // 'password' => 'sometimes|string|min:8',
        ]);

        // Find the user and update
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            // Uncomment if you're updating the password
            // 'password' => bcrypt($request->password),
        ]);

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified user from the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the user and delete
        $user = User::findOrFail($id);
        $user->delete();

        // Redirect with success message
        return redirect()->route('users.index')->with('success', 'User successfully deleted.');
    }
}


