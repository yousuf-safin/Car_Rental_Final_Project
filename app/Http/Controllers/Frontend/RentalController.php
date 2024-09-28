<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller {

    public function store( Request $request ) {

        $request->validate( [
            'car_id'     => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date'   => 'required|date|after:start_date',
        ] );

        $car = Car::findOrFail( $request->car_id );
        $startDate = Carbon::parse( $request->start_date );
        $endDate = Carbon::parse( $request->end_date );
        $rentalPeriod = $startDate->diffInDays( $endDate );
        $totalCost = $car->daily_rent_price * $rentalPeriod;

        $rental = new Rental();
        $rental->user_id = auth()->id();
        $rental->car_id = $request->car_id;
        $rental->start_date = $startDate;
        $rental->end_date = $endDate;
        $rental->total_cost = $totalCost;
        $rental->save();

        return redirect()->route( 'frontedrentals' )->with( 'status', 'Rental successfully created!' );
    }

    public function index( Request $request ) {
        $query = Car::query();

        if ( $request->filled( 'car_type' ) ) {
            $query->where( 'car_type', $request->car_type );
        }

        if ( $request->filled( 'brand' ) ) {
            $query->where( 'brand', $request->brand );
        }

        if ( $request->filled( 'price_range' ) ) {
            $query->where( 'daily_rent_price', '<=', $request->price_range );
        }

        $cars = $query->paginate( 12 );

        $carTypes = Car::distinct()->pluck( 'car_type' );
        $brands = Car::distinct()->pluck( 'brand' );

        return view( 'frontend.rentals', compact( 'cars', 'carTypes', 'brands' ) );
    }

    public function create( $carId ) {

        $car = Car::findOrFail( $carId );

        $unavailableDates = Rental::where( 'car_id', $carId )
            ->where( 'end_date', '>=', Carbon::now() )
            ->get( ['start_date', 'end_date'] );

        return view( 'frontend.rentals.create', compact( 'car', 'unavailableDates' ) );
    }

    public function cancel( $id ) {

        $rental = Rental::findOrFail( $id );

        $rental->status = 'canceled';
        $rental->save();

        return redirect()->route( 'myrentals' )->with( 'status', 'Booking canceled successfully.' );
    }
}
