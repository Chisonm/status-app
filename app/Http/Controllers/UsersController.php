<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('role', "user")->get();
        return view('admin.users.users',compact('users'));
    }

    public function approveUser($id)
    {
        $user = User::findOrFail($id);

        $user->approved_at = now();
        $user->status = 1;
        $user->update();

        return back()->with('status', 'User Approved!');
    }
}
