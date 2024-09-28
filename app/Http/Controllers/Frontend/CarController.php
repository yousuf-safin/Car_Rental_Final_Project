<?php

// namespace App\Http\Controllers\Frontend;
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller {
    public function index() {
        $cars = Car::where( 'availability', true )->get();
        return view( 'frontend.cars', compact( 'cars' ) );
    }
}
