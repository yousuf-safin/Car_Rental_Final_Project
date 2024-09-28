<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller {
    public function index() {
        $cars = Car::all();
        return view( 'admin.cars', compact( 'cars' ) );
    }

    public function create() {
        return view( 'admin.cars.create' );
    }

    public function store( Request $request ) {
        $request->validate( [
            'name'             => 'required|string|max:255',
            'brand'            => 'required|string|max:255',
            'model'            => 'required|string|max:255',
            'year'             => 'required|integer|min:1900|max:' . date( 'Y' ),
            'car_type'         => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability'     => 'required|boolean',
            'image'            => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ] );

        $car = new Car( $request->all() );

        if ( $request->hasFile( 'image' ) ) {
            $imagePath = $request->file( 'image' )->store( 'cars', 'public' );
            $car->image = $imagePath;
        }

        $car->save();

        return redirect()->route( 'cars.index' )->with( 'status', 'Car added successfully!' );
    }

    public function destroy( Car $car ) {
        $car->delete();
        return redirect()->route( 'cars.index' )->with( 'status', 'Car deleted successfully!' );
    }

    public function edit( Car $car ) {

        $car = Car::findOrFail( $car->id );

        return view( 'admin.cars.edit', compact( 'car' ) );
    }

    public function update( Request $request, $id ) {
        $car = Car::findOrFail( $id );

        $request->validate( [
            'name'             => 'required|string|max:255',
            'brand'            => 'required|string|max:255',
            'model'            => 'required|string|max:255',
            'year'             => 'required|integer|min:1900|max:' . date( 'Y' ),
            'car_type'         => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric|min:0',
            'availability'     => 'nullable|boolean',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ] );

        $car->name = $request->input( 'name' );
        $car->brand = $request->input( 'brand' );
        $car->model = $request->input( 'model' );
        $car->year = $request->input( 'year' );
        $car->car_type = $request->input( 'car_type' );
        $car->daily_rent_price = $request->input( 'daily_rent_price' );
        $car->availability = $request->input( 'availability', 0 );

        if ( $request->hasFile( 'image' ) ) {
            $car->image = $request->file( 'image' )->store( 'car_images', 'public' );
        }

        $car->save();

        return redirect()->route( 'cars.index' )->with( 'status', 'Car updated successfully!' );
    }

}
