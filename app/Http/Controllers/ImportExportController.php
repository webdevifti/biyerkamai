<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GuestGift;
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
}
