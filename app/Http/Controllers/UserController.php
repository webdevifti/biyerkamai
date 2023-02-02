<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

    public function index()
    {
        $data = User::where('id', '!=', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        $totalusers = User::where('id', '!=', Auth::user()->id)->get()->count();
        return view('users.index', compact('data', 'totalusers'));
    }

    public function create()
    {
        return view('users.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users,email',
            'user_type' => 'required',
            'password' => 'required|min:8'
        ]);
        try {
            $photoname = NULL;
            if ($request->hasFile('photo')) {
                $extension = $request->photo->getClientOriginalExtension();
                $photoname = uniqid() . '.' . $extension;
                $request->photo->move(public_path('/uploads/users/'), $photoname);
            }
            User::create([
                'added_by' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone,
                'image' => $photoname,
                'user_type' => $request->user_type,
            ]);
            return back()->with('success', 'User has been added successfully.');
        } catch (Exception $e) {
            return back()->with('error', 'User Not added');
        }
    }
}
