<?php

namespace App\Http\Controllers;

use App\Models\GuestGift;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestGiftController extends Controller
{
    //

    public function index(){
        $data = GuestGift::orderBy('created_at', 'DESC')->get();
        $totalCollection = GuestGift::select('gift_amount')->sum('gift_amount');
        return view('gifts.index', compact('data','totalCollection'));
    }
    public function create(){
        return view('gifts.create');
    }
    public function store(Request $request){
        $request->validate([
            'guest_name' => 'required|string',
        ]);
        if($request->gift_type == 'cash'){
            $request->validate([
                'gift_amount' => 'required|integer'
            ]);
        }
        try{
            GuestGift::create([
                'user_id' => Auth::user()->id,
                'guest_name' => $request->guest_name,
                'guest_address' => $request->guest_address,
                'gift_type' => $request->gift_type,
                'gift_amount' => $request->gift_amount
            ]);
            return back()->with('success','Collection has been saved');
        }catch(Exception $e){
            return back()->with('error','Collection not saved');
        }
    }
    public function edit($id){

    }
    public function delete($id){
        try{
            $row = GuestGift::findOrFail(decrypt($id));
            $row->delete();
            return back()->with('success','Item has been removed successfully.');
        }catch(Exception $e){
            return back()->with('error', 'Something happened wrong');
        }
    }
    public function permanentDelete(){

    }
    public function restore(){

    }

}
