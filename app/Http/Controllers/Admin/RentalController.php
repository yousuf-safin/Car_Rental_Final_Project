<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentalController extends Controller {

    public function index() {
        $rentals = Rental::with( ['user', 'car'] )->get();

        foreach ( $rentals as $rental ) {
            $rental->start_date = Carbon::parse( $rental->start_date );
            $rental->end_date = Carbon::parse( $rental->end_date );
        }

        return view( 'admin.rentals.index', compact( 'rentals' ) );
    }

    public function show( $id ) {
        $rental = Rental::with( ['user', 'car'] )->findOrFail( $id );
        return view( 'admin.rentals.show', compact( 'rental' ) );
    }

    public function destroy( $id ) {
        $rental = Rental::findOrFail( $id );
        $rental->delete();
        return redirect()->route( 'rentals.index' )->with( 'status', 'Rental deleted successfully!' );
    }

    public function edit( $id ) {
        $rental = Rental::findOrFail( $id );
        $rental->start_date = Carbon::parse( $rental->start_date );
        $rental->end_date = Carbon::parse( $rental->end_date );
        $cars = Car::all();
        return view( 'admin.rentals.edit', compact( 'rental', 'cars' ) );
    }

    public function update( Request $request, $id ) {
        $rental = Rental::findOrFail( $id );

        $request->validate( [
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
            'status'     => 'required|in:Ongoing,Completed,Canceled',
        ] );

        $rental->start_date = $request->start_date;
        $rental->end_date = $request->end_date;
        $rental->status = $request->status;
        $rental->save();

        return redirect()->route( 'rentals.index' )->with( 'status', 'Rental updated successfully!' );
    }

}
