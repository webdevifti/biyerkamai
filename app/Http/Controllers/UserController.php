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
            'password' => 'required|min:8',
            'photo' => 'mimes:jpg,png,jpeg|max:2048'
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

    public function edit($id){
        $user =  User::findOrFail(decrypt($id));
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'photo' => 'mimes:jpg,jpeg,png'
        ]);
       try {
            $user = User::findOrFail(decrypt($id));
            if ($request->hasFile('photo')) {
                $extension = $request->photo->getClientOriginalExtension();
                $fileName = uniqid() . '.' . $extension;
                if (file_exists(public_path('/uploads/users/' . $user->image)) && $user->image != null) {
                    unlink(public_path('/uploads/users/' . $user->image));
                    $request->photo->move(public_path('/uploads/users/'), $fileName);
                } else {
                    $request->photo->move(public_path('/uploads/users/'), $fileName);
                }
               
                $user->image = $fileName;
                $user->save();
            }
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone_number = $request->phone;
            $user->user_type = $request->user_type;
            $user->save();

         return back()->with('success', 'User has been Updated!');
        } catch (Exception $e) {
           return back()->with('error', 'Something happen Wrong!');
        }
    }

    public function delete($id){
        try{
            $user = User::findOrFail(decrypt($id));
            $user->delete();
            return back()->with('success','user has been deleted successfully.');
        }catch(Exception $e){
            return back()->with('error','Someting happened wrong!');
        }
    }
}
