<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestGift;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;

class ImportExportController extends Controller
{
    //
    function exportPDF()
    {
        // retreive all records from db
        $gifts = GuestGift::orderBy('created_at','ASC')->get();
        $totalCollection = GuestGift::select('gift_amount')->sum('gift_amount');
        $data = [
            'title' => 'All Collection',
            'date' => date('m/d/Y, H:i a'),
            'gifts' => $gifts,
            'totalCollection' => $totalCollection
        ]; 
            
        $pdf = PDF::loadView('exports.collectionPDF', $data);
     
        return $pdf->download('collection.pdf');
    }
    function userExportPDF()
    {
        // retreive all records from db
        $users = User::where('id','!=',Auth::user()->id)->orderBy('created_at','ASC')->get();
        $totalusers = User::all()->count();
        $data = [
            'title' => 'All Users',
            'date' => date('m/d/Y, H:i a'),
            'users' => $users,
            'totalusers' => $totalusers
        ]; 
            
        $pdf = PDF::loadView('exports.userPDF', $data);
     
        return $pdf->download('users.pdf');
    }
}
