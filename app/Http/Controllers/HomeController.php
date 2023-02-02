<?php

namespace App\Http\Controllers;

use App\Models\GuestGift;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $total_collection = GuestGift::select('gift_amount')->sum('gift_amount');
        $total_users = GuestGift::all()->count();
        $maximum_collections = GuestGift::orderBy('gift_amount','DESC')->limit(10)->get();
        return view('home', compact('total_collection','total_users','maximum_collections'));
    }
}
