<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Carbon\Carbon;

class MyRentals extends Controller {
    public function index() {
      
        $currentUser = auth()->user();
        $userId = $currentUser->id;

     
        $currentRentals = Rental::where('user_id', $userId)
            ->where('end_date', '>=', Carbon::now())
            ->get();

     
        $pastRentals = Rental::where('user_id', $userId)
            ->where('end_date', '<', Carbon::now())
            ->get();

        return view('myrentals.index', compact('currentRentals', 'pastRentals'));
    }
}
