<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('pages.user.index', compact('users'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'max:10', 'regex:/[a-z]/', 'regex:/[A-Z]/', Password::min(8)->mixedCase()->numbers()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.index')->with('success', 'addConfirm();');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (User::where('email', $request->email)->first()) {
            $email_rule = 'required|string|email|max:255';
        } else {
            $email_rule = 'required|string|email|max:255|unique:users';
        }

        if($request->password == null ) {
            $password_rule = '';
        }else {
            $password_rule = ['min:8', 'max:10', 'regex:/[a-z]/', 'regex:/[A-Z]/', Password::min(8)->mixedCase()->numbers()];
        }
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => $email_rule,
            'password' => $password_rule,
        ]);
        
        if($request->password == null ) {
            $password = $user->password;
        }else {
            $password = Hash::make($request->password);
        }
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password

        ]);
        return redirect()->route('user.index')->with('success', 'editConfirm();');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id === Auth::user()->id) {
            return redirect()->route('user.index')->with('success', 'destroyMessageFail();');
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'destroyMessage();');
    }
}
