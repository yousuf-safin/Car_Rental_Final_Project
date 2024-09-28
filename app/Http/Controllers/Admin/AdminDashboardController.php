<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;

class AdminDashboardController extends Controller {
    public function index() {
        $totalCars = Car::count();
        $availableCars = Car::where( 'availability', true )->count();
        $totalRental = Rental::count();
        $totalEarning = Rental::sum( 'total_cost' );

        return view( 'admin.dashboard', compact( 'totalCars', 'availableCars', 'totalRental', 'totalEarning' ) );
    }
}
